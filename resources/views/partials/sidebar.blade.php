<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-60 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 border-r border-r-main shadow-lg">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <a href="{{ route('portal.dashboard') }}">
                <img src="/assets/images/zfair-logo.png" alt="" class="w-16">
            </a>
        </div>
    </div>

    <nav class="flex flex-col mt-10 text-center">
        <a href="{{ route('portal.dashboard') }}" class="font-Lato py-3 text-sm flex items-center space-x-3 {{ request()->is('portal/dashboard') ? 'bg-red-600 text-white' : 'text-red-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- <a href="{{ route('portal.verify') }}" class="font-Lato py-3 text-sm flex items-center space-x-3 {{ request()->is('portal/verify-participant') ? 'bg-red-600 text-white' : 'text-red-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
            </svg>
            <span>Verification</span>
        </a> --}}
    </nav>
</div>
