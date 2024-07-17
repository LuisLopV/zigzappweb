<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $role = $profile->role->name;

        if ($role == 'Conductor') {
            $motorcycle = $profile->motorcycle;
            if ($request->expectsJson()) {
                return response()->json(['user' => $user, 'profile' => $profile, 'motorcycle' => $motorcycle]);
            }
            return view('profile.conductor', compact('user', 'profile', 'motorcycle'));
        } elseif ($role == 'Pasajero') {
            if ($request->expectsJson()) {
                return response()->json(['user' => $user, 'profile' => $profile]);
            }
            return view('profile.pasajero', compact('user', 'profile'));
        }

        return redirect('/login')->with('error', 'No eres un usuario autorizado.');
    }

    public function create(Request $request)
    {
        $roles = Role::all();
        if ($request->expectsJson()) {
            return response()->json(['roles' => $roles]);
        }
        return view('profile.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'secondname' => 'nullable|string|max:255',
            'firstlastname' => 'required|string|max:255',
            'secondlastname' => 'nullable|string|max:255',
            'rh' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'cell_number' => 'nullable|numeric',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user_id = User::latest()->first()->id;

        $profile = Profile::create([
            'firstname' => $request->firstname,
            'secondname' => $request->secondname,
            'firstlastname' => $request->firstlastname,
            'secondlastname' => $request->secondlastname,
            'rh' => $request->rh,
            'date_of_birth' => $request->date_of_birth,
            'cell_number' => preg_replace('/[^0-9]/', '', $request->cell_number),
            'user_id' => $user_id,
            'role_id' => $request->role_id,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['profile' => $profile], 201);
        }

        if ($request->role_id == 2) {
            return redirect()->route('motorcycles.create', ['profile' => $profile->id]);
        }
        
        return redirect()->route('login.form');
    }

    public function edit(Request $request, $id)
    {
        $profile = Profile::find($id);
        $motorcycle = $profile->motorcycle;

        if ($request->expectsJson()) {
            return response()->json(['profile' => $profile, 'motorcycle' => $motorcycle]);
        }

        return view('profile.edit', compact('profile', 'motorcycle'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'secondname' => 'nullable|string|max:255',
            'firstlastname' => 'required|string|max:255',
            'secondlastname' => 'nullable|string|max:255',
            'rh' => 'required|string|max:255',
            'cell_number' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
        ]);

        $profile->update($request->except([]));

        if ($profile->role->name == 'Conductor') {
            $motorcycle = $profile->motorcycle;
            if ($motorcycle) {
                if ($request->hasFile('property_card_photo')) {
                    $propertyCardName = time() . '_property.' . $request->property_card_photo->extension();
                    $motorcycle->property_card_photo = $request->file('property_card_photo')->storeAs('card_property', $propertyCardName, 'public');
                }

                if ($request->hasFile('pdf_secure')) {
                    $motorcycle->pdf_secure = $request->file('pdf_secure')->store('uploads/pdfs', 'public');
                }

                if ($request->hasFile('pdf_mechanical_technician')) {
                    $motorcycle->pdf_mechanical_technician = $request->file('pdf_mechanical_technician')->store('uploads/pdfs', 'public');
                }

                if ($request->hasFile('pdf_driving_licence')) {
                    $motorcycle->pdf_driving_licence = $request->file('pdf_driving_licence')->store('uploads/pdfs', 'public');
                }

                $motorcycle->save();
            }
        }

        $profile->save();

        if ($request->expectsJson()) {
            return response()->json(['profile' => $profile]);
        }

        return redirect()->route('profile.index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $user = $profile->user;

        if ($profile->motorcycle) {
            $profile->motorcycle->delete();
        }

        $profile->delete();
        $user->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Perfil y usuario eliminados correctamente']);
        }

        return redirect('/')->with('success', 'Perfil y usuario eliminados correctamente');
    }
}


    


