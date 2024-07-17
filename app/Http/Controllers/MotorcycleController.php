<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use App\Models\Profile;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    public function create(Request $request)
    {
        $profiles = Profile::all();
        if ($request->expectsJson()) {
            return response()->json(['profiles' => $profiles]);
        }
        return view('motorcycles.create', compact('profiles'));
    }

    public function store(Request $request)
    {
        // Validar y almacenar los datos de la nueva motocicleta
        $data = $request->validate([
            'property_card_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:24576', // Acepta solo imágenes
            'pdf_secure' => 'required|file|mimes:pdf|max:24576',
            'pdf_mechanical_technician' => 'required|file|mimes:pdf|max:24576',
            'pdf_driving_licence' => 'required|file|mimes:pdf|max:24576',
        ]);

        // Obtener el último perfil registrado
        $latestProfile = Profile::latest()->first();

        if (!$latestProfile) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No profiles found. Please create a profile first.'], 400);
            }
            return redirect()->back()->with('error', 'No profiles found. Please create a profile first.');
        }

        // Asignar el profile_id al dato
        $data['profile_id'] = $latestProfile->id;

        // Manejar la subida de archivos
        if ($request->hasFile('property_card_photo')) {
            $imageName = $request->file('property_card_photo')->store('uploads/photos', 'public');
            $data['property_card_photo'] = $imageName; // Guardar la ruta de la imagen en $data
        }

        if ($request->hasFile('pdf_secure')) {
            $data['pdf_secure'] = $request->file('pdf_secure')->store('uploads/pdfs', 'public');
        }

        if ($request->hasFile('pdf_mechanical_technician')) {
            $data['pdf_mechanical_technician'] = $request->file('pdf_mechanical_technician')->store('uploads/pdfs', 'public');
        }

        if ($request->hasFile('pdf_driving_licence')) {
            $data['pdf_driving_licence'] = $request->file('pdf_driving_licence')->store('uploads/pdfs', 'public');
        }

        // Crear una nueva motocicleta en la base de datos
        $motorcycle = Motorcycle::create($data);

        if ($request->expectsJson()) {
            return response()->json(['motorcycle' => $motorcycle], 201);
        }

        // Redirigir con éxito
        return redirect()->route('login.form')->with('success', 'Motorcycle documents uploaded successfully.');
    }
}