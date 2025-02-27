<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body>
    <header>
        <x-admin-components.navbar title="Admin Dashboard" />
    </header>
    <div class="mx-5 flex flex-col gap-5">
        <div class="flex justify-between">
            <x-admin-components.btn-add-students />
            <x-admin-components.select-filter />
        </div>
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="table">
                    <x-admin-components.table-heading />
                    <x-admin-components.table-content :students="$students" />
                </table>
            </div>
        </div>
    </div>
    <div>
        @if ($errors->any()){
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            }
        @endif
    </div>
    <x-admin-components.add-student-modal />
    <x-admin-components.update-student-modal />
    {{-- Ajax add students --}}
    @vite('resources/js/admin.js')

    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.close').click(function() {
                $('.modal').hide();

            });


        })
        // Handle Add Student Form Submission
        $("#add-students").on("submit", function(e) {
            e.preventDefault(); // Prevent form submission

            $.ajax({
                type: "POST",
                url: "{{ route('admin.store') }}", // Corrected route syntax
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    if (response.success === true) {
                        $('#student-info').append(
                            `<tr data-id = "${response.id}">
                                    <td>${response.id}</td>
                                    <td>${response.first_name}</td>
                                    <td>${response.last_name}</td>
                                    <td>${response.address}</td>
                                    <td>${response.age}</td>
                                    <td>${response.gender}</td>
                                    <td>${response.grade_level}</td>
                                    <td>
                                        <a class="update btn btn-sm m-2" data-id="${response.id}" href="">Edit</a>
                                        <a class="delete btn btn-sm m-2" href="" data-id="${response.id}">Delete</a>
                                    </td>
                                </tr>`
                        );
                        $('.message').removeClass('hidden');
                        $('.message').removeClass('alert-warning');
                        $('.message').addClass('alert-success');
                        $('.message').html(`<span>${response.message}</span>`);
                        $('#add-students')[0].reset();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Unprocessable Entity
                        const errors = xhr.responseJSON
                            .errors; // Ensure this is accessing the errors correctly
                        let errorMessage = "<ul>";
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function(error) {
                                    errorMessage += `<li>${error}</li>`;
                                });
                            }
                        }
                        errorMessage += "</ul>";
                        $('#message').html(
                            `<span>${errorMessage}</span>`
                        );
                        $('#message').removeClass(
                            'hidden');
                        $('.message').removeClass('alert-success');
                        $('.message').addClass('alert-warning');
                    } else {
                        $('.message').removeClass('alert-success');
                        $('.message').addClass('alert-error');
                        $('.message').html(
                            `<span>An unexpected error occurred. Please try again.</span>`
                        );
                    }
                    console.log("An error occurred:", xhr);
                },
            });
        });

        // Handle Delete Student
        $('#student-info').on('click', '.delete', function(e) {
            e.preventDefault();

            const studentId = $(this).data('id');
            if (confirm('Are you sure you want to delete this student from the list?')) {
                $.ajax({
                    type: "DELETE",
                    url: "admin-dashboard/" + studentId,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $(e.target).closest('tr').remove();
                            $('#message').html(
                                '<p>Student data has been successfully deleted</p>');
                        }
                    }

                });
            }
        });

        // Handle Update Student
        $('#student-info').on('click', '.update', function(e) {
            e.preventDefault();


            const studentId = $(this).data('id');
            console.log(studentId);
            $.ajax({
                type: "GET",
                url: "admin-dashboard/" + studentId,
                success: function(response) {
                    console.log(response)
                    $('.message').addClass('hidden');
                    $('#student-id').val(studentId);
                    $('#fetch-first-name').val(response.first_name);
                    $('#fetch-last-name').val(response.last_name);
                    $('#fetch-age').val(response.age);
                    $('#fetch-address').val(response.address);
                    $('input[name="fetch-gender"][value="' + response.gender + '"]').prop(
                        'checked', true);
                    $('#fetch-grade-level').val(response.grade_level);

                    document.getElementById('update-students-container').showModal();
                }
            });
        });

        // Handle Update Form Submission
        $('#update-students').on('submit', function(e) {
            e.preventDefault();

            const studentId = $('#student-id').val(); // Fixed: changed to 'id'
            $.ajax({
                type: "PUT",
                url: "admin-dashboard/" + studentId,
                data: $(this).serialize(), // Fixed: added missing comma
                success: function(response) {
                    console.log(response)


                    const row = $('tr[data-id = "' + studentId + '"]');
                    row.find('td:nth-child(1)').text(response.id);
                    row.find('td:nth-child(2)').text(response.first_name);
                    row.find('td:nth-child(3)').text(response.last_name);
                    row.find('td:nth-child(4)').text(response.address);
                    row.find('td:nth-child(5)').text(response.age);
                    row.find('td:nth-child(6)').text(response.gender);
                    row.find('td:nth-child(7)').text(response.grade_level);

                    $('.message').removeClass('hidden');
                    $('.message').removeClass('alert-warning');
                    $('.message').addClass('alert-success');
                    $('.message').html('<span>Update Succesful</span>');


                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Unprocessable Entity
                        const errors = xhr.responseJSON
                            .errors; // Ensure this is accessing the errors correctly
                        let errorMessage = "<ul>";
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach(function(error) {
                                    errorMessage += `<li>${error}</li>`;
                                });
                            }
                        }
                        errorMessage += "</ul>";
                        $('.message').html(
                            `<span>${errorMessage}</span>`
                        );
                        $('.message').removeClass(
                            'hidden'); // Use a class for styling if needed
                    } else {
                        $('.message').html(
                            `<span>An unexpected error occurred. Please try again.</span>`
                        );
                    }
                    console.log("An error occurred:", xhr);
                },

            });
        });
    </script> --}}

</body>

</html>
