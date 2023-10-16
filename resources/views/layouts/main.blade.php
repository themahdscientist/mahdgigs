<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="/images/favicon.ico" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        @vite('resources/css/app.css')
        <title>Mahdgigs | Find Laravel Jobs & Projects</title>
    </head>

    <body>
        <nav class="mb-2 flex items-center justify-between">
            <a href="{{ route('index') }}"><img class="w-24" src="{{ asset('images/logo.png') }}" alt="MahdGigs Logo"
                    class="logo" /></a>
            <ul class="mr-6 flex space-x-6 text-lg">
                @auth
                    <li>
                        <span class="font-bold uppercase">Welcome, {{ Auth::user()->name }}</span>
                    </li>
                    <li>
                        <a href="{{ route('users.listings') }}" class="hover:text-laravel"><i class="fa-solid fa-gear"></i>
                            Manage Listings</a>
                    </li>
                    <li>
                        <form action="{{ route('users.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-door-open"></i> Logout
                            </button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li>
                        <a href="{{ route('users.create') }}" class="hover:text-laravel"><i
                                class="fa-solid fa-user-plus"></i>
                            Register</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="hover:text-laravel"><i
                                class="fa-solid fa-arrow-right-to-bracket"></i>
                            Login</a>
                    </li>
                @endguest
            </ul>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="mt-5 flex w-full items-center justify-around bg-green-500 p-5 font-bold text-white opacity-90">
            <p>Copyright &copy; 2022, All Rights reserved</p>
            <a href="{{ route('listings.create') }}" class="ml-32 rounded-xl bg-laravel px-3 py-2">Post a Job</a>
        </footer>
        <x-flash-message />
        @vite('resources/js/app.js')
    </body>

</html>
