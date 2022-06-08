<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>P-Log | {{ $photographer->pexel_photographer_name  }}'s Photos</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="index">
<h1 style="color:#fff; margin:10px 0px;">{{ $photographer->pexel_photographer_name }}'s Photos</h1>
<div class="grid-wrapper">
    @foreach($photos as $photo)
        @if($photo->pexel_width > @$photo->pexel_height)
            <a href="{{ $photo->pexel_url }}" target="_blank" class="wide">
                <img
                    src="{{ $photo->getImage->pexel_large }}"
                    alt=""/>
            </a>
        @elseif($photo->pexel_height > @$photo->pexel_width)
            <a href="{{ $photo->pexel_url }}" target="_blank" class="tall">
                <img
                    src="{{ $photo->getImage->pexel_large }}"
                    alt=""/>
            </a>
        @else
            <a href="{{ $photo->pexel_url }}" target="_blank">
                <img
                    src="{{ $photo->getImage->pexel_large }}"
                    alt=""/>
            </a>
        @endif
    @endforeach
</div>
<a style="color:#fff; font-size: 24px; text-align: left; margin-top: 30px; display: block;" href="{{ url('') }}">Geri Dön</a>
</body>
</html>
