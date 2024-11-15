<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        // Cek role user dan arahkan sesuai rolenya
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard.index'));
        }

        // Jika bukan admin, arahkan ke welcome
        return redirect()->route('welcome');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override logout method untuk mengarahkan ke welcome setelah logout
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
