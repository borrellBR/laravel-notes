<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons/css/all/all.css" rel="stylesheet">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <title>Document</title>
</head>
<body>


    <nav style="display: flex; justify-content: space-between; align-items: center;">

        <div style="flex: 1; display: flex; justify-content: center; align-items: center;">
            <a href ="{{ route('index') }}">
                <img src="Scribl.png" alt="Scribl Logo" style="max-width:20rem">
            </a>
        </div>
    </nav>



</body>
</html>
