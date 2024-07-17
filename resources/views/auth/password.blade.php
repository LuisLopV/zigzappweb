@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Contraseña actual</label>
            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_password">Nueva contraseña</label>
            <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirmar nueva contraseña</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
    </form>
</div>
@endsection