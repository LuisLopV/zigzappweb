<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/photos'), $photoName);
        } else {
            $photoName = null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoName,
        ]);

        if ($request->expectsJson()) {
            return response()->json($user, 201);
        }

        return redirect()->route('profile.create');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Login successful'], 200);
            }
            return redirect()->route('home');
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return redirect()->route('login.form');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Current password is incorrect'], 422);
            }
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Password updated successfully'], 200);
        }

        session()->flash('status', 'Contraseña cambiada exitosamente. Por favor, inicie sesión de nuevo.');
        Auth::logout();

        return redirect()->route('menssage');
    }
}
