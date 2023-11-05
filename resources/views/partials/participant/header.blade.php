<nav class="fixed top-0 inset-x-0 z-50 w-full {{ $success ? 'bg-[#1F262C]' : 'bg-[url("/assets/images/bg-header.svg")]' }}">
    <div class="p-3 lg:py-8 lg:px-2 flex justify-between md:justify-around items-center">
        <div>
            <a href="/" class="{{ $success ? 'block' : 'hidden lg:block'}}">
                <img src="/assets/images/logo.svg" alt="" class="w-36">
            </a>
        </div>

        <div class="text-white text-center ">
            <div class="{{ $success ? 'hidden' : 'lg:block'}}">
                <h2 class="text-2xl font-semibold lg:text-4xl">Zenith Tech Fair 2023</h2>
                <p class="font-normal">Event Registration Page</p>
            </div>
        </div>

        <div class=""></div>
    </div>
</nav>
