$(document).ready(function() {
    $('#year').change(function() {
        const year = $(this).val();
        const classSelect = $('#class');
        const subjectSelect = $('#subject');
       
        if (year) {
            classSelect.prop('disabled', true);
            classSelect.html('<option value="">Loading...</option>');
            subjectSelect.html('<option value="">Please select a class first</option>');
            subjectSelect.prop('disabled', true);
            $('#showResults').prop('disabled', true);
           
            // Itt használjuk a Blade-ben generált változót
            $.get(getClassesUrl + "/" + year, function(data) {
                classSelect.html('<option value="">Select class...</option>');
                $.each(data, function(index, item) {
                    classSelect.append(`<option value="${item.id}">${item.name}</option>`);
                });
                classSelect.prop('disabled', false);
            });
        } else {
            classSelect.html('<option value="">Please select a year first</option>');
            classSelect.prop('disabled', true);
            subjectSelect.html('<option value="">Please select a class first</option>');
            subjectSelect.prop('disabled', true);
            $('#showResults').prop('disabled', true);
        }
    });
 
    $('#class').change(function() {
        const classId = $(this).val();
        const subjectSelect = $('#subject');
       
        if (classId) {
            subjectSelect.prop('disabled', true);
            subjectSelect.html('<option value="">Loading...</option>');
           
            // Itt is a Blade-ben generált változót használjuk
            $.get(getSubjectsUrl + "/" + classId, function(data) {
                const subjectSet = new Set();
                if(data.length > 0) {
                    subjectSelect.html('<option value="">Select subject...</option>');
                    $.each(data, function(index, item) {
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
            }).fail(function() {
                subjectSelect.html('<option value="">Error loading subjects</option>');
                console.error('Error occurred while loading subjects');
            });
        } else {
            subjectSelect.html('<option value="">Please select a class first</option>');
            subjectSelect.prop('disabled', true);
            $('#showResults').prop('disabled', true);
        }
    });
 
    $('#showResults').click(function(e) {
        e.preventDefault();
       
        const year = $('#year').val();
        const classId = $('#class').val();
        const subjectId = $('#subject').val();
       
        if (year && classId && subjectId) {
            // Create and submit form
            const form = $('<form>', {
                action: showResultsUrl,
                method: "POST",
                style: "display: none;"
            });
           
            // CSRF token
            form.append($('<input>', {
                type: "hidden",
                name: "_token",
                value: csrfToken
            }));
           
            form.append($('<input>', {
                type: "hidden",
                name: "year",
                value: year
            }));
           
            form.append($('<input>', {
                type: "hidden",
                name: "class_id",
                value: classId
            }));
           
            form.append($('<input>', {
                type: "hidden",
                name: "subject_id",
                value: subjectId
            }));
           
            $('body').append(form);
            form.submit();
        } else {
            alert('Please select year, class, and subject!');
        }
    });
});