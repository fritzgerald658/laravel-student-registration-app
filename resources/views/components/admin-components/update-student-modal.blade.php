<dialog id="update-students-container" class="modal m-0">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center mb-3">Update Students</h3>
        <x-admin-components.success-error-message />
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
                <button type="submit" name="submit" class="btn btn-md btn-accent">Update</button>
            </div>
        </form>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>

</dialog>
