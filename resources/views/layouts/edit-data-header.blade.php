<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons/css/all/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    @vite('resources/css/app.css')

    <title>Document</title>
</head>
<body>


    <nav style="margin-top:2rem; border-radius:8px; display: flex; justify-content: space-between; align-items: center; padding: 0 2rem;">
        <div style="display: flex; justify-content: flex-start; align-items: center;">
            <a href="{{ route('index') }}" style=" color: black; font-weight: bold;">
                <i class="fi fi-rr-house-chimney" style="font-size: 2rem; background-color:rgb(255, 255, 255); color:rgb(0, 0, 0); border-radius:4px; padding:3px;"></i>
            </a>
        </div>

        <div style="flex: 1; margin-left:29rem;display: flex; justify-content: center; align-items: center;">
            <a href="{{ route('index') }}">
                <img src="Scribl2.png" alt="Scribl Logo" style="max-width: 20rem;">
            </a>
        </div>

        @if(Request::is('edit-password'))
                    <div class="top-right" style= "border-radius:8px; margin-left:2rem; align-items:center; display:flex; background-color:rgb(234, 234, 234)">
                        <a href="{{ route('edit-profile.get') }}" class="btn btn-dark fw-bold" style="border-radius:8px; color:grey; text-decoration:none; padding-left:1rem; padding:rem; display: flex; align-items: center; justify-content: center; height: 3rem;">
                            <i class="fi fi-sr-pencil" style="margin-right: 0.5rem;"></i> Editar Perfil
                        </a>
                <a href="{{ route('edit-password.get') }}" class="btn btn-dark fw-bold" style=" text-decoration:none; background-color:black; color:white; padding-left:1rem; padding:2rem; display: flex; align-items: center; justify-content: center; height: 3rem;">
                    <i class="fi fi-sr-pencil" style="margin-right: 0.5rem;"></i> Cambiar contraseña
                 </a>
            </div>
        @else
            <div class="top-right" style= "border-radius:8px; margin-right:3rem; align-items:center; display:flex; background-color:rgb(234, 234, 234)">
                <a href="{{ route('edit-profile.get') }}" class="btn btn-dark fw-bold" style="border-radius:8px; text-decoration:none; background-color:black; color:white; padding-left:1rem; padding:2rem; display: flex; align-items: center; justify-content: center; height: 3rem;">
                    <i class="fi fi-sr-pencil" style="margin-right: 0.5rem;"></i> Editar Perfil
                </a>
                <a href="{{ route('edit-password.get') }}" class="btn btn-dark fw-bold" style="border-radius:8px; color:grey; text-decoration:none; padding-left:1rem; padding:rem; display: flex; align-items: center; justify-content: center;  height: 3rem;">
                    <i class="fi fi-sr-pencil" style="margin-right: 0.5rem;"></i> Cambiar contraseña
                </a>
            </div>
        @endif
    </nav>




    </nav>
</body>
</html>

