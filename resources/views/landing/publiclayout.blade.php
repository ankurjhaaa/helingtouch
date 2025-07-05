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
        html {
            scroll-behavior: smooth;
        }

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
    <style>
        /* Center the bell icon on the page */
        .bell-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        /* Bell icon styling */
        .bell-icon {
            font-size: 48px;
            color: #f1c40f;
            /* Golden color for the bell */
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        /* Shake animation */
        @keyframes shake {
            0% {
                transform: rotate(0deg);
            }

            10% {
                transform: rotate(15deg);
            }

            20% {
                transform: rotate(-15deg);
            }

            30% {
                transform: rotate(10deg);
            }

            40% {
                transform: rotate(-10deg);
            }

            50% {
                transform: rotate(5deg);
            }

            60% {
                transform: rotate(-5deg);
            }

            70% {
                transform: rotate(3deg);
            }

            80% {
                transform: rotate(-3deg);
            }

            90% {
                transform: rotate(1deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        /* Apply shake animation */
        .shake {
            animation: shake 0.8s ease-in-out;
        }

        /* Fade out effect */
        .fade-out {
            opacity: 0;
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

    <!-- Scroll to Top Button (Wooden Theme) -->
    <button onclick="scrollToTop()"
        class="fixed bottom-6 right-6 bg-[#5a3921] hover:bg-[#3e2717] text-white p-3 rounded-full shadow-lg z-50 transition-all duration-300">
        <!-- Up Arrow Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    @section('content')

    @show

    
</body>

</html>