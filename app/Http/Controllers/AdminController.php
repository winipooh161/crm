<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;

use App\Jobs\RunMigrationsJob;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $authenticatedUser = auth()->user();
        $users = User::all();

        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to perform this action.']);
        }

        return view('admin', compact('users', 'authenticatedUser'));
    }

    public function updateStatus(Request $request, $id)

    {
        $request->validate([
            'role' => 'required|in:user,admin,manager',
        ]);

        $user = User::findOrFail($id);
        $newRole = $request->role;

        if ($newRole === 'admin' && $user->role !== 'admin') {
            // Create migration and model
            $adminTableName = 'admin' . $user->id;
            $adminModelName = 'Admin' . $user->id;

            // Ensure the migrations directory exists
            $migrationPath = database_path('migrations/');
            if (!File::exists($migrationPath)) {
                File::makeDirectory($migrationPath, 0755, true);
            }

            // Migration file content
            $migrationClassName = 'Create' . ucfirst($adminTableName) . 'Table';
            $migrationFileName = date('Y_m_d_His') . '_create_' . $adminTableName . '_table.php';
            $migrationFilePath = $migrationPath . $migrationFileName;

            $migrationContent = <<<EOT
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class $migrationClassName extends Migration
{
    public function up()
    {
        Schema::create('$adminTableName', function (Blueprint \$table) {
            \$table->id();
            \$table->string('role');
            \$table->string('who');
            \$table->string('name');
            \$table->string('surname');
            \$table->string('organization')->nullable();
            \$table->string('phone')->nullable();
            \$table->string('email')->unique();
            \$table->string('password');
            \$table->json('social_links')->nullable();
            \$table->string('admin_table')->nullable();
            \$table->rememberToken();
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('$adminTableName');
    }
}
EOT;

            File::put($migrationFilePath, $migrationContent);

            // Ensure the models directory exists
            $modelPath = app_path('Models/');
            if (!File::exists($modelPath)) {
                File::makeDirectory($modelPath, 0755, true);
            }

            // Model file content
            $modelFilePath = $modelPath . "{$adminModelName}.php";

            $modelContent = <<<EOT
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class {$adminModelName} extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected \$table = '$adminTableName';

    protected \$fillable = [
        'role',
        'who',
        'name',
        'surname',
        'organization',
        'phone',
        'email',
        'password',
        'social_links',
        'admin_table',
    ];

    protected \$hidden = [
        'password',
        'remember_token',
    ];

    protected \$casts = [
        'password' => 'hashed',
        'social_links' => 'array',
    ];
}
EOT;

            File::put($modelFilePath, $modelContent);

            // Run the migration immediately after creating the files
            Artisan::call('migrate', ['--path' => 'database/migrations/' . $migrationFileName, '--force' => true]);

            // Update user's admin_table column
            $user->admin_table = $adminTableName;
        }

        // Update the user's role
        $user->role = $newRole;
        $user->save();

        return redirect()->route('admin')->with('success', 'User status successfully updated. Migrations have been run.');

    }
}
