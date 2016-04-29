<!DOCTYPE html>
<html lang="en" class="front">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'BlogPHP')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
</head>
<body>
<header>
    <h1>Blog PHP</h1>
    <nav>
        @include('partials.nav')
    </nav>
</header>

<div class="main">
    <div class="container">
            @yield('content')
        <div class="sidebar">
            <h3>Sponsors</h3>
            <img src="{{url('sponsors', 'elao_logo_150px.png')}}">
            <img src="{{url('sponsors', 'Elephpant.png')}}">
            <img src="{{url('sponsors', 'logo-large.png')}}">
            <img src="{{url('sponsors', 'zol-logo.png')}}">
        </div>
    </div>
</div>
</body>
<footer>
</footer>
</html>