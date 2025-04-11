
@extends('layout')

@section('content')
<div class="container">
    <h1>{{ __('messages.subject') }}</h1>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <label for="year" class="form-label">{{ __('messages.year') }}</label>
            <select class="form-select" id="year">
                <option value="">{{ __('messages.select_year') }}</option>
                @foreach($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-4">
            <label for="class" class="form-label">{{ __('messages.class') }}</label>
            <select class="form-select" id="class" disabled>
                <option value="">{{ __('messages.select_year_first') }}</option>
            </select>
        </div>
        
        <div class="col-md-4">
            <label for="subject" class="form-label">{{ __('messages.subject') }}</label>
            <select class="form-select" id="subject" disabled>
                <option value="">{{ __('messages.select_class_first') }}</option>
            </select>
        </div>
    </div>
    
    <button id="showResults" class="btn btn-primary" disabled>{{ __('messages.results') }}</button>
</div>


<script>
    const getClassesUrl = "{{ route('subjects.get-classes', '') }}";
    const getSubjectsUrl = "{{ route('subjects.get-subjects', '') }}";
    const showResultsUrl = "{{ route('subjects.show-results') }}";
    const csrfToken = "{{ csrf_token() }}";  
</script>
 
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

@endsection