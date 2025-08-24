

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        * {
            font-family: "Cairo", sans-serif;
        }

        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
{{-- @if(session('error') || session('success') || session('message'))
    @php
        $message = session('error') ?? session('success') ?? session('message');
        $type = session('error') ? 'error' : (session('success') ? 'success' : 'info');
        $bgColor = match($type) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'info' => 'bg-gray-700',
        };
    @endphp

    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 2500)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-10"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-10"
        class="fixed bottom-5 right-5 z-50 max-w-xs w-full {{ $bgColor }} text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-3"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            @if($type === 'success')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            @elseif($type === 'error')
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m0-4h.01M12 18h.01" />
            @endif
        </svg>
        <span class="text-sm font-medium">{{ $message }}</span>
    </div>
@endif --}}

<body class="bg-slate-100 font-sans">
    <div class="relative h-screen flex overflow-hidden" dir="rtl" x-data="{ openSidebar: true }">



        <!-- ✅ السايدبار -->
        <div
            x-show="openSidebar"
            x-transition:enter="transition-all transform ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-full"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition-all transform ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-full"
            @click.outside.window="if(window.innerWidth < 768) openSidebar = false"
            class="fixed inset-y-0 right-0 w-64 bg-white p-6 flex flex-col border-l border-slate-200 z-40 overflow-y-auto shadow-xl md:relative md:shadow-none md:block">
            <aside id="sidebar" class="w-full">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" />
                            <path d="M13 5v2" />
                            <path d="M13 17v2" />
                            <path d="M13 11v2" />
                        </svg>
                    </div>
                </div>

                @include('user.layouts.aside')
                <div class="mt-auto p-4 border-t">
                    <form action="" method="post">
                        @csrf
                        <button type="submit" class="inline-flex items-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 h-10 px-4 py-2 w-full justify-start text-base text-red-500 hover:text-red-600 hover:bg-red-50">
                            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" x2="9" y1="12" y2="12"></line>
                            </svg>
                            تسجيل الخروج
                        </button>
                    </form>
                </div>
            </aside>
        </div>


        <main class="relative flex-1 overflow-y-auto">
            @include('user.layouts.nav')

            <div class="sm:p-6 lg:p-8">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://cdn.tiny.cloud/1/evqw8zgybaz9h1ukpi5qcps683qv0ef37icy3d3o5xjbo9it/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
