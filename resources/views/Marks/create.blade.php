@extends('layout')

@section('content')
<div class="container">
    <h1>{{ __('messages.new_grade') }}</h1>

    <form action="{{ route('marks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">{{ __('messages.students') }}</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">{{ __('messages.select_student') }}</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">{{ __('messages.subject') }}</label>
            <select name="subject_id" id="subject_id" class="form-select" required>
                <option value="">{{ __('messages.select_subject') }}</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mark" class="form-label">{{ __('messages.grades') }}</label>
            <select name="mark" id="mark" class="form-select" required>
                <option value="">{{ __('messages.select_grade') }}</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">{{ __('messages.date') }}</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection