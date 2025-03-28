@extends('layouts.app')

@section('content')
<h1>Marks</h1>
<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Subject</th>
            <th>Mark</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($marks as $mark)
        <tr>
            <td>{{ $mark->student->name }}</td>
            <td>{{ $mark->subject->name }}</td>
            <td>{{ $mark->marks }}</td>
            <td>{{ $mark->date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection