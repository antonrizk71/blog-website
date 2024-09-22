<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>email</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/icons/font/bootstrap-icons.css') }}" rel="stylesheet">
</head>

<body>
    <h1>Welcome Mr. {{ config('app.name') }}</h1>
    <h3>My name is: <span style="color: blue">{{ $data['name'] }}</span></h3>
    <h3>📞 <span>{{ $data['phone'] }}</span></h3>
    <h3>✉️ <span>{{ $data['email'] }}</span></h3>
    <p>{{ $data['message'] }}</p>
    <p>Regards,</p>
    <h4>{{ $data['name'] }}</h4>
    
</body>

</html>