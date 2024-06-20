<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('user', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.user')->with('success', 'Berhasil Masuk sebagai Admin!')->with('loggedIn', true);
            } elseif ($user->hasRole('akuntan')) {
                return redirect()->route('akuntan.index')->with('success', 'Berhasil Masuk sebagai Akuntan!')->with('loggedIn', true);
            } elseif ($user->hasRole('owner')) {
                return redirect()->route('owner.index')->with('success', 'Berhasil Masuk sebagai Owner!')->with('loggedIn', true);
            } else {
                return redirect()->route('login')->with('failed', 'Anda tidak memiliki peran yang valid!');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Username atau Password Anda salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil keluar!');
    }
}
