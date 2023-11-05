@extends('layouts.errors')
@section('title', '503 - Whoops!!! Service is currently unavailable')
@section('content')
    <div class="container mx-auto font-Poppins">
        <div class="grid h-screen place-items-center mx-4">
            <div class="text-center">
                <img src="{{ asset('assets/images/errors/503.svg') }}" alt="503" class="mb-4">
                <div class="space-y-5">
                    <h2 class="font-semibold text-2xl text-[#1F262C]">Service Unavailable</h2>
                    <p class="font-light text-gray-500">The app is being (quickly!) updated. Please try again in a minute.</p>
                    <div class="flex justify-center">
                        <a href="{{ route('welcome') }}" class="text-[#1F262C] flex items-center space-x-1 font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>

                            <span>
                                Try Again
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
