if (window.location.pathname.includes('/subjects')) {
    $(document).ready(function () {
        $('#year').change(function () {
            const year = $(this).val();
            const classSelect = $('#class');
            const subjectSelect = $('#subject');
    
            if (year) {
                classSelect.prop('disabled', true);
                classSelect.html('<option value="">Loading...</option>');
                subjectSelect.html('<option value="">Please select a class first</option>');
                subjectSelect.prop('disabled', true);
                $('#showResults').prop('disabled', true);
    
                const url = `${getClassesBaseUrl}/${year}`;
                $.get(url, function (data) {
                    classSelect.html('<option value="">Select class...</option>');
                    $.each(data, function (index, item) {
                        classSelect.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                    classSelect.prop('disabled', false);
                }).fail(function () {
                    classSelect.html('<option value="">Error loading classes</option>');
                    console.error('Error occurred while loading classes');
                });
            } else {
                classSelect.html('<option value="">Please select a year first</option>');
                classSelect.prop('disabled', true);
                subjectSelect.html('<option value="">Please select a class first</option>');
                subjectSelect.prop('disabled', true);
                $('#showResults').prop('disabled', true);
            }
        });
    
        $('#class').change(function () {
            const classId = $(this).val();
            const subjectSelect = $('#subject');
    
            if (classId) {
                subjectSelect.prop('disabled', true);
                subjectSelect.html('<option value="">Loading...</option>');
    
                const url = `${getSubjectsBaseUrl}/${classId}`;
                $.get(url, function (data) {
                    const subjectSet = new Set();
                    if (data.length > 0) {
                        subjectSelect.html('<option value="">Select subject...</option>');
                        $.each(data, function (index, item) {
                            if (!subjectSet.has(item.id)) {
                                subjectSet.add(item.id);
                                subjectSelect.append(`<option value="${item.id}">${item.name}</option>`);
                            }
                        });
                        subjectSelect.prop('disabled', false);
                        $('#showResults').prop('disabled', false);
                    } else {
                        subjectSelect.html('<option value="">No subjects for this class</option>');
                        subjectSelect.prop('disabled', true);
                        $('#showResults').prop('disabled', true);
                    }
                }).fail(function () {
                    subjectSelect.html('<option value="">Error loading subjects</option>');
                    console.error('Error occurred while loading subjects');
                });
            } else {
                subjectSelect.html('<option value="">Please select a class first</option>');
                subjectSelect.prop('disabled', true);
                $('#showResults').prop('disabled', true);
            }
        });
    
        $('#showResults').click(function (e) {
            e.preventDefault();
    
            const year = $('#year').val();
            const classId = $('#class').val();
            const subjectId = $('#subject').val();
    
            if (year && classId && subjectId) {
                const form = $('<form>', {
                    action: showResultsUrl,
                    method: "POST",
                    style: "display: none;"
                });
    
                form.append($('<input>', { type: "hidden", name: "_token", value: csrfToken }));
                form.append($('<input>', { type: "hidden", name: "year", value: year }));
                form.append($('<input>', { type: "hidden", name: "class_id", value: classId }));
                form.append($('<input>', { type: "hidden", name: "subject_id", value: subjectId }));
    
                $('body').append(form);
                form.submit();
            } else {
                alert('Please select year, class, and subject!');
            }
        });
    });

}



if (window.location.pathname.includes('/students')) {
    $(document).ready(function () {
        const getStudentsUrlTemplate = "/get-students/__CLASS_ID__";

        $('#year').change(function () {
            const year = $(this).val();
            const classSelect = $('#class');
            const studentList = $('#studentsList');
            const errorMessage = $('#errorMessage');

            if (year) {
                classSelect.prop('disabled', true).html('<option value="">Loading...</option>');
                studentList.empty();
                errorMessage.hide();

                $.get("/get-classes/" + year, function (data) {
                    classSelect.html('<option value="">Select class...</option>');
                    $.each(data, function (index, item) {
                        classSelect.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                    classSelect.prop('disabled', false);
                }).fail(function () {
                    errorMessage.text('Error loading the classes').show();
                });
            } else {
                classSelect.html('<option value="">Choose year</option>').prop('disabled', true);
                studentList.empty();
                errorMessage.hide();
            }
        });

        $('#class').change(function () {
            const classId = $(this).val();
            const url = getStudentsUrlTemplate.replace('__CLASS_ID__', classId);

            if (classId) {
                $.get(url, function (data) {
                    const studentList = $('#studentsList');
                    const errorMessage = $('#errorMessage');

                    studentList.empty();
                    errorMessage.hide();

                    $.each(data, function (index, item) {
                        studentList.append(`
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ${item.name}
                                <div>
                                    <a href="/students/${item.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/students/${item.id}" method="POST" style="display: inline;">
                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </li>
                        `);
                    });
                }).fail(function () {
                    $('#studentsList').empty();
                    $('#errorMessage').text('Error loading the students').show();
                });
            } else {
                $('#studentsList').empty();
            }
        });
    });
}
