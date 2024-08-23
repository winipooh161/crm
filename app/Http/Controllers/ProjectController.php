<?php

namespace App\Http\Controllers;

use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Метод для отображения страницы с проектами
    public function index(Request $request)
    {
        $authenticatedUser = auth()->user();
        $tableName = 'admin_table_projects' . $authenticatedUser->id;

        if (Schema::hasTable($tableName)) {
            $projects = DB::table($tableName)->get();
        } else {
            $projects = collect(); // Пустая коллекция, если таблица не существует
        }

        return view('projectCards', compact('projects', 'authenticatedUser'));
    }
    public function uploadProjectAvatar(Request $request, $projectId)
    {
        // Валидация изображения
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Максимум 2MB
        ]);
    
        $user = auth()->user();
        $tableName = 'admin_table_projects' . $user->id;
    
        // Проверяем, существует ли таблица для пользователя
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->withErrors('Таблица не найдена');
        }
    
        // Определяем путь для хранения изображения
        $baseDir = public_path('baseAdmin');
        $userDir = 'admin' . $user->id . '/projects/project_' . $projectId;
        $fullPath = $baseDir . '/' . $userDir;
    
        // Убедитесь, что директории существуют
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }
    
        // Переименовываем файл в ID пользователя
        $fileExtension = $request->file('avatar')->getClientOriginalExtension();
        $fileName = $user->id . '.' . $fileExtension;
        $newFilePath = $fullPath . '/' . $fileName;
    
        // Найдите старый аватар из базы данных
        $project = DB::table($tableName)->where('id', $projectId)->first();
        
        if ($project && !empty($project->avatar)) {
            $oldFilePath = public_path($project->avatar);
            
            // Удаляем старый аватар, если он существует
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    
        // Перемещаем новый файл в указанную директорию
        $request->file('avatar')->move($fullPath, $fileName);
    
        DB::table($tableName)
        ->where('id', $projectId)
        ->update(['avatar' => 'baseAdmin/' . $userDir . '/' . $fileName]);

    // Возвращаем JSON-ответ
    return response()->json([
        'success' => true,
        'message' => 'Аватар проекта успешно загружен',
        'avatar' => asset('baseAdmin/' . $userDir . '/' . $fileName)
    ]);
    }
    





    public function projectshow($id)
    {
        $authenticatedUser = auth()->user();
        $tableName = 'admin_table_projects' . $authenticatedUser->id;
        $taskTableName = 'admin_table_projects_quest' . $authenticatedUser->id;
        $statusTableName = 'task_statuses_' . $authenticatedUser->id;

        // Check if the project exists
        $project = DB::table($tableName)->where('id', $id)->first();

        if (!$project) {
            return redirect()->route('projectCards')->with('error', 'Проект не найден');
        }

        // Check if the statuses table exists and create default statuses if not present
        if (Schema::hasTable($statusTableName)) {
            $existingStatuses = DB::table($statusTableName)->pluck('status_name')->toArray();

            $defaultStatuses = ['начало', 'в работе', 'на правках', 'конец'];

            foreach ($defaultStatuses as $status) {
                if (!in_array($status, $existingStatuses)) {
                    DB::table($statusTableName)->insert([
                        'user_id' => $authenticatedUser->id,
                        'status_name' => $status,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        } else {
            // If the statuses table doesn't exist, create it and insert the default statuses
            $this->createStatusMigrationFile($statusTableName);
            Artisan::call('migrate', ['--force' => true]);

            DB::table($statusTableName)->insert([
                ['user_id' => $authenticatedUser->id, 'status_name' => 'начало', 'created_at' => now(), 'updated_at' => now()],
                ['user_id' => $authenticatedUser->id, 'status_name' => 'в работе', 'created_at' => now(), 'updated_at' => now()],
                ['user_id' => $authenticatedUser->id, 'status_name' => 'на правках', 'created_at' => now(), 'updated_at' => now()],
                ['user_id' => $authenticatedUser->id, 'status_name' => 'конец', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        $tasks = DB::table($taskTableName)->where('project_id', $id)->get();
        $statuses = $this->fetchStatusesFromDatabase($authenticatedUser->id);

        return view('projectshow', compact('project', 'tasks', 'statuses', 'authenticatedUser'));
    }

    public function updateTaskStatus(Request $request)
    {
        $authenticatedUser = auth()->user();
        $taskTableName = 'admin_table_projects_quest' . $authenticatedUser->id;

        $taskId = $request->input('task_id');
        $status = $request->input('status');

        // Validate status
        if (!in_array($status, $this->fetchStatusesFromDatabase($authenticatedUser->id))) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        // Update task status
        DB::table($taskTableName)->where('id', $taskId)->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Task status updated successfully']);
    }

    // Метод поиска проектов
    public function search(Request $request)
    {
        $authenticatedUser = auth()->user();
        $tableName = 'admin_table_projects' . $authenticatedUser->id;

        $query = DB::table($tableName);

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('organization', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if (Schema::hasTable($tableName)) {
            $projects = $query->get();
        } else {
            $projects = collect(); // Пустая коллекция, если таблица не существует
        }

        return response()->json($projects);
    }

    // Метод создания проекта
    public function createProject(Request $request)
    {
        $authenticatedUser = auth()->user();
        $tableName = 'admin_table_projects' . $authenticatedUser->id;
        $taskTableName = 'admin_table_projects_quest' . $authenticatedUser->id;
        $statusTableName = 'task_statuses_' . $authenticatedUser->id;

        // Проверка наличия таблиц, если нет — создаются
        if (!Schema::hasTable($tableName)) {
            $this->createMigrationFile($tableName);
            Artisan::call('migrate', ['--force' => true]);
        }

        if (!Schema::hasTable($taskTableName)) {
            $this->createTaskMigrationFile($taskTableName, $tableName);
            Artisan::call('migrate', ['--force' => true]);
        }

        if (!Schema::hasTable($statusTableName)) {
            $this->createStatusMigrationFile($statusTableName);
            Artisan::call('migrate', ['--force' => true]);
        }

        // Вставка данных в таблицу admin_table_projects$ID_АДМИНА
        DB::table($tableName)->insert([
            'role' => 'admin',
            'who' => $authenticatedUser->id,
            'name' => $request->input('name'),
            'organization' => $request->input('organization') ?? '',
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'admin_table_projects_quest' => $taskTableName, // Ссылка на связанную таблицу задач
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('project')->with('success', 'Проект успешно создан!');
    }

    // Создание файла миграции для таблицы проектов
    protected function createMigrationFile($tableName)
    {
        $migrationPath = database_path('migrations') . '/' . now()->format('Y_m_d_His') . '_create_' . $tableName . '_table.php';
        File::put($migrationPath, $this->getMigrationStub($tableName));
    }

    // Шаблон миграции для таблицы проектов
    protected function getMigrationStub($tableName)
    {
        return <<<EOT
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('$tableName', function (Blueprint \$table) {
                \$table->id();
                \$table->string('role');
                 \$table->string('avatar');
                \$table->unsignedBigInteger('who');
                \$table->string('name');
                \$table->string('organization')->nullable();
                \$table->string('phone');
                \$table->string('email');
                \$table->string('admin_table_projects_quest')->nullable(); // Ссылка на связанную таблицу задач
                \$table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('$tableName');
        }
    };
    EOT;
    }

    // Создание файла миграции для связанной таблицы задач
    protected function createTaskMigrationFile($taskTableName, $projectTableName)
    {
        $migrationPath = database_path('migrations') . '/' . now()->format('Y_m_d_His') . '_create_' . $taskTableName . '_table.php';
        File::put($migrationPath, $this->getTaskMigrationStub($taskTableName, $projectTableName));
    }

    // Шаблон миграции для связанной таблицы задач
    protected function getTaskMigrationStub($taskTableName, $projectTableName)
    {
        return <<<EOT
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('$taskTableName', function (Blueprint \$table) {
                \$table->id();
                \$table->string('name');
                \$table->text('description');
                \$table->unsignedBigInteger('who');
                \$table->unsignedBigInteger('project_id');
                \$table->foreign('project_id')->references('id')->on('$projectTableName')->onDelete('cascade');
                \$table->string('status')->default('todo'); // Добавлено поле для статуса задачи
                \$table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('$taskTableName');
        }
    };
    EOT;
    }

    // Создание файла миграции для таблицы статусов задач
    protected function createStatusMigrationFile($statusTableName)
    {
        $migrationPath = database_path('migrations') . '/' . now()->format('Y_m_d_His') . '_create_' . $statusTableName . '_table.php';
        File::put($migrationPath, $this->getStatusMigrationStub($statusTableName));
    }

    // Шаблон миграции для таблицы статусов задач
    protected function getStatusMigrationStub($statusTableName)
    {
        return <<<EOT
    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('$statusTableName', function (Blueprint \$table) {
                \$table->id();
                \$table->unsignedBigInteger('user_id');
                \$table->string('status_name');
                \$table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('$statusTableName');
        }
    };
    EOT;
    }
    protected function fetchStatusesFromDatabase($userId)
    {
        return DB::table('task_statuses_' . $userId)->pluck('status_name')->toArray();
    }

    // Метод создания задачи
    public function createQuest(Request $request)
    {
        $authenticatedUser = auth()->user();
        $tableName = 'admin_table_projects' . $authenticatedUser->id;

        // Check if project exists
        $projectId = $request->input('project_id');
        $projectExists = DB::table($tableName)->where('id', $projectId)->exists();

        if (!$projectExists) {
            return redirect()->back()->with('error', 'Проект не найден');
        }

        // Create task and save it in the task table
        $taskTableName = 'admin_table_projects_quest' . $authenticatedUser->id;

        if (!Schema::hasTable($taskTableName)) {
            return redirect()->back()->with('error', 'Таблица задач не найдена');
        }

        // Get the first status
        $statusTableName = 'task_statuses_' . $authenticatedUser->id;
        $firstStatus = DB::table($statusTableName)->orderBy('created_at')->value('status_name');

        if (!$firstStatus) {
            $firstStatus = 'todo'; // Default status if no statuses are found
        }

        DB::table($taskTableName)->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'who' => $authenticatedUser->id,
            'project_id' => $projectId,
            'status' => $firstStatus, // Set to first status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Задача успешно создана!');
    }
    public function addStatus(Request $request)
    {
        $authenticatedUser = auth()->user();
        $statusTableName = 'task_statuses_' . $authenticatedUser->id;

        $statusName = $request->input('status_name');

        // Validate status
        if (empty($statusName) || strlen($statusName) > 255) {
            return response()->json(['error' => 'Invalid status name'], 400);
        }

        // Retrieve current statuses
        $statuses = DB::table($statusTableName)->pluck('status_name')->toArray();

        // Check if status already exists
        if (in_array($statusName, $statuses)) {
            return response()->json(['error' => 'Status already exists'], 400);
        }

        // Add new status
        DB::table($statusTableName)->insert([
            'user_id' => $authenticatedUser->id,
            'status_name' => $statusName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Status added successfully', 'status_name' => $statusName]);
    }

    public function getStatuses(Request $request)
    {
        $authenticatedUser = auth()->user();

        if ($authenticatedUser) {
            // Fetch statuses from a user-specific table if the user is authenticated
            $statuses = DB::table('task_statuses_' . $authenticatedUser->id)
                ->pluck('status_name');
        } else {
            // Fallback to fetching all statuses from the Status model if not authenticated
            $statuses = Status::all()->pluck('name'); // Assuming Status model has a 'name' attribute
        }

        return response()->json($statuses);
    }
    public function getTasks($project_id)
    {
        $authenticatedUser = auth()->user();
        $taskTableName = 'admin_table_projects_quest' . $authenticatedUser->id;

        $tasks = DB::table($taskTableName)
            ->where('project_id', $project_id)
            ->get();

        return response()->json($tasks);
    }
}
