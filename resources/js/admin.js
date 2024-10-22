// add csrf to the main admin dashboard
function setUpCsrfToken() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
}

function resetFormMessages() {
    $("#btn-add-students").click(function () {
        $(".message").addClass("hidden");
    });
}

// this will handle ajax code for adding students
function addStudents() {
    $("#add-students").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission
        console.log("Hey");

        $.ajax({
            type: "POST",
            url: "admin-dashboard/store", // Corrected route syntax
            data: $(this).serialize(), // Serialize form data
            success: function (response) {
                if (response.success === true) {
                    $("#student-info").append(
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
                    $(".message").removeClass("hidden");
                    $(".message").removeClass("alert-warning");
                    $(".message").addClass("alert-success");
                    $(".message").html(`<span>${response.message}</span>`);
                    $("#add-students")[0].reset();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Unprocessable Entity
                    const errors = xhr.responseJSON.errors; // Ensure this is accessing the errors correctly
                    let errorMessage = "<ul>";
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errors[key].forEach(function (error) {
                                errorMessage += `<li>${error}</li>`;
                            });
                        }
                    }
                    errorMessage += "</ul>";
                    $("#message").html(`<span>${errorMessage}</span>`);
                    $("#message").removeClass("hidden");
                    $(".message").removeClass("alert-success");
                    $(".message").addClass("alert-warning");
                } else {
                    $(".message").removeClass("alert-success");
                    $(".message").addClass("alert-error");
                    $(".message").html(
                        `<span>An unexpected error occurred. Please try again.</span>`
                    );
                }
                console.log("An error occurred:", xhr);
            },
        });
    });
}

function deleteStudent() {
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#student-info").on("click", ".delete", function (e) {
        e.preventDefault();

        const studentId = $(this).data("id");
        if (
            confirm(
                "Are you sure you want to delete this student from the list?"
            )
        ) {
            $.ajax({
                type: "DELETE",
                url: "admin-dashboard/" + studentId, // Use the Blade-defined variable for the base URL
                success: function (response) {
                    if (response.success) {
                        $(e.target).closest("tr").remove();
                        $("#message").html(
                            "<p>Student data has been successfully deleted</p>"
                        );
                    }
                },
                error: function (xhr) {
                    console.error("An error occurred:", xhr);
                    $("#message").html(
                        "<p>An error occurred while deleting the student.</p>"
                    );
                },
            });
        }
    });
}

function fetchStudent() {
    $("#student-info").on("click", ".update", function (e) {
        e.preventDefault();

        const studentId = $(this).data("id");
        console.log(studentId);
        $.ajax({
            type: "GET",
            url: "admin-dashboard/" + studentId,
            success: function (response) {
                console.log(response);
                $(".message").addClass("hidden");
                $("#student-id").val(studentId);
                $("#fetch-first-name").val(response.first_name);
                $("#fetch-last-name").val(response.last_name);
                $("#fetch-age").val(response.age);
                $("#fetch-address").val(response.address);
                $(
                    'input[name="fetch-gender"][value="' +
                        response.gender +
                        '"]'
                ).prop("checked", true);
                $("#fetch-grade-level").val(response.grade_level);

                document
                    .getElementById("update-students-container")
                    .showModal();
            },
        });
    });
}

function updateStudents() {
    $("#update-students").on("submit", function (e) {
        e.preventDefault();

        const studentId = $("#student-id").val(); // Fixed: changed to 'id'
        $.ajax({
            type: "PUT",
            url: "admin-dashboard/" + studentId,
            data: $(this).serialize(), // Fixed: added missing comma
            success: function (response) {
                console.log(response);

                const row = $('tr[data-id = "' + studentId + '"]');
                row.find("td:nth-child(1)").text(response.id);
                row.find("td:nth-child(2)").text(response.first_name);
                row.find("td:nth-child(3)").text(response.last_name);
                row.find("td:nth-child(4)").text(response.address);
                row.find("td:nth-child(5)").text(response.age);
                row.find("td:nth-child(6)").text(response.gender);
                row.find("td:nth-child(7)").text(response.grade_level);

                $(".message").removeClass("hidden");
                $(".message").removeClass("alert-warning");
                $(".message").addClass("alert-success");
                $(".message").html("<span>Update Succesful</span>");
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Unprocessable Entity
                    const errors = xhr.responseJSON.errors; // Ensure this is accessing the errors correctly
                    let errorMessage = "<ul>";
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errors[key].forEach(function (error) {
                                errorMessage += `<li>${error}</li>`;
                            });
                        }
                    }
                    errorMessage += "</ul>";
                    $(".message").html(`<span>${errorMessage}</span>`);
                    $(".message").removeClass("hidden"); // Use a class for styling if needed
                } else {
                    $(".message").html(
                        `<span>An unexpected error occurred. Please try again.</span>`
                    );
                }
                console.log("An error occurred:", xhr);
            },
        });
    });
}

function filterStudents() {
    $(document).on("change", "#grade-level-filter", function () {
        var gradeLevel = $(this).val();
        console.log(gradeLevel);

        $.ajax({
            type: "GET",
            url: "filter-students/grade_level",
            data: { grade_level: gradeLevel },
            success: function (response) {
                $("#student-info").empty();
                response.forEach(function (student) {
                    $("#student-info").append(
                        `<tr data-id="${student.id}">
                            <td>${student.id}</td>
                            <td>${student.first_name}</td>
                            <td>${student.last_name}</td>
                            <td>${student.address}</td>
                            <td>${student.age}</td>
                            <td>${student.gender}</td>
                            <td>${student.grade_level}</td>
                            <td>
                                <a class="update btn btn-sm m-2" data-id="${student.id}" href="">Edit</a>
                                <a class="delete btn btn-sm m-2" href="" data-id="${student.id}">Delete</a>
                            </td>
                        </tr>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + status + error);
            },
        });
    });
}

function execute() {
    $(document).ready(function () {
        setUpCsrfToken();
        resetFormMessages();
        addStudents();
        updateStudents();
        deleteStudent();
        fetchStudent();
        filterStudents();
    });
}

execute();
