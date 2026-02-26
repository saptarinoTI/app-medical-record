<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log Permit Services</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

<h3>Log Permit Services</h3>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->service->name }}</td>
                <td>{{ \Carbon\Carbon::parse($item->permit_start)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->permit_end)->format('d M Y') }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>