@extends('user.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p class="text-gray-700">Welcome to your dashboard, {{ auth()->user()->name }}!</p>
        
        <!-- Add more dashboard content here -->
        
        <div class="mt-6">
            <a href="{{ route('profile') }}" class="text-blue-500 hover:underline">View Profile</a>
        </div>
    </div>

@endsection