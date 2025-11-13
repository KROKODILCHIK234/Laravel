<!DOCTYPE html>
<html lang="ru">
<head><title>@yield('title')</title></head>
<body>
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
</body>
</html>
