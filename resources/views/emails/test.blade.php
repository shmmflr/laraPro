<?php

$style =[
    'parent'=>' display: flex;
                justify-content: center;
                align-items: center;',
                
    'child'=>'  display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                background: #7fffd461;
                padding: 20px 60px;
                border-radius: 15px;',
]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
 <div style="{{$style['parent']}}">
    <div style="{{$style['child']}}">
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
        {{-- {{$message->embed(storage_path('app/public/test3.txt'))}} --}}
        {{-- برای نمایش عکس هم میشه --}}
        {{-- {{$message->embed(storage_path('app/public/ax.jpg'))}} --}}
        {{-- <img src="{{$message->embed(storage_path('app/public/ax.jpg'))}}" alt="test"> --}}
        <img src="{{asset('ax.jpg')}}" alt="test">
    </div>
 </div>

</body>
</html>