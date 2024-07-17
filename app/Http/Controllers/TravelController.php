<?php

namespace App\Http\Controllers;
use App\Models\Travel; 
use App\Models\PaymentMethod;
use App\Models\Rating;
use App\Models\Profile;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->user()->profile->id;

        // Obtener viajes visibles solo para el pasajero que lo creó y el conductor que lo aceptó
        $travels = Travel::where('passenger_id', $userId)
            ->orWhere('driver_id', $userId)
            ->orWhere('travel_status_id', 1) // Solo si el viaje está disponible
            ->get();

        if ($request->expectsJson()) {
            return response()->json(['travels' => $travels]);
        }

        return view('travels.index', compact('travels'));
    }

    public function create(Request $request)
    {
        $drivers = Profile::where('role_id', 2)->get(); // Conductores
        $paymentMethods = PaymentMethod::all(); // Métodos de pago

        if ($request->expectsJson()) {
            return response()->json(['drivers' => $drivers, 'paymentMethods' => $paymentMethods]);
        }

        return view('travels.create', compact('drivers', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'destination' => 'required|string',
            'price' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        // Obtener el ID del pasajero autenticado
        $passengerId = auth()->user()->profile->id;

        // Crear el viaje
        $travel = Travel::create([
            'location' => $request->location,
            'destination' => $request->destination,
            'passenger_id' => $passengerId,
            'travel_status_id' => 1, // Cambia esto según tu lógica
        ]);

        // Guardar el pago asociado al viaje
        $travel->pays()->create([
            'price' => $request->price,
            'payment_method_id' => $request->payment_method_id,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['travel' => $travel], 201);
        }

        return redirect()->route('travels.index')->with('success', 'Viaje creado con éxito');
    }

    public function accept(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);
        $travel->update([
            'driver_id' => auth()->user()->profile->id,
            'travel_status_id' => 2, // Cambia a 'En curso' o similar
        ]);

        if ($request->expectsJson()) {
            return response()->json(['travel' => $travel]);
        }

        return redirect()->route('travels.index')->with('success', 'Viaje aceptado con éxito');
    }

    public function complete(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);
        $travel->complete();

        if ($request->expectsJson()) {
            return response()->json(['travel' => $travel]);
        }

        return redirect()->route('travels.index')->with('success', 'Has completado el viaje.');
    }

    public function rate(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'travels_id' => 'required|exists:travels,id',
        ]);

        // Obtén el perfil del pasajero autenticado
        $qualifierId = auth()->user()->profile->id;

        // Encuentra el viaje y el pasajero asociado
        $travel = Travel::findOrFail($validated['travels_id']);

        // Asegúrate de que el pasajero que califica es el mismo que el asociado al viaje
        if ($travel->passenger_id !== $qualifierId) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No tienes permiso para calificar este viaje.'], 403);
            }
            return redirect()->route('travels.index')->with('error', 'No tienes permiso para calificar este viaje.');
        }

        $rating = Rating::create([
            'score' => $validated['score'],
            'comment' => $validated['comment'],
            'qualified_id' => $travel->driver_id, // Asumiendo que calificas al conductor
            'travels_id' => $validated['travels_id'],
            'qualifier_id' => $qualifierId, // El calificador es el pasajero autenticado
        ]);

        if ($request->expectsJson()) {
            return response()->json(['rating' => $rating]);
        }

        return redirect()->route('travels.index')->with('success', 'Calificación enviada correctamente.');
    }
}