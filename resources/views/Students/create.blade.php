<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.student_add') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>{{ __('messages.student_add') }}</h1>

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

      
        <div class="form-group">
            <label for="name">{{ __('messages.students') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        
        <div class="form-group">
            <label for="gender">{{ __('messages.gender') }}</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">{{ __('messages.select_gender') }}</option>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>{{ __('messages.m') }}</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>{{ __('messages.f') }}</option>
            </select>
        </div>

        
        <div class="form-group">
        <label for="class_id">{{ __('messages.select_class') }}</label>
            <select name="class_id" id="class_id" required>
                <option value="">{{ __('messages.select_class') }}</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="year">{{ __('messages.year') }}</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>
</body>
</html>
