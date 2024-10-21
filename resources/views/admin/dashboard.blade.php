<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto ">
        <table>
            <thead class="border-solid border-b-2 border-black ">
                <th class="pr-8">ID</th>
                <th class="pr-8">First Name</th>
                <th class="pr-8">Last Name</th>
                <th class="pr-8">Address</th>
                <th class="pr-8">Age</th>
                <th class="pr-8">Gender</th>
                <th class="pr-8">Grade Level</th>
                <th class="pr-8">Action</th>
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
                        <td>
                            <a class="update" data-id="{{ $student->id }}" href="">Edit</a>
                            <a class="delete" href="" data-id="{{ $student->id }}">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div id="message"></div>
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
    <form action="{{ route('admin.store') }}" method="POST" id="add-students">
        @csrf
        @method('post')
        <div>
            <label for="first-name">First Name</label>
            <input type="text" placeholder="First Name" name="first_name" id="first-name">
        </div>
        <div>
            <label for="last-name">Last Name</label>
            <input type="text" placeholder="Last Name" name="last_name" id="last-name">
        </div>
        <div>
            <label for="address">Address</label>
            <input type="text" placeholder="Address" name="address" id="address">
        </div>
        <div>
            <label for="age">Age</label>
            <input type="number" placeholder="Age" name="age" id="age">
        </div>
        <div>
            <fieldset>
                <legend class="form-label">Gender:</legend>
                <div class="container ">
                    <div class="form-check">
                        <input type="radio" id="male" name="gender" value="Male" class="form-check-input"
                            required>
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="female" name="gender" value="Female" class="form-check-input"
                            required>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div>
            <label for="grade_level">Grade Level</label>
            <select name="grade_level" id="grade-level">
                <option value="" disabled></option>
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
            <button type="submit" name="submit" class="bg-black text-black p-2 rounded">Add students</button>
        </div>
    </form>

    <div class="mt-5">
        <h1>Update</h1>
    </div>
    <form action="" method="post" id="update-students" class="hidden">
        @csrf
        @method('put')
        <div>
            <input type="text" name="student_id" id="student-id">
        </div>
        <div>
            <label for="first-name">First Name</label>
            <input type="text" placeholder="First Name" name="first_name" id="fetch-first-name">
        </div>
        <div>
            <label for="last-name">Last Name</label>
            <input type="text" placeholder="Last Name" name="last_name" id="fetch-last-name">
        </div>
        <div>
            <label for="address">Address</label>
            <input type="text" placeholder="Address" name="address" id="fetch-address">
        </div>
        <div>
            <label for="age">Age</label>
            <input type="number" placeholder="Age" name="age" id="fetch-age">
        </div>
        <div>
            <fieldset>
                <legend class="form-label">Gender:</legend>
                <div class="container ">
                    <div class="form-check">
                        <input type="radio" id="male" name="fetch-gender" value="Male"
                            class="form-check-input" required>
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="female" name="fetch-gender" value="Female"
                            class="form-check-input" required>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div>
            <label for="grade_level">Grade Level</label>
            <select name="grade_level" id="fetch-grade-level">
                <option value="" disabled></option>
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
            <button type="submit" name="submit" class="bg-black text-black p-2 rounded">Add students</button>
        </div>
    </form>
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
                            $('#message').html(`<p>${response.message}</p>`);
                            $('#add-students')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Unprocessable Entity
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = "<ul>";
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errors[key].forEach(function(error) {
                                        errorMessage += `<li>${error}</li>`;
                                    });
                                }
                            }
                            errorMessage += "</ul>";
                            $('#message').html(`<div class="error">${errorMessage}</div>`);
                        } else {
                            $('#message').html(
                                `<p>An unexpected error occurred. Please try again.</p>`);
                        }
                        console.log("An error occurred:", xhr);
                    },
                });
            });

            // Handle Delete Student
            $('#student-info').on('click', '.delete', function(e) {
                e.preventDefault();

                const studentId = $(this).data('id');
                $('#update-students').addClass('hidden');
                $('#update-students').removeClass('block');
                $('#update-students')[0].reset();
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

                $('#update-students').addClass('block');
                $('#update-students').removeClass('hidden');

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
                        alert('Update completed');

                        const row = $('tr[data-id = "' + studentId + '"]');
                        row.find('td:nth-child(1)').text(response.id);
                        row.find('td:nth-child(2)').text(response.first_name);
                        row.find('td:nth-child(3)').text(response.last_name);
                        row.find('td:nth-child(4)').text(response.address);
                        row.find('td:nth-child(5)').text(response.age);
                        row.find('td:nth-child(6)').text(response.gender);
                        row.find('td:nth-child(7)').text(response.grade_level);

                        $('#update-students').addClass('hidden');
                        $('#update-students').removeClass('block');
                    }

                });
            });
        });
    </script>

</body>

</html>
