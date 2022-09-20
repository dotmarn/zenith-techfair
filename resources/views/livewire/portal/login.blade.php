@section('title', 'Zenith Trade Seminar Portal::Login')
<div class="flex flex-col h-screen font-Lato bg-gradient-to-b from-red-300 to-blue-200">
    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12
            px-6 py-10 sm:px-10 sm:py-6
            bg-white rounded-lg shadow-md lg:shadow-lg">
            <div class="text-center mb-5">
                <img src="/assets/images/zenith-bank.png" alt="" class="mx-auto w-24">
            </div>
            <form class="space-y-5" method="POST" wire:submit.prevent="authenticateUser">
                {{ csrf_field() }}
                <div>
                    <label for="username" class="block text-xs font-semibold text-gray-600 uppercase">Username</label>
                    <input id="username" type="text" wire:model.defer="username"
                        class="block w-full py-3 px-3 mt-2
                        text-gray-800 appearance-none border border-gray-300 focus:outline-none focus:border-gray-200 rounded-md"/>
                        @error('username') <p class="text-red-600 font-normal">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <input id="password" type="password" wire:model.defer="password" autocomplete="current-password"
                        class="block w-full py-3 px-3 mt-2
                        text-gray-800 appearance-none border border-gray-300 focus:outline-none focus:border-gray-200 rounded-md"/>
                        @error('password') <p class="text-red-600 font-normal">{{ $message }}</p> @enderror
                </div>

                <!-- Auth Buttton -->
                <button type="submit"
                    class="w-full py-3 mt-10 bg-red-600 rounded-md
                    font-medium text-white uppercase
                    focus:outline-none hover:shadow-none">
                    Login
                    <i class="fas fa-spinner fa-spin" wire:loading wire:target="authenticateUser"></i>
                </button>

            </form>
        </div>
    </div>
</div>
