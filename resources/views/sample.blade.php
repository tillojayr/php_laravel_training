<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World {{$id}}</h1>
    <ul>
    @foreach($names as $name)

    <li>{{$name}}</li>

    @endforeach
    </ul<>
</body>
</html>