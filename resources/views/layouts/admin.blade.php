<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="page-header-fixed">

<header>
    @include('partials.header')
</header>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<footer></footer>

</body>
</html>