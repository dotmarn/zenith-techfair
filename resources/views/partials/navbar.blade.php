<header class="flex justify-between items-center px-6 py-4 shadow-lg border-b border-b-main">
    <div class="flex items-center space-x-4 lg:space-x-0">
        <button @click="sidebarOpen = true" class="focus:outline-none lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div>
            <h1 class="text-2xl font-medium"></h1>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <button class="flex focus:outline-none" aria-label="Color Mode">
            <a href="{{ route('portal.logout') }}" class="border-2 border-main block p-2 shadow-lg rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </a>
        </button>
    </div>
</header>

