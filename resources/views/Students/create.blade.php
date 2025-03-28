<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Add New Student</h1>

    <!-- Hibák megjelenítése -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <!-- Tanuló neve -->
        <div class="form-group">
            <label for="name">Tanuló neve:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Nem kiválasztása -->
        <div class="form-group">
            <label for="gender">Nem:</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">Válassz nemet</option>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Férfi</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Nő</option>
            </select>
        </div>

        <!-- Osztály kiválasztása -->
        <div class="form-group">
        <label for="class_id">Válassz osztályt:</label>
            <select name="class_id" id="class_id" required>
                <option value="">Válassz osztályt</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="year">Év:</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
</div>
</body>
</html>
