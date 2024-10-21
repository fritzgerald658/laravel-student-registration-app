$(document).ready(function () {
        console.log("success");
        $("#add-students").on("submit", function (e) {
            e.preventDefault(); // Prevent form submission

            $.ajax({
                type: "POST",
                url: "{{ route('admin.store') }}", // Corrected route syntax
                data: $(this).serialize(), // Serialize form data
                success: function (response) {
                    alert("Data has been uploaded");
                },
                error: function (xhr, status, error) {
                    console.log("An error occurred:", error);
                },
            });
        });
});
