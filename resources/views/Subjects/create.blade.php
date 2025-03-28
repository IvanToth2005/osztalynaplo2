@extends('layouts.app')

@section('content')
<h1>Új Tárgy Létrehozása</h1>

<form action="{{ route('subjects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tárgy Neve</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Létrehozás</button>
</form>
@endsection