@extends('layouts.app')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contraseña Actualizada</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        /* Estilos específicos para la página de confirmación de contraseña actualizada */

        .password-updated-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .password-updated-card {
            width: 400px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            background-color: #ffffff;
        }

        .password-updated-card h3 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .password-updated-card p {
            margin-bottom: 15px;
            color: #555555;
        }

        .password-updated-card .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .password-updated-card .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="password-updated-container">
        <div class="password-updated-card">
            <h3>Contraseña Actualizada</h3>
            <p>Tu contraseña se actualizó sin problemas.</p>
            <p>Vuelve a iniciar sesión para continuar.</p>
            <a href="{{ route('login.form') }}" class="btn btn-primary">Iniciar Sesión</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (for optional usage) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js" integrity="sha384-+6EVo3wSvni4/xALk5vO6L6bcTcRZ4zj6aXJwsqG0y06iG/JPhdsENThswF5A+03" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+UbhYYLXD2NOOvOoBaqYS1MFeFkXp2xXuuU" crossorigin="anonymous"></script>
</body>
</html>


@endsection