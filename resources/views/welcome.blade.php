<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h1>ZKTeco Device Test Results</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>IP Address</th>
                    <th>Status</th> 
                </tr>
            </thead>
            <tbody>
                @if(isset($results))
                    @foreach($results as $ip => $status)
                        <tr>
                            <td>{{ $ip }}</td>
                            <td>{{ $status }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">No results found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
