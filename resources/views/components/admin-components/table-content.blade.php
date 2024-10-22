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
                <a class="update btn btn-sm  text-sm m-2 md:m-1" data-id="{{ $student->id }}" href="">Edit</a>
                <a class="delete btn btn-sm text-sm m-2 md:m-1" href="" data-id="{{ $student->id }}">Delete</a>
            </td>
        </tr>
    @endforeach
</tbody>
