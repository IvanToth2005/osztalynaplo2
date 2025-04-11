<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.edit_student') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>{{ __('messages.edit_student') }}</h1>

@if($student)
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div>
        <label for="name">{{ __('messages.name') }}</label>
        <input type="text" name="name" value="{{ old('name', $student->name) }}" required>
    </div>

    <div>
    <label for="year">{{ __('messages.select_year') }}</label>
    <select id="year" name="year" required>
        <option value="">{{ __('messages.select_year') }}</option>
        @foreach($years as $year)  <!-- Frissített változó -->
            <option value="{{ $year }}" {{ $student->year == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endforeach
    </select>
</div

    <div>
        <label for="class">{{ __('messages.select_class') }}</label>
        <select id="class" name="class_id" required>
            <option value="">{{ __('messages.select_class') }}</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">{{ __('messages.update_student') }}</button>
</form>
@else
    <p>Student not found.</p>
@endif

<script>
$(document).ready(function() {
    $('#year').change(function() {
        var year = $(this).val();
        if (year) {
            $.ajax({
                url: '/get-classes/' + year,
                type: 'GET',
                success: function(data) {
                    $('#class').empty().append('<option value="">Select Class</option>');
                    $.each(data, function(index, value) {
                        $('#class').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#class').empty();
        }
    });
});
</script>

</body>
</html>