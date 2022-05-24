<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <style>
        body {
            font-family: 'Nunito'
        }
    </style>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

</head>

<body>
    @php $locale = session()->get('locale'); @endphp
    <nav class="navbar navbar-nav navbar-light navbar-expand-lg mt-3 mb-5">
        <div class="container px-4">
            <div class="lang-container">
                <a class="nav-link px-3 me-3 @if($locale=='en') bg-secondary text-light @endif" href="{{route('lang', 'en')}}"><img src="{{ asset('images/flag/en.png')}}" alt="English"> English</a>
                <a class="nav-link px-3 @if($locale=='fr') bg-secondary text-light @endif" href="{{route('lang', 'fr')}}"><img src="{{ asset('images/flag/fr.png')}}" alt="Français"> Français</a>

            </div>

            @guest
            <div class="btn-container">
                @if(!Route::is('login'))
                <a href="{{ route('login') }}" class="btn btn-outline-primary">@lang('lang.text_top_nav_login')</a>
                @endif
                @if(!Route::is('registration'))
                <a href="{{ route('registration') }}" class="btn btn-outline-primary">@lang('lang.text_top_nav_register')</a>
                @endif
            </div>
            @else
            <div class="nav-list">
                <a class="top-nav-item" href="{{ route('forum')}}">@lang('lang.text_top_nav_view_blog')</a>
                <a class="top-nav-item" href="{{ route('doc')}}">@lang('lang.text_top_nav_view_docs')</a>
                <a class="top-nav-item" href="{{ route('etudiant')}}">@lang('lang.text_top_nav_view_students')</a>
            </div>

            <div class="dropdown">
                <button class="dropdown-btn btn btn-outline-primary">@lang('lang.text_top_nav_welcome') {{ Auth::user()->name }}
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content bg-secondary">
                    <a class="text-light" href="{{ route('dashboard') }}">@lang('lang.text_top_nav_view_profile')</a>
                    <a class="text-light" href="{{ route('logout') }}">@lang('lang.text_top_nav_logout')</a>
                </div>
            </div>
            @endguest
        </div>
    </nav>
    @yield('content')
</body>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

</html>