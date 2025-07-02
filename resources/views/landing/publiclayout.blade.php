<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')|{{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
    <!-- Font Awesome CDN (Latest v6 as of now) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <!-- Optional: Add subtle animation for gallery items -->
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>




</head>

<body>
    @include('includes.navbar')
    <!-- --------------------------- loder wirl Here ---------------- -->
    <div id="loaderOverlay" class="fixed inset-0 bg-black/30 bg-opacity-40 hidden items-center justify-center z-50">
        <div class="loader border-4 border-white border-t-[#9b714a] rounded-full w-12 h-12 animate-spin"></div>
    </div>
    <script>
        function showLoader() {
            const overlay = document.getElementById('loaderOverlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }
    </script>
    @section('content')

    @show


</body>

</html>