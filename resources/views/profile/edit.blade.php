@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-card text-center">
        <h1 class="profile-title">Editar Perfil </h1>

        <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="firstname" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="firstname" value="{{ $profile->firstname }}" required>
            </div>

            <div class="mb-3">
                <label for="secondname" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="secondname" value="{{ $profile->secondname }}">
            </div>

            <div class="mb-3">
                <label for="firstlastname" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="firstlastname" value="{{ $profile->firstlastname }}" required>
            </div>

            <div class="mb-3">
                <label for="secondlastname" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="secondlastname" value="{{ $profile->secondlastname }}">
            </div>

            <div class="mb-3">
                <label for="rh" class="form-label">Tipo de Sangre</label>
                <select name="rh" id="rh" class="form-select">
                    <option value="">Seleccionar</option>
                    <option value="A+" {{ $profile->rh == 'A+' ? 'selected' : '' }}>A+</option>
                    <option value="A-" {{ $profile->rh == 'A-' ? 'selected' : '' }}>A-</option>
                    <option value="B+" {{ $profile->rh == 'B+' ? 'selected' : '' }}>B+</option>
                    <option value="B-" {{ $profile->rh == 'B-' ? 'selected' : '' }}>B-</option>
                    <option value="O+" {{ $profile->rh == 'O+' ? 'selected' : '' }}>O+</option>
                    <option value="O-" {{ $profile->rh == 'O-' ? 'selected' : '' }}>O-</option>
                    <option value="AB+" {{ $profile->rh == 'AB+' ? 'selected' : '' }}>AB+</option>
                    <option value="AB-" {{ $profile->rh == 'AB-' ? 'selected' : '' }}>AB-</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="date_of_birth" value="{{ $profile->date_of_birth }}" required>
            </div>

            <div class="mb-3">
                <label for="cell_number" class="form-label">Número de Celular</label>
                <input type="text" class="form-control" name="cell_number" value="{{ $profile->cell_number }}">
            </div>

            

            @if ($profile->role->name == 'Conductor')
    <h3>Motocicleta</h3>
    
    <div class="mb-3">
    <label for="property_card_photo" class="form-label">Tarjeta de Propiedad</label>
    <div class="text-center">
        @if ($motorcycle->property_card_photo)
            <img src="{{ asset('storage/' . $motorcycle->property_card_photo) }}" alt="Foto de Tarjeta de Propiedad" class="img-fluid" style="max-width: 150px;">
        @else
            <p>No disponible</p>
        @endif
    </div>
    <br>
    <input type="file" class="form-control" name="property_card_photo">
</div>

    <div class="mb-3">
        <label for="pdf_secure" class="form-label">PDF de Seguridad</label>
        @if ($motorcycle->pdf_secure)
            <a href="{{ asset('storage/' . $motorcycle->pdf_secure) }}" target="_blank">Ver PDF de Seguridad</a>
        @endif
        <input type="file" class="form-control" name="pdf_secure">
    </div>

    <div class="mb-3">
        <label for="pdf_mechanical_technician" class="form-label">PDF de Técnico Mecánico</label>
        @if ($motorcycle->pdf_mechanical_technician)
            <a href="{{ asset('storage/' . $motorcycle->pdf_mechanical_technician) }}" target="_blank">Ver PDF de Técnico Mecánico</a>
        @endif
        <input type="file" class="form-control" name="pdf_mechanical_technician">
    </div>

    <div class="mb-3">
        <label for="pdf_driving_licence" class="form-label">PDF de Licencia de Conducir</label>
        @if ($motorcycle->pdf_driving_licence)
            <a href="{{ asset('storage/' . $motorcycle->pdf_driving_licence) }}" target="_blank">Ver PDF de Licencia de Conducir</a>
        @endif
        <input type="file" class="form-control" name="pdf_driving_licence">
    </div>
@endif

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

<style>
    body {
        background-image: url('{{ asset('fondo.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .profile-card {
        background-color: rgba(0, 0, 0, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        text-align: center;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        color: white; /* Texto en blanco para contraste */
    }

    .profile-title {
        font-size: 2rem; /* Título más grande */
        margin-bottom: 15px;
    }
</style>
@endsection