<table>
    <thead>
        <tr>
            <th colspan="{{ 6 + count($days) }}">
                Attendance Report | Section: {{ $sectionId }} | From {{ $from }} To {{ $to }}
                @if($name) | Filter: {{ $name }} @endif
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Present</th>
            <th>Absent</th>
            @foreach($days as $d)
                <th>{{ \Carbon\Carbon::parse($d)->format('d-m-Y') }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @foreach($students as $student)
            @php
                $presentCount = $student->attendance->filter(fn($a)=> (int)$a->attendence_status === 1)->count();
                $absentCount  = $student->attendance->filter(fn($a)=> (int)$a->attendence_status === 0)->count();
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ optional($student->Grade)->name }}</td>
                <td>{{ optional($student->Section)->section_name }}</td>
                <td>{{ $presentCount }}</td>
                <td>{{ $absentCount }}</td>

                @foreach($days as $d)
                    @php $status = $attendanceMap[$student->id][$d] ?? null; @endphp
                    <td>
                        @if($status === 1) ✔
                        @elseif($status === 0) ✖
                        @else —
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>