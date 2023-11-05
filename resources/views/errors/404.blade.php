@extends('layouts.errors')
@section('title', '404 - Page Not Found')
@section('content')
    <div class="container mx-auto">
        <div class="grid h-screen place-items-center mx-4">
            <div class="text-center">
                <img src="{{ asset('assets/images/errors/404.svg') }}" alt="404" class="mb-4">
                <div class="space-y-5">
                    <h2 class="font-custom-medium text-xl">Page Not Found</h2>
                    <p class="font-custom-light text-gray-500">It seems the page you are looking for doesn't exist or has
                        been moved.</p>
                    <div class="flex justify-center">
                        <!-- Added flex justify-center classes -->
                        <a href="" class="text-purple-one flex items-center space-x-1 font-custom-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                            </svg>
                            <span>
                                Go Back
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
