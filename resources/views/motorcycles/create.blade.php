@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Motorcycle</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('motorcycles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="property_card_photo">Property Card Photo</label>
            <input type="file" class="form-control" name="property_card_photo" id="property_card_photo" required>
            @error('property_card_photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pdf_secure">PDF Secure</label>
            <input type="file" class="form-control" name="pdf_secure" id="pdf_secure" required>
            @error('pdf_secure')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pdf_mechanical_technician">PDF Mechanical Technician</label>
            <input type="file" class="form-control" name="pdf_mechanical_technician" id="pdf_mechanical_technician" required>
            @error('pdf_mechanical_technician')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pdf_driving_licence">PDF Driving Licence</label>
            <input type="file" class="form-control" name="pdf_driving_licence" id="pdf_driving_licence" required>
            @error('pdf_driving_licence')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Motorcycle</button>
    </form>
</div>
@endsection