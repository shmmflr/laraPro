<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>
        به نام خدا
    </h1>
    <h2>
        {{$data['name']}}
    </h2>
    <a href="https://google.com">Google</a>
    <code>
        {{$date}}
    </code>

    {{-- ارسال فایل مستقیم در اینجا --}}
    {{$message->embed(storage_path('app/public/test3.txt'))}}
    {{-- برای نمایش عکس هم میشه --}}
    {{$message->embed(storage_path('app/public/ax.jpg'))}}
    <img src="{{$message->embed(storage_path('app/public/ax.jpg'))}}" alt="test">

</body>
</html>