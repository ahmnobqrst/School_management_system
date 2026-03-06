<!doctype html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10.5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #444; padding: 4px; text-align: center; white-space: nowrap; }
        th { background: #f1f1f1; }
        .p { background: #eaf6ee; font-weight: 800; }
        .a { background: #fdecee; font-weight: 800; }
        .n { background: #fff6db; font-weight: 700; }
    </style>
</head>
<body>

<h3>
    Attendance Report | Section: {{ $id }} | From {{ $from }} To {{ $to }}
    @if($name) | Filter: {{ $name }} @endif
</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Present</th>
            <th>Absent</th>
            @foreach($days as $d)
                <th>{{ \Carbon\Carbon::parse($d)->format('d') }}</th>
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
                    @if($status === 1)
                        <td class="p">✔</td>
                    @elseif($status === 0)
                        <td class="a">✖</td>
                    @else
                        <td class="n">—</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>