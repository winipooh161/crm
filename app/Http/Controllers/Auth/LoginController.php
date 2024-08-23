<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function storePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);
    
        $phone = $request->input('phone');
        session(['phone' => $phone]);
    
        return redirect()->route('verify.sms');
    }
        public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->input('phone');

        // Special phone number handling
        if ($phone === '+7 (965) 222-44-24') {
            $code = '2281'; // Fixed code
            Cache::put('sms_code_' . $phone, $code, 300);
            return redirect()->route('verify.sms')->with('phone', $phone);
        }

        // Generate and cache code
        $code = mt_rand(1000, 9999);
        Cache::put('sms_code_' . $phone, $code, 300);

        // Send SMS
        if ($this->sendSms($phone, $code)) {
            $user = \App\Models\User::where('phone', $phone)->first();
            if ($user) {
                Auth::login($user);
                Cache::forget('sms_code_' . $phone);
                return redirect()->intended('/home');
            } else {
                $request->session()->flash('phone', $phone);
                return redirect()->route('register');
            }
        } else {
            return back()->withErrors(['phone' => 'Не удалось отправить SMS. Пожалуйста, попробуйте снова.']);
        }
    }

    public function resendCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->input('phone');
        $code = mt_rand(1000, 9999);
        Cache::put('sms_code_' . $phone, $code, 300);

        if ($this->sendSms($phone, $code)) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Не удалось отправить SMS.']);
        }
    }

    private function sendSms($phone, $code)
    {
        $apiId = config('services.sms_api.key'); // Use env configuration
        $url = 'https://sms.ru/sms/send';

        try {
            $response = Http::get($url, [
                'api_id' => $apiId,
                'to' => $phone,
                'msg' => "Ваш код для входа: $code",
                'json' => 1,
            ]);

            \Log::info('SMS API response', ['response' => $response->body()]);

            return $response->successful() && $response->json('status') == 'OK';
        } catch (\Exception $e) {
            \Log::error('SMS sending exception', ['message' => $e->getMessage()]);
            return false;
        }
    }

    public function showVerifyForm()
    {
        $phone = session('phone');
        if (!$phone) {
            return redirect()->route('login')->withErrors(['phone' => 'Номер телефона не найден в сессии.']);
        }
    
        return view('auth.verify-sms')->with('phone', $phone);
    }
    

    public function verifySms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'code' => 'required|string|size:4',
        ]);

        $phone = $request->input('phone');
        $code = $request->input('code');

        $cachedCode = Cache::get('sms_code_' . $phone);

        if ($cachedCode && $cachedCode == $code) {
            $user = \App\Models\User::where('phone', $phone)->first();
            if ($user) {
                Auth::login($user);
                Cache::forget('sms_code_' . $phone);
                return redirect()->intended('/home');
            } else {
                return back()->withErrors(['phone' => 'Пользователь не найден.']);
            }
        } else {
            return back()->withErrors(['code' => 'Пожалуйста, укажите корректный код.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
