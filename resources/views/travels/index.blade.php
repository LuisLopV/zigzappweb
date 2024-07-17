@extends('layouts.app')

@section('content')
<div class="container" id="travel-container">
    <h1 id="travel-title">Viajes</h1>
    <table class="table mt-3" id="travel-table">
        <thead>
            <tr>
                <th>Viaje</th>
                <th>Localización</th>
                <th>Destino</th>
                <th>Estado</th>
                <th>Pasajero</th>
                <th>Conductor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($travels as $index => $travel)
                <tr>
                    <td colspan="7" class="text-center"><strong>Viaje {{ $index + 1 }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $travel->location }}</td>
                    <td>{{ $travel->destination }}</td>
                    <td>{{ $travel->status->status }}</td>
                    <td>{{ $travel->passenger->user->name }}</td>
                    <td>{{ $travel->driver ? $travel->driver->user->name : 'N/A' }}</td>
                    <td>
                        @if($travel->travel_status_id == 1 && auth()->user()->profile->role_id == 2)
                            <form action="{{ route('travels.accept', $travel->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </form>
                        @elseif($travel->travel_status_id == 2 && $travel->driver_id == auth()->user()->profile->id)
                            <form action="{{ route('travels.complete', $travel->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Completar</button>
                            </form>
                        @elseif($travel->travel_status_id == 3 && $travel->passenger_id == auth()->user()->profile->id && !$travel->rating)
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#rateModal{{ $travel->id }}">
                                Calificar
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Mostrar calificación si existe -->
                @if($travel->rating)
                <tr>
                    <td colspan="5" class="text-center">
                        <strong>Calificación:</strong> {{ $travel->rating->score }} | 
                        <strong>Comentario:</strong> {{ $travel->rating->comment }}
                    </td>
                </tr>
                @endif

                <!-- Mostrar detalles de pago -->
                @foreach($travel->pays as $pay)
                <tr>
                    <td colspan="5" class="text-center">
                        <strong>Monto:</strong> {{ $pay->price }} | 
                        <strong>Tipo de Pago:</strong> {{ $pay->paymentMethod ? $pay->paymentMethod->method : 'N/A' }}
                    </td>
                </tr>
                @endforeach

                <!-- Espacio entre viajes -->
                <tr><td colspan="9" style="height: 10px;"></td></tr>

                <!-- Modal para calificar -->
                <div class="modal fade" id="rateModal{{ $travel->id }}" tabindex="-1" aria-labelledby="rateModalLabel{{ $travel->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rateModalLabel{{ $travel->id }}">Calificar Viaje</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('travels.rate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="travels_id" value="{{ $travel->id }}">

                                    <div class="mb-3">
                                        <label for="score" class="form-label">Calificación</label>
                                        <select class="form-select" id="score" name="score" required>
                                            <option value="">Selecciona una calificación</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comentario</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Enviar Calificación</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>
</div>

<style>
/* Estilos previos aquí */
</style>
@endsection







