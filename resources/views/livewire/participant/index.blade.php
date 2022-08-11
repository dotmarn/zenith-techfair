@section('title', 'Zenith Tech Fair::Welcome')
<div>
    <div class="text-center mx-auto border-b border-gray-100">
        <div class="mb-4">
            <img src="/assets/images/zfair-logo.png" alt="" class="mx-auto">
        </div>
    </div>
    <div class="max-w-3xl px-4 mx-auto">
        <div class="py-4 px-4 lg:px-8 space-y-5 lg:space-y-8">
            <form method="POST" wire:submit.prevent="bookSummit">
                {{ csrf_field() }}
                <div class="border-b border-gray-100 py-4">
                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="firstname" class="block font-semibold text-[#544837] mb-2">First Name <span
                                    class="text-red-400">*</span></label>
                            <input type="text" wire:model.lazy="firstname"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                id="firstname">
                            @error('firstname')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="lastname" class="block font-semibold text-[#544837] mb-2">Last Name <span
                                    class="text-red-400">*</span></label>
                            <input type="text" wire:model.lazy="lastname"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                id="lastname">
                            @error('lastname')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="email" class="block font-semibold text-[#544837] mb-2">Email Address
                                <span class="text-red-400">*</span></label>
                            <input type="text" wire:model.lazy="email"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                id="email">
                            @error('email')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="phone" class="block font-semibold text-[#544837] mb-2">Phone <span
                                    class="text-red-400">*</span></label>
                            <input type="text" wire:model.lazy="phone"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                id="phone">
                            @error('phone')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-5 mb-2">
                        <div class="w-full">
                            <label for="account" class="block font-semibold text-[#544837] mb-2">Do you have a zenith account?
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="have_an_account" id="have_an_account"
                                class="w-full px-4 py-3 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            @error('have_an_account')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="account_section" class="{{ $show_account_section ? '' : 'hidden' }}">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                <div class="w-2/3 lg:w-3/4">
                                    <input type="text" wire:model.lazy="account_number"
                                        class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                        id="account_number" placeholder="Enter your 10-digit account number">
                                    @error('account_number')
                                        <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="">
                                    <button type="button" class="bg-red-600 text-white px-8 py-3 rounded-lg border border-[#ccd1d9]" wire:click.prevent="verifyAccount">
                                        Verify
                                        <i class="fas fa-spinner fa-spin" wire:loading wire:target="verifyAccount"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="gender" class="block font-semibold text-[#544837] mb-2">Gender
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="gender" id="gender"
                                class="w-full px-4 py-3 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="city" class="block font-semibold text-[#544837] mb-2">City <span
                                    class="text-red-400">*</span></label>
                            <input type="text" wire:model.lazy="city"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                id="city">
                            @error('city')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">



                    </div>

                    {{-- <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="industry" class="block font-semibold text-[#544837] mb-2">Industry <span
                                    class="text-red-400">*</span></label>
                            <select wire:model.lazy="industry" id="industry"
                                class="w-full px-4 py-3 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                @foreach ($industries as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('industry')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="organization" class="block font-semibold text-[#544837] mb-2">Organization
                                <span class="text-red-400">*</span></label>
                            <input type="text" wire:model.lazy="organization"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]"
                                id="organization">
                            @error('organization')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div> --}}
                </div>

                {{-- <div class="py-4">
                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="account" class="block font-semibold text-[#544837] mb-2">Do you have an
                                account with Zenith Bank? <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="account" id="account"
                                class="w-full px-4 py-3 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                <option value="yes">Yes, I do</option>
                                <option value="no">No, I don't</option>
                                <option value="nay">No, but i wish to open one</option>
                            </select>
                            @error('account')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                        </div>
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="importer_or_exporter" class="block font-semibold text-[#544837] mb-2">Are
                                you an Importer or Exporter? <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="importer_or_exporter" id="importer_or_exporter"
                                class="w-full px-4 py-3 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                <option value="importer">I am an Importer</option>
                                <option value="exporter">I am an Exporter</option>
                                <option value="none">I am neither</option>
                            </select>
                            @error('importer_or_exporter')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                        </div>
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="trade_category" class="block font-semibold text-[#544837] mb-2">Select
                                your Trade Category <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="trade_category" id="trade_category"
                                class="w-full px-4 py-3 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                            @error('trade_category')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                        </div>
                    </div>
                </div> --}}

                <div class="">
                    <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded w-full lg:w-1/4">
                        Register
                        <i class="fas fa-spinner fa-spin" wire:loading wire:target="bookSummit"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script src=""></script>
@endsection
