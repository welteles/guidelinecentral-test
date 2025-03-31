<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')

    @stack('styles')
</head>

<body">
    <div style="background: #083248; margin:0; padding:24px;">
        <img src="{{ asset('img/logo.svg') }} " alt="" srcset="" style="height:34px;">
    </div>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @yield('content')
   
    @stack('scripts')
</body>
</html>
