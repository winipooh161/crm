<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Jobs\RunMigrationsJob;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


public function updateStatus(Request $request, $id)
{
    // ... existing logic ...

    if ($newRole === 'admin' && $user->role !== 'admin') {
        // ... generate files ...

        // Dispatch job to run migrations
        RunMigrationsJob::dispatch();
        
        // Update user's admin_table column
        $user->admin_table = $adminTableName;
    }

    $user->role = $newRole;
    $user->save();

    return redirect()->route('admin')->with('success', 'Статус пользователя успешно обновлен. Миграции запущены.');
}

}
