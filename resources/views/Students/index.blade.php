<!DOCTYPE html>
<html>
<head>
    <title>Students by Class</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Students by Class</h1>

<label for="year">Choose a year:</label>
<select id="year">
    <option value="">Select Year</option>
    <option value="2024">2024</option>
    <option value="2023">2023</option>
    <option value="2022">2022</option>
</select>

<label for="class">Choose a class:</label>
<select id="class" disabled>
    <option value="">Select Class</option>
</select>

<h2>Students</h2>
<div id="errorMessage" style="color: red; display: none;"></div>
<ul id="studentsList"></ul>

<a href="{{ route('students.create') }}">Add Student</a>

<script>
$(document).ready(function() {
    $('#year').change(function() {
        var year = $(this).val();
        if (year) {
            $.ajax({
                url: '/get-classes/' + year,
                type: 'GET',
                success: function(data) {
                    $('#errorMessage').hide();
                    $('#class').empty().append('<option value="">Select Class</option>');
                    $.each(data, function(index, value) {
                        $('#class').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#class').prop('disabled', false);
                },
                error: function() {
                    $('#errorMessage').text('Failed to load classes. Please try again.').show();
                }
            });
        } else {
            $('#class').empty().prop('disabled', true);
            $('#errorMessage').hide();
        }
    });

    $('#class').change(function() {
        var classId = $(this).val();
        if (classId) {
            $.ajax({
                url: '/get-students/' + classId,
                type: 'GET',
                success: function(data) {
                    $('#studentsList').empty();
                    $.each(data, function(index, value) {
                        $('#studentsList').append('<li>' + value.name + '</li>');
                    });
                },
                error: function() {
                    $('#studentsList').empty();
                    $('#errorMessage').text('Failed to load students. Please try again.').show();
                }
            });
        } else {
            $('#studentsList').empty();
        }
    });
});
</script>

</body>
</html>