@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-card text-center">
        <h1 class="profile-title">PERFIL</h1>
        <div class="profile-image">
            @if ($user->photo)
                <img src="{{ asset('uploads/photos/' . $user->photo) }}" alt="Foto de Usuario" class="img-fluid rounded-circle" width="150">
            @else
                <p>No disponible</p>
            @endif
        </div>
        <br>

        <h3 class="profile-name">{{ $profile->firstname }} {{ $profile->secondname }} {{ $profile->firstlastname }} {{ $profile->secondlastname }}</h3>
        <p class="profile-info"><strong>Email</strong> <br> {{ $user->email }}</p>
        <p class="profile-info"><strong>Celular</strong> <br> {{ $profile->cell_number }}</p>
        <p class="profile-info"><strong>Fecha de Nacimiento</strong> <br> {{ $profile->date_of_birth }}</p>
        <p class="profile-info"><strong>Tipo de Sangre</strong> <br> {{ $profile->rh }}</p>
        <br>

        <div class="profile-card text-center">
            <h1 class="profile-title">MOTOCICLETA</h1>
            @if ($motorcycle)
                <div class="text-center mb-3">
                    <strong>Tarjeta De Propiedad</strong>
                    <br>
                    <div class="mt-2">
                        @if ($motorcycle->property_card_photo)
                            <img src="{{ asset('storage/' . $motorcycle->property_card_photo) }}" alt="Foto de Propiedad Tarjeta" class="img-fluid rounded" style="max-width: 450px; height: auto;">
                        @else
                            <p>No disponible</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mb-3">
                    <strong>PDF Seguro</strong>
                    <div class="mt-2">
                        @if ($motorcycle->pdf_secure)
                            <embed src="{{ asset('storage/' . $motorcycle->pdf_secure) }}" type="application/pdf" width="100%" height="400px" />
                        @else
                            <p>No disponible</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mb-3">
                    <strong>Técnico Mecánico PDF</strong>
                    <div class="mt-2">
                        @if ($motorcycle->pdf_mechanical_technician)
                            <embed src="{{ asset('storage/' . $motorcycle->pdf_mechanical_technician) }}" type="application/pdf" width="100%" height="400px" />
                        @else
                            <p>No disponible</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mb-3">
                    <strong>Licencia de Conducción PDF</strong>
                    <div class="mt-2">
                        @if ($motorcycle->pdf_driving_licence)
                            <embed src="{{ asset('storage/' . $motorcycle->pdf_driving_licence) }}" type="application/pdf" width="100%" height="400px" />
                        @else
                            <p>No disponible</p>
                        @endif
                    </div>
                </div>
            @else
                <p>No hay información de motocicleta.</p>
            @endif
        </div>
        <br>

        <div class="button-group text-center">
            <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-primary">Editar Perfil</a>
            <a href="{{ route('password.change') }}" class="btn btn-warning">Cambiar Contraseña</a>
            <form action="{{ route('profile.destroy', $profile->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Perfil</button>
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
            color: white;
        }
        
        .profile-title {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .profile-name {
            font-size: 1.5rem;
            margin: 10px 0;
        }

        .profile-info {
            font-size: 1.1rem;
            margin: 5px 0;
        }

        .profile-image img {
            border: 3px solid #007BFF;
            border-radius: 50%;
        }

        .button-group .btn {
            margin: 5px;
        }

        .btn-primary {
            background-color: #007BFF;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
    </style>
@endsection
