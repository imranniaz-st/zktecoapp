<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZKTeco Device Status Check</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>ZKTeco Device Status Check</h2>
    <form action="{{ url('/devices/status') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="addresses">Device Addresses (Enter IPs and Ports, separated by commas)</label>
            <textarea class="form-control" id="addresses" name="addresses" rows="10">{{ $defaultAddresses }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Check Status</button>
    </form>
</div>
</body>
</html>
