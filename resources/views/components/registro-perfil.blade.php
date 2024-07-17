<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: auto;
        }
        .form-header {
            background: #007bff;
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <div class="form-header">
                    <h1 class="mb-0">Create Profile</h1>
                </div>
                <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="secondname">Second Name:</label>
                        <input type="text" id="secondname" name="secondname" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="firstlastname">First Last Name:</label>
                        <input type="text" id="firstlastname" name="firstlastname" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="secondlastname">Second Last Name:</label>
                        <input type="text" id="secondlastname" name="secondlastname" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="autoSizingSelect">RH:</label>
                        <select class="form-select form-control" id="autoSizingSelect" name="rh" required>
                            <option selected>Selecciona</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cell_number">Cell Number:</label>
                        <input type="text" id="cell_number" name="cell_number" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="role_id">Role:</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Save Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


