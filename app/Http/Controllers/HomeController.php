<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::all();
        $authenticatedUser = auth()->user();
        $adminTable = $authenticatedUser->admin_table;
        
        $adminUsers = [];
        
        if ($adminTable) {
            $modelClass = 'App\\Models\\' . ucfirst($adminTable);
    
            if (class_exists($modelClass)) {
                $query = $modelClass::query();
                
                // Filtering and search based on request parameters
                if ($request->filled('search')) {
                    $search = $request->input('search');
                    $query->where(function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('surname', 'like', '%' . $search . '%')
                          ->orWhere('organization', 'like', '%' . $search . '%')
                          ->orWhere('phone', 'like', '%' . $search . '%');
                    });
                }
                
                if ($request->filled('filter')) {
                    $filter = $request->input('filter');
                    switch ($filter) {
                        case 'date':
                            $query->orderBy('created_at', 'desc');
                            break;
                    }
                }
                
                $adminUsers = $query->get();
            }
        }
        
        // Get users from the default table for other user views
        $users = User::where('who', auth()->id())->get();
    
        return view('home', compact('users', 'authenticatedUser', 'adminUsers'));
    }
    
    
    public function addUser(Request $request)
    {
        $users = User::all();
        // Ensure the user is an admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to perform this action.']);
        }
    
        $authenticatedUser = auth()->user();
        $adminTable = $authenticatedUser->admin_table;
    
        if (!$adminTable) {
            return redirect()->back()->withErrors(['error' => 'Admin table not found.']);
        }
    
        $modelClass = 'App\\Models\\' . ucfirst($adminTable);
    
        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['error' => 'Invalid admin table model.']);
        }
    
        // Prepare data from the request
        $data = $request->only([
            'name',
            'surname',
            'organization',
            'phone',
            'email',
            'social_links'
        ]);
    
        // Add the admin ID (who field) and default role
        $data['who'] = $authenticatedUser->id;
        $data['role'] = 'user'; // Only if applicable
    
        // Generate the password
        $data['password'] = 'admincreate' . $authenticatedUser->id;
    
        // Ensure password is hashed before saving
        $data['password'] = bcrypt($data['password']);
    
        // Create a new record in the dynamically specified table
        $modelClass::create($data);
    
        return redirect()->route('home')->with('success', 'User added successfully.');
        
    }
   // HomeController.php
   public function profileClient($id)
   {
       // Получите текущего аутентифицированного пользователя
       $authenticatedUser = auth()->user();
       $adminTable = $authenticatedUser->admin_table;
   
       // Если админ таблица не указана, вернуть ошибку или перенаправление
       if (!$adminTable) {
           return redirect()->route('home')->withErrors(['error' => 'Admin table not found.']);
       }
   
       // Определите модель класса для таблицы администратора
       $modelClass = 'App\\Models\\' . ucfirst($adminTable);
   
       // Проверьте, существует ли класс модели
       if (!class_exists($modelClass)) {
           return redirect()->route('home')->withErrors(['error' => 'Invalid admin table model.']);
       }
   
       // Найдите пользователя по ID в указанной таблице
       $user = $modelClass::findOrFail($id);
   
       // Передайте информацию о пользователе в представление
       return view('profileClient', ['user' => $user]);
   }


  

}
