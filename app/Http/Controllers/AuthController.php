<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashboard.login');
    }
    public function regist()
    {
        return view('dashboard.register');
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Alert::success('Congrats', 'Login Successfully');
            return redirect('/dashboard');
        }else {
            Alert::error('Error', 'Failed Login');
            return redirect('/login');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required', 'string', 'email', 'max:255',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3
        ]);
        Alert::success('Congrats', 'Register Successfully');
        return redirect('/login');
    }
}
