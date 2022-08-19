<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>


@error('image')
<p style="color: red">
    {{ $message }}
</p>
@enderror
<form action="/practice" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" >
    <button type="submit">Upload Image</button>

</form>

<div>
    <img src="{{ asset('storage/avatar/1369354921660317181.jpg') }}" alt="">
</div>
{{--     {{ dd(rand(1,1000000000000).now()) }}--}}
</body>
</html>
