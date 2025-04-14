@extends('layout')

@section('content')
<div class="container">
    <h1>{{ __('messages.grades') }}</h1>
    @if(auth()->check())
    <a href="{{ route('marks.create') }}" class="btn btn-primary mb-3">{{ __('messages.new_grade') }}</a>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('messages.students') }}</th>
                <th>{{ __('messages.subject') }}</th>
                <th>{{ __('messages.grades') }}</th>
                <th>{{ __('messages.date') }}</th>
                <th>{{ __('messages.operations') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marks as $mark)
            <tr>
                <td>{{ $mark->student->name }}</td>
                <td>{{ $mark->subject->name }}</td>
                <td>{{ $mark->mark }}</td>
                <td>{{ \Carbon\Carbon::parse($mark->date)->format('Y.m.d') }}</td>
                <td>
                    @if(auth()->check())
                    <a href="{{ route('marks.edit', $mark->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                    <form action="{{ route('marks.destroy', $mark->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Biztosan törölni szeretnéd?')">{{ __('messages.delete') }}</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection