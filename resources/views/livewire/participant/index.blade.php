@section('title', 'Zenith Tech Fair::Welcome')
@section('styles')
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
@endsection
<div>
    <div class="text-center mx-auto border-b border-gray-100">
        <div class="mb-4">
            <img src="/assets/images/zfair-logo.png" alt="" class="mx-auto">
        </div>
    </div>
    <div class="max-w-3xl px-4 mx-auto">
        <div class="py-8 px-4 lg:px-8">
            <form method="POST" wire:submit.prevent="bookSummit">
                {{ csrf_field() }}
                <div class="py-4">
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
                            <label for="have_an_account" class="block font-semibold text-[#544837] mb-2">Do you have a
                                zenith
                                account?
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="have_an_account" id="have_an_account"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
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
                                    <button type="button"
                                        class="bg-red-600 text-white px-8 py-3 rounded-lg border border-[#ccd1d9]"
                                        wire:click.prevent="verifyAccount">
                                        Verify
                                        <i class="fas fa-spinner fa-spin" wire:loading wire:target="verifyAccount"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mb-2">
                        <label for="" class="w-full md:w-4/5 block font-semibold mb-2 text-[#544837]">Select
                            Class</label>
                        <div wire:ignore>
                            <select wire:model="class_session"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970] js-example-basic-multiple appearance-none"
                                multiple="multiple">
                                @foreach ($super_sessions as $super_session)
                                    <option value="{{ $super_session->id }}">{{ $super_session->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('class_session')
                            <p class="text-red-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="gender" class="block font-semibold text-[#544837] mb-2">Gender
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="gender" id="gender"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="job_function" class="block font-semibold text-[#544837] mb-2">Job Function
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="job_function" id="job_function"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                @foreach ($job_functions as $job)
                                    <option value="{{ $job }}">{{ ucwords($job) }}</option>
                                @endforeach
                            </select>
                            @error('job_function')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="lg:flex lg:items-center lg:space-x-5 space-y-5 lg:space-y-0 w-full mb-2">
                        <div class="w-full">
                            <label for="area_of_responsibility" class="block font-semibold text-[#544837] mb-2">Area
                                of Responsibility
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="area_of_responsibility" id="area_of_responsibility"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                <option value="area_one">Area One</option>
                                <option value="area_two">Area Two</option>
                            </select>
                            @error('area_of_responsibility')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="industry_type" class="block font-semibold text-[#544837] mb-2">Industry Type
                                <span class="text-red-400">*</span></label>
                            <select wire:model.lazy="industry_type" id="industry_type"
                                class="w-full px-4 py-3 rounded-lg border border-[#ccd1d9] outline-none focus:border-[#063970]">
                                <option value="">Choose One...</option>
                                @foreach ($industries as $industry)
                                    <option value="{{ $industry }}">{{ $industry }}</option>
                                @endforeach
                            </select>
                            @error('industry_type')
                                <p class="text-red-600 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-full relative">
                    <label for="" class="block font-semibold text-[#544837] mb-4">Area of Interest <span
                            class="text-red-400">*</span></label>
                    <div class="">
                        @foreach ($area_of_interests as $key => $item)
                            <div class="btn_check mb-4 mr-4">
                                <input type="checkbox" wire:model.lazy="selectedInterests"
                                    value="{{ $item }}" id="area_of_interest{{ $key }}" />
                                <label class="check-btn" for="area_of_interest{{ $key }}">
                                    <i class="fas fa-square"></i>
                                    {{ ucfirst($item) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('selectedInterests')
                        <p class="text-red-600 font-semibold text-xs clear-both mb-5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="clear-left">
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
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            $('.js-example-basic-multiple').on('change', function(event) {
                let data = $(this).val();
                @this.set('class_session', data);
            });
        });
    </script>
@endsection
