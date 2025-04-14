@extends('layout')

@section('content')
<div class="container">
    <h1>{{ __('messages.students') }}</h1>
    
    <div class="row mb-4">
        <div class="col-md-6">
            <label for="year" class="form-label">{{ __('messages.year') }}</label>
            <select class="form-select" id="year">
                <option value="">{{ __('messages.select_year') }}</option>
                @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-6">
            <label for="class" class="form-label">{{ __('messages.class') }}</label>
            <select class="form-select" id="class" disabled>
                <option value="">{{ __('messages.select_class') }}</option>
            </select>
        </div>
        
    </div>
    
    <h2>{{ __('messages.students') }}</h2>
    <div id="errorMessage" class="text-danger" style="display: none;"></div>
    <ul id="studentsList" class="list-group"></ul>
    @if(auth()->check())
    <a href="{{ route('students.create') }}" class="btn btn-primary mt-3">{{ __('messages.student_add') }}</a>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection