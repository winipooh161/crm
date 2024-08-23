<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $authenticatedUser = auth()->user();
        $users = User::all();  // Assuming you need this for some other part of the view
        
        return view('profile', compact('users', 'authenticatedUser'))
            ->with('user', $authenticatedUser); // Pass the authenticated user as 'user'
    }
   public function uploadPhoto(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Валидация изображения
    ]);

    $user = auth()->user();

    // Определяем путь для хранения изображения
    $baseDir = public_path('baseAdmin');
    $adminDir = 'admin' . $user->id . '/ava';
    $fullPath = $baseDir . '/' . $adminDir;

    // Убедитесь, что директории существуют
    if (!file_exists($fullPath)) {
        mkdir($fullPath, 0777, true);
    }

    // Определяем имя файла с временной меткой
    $fileName = 'avatar_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();

    // Перемещаем файл в указанную директорию
    $request->file('avatar')->move($fullPath, $fileName);

    // Опционально, удаляем старый аватар, если он существует
    if ($user->avatar && file_exists(public_path($user->avatar))) {
        unlink(public_path($user->avatar));
    }

    // Сохраняем путь к новому аватару в базе данных
    $user->avatar = 'baseAdmin/' . $adminDir . '/' . $fileName;
    $user->save();

    return redirect()->route('profile')->with('success', 'Фотография успешно загружена');
}
public function saveNotes(Request $request)
{
    $user = auth()->user();

    // Validate the incoming request if necessary
    $request->validate([
        'notes' => 'required|string|max:10000', // Adjust validation rules as needed
    ]);

    // Save the notes to the user's profile
    $user->notes = $request->input('notes');
    $user->save();

    return response()->json(['success' => true, 'message' => 'Notes updated successfully']);
}
}

    
    
  

