<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo/Ticket-Window-01.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <style>
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
    <style>
        * {
            font-family: "Cairo", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings:
                "slnt" 0;
        }
    </style>
</head>

<body class="font-sans">
    <!-- @livewire('front.nav') -->
    <div class="absolute top-6 left-6" bis_skin_checked="1">
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-lg text-sm font-semibold ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-primary/30 hover:text-accent-foreground h-10 px-4 py-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                <path d="m12 19-7-7 7-7"></path>
                <path d="M19 12H5"></path>
            </svg> العودة للرئيسية</a>
    </div>
    {{ $slot }}

    @livewireScripts
    @stack('scripts')
    <script>
        function initBurgerMenu() {
            let burgerBtn = document.getElementById('burgerBtn');
            let mobileMenu = document.getElementById('mobileMenu');

            if (burgerBtn && mobileMenu) {
                // تخلص من كل الأحداث القديمة عن طريق استبدال العنصر بنفسه (clone)
                const newBtn = burgerBtn.cloneNode(true);
                burgerBtn.parentNode.replaceChild(newBtn, burgerBtn);
                burgerBtn = newBtn;

                burgerBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        }

        document.addEventListener('DOMContentLoaded', initBurgerMenu);
        document.addEventListener('livewire:navigated', initBurgerMenu);
    </script>


</body>

</html>
