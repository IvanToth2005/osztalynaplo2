<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Edit Student</h1>

@if($student)
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name', $student->name) }}" required>
    </div>

    <div>
        <label for="year">Choose a year:</label>
        <select id="year" name="year" required>
            <option value="">Select Year</option>
            <option value="2024" {{ $student->year == 2024 ? 'selected' : '' }}>2024</option>
            <option value="2023" {{ $student->year == 2023 ? 'selected' : '' }}>2023</option>
            <option value="2022" {{ $student->year == 2022 ? 'selected' : '' }}>2022</option>
        </select>
    </div>

    <div>
        <label for="class">Choose a class:</label>
        <select id="class" name="class_id" required>
            <option value="">Select Class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Update Student</button>
</form>
@else
    <p>Student not found.</p>
@endif

<script>
$(document).ready(function() {
    // Lehet, hogy a class mezőn nem kell dinamikusan frissíteni, ha már van adat
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