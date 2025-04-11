@extends('layout')

@section('content')
<div class="container">
    <h1>{{ __('messages.edit_grade') }}</h1>

    <form action="{{ route('marks.update', $mark->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">{{ __('messages.students') }}</label>
            <select name="student_id" id="student_id" class="form-select" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $mark->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">{{ __('messages.subject') }}</label>
            <select name="subject_id" id="subject_id" class="form-select" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $mark->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mark" class="form-label">{{ __('messages.grades') }}</label>
            <select name="mark" id="mark" class="form-select" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $mark->mark == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">{{ __('messages.date') }}</label>
            <input type="date" name="date" id="date" class="form-control" 
                   value="{{ \Carbon\Carbon::parse($mark->date)->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection