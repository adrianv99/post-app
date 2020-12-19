<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    public function __construct()
    {
        // just can get access to this controller when user is a guest
        $this->middleware(['guest']);
    }

    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));
        
        return redirect()->route('dashboard');

    }
}
