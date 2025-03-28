@extends('layout')

@section('title', 'Új osztály hozzáadása')

@section('content')
    <h1>Új osztály hozzáadása</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('schoolClass.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Osztály neve:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Év:</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ old('year') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
@endsection
