<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZKTeco Device Status</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>ZKTeco Device Status</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>IP</th>
                <th>Port</th>
                <th>Connected</th>
                <th>Version</th>
                <th>OS Version</th>
                <th>Platform</th>
                <th>Firmware Version</th>
                <th>Serial Number</th>
                <th>Device Name</th>
                <th>Device Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{ $status['ip'] }}</td>
                    <td>{{ $status['port'] }}</td>
                    <td>{{ $status['connected'] ? 'Yes' : 'No' }}</td>
                    <td>{{ $status['version'] ?? 'N/A' }}</td>
                    <td>{{ $status['os_version'] ?? 'N/A' }}</td>
                    <td>{{ $status['platform'] ?? 'N/A' }}</td>
                    <td>{{ $status['firmware_version'] ?? 'N/A' }}</td>
                    <td>{{ $status['serial_number'] ?? 'N/A' }}</td>
                    <td>{{ $status['device_name'] ?? 'N/A' }}</td>
                    <td>{{ $status['device_time'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
