@extends('layout')

@section('content')
<div class="container">
    <h2>{{ $subject->name }} - {{ $class->name }} ({{ $year }})</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="mb-0">{{ __('messages.class_average') }} <strong>{{ number_format($classAverage, 2) }}</strong></h4>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">{{ __('messages.S&G') }}</h3>
        </div>
        <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.average') }}</th>
                    <th>{{ __('messages.grades') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ number_format($student->average, 2) }}</td>
                    <td>
                        @foreach($student->marks as $mark)
                            <span class="badge bg-primary me-1">{{ $mark->mark }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary mt-3">{{ __('messages.back') }}</a>
</div>
@endsection