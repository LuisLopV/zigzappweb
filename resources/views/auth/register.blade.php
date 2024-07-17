@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-card text-center">
        <h1 class="profile-title">Datos Usuario</h1>

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="photo" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
                <div class="text-center mt-3">
                    <img id="photo-preview" src="#" alt="Previsualización de la foto de perfil" class="rounded-circle" style="display:none; max-width: 150px; height: auto; margin: 0 auto;">
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirma tu contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
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

    #photo-preview {
        display: block; /* Aseguramos que esté centrado */
        margin-left: auto;
        margin-right: auto;
    }
</style>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection