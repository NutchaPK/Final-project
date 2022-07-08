<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tracking Nutrition for CKD patient') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;600&display=swap" rel="stylesheet">
    
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    body{
        font-family: 'Mitr', sans-serif;
    }
    nav {
        background-color: #90C8AC;
        font-size: 150%;
    }

    .card {
        border-radius: 15px;
    }

    .card-header{
        text-align:center;
        background-color:#90C8AC
        
    }

    button {
        border-radius: 15px;
    }
    button:hover {
        background-color: #90C8AC;
        padding-left:5px;
    }
    
    .card-content{
        height: 100%;
        padding-right:5px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    #toast {
        visibility: hidden;
        position:absolute;
        top:90%;
        left:3%;

    }
    #toast.show{
        visibility:visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    .card-content::-webkit-scrollbar {
    width: 6px;
}


/* Handle */
.card-content::-webkit-scrollbar-thumb {
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background:#F5F0BB; 
}
    
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-heart-fill" viewBox="0 0 16 16">
                        <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707L7.293 1.5Z"/>
                        <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9.293Zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018Z"/>
                      </svg>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @guest
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                </ul>
                @else
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">หน้าหลัก </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('history') }}">ประวัติโภชนาการ</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">โปรไฟล์</a>
                        </li>
                    </ul>
                </div>
                @endguest
                
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
            
        </main>
    </div>
</body>

</html>


