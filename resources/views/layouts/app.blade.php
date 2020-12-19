<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Posty</title>
</head>
<body class="bg-gray-200">
    <nav class="bg-indigo-500 text-white p-3 flex justify-between">
        <ul class="flex items-center">
            <li class="p-3"> 
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="p-3"> 
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="p-3"> 
                <a href="{{ route('posts') }}">Post</a>
            </li>
        </ul>
        <ul class="flex items-center">
            
            @auth
                <li class="p-3 text-indigo-200"> 
                    <p>{{ auth()->user()->name }}</p>
                </li>
                <li class="p-3"> 
                    <!-- protecting the logout -->
                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                </li>
            @endauth

            @guest
                <li class="p-3"> 
                    <a href="{{ route('login') }}">Login</a>
                </li>
                <li class="p-3"> 
                    <a href="{{ route('register') }}">Register</a>
                </li>
            @endguest
               
        </ul>
    </nav>
    @yield('content')
</body>
</html>