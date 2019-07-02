<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Weibo App') - Laravel </title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ mix('js/app.js') }}"></script>
      
  </head>
  <body>

    @include('layouts._header')

    <div class="container">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>

  </body>
</html>