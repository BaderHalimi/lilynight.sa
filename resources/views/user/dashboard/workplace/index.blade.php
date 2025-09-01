@extends('user.layouts.app')

@section('content')
    <main class="flex-1 overflow-y-auto p-6 lg:p-8">
        <div class="max-w-3xl mx-auto space-y-6">

            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-slate-800">مكان العمل</h1>
            </div>
            <h2 class="text-xl font-bold text-slate-800 mt-6">نقاط البيع التي تمتلكها</h2>
            @if (!$providers->isEmpty())
                @foreach ($providers as $provider)
                    <div class="p-4 border rounded-lg shadow-sm flex items-center gap-3">
                        <img src="{{ Storage::url($provider->logo) }}" alt="{{ $provider->name }}"
                            class="w-12 h-12 rounded-full border">
                        <div>
                            <a href="{{route("provider.Dashboard.overview",$provider->id)}}">
                            <h3 class="font-semibold">{{ $provider->name }}</h3></a>
                            <p class="text-sm text-slate-500">{{ $provider->city }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">ليس لديك نقاط بيع مرتبطة بك.</p>
            @endif

            <h2 class="text-xl font-bold text-slate-800 mt-6">الوظائف الخاص بك</h2>
            @if (!$jobs->isEmpty())
                @foreach ($jobs as $job)
                    <div class="p-4 border rounded-lg shadow-sm flex items-center gap-3">
                        <img src="{{ $job->provider->logo }}" alt="{{ $job->provider->name }}"
                            class="w-12 h-12 rounded-full border">
                        <div>
                            <h3 class="font-semibold">{{ $job->title }}</h3>
                            <p class="text-sm text-slate-500">{{ $job->provider->name }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">ليس لديك وظائف مرتبط بك.</p>
            @endif


        </div>
    </main>

@endsection
