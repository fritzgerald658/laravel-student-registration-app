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
        </tr>
    @endforeach
</tbody>
