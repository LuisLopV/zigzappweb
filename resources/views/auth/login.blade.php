@extends('layouts.app')

@section('content')
<div class="login-container">
<div class="sidenav">
    <div class="fade-container">
        <img src="{{ asset('login.jpg') }}" alt="Descripción de la imagen" class="fade-image">
        <div class="fade-text">Bienvenidos a ZigZapp</div>
    </div>
</div>
    <div class="main">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="login-form">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required value="{{ old('email') }}" aria-label="Correo Electrónico">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required aria-label="Contraseña">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-black">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.login-container {
    display: flex;
    min-height: calc(60vh - 100px); /* Ajusta este valor según la altura de tu navbar */
    padding-left: 100px;
}


.sidenav {
    width: 45%; /* Ajusta el ancho según sea necesario */
    background-color: #000; /* Fondo negro */
    padding-top: 10px; /* Espaciado superior */
    overflow: hidden; /* Oculta cualquier contenido que se desborde */
    position: relative; /* Para posicionar correctamente los elementos */
}

.fade-container {
    position: relative; /* Contenedor para la imagen y el texto */
    width: 100%;
    height: auto; /* Ajusta la altura según el contenido */
}

.fade-image {
    width: 100%; /* Ajusta la imagen al contenedor */
    height: auto; /* Mantiene la proporción */
    transition: opacity 2s ease; /* Transición de opacidad */
}

.fade-text {
    position: absolute;
    top: 10%; /* Centra verticalmente */
    left: 50%; /* Centra horizontalmente */
    transform: translate(-50%, -50%); /* Ajusta para el centrado exacto */
    font-size: 48px; /* Tamaño del texto */
    font-weight: bold; /* Texto en negrita */
    opacity: 0; /* Inicialmente invisible */
    transition: opacity 2s ease; /* Transición de opacidad */
    color: #ffffff; /* Color del texto */
    white-space: nowrap; /* Evita que el texto se rompa en múltiples líneas */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra de texto sutil */
    animation: text-appear 2s ease-in-out forwards; /* Animación de entrada */
}

@keyframes text-appear {
    0% {
        opacity: 0;
        transform: translate(-50%, -60%);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

.fade-container:hover .fade-image {
    opacity: 0; /* Desvanece la imagen al pasar el mouse */
}

.fade-container:hover .fade-text {
    opacity: 1; /* Muestra el texto al pasar el mouse */
}


.main {
    width: 50%;
    padding-top: 120px;
    
}


.btn-black {
    background-color: #1e30f3 !important;
    color: #fff;
}

@media screen and (max-width: 767px) {
    .login-container {
        flex-direction: column;
    }
    .sidenav, .main {
        width: 100%;
    }
    .sidenav {
        height: auto;
        padding-bottom: 20px;
    }
    .main {
        margin-left: 0;
    }
}
</style>
@endpush
