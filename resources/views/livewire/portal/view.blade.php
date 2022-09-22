@section('title', 'Zenith Tech Fair::Participant')
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-8 gap-y-5 mb-4">
        <div class="lg:col-span-2">
            <div class="p-4 bg-white rounded-lg">
                <div class="text-center">
                    <div class="mb-4">
                        <img src="/assets/images/default-avatar.jpg" alt="" srcset=""
                            class="h-24 w-24 rounded-full border-2 border-gray-200 object-cover mx-auto">
                    </div>
                    <div class="text-center">
                        <div class="mb-8">
                            <h6 class="font-semibold">
                                {{ ucfirst($details->reg_info->firstname) . ' ' . ucfirst($details->reg_info->lastname) }}
                            </h6>
                            <h1 class="text-2xl font-semibold">{{ $details->token }}</h1>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 mb-4 border-b-2 border-gray-200 pb-4">
                            <div class="text-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center mx-auto"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <h6 class="font-semibold mt-2">{{ $details->reg_info->phone }}</h6>
                            </div>

                            <div class="text-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center mx-auto"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <h6 class="font-semibold mt-2">{{ $details->reg_info->email }}</h6>
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 pb-4 mb-4">
                            <h6 class="text-left font-semibold">Have Zenith Account:</h6>
                            <div class="text-left">
                                <span
                                    class="{{ $details->reg_info->have_an_account == 'yes' ? 'bg-green-600' : 'bg-red-600' }} text-white py-1 px-6 rounded-md text-xs">{{ ucfirst($details->reg_info->have_an_account) }}</span>
                            </div>
                        </div>

                        @if ($details->reg_info->have_an_account === 'yes')
                            <div class="flex justify-between border-b-2 border-gray-200 pb-4 mb-4">
                                <h6 class="text-left font-semibold">Account Number:</h6>
                                <div class="text-left">
                                    {{ $details->reg_info->account_number }}
                                </div>
                            </div>
                        @endif

                        <div class="flex justify-between border-b-2 border-gray-200 pb-4 mb-4">
                            <h6 class="text-left font-semibold">Reason for attending:</h6>
                            <div class="text-left">
                                {{ $details->reg_info->reason }}
                            </div>
                        </div>

                        <div class="border-b-2 border-gray-200 pb-4 mb-4">
                            <h6 class="text-left font-semibold">Area of Interests:</h6>
                            <div class="w-full max-w-fit lg:ml-auto">
                                @forelse ($details->reg_info->interests as $interest)
                                    <div class="bg-[#063970] text-white text-xs rounded-lg py-1 px-6 mb-2">
                                        <span>{{ $interest }}</span>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>

                        <div class="flex justify-between pb-4 mb-4 clear-both">
                            <h6 class="text-left font-semibold">Date Registered:</h6>
                            <div class="text-left">
                                {{ \Carbon\Carbon::parse($details->reg_info->created_at)->format('j F, Y H:i a') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($details->reg_info->super_session->count())
            <div>
                <h2 class="font-semibold mb-2">Master Class Events</h2>
                @foreach ($details->reg_info->super_session as $key => $item)
                    <div class="p-4 bg-white rounded-lg mb-4" id="layout{{ $key }}">
                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Event Name:</h6>
                            <div class="text-left">
                                {{ $item->masterclass->title }}
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Date:</h6>
                            <div class="text-left">
                                {{ $item->preferred_date }}
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Time:</h6>
                            <div class="text-left">
                                {{ $item->preferred_time }}
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Status:</h6>
                            <div class="text-left">
                                <span class="{{ $item->status == 'verified' ? 'bg-green-600' : 'bg-red-600' }} text-white py-1 px-6 rounded-md text-xs">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>

                        @if (!is_null($item->admitted_at))
                        <div class="flex justify-between border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Time In:</h6>
                            <div class="text-left">
                                {{ \Carbon\Carbon::parse($item->admitted_at)->format('j F, Y H:i a') }}
                            </div>
                        </div>
                        @endif

                        @if ($item->status == 'pending')
                        <div class="text-center">
                            <button id="button{{ $key }}" type="button" class="mx-auto bg-red-600 text-white py-2 px-6 rounded-lg" wire:click.prevent="checkIn({{ $item->id }})">Check In
                                <i id="spinner{{ $key }}" class="fas fa-spinner fa-spin" wire:loading wire:target="checkIn"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
