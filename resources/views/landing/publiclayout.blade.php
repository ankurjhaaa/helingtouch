<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')|{{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome CDN (Latest v6 as of now) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

</head>

<body>
      @include('includes.navbar')
      @section('content')
      
      @show
      

</body>

</html>