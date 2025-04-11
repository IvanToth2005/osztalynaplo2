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
    
    <a href="{{ route('students.create') }}" class="btn btn-primary mt-3">{{ __('messages.student_add') }}</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const getStudentsUrl = "{{ route('students.get-students', ['classId' => '__CLASS_ID__']) }}"; // A Blade URL minta

    $('#year').change(function() {
        const year = $(this).val();
        const classSelect = $('#class');
        
        if (year) {
            classSelect.prop('disabled', true).html('<option value="">Loading...</option>');
            
            $.get("/get-classes/" + year, function(data) {
                classSelect.html('<option value="">Select class...</option>');
                $.each(data, function(index, item) {
                    classSelect.append(`<option value="${item.id}">${item.name}</option>`);
                });
                classSelect.prop('disabled', false);
            }).fail(function() {
                $('#errorMessage').text('Error loading the classes').show();
            });
        } else {
            classSelect.html('<option value="">Choose year</option>').prop('disabled', true);
            $('#studentsList').empty();
            $('#errorMessage').hide();
        }
    });

    $('#class').change(function() {
        const classId = $(this).val();
        if (classId) {
            const url = getStudentsUrl.replace('__CLASS_ID__', classId); // Dinamikus URL létrehozás
            $.get(url, function(data) {
            $('#studentsList').empty();
            $.each(data, function(index, item) {
                $('#studentsList').append(`
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ${item.name}
                        <div>
                            <a href="/students/${item.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/students/${item.id}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </li>
                `);
            });
        }).fail(function() {
            $('#studentsList').empty();
            $('#errorMessage').text('Error loading the students').show();
        });
        } else {
            $('#studentsList').empty();
        }
    });
});
</script>
@endsection