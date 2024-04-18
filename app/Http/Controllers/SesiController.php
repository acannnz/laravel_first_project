<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class SesiController extends Controller
{
    function index()
    {
        return view('index');
    }
    function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ], [
            'name.required' => 'Username wajib Diisi',
            'password.required' => 'Password wajib Diisi'
        ]);

        $infologin = [
            'name' => $request->name,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            $request->session()->regenerate();
            $get = Users::find(Auth::user()->id);
            $session = [
                'id' => $get->id,
                'name' => $get->name,
                'email' => $get->email,
                'role' => $get->role,
            ];
            $request->session()->put($session);
            if (Auth::user()->role == 'admin') {
                return redirect('/home');
            } elseif (Auth::user()->role == 'user') {
                return redirect('/user');
            }
        } else {
            return redirect('')->withErrors('GAGAL LOGIN')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
