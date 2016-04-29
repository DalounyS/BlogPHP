<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'BlogPHP Administration')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
    <script src="{{url('assets/js/app.min.js')}}"></script>
</head>
<body>
<header>
    <h1>Blog PHP</h1>
    <nav>
        @include('partials.adminNav')
    </nav>
</header>

<div class="main">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
<footer>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</footer>
</html>