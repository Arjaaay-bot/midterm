<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to A King Inventory</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('{{ asset('images/bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            min-height: 100vh; /* Ensure a minimum height to cover the entire viewport */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content {
            width: 100%;
            text-align: center;
            color: #fff;
            margin-bottom: 20px; /* Adjust margin-bottom as needed */
        }

        .btn-container {
            text-align: center;
        }


        a {
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 5px 15px;
            font-size: 20px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #6A9C89;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #176B87;
        }

        .button:hover {
            background-color: #64CCC5;
        }

        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
    </style>
</head>

<body class="antialiased">
    <div class="content">
        <h1>Welcome <br> to <br> A King Inventory Management System!</h1>
    </div>

    <div class="btn-container">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
            <div class="btn-container">
                <a href="{{ route('login') }}" class="button">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="button">Register</a>
                @endif
            </div>
            @endauth
        </div>
        @endif
    </div>
</body>

</html>
