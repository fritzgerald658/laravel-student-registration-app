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

<body class="relative h-screen">

    <header>
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">Admin Dashboard</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li>
                        <details>
                            <summary>Actions</summary>
                            <ul class="bg-base-100 rounded-t-none p-2">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">Log
                                            Out</a>
                                    </form>
                                </li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="mx-5 flex flex-col gap-5 ">

        <div class="btn-container">
            <button id="btn-add-students" class=" btn btn-sm btn-secondary text-sm" onclick="my_modal_2.showModal()">Add
                students</button>
        </div>
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Grade Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="student-info">
                        @foreach ($students as $student)
                            <tr data-id="{{ $student->id }}">
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->age }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->grade_level }}</td>
                                <td class="flex gap-3 ">
                                    <a class="update btn btn-sm btn-accent text-sm" data-id="{{ $student->id }}"
                                        href="">Edit</a>
                                    <a class="delete btn btn-sm text-sm" href=""
                                        data-id="{{ $student->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
    <dialog id="my_modal_2" class="modal container ">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center mb-3">Add Students</h3>
            <div id="message" role="alert" class="message alert alert-warning hidden text-sm p-2 mb-3">
            </div>
            <form action="" method="POST" id="add-students" class="flex flex-col gap-3">
                @csrf
                @method('post')
                <div>
                    {{-- <label for="first-name">First Name</label> <br> --}}
                    <input type="text" placeholder="First name" name="first_name"
                        class="input input-bordered input-md w-full max-w-s" />
                </div>
                <div>
                    {{-- <label for="last-name">Last Name</label> <br> --}}
                    <input type="text" placeholder="Last name" name="last_name"
                        class="input input-bordered input-md w-full max-w-s" />
                </div>
                <div>
                    {{-- <label for="address">Address</label><br> --}}
                    <input type="text" name="address" class="input input-bordered input-md w-full max-w-s"
                        placeholder="Address" name="address" id="address">
                </div>
                <div>
                    {{-- <label for="age">Age</label><br> --}}
                    <input type="number" name="age" class="input input-bordered input-md w-full max-w-s"
                        placeholder="Age" name="age" id="age">
                </div>
                <div>
                    <select name="grade_level" id="grade-level"
                        class="select select-bordered w-full select-md  max-w-s">
                        <option disabled selected>Grade Level</option>
                        <option value="Kindergarten">Kindergarten</option>
                        <option value="Grade 1">Grade 1</option>
                        <option value="Grade 2">Grade 2</option>
                        <option value="Grade 3">Grade 3</option>
                        <option value="Grade 4">Grade 4</option>
                        <option value="Grade 5">Grade 5</option>
                        <option value="Grade 6">Grade 6</option>
                        <option value="Young People">Young People</option>
                    </select>
                </div>

                <div>
                    <fieldset>
                        <div class="flex gap-5">
                            <div class="form-check">
                                <input type="radio" id="male" name="gender" value="Male"
                                    class="radio radio-sm radio-secondary" required>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="female" name="gender" value="Female"
                                    class="radio radio-sm radio-secondary" required>
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="text-end">
                    <button type="submit" name="submit" class="btn btn-md btn-accent">Register</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>

    </dialog>
    <div class="container absolute inset-0 flex items-center justify-center hidden" id="add-students-container">

    </div>
    <dialog id="update-students-container" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center mb-3">Update Students</h3>
            <div role="alert" class="message alert alert-warning hidden text-sm p-2 mb-3">
            </div>
            <form action="" method="POST" id="update-students" class="flex flex-col gap-3">
                @csrf
                @method('post')
                <input type="hidden" id="student-id" name="student_id">
                <div>
                    {{-- <label for="first-name">First Name</label> <br> --}}
                    <input type="text" placeholder="First name" id="fetch-first-name" name="first_name"
                        class="input input-bordered input-md w-full max-w-s" />
                </div>
                <div>
                    {{-- <label for="last-name">Last Name</label> <br> --}}
                    <input type="text" placeholder="Last name" id="fetch-last-name" name="last_name"
                        class="input input-bordered input-md w-full max-w-s" />
                </div>
                <div>
                    {{-- <label for="address">Address</label><br> --}}
                    <input type="text" name="address" class="input input-bordered input-md w-full max-w-s"
                        placeholder="Address" id="fetch-address">
                </div>
                <div>
                    {{-- <label for="age">Age</label><br> --}}
                    <input type="number" name="age" class="input input-bordered input-md w-full max-w-s"
                        placeholder="Age" id="fetch-age" name="age">
                </div>
                <div>
                    <select id="fetch-grade-level" name="grade_level" id="grade-level"
                        class="select select-bordered w-full select-md  max-w-s">
                        <option disabled selected>Grade Level</option>
                        <option value="Kindergarten">Kindergarten</option>
                        <option value="Grade 1">Grade 1</option>
                        <option value="Grade 2">Grade 2</option>
                        <option value="Grade 3">Grade 3</option>
                        <option value="Grade 4">Grade 4</option>
                        <option value="Grade 5">Grade 5</option>
                        <option value="Grade 6">Grade 6</option>
                        <option value="Young People">Young People</option>
                    </select>
                </div>

                <div>
                    <fieldset>
                        <div class="flex gap-5">
                            <div class="form-check">
                                <input type="radio" id="male" name="fetch-gender" value="Male"
                                    class="radio radio-sm radio-secondary" required>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="female" name="fetch-gender" value="Female"
                                    class="radio radio-sm radio-secondary" required>
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="text-end">
                    <button type="submit" name="submit" class="btn btn-md btn-accent">Update</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>

    </dialog>
    <div class="mt-5">

    </div>

    {{-- <a href="{{ route('admin.student') }}">Add Student</a> --}}

    {{-- Ajax add students --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log("success");
            $('#btn-add-students').click(function() {
                $('#add-students')[0].reset()
                $('#message').addClass('hidden');

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
                                `<tr>
                                    <td>${response.id}</td>
                                    <td>${response.first_name}</td>
                                    <td>${response.last_name}</td>
                                    <td>${response.address}</td>
                                    <td>${response.age}</td>
                                    <td>${response.gender}</td>
                                    <td>${response.grade_level}</td>
                                    <td>
                                        <a class="update" data-id="${response.id}" href="">Edit</a>
                                        <a class="delete" href="" data-id="${response.id}">Delete</a>
                                    </td>
                                </tr>`
                            );
                            $('#message').removeClass('hidden');
                            $('#message').removeClass('alert-warning');
                            $('#message').addClass('alert-success');
                            $('#message').html(`<span>${response.message}</span>`);
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


                    }

                });
            });

            // show add form
            $('#show-add-form').click(function(e) {
                e.preventDefault();
                $('#add-students-container').fadeIn();
            });
        });
    </script>

</body>

</html>
