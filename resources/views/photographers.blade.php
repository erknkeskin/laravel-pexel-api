<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>P-Log | All Photographers</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<h1 class="photographer_title">All Photographers</h1>
@foreach($photographers as $photographer)
    <a href="{{ url('detail', $photographer) }}" class="photographer_link">{{ $photographer->pexel_photographer_name }}</a><br>
@endforeach
</body>
</html>
