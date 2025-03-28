@extends('layout')

@section('title', 'Osztály módosítása')

@section('content')
    <h1>Osztály módosítása: {{ $class->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('schoolClass.update', $class->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Osztály neve:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $class->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Év:</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $class->year) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
@endsection