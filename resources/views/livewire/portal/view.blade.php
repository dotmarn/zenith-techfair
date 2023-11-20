@section('title', 'Zenith Tech Fair::Participant')
@section('styles')
    <link type="text/css" href="/assets/css/datatables.min.css" rel="stylesheet" />
    <style>
        .instagram {
            background: #d6249f;
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
            box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
        }

        /* @media print {
            body {
                visibility: hidden;
            }

            #printableArea {
                visibility: visible;
                position: absolute;
                left: 0;
                top: 0;
            }
        } */
    </style>
@endsection
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-8 gap-y-5 mb-4">
        <div class="lg:col-span-2">
            <div class="p-4 bg-white rounded-lg mb-4">
                <div>
                    <a href="javascript:void(0);" class="flex items-center place-content-end" onclick="printPageArea()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                    </a>
                </div>

                <div class="text-center">
                    <div class="mb-4">
                        <img src="/assets/images/default-avatar.jpg" alt="" srcset=""
                            class="h-24 w-24 rounded-full border-2 border-gray-200 object-cover mx-auto">
                    </div>
                    <div class="text-center">
                        <div class="mb-8">
                            <h6 class="font-semibold">
                                {{ ucfirst($details->reg_info->firstname) . ' ' . ucfirst($details->reg_info->lastname) . ' ' . ucfirst($details->reg_info->middlename) }}
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
                        @php
                            $social_media = $details->reg_info->social_media;
                        @endphp

                        @if (@count($social_media) > 0)
                            <div class="border-b-2 border-gray-200 pb-4 mb-4">
                                <h6 class="text-left font-semibold mb-2">Social Media:</h6>
                                <div class="lg:flex lg:space-x-3 lg:overflow-x-scroll lg:w-full">
                                    @foreach ($social_media as $platform => $handle)
                                        <div class="flex items-center space-x-3 mb-2">
                                            @if ($handle !== '')
                                                @if ($platform == 'twitter')
                                                    <a href="#" class="py-2 px-3 rounded-full bg-[#00acee]">
                                                        <i class="fab fa-twitter text-white"></i>
                                                    </a>
                                                @endif

                                                @if ($platform == 'facebook')
                                                    <a href="#" class="py-2 px-4 rounded-full bg-[#3b5998]">
                                                        <i class="fab fa-facebook-f text-white"></i>
                                                    </a>
                                                @endif

                                                @if ($platform == 'instagram')
                                                    <a href="#" class="py-2 px-3 rounded-full instagram">
                                                        <i class="fab fa-instagram text-white"></i>
                                                    </a>
                                                @endif

                                                @if ($platform == 'linkedin')
                                                    <a href="#" class="py-2 px-3 rounded-full bg-[#0072B1]">
                                                        <i class="fab fa-linkedin-in text-white"></i>
                                                    </a>
                                                @endif
                                                <label>{{ $handle }}</label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="flex justify-between pb-4 mb-4 clear-both">
                            <h6 class="text-left font-semibold">Date Registered:</h6>
                            <div class="text-left">
                                {{ \Carbon\Carbon::parse($details->reg_info->created_at)->format('j F, Y H:i a') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white rounded-lg">
                <div class='overflow-x-auto w-full'>
                    <table
                        class='mx-auto w-full whitespace-nowrap rounded-lg divide-y divide-gray-300 overflow-hidden datatable'>
                        <thead class="bg-gray-50 font-Mulish">
                            <tr class="text-left text-darkskin">
                                <th class="font-semibold text-sm px-6 py-4">
                                    #
                                </th>
                                <th class="font-semibold text-sm px-6 py-4">
                                    Label
                                </th>
                                <th class="font-semibold text-sm px-6 py-4">
                                    Date
                                </th>
                                <th class="font-semibold text-sm px-6 py-4">
                                    Time In
                                </th>
                                <th class="font-semibold text-sm px-6 py-4">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 font-Mulish text-sm">
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($attendance as $item)
                                <tr class="border-2">
                                    <td class="px-6 py-4 font-normal">
                                        {{ $count++ }}
                                    </td>
                                    <td class="px-6 py-4 font-normal">
                                        <span
                                            class="rounded-lg bg-[#063970] text-white font-semibold py-1 px-6 text-xs">
                                            {{ $item->event_label }}
                                        </span>

                                    </td>
                                    <td class="px-6 py-4 font-normal">
                                        {{ \Carbon\Carbon::parse($item->event_date)->format('j F, Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-normal">
                                        {{ $item->admitted_at }}
                                    </td>
                                    @if (is_null($item->admitted_at))
                                        <td class="px-6 py-4 font-light text-[#323232] flex space-x-3">
                                            <a href="#" class="bg-[#063970] text-white py-1 px-2 rounded-md"
                                                title="Mark Present"
                                                wire:click.prevent="markPresent({{ $item }})">
                                                <i class="fas fa-check"></i> Mark Present
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($details->reg_info->super_session->count())
            <div>
                <h2 class="font-semibold mb-2">Master Class Events</h2>
                @foreach ($details->reg_info->super_session as $key => $session)
                    <div class="p-4 bg-white rounded-lg mb-4" id="layout{{ $key }}">
                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Event Name:</h6>
                            <div class="text-left">
                                {{ $session->masterclass->title }}
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Date:</h6>
                            <div class="text-left">
                                {{ $session->preferred_date }}
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Time:</h6>
                            <div class="text-left">
                                {{ $session->preferred_time }}
                            </div>
                        </div>

                        <div class="flex justify-between border-b-2 border-gray-200 py-2 mb-4">
                            <h6 class="text-left font-semibold">Status:</h6>
                            <div class="text-left">
                                <span
                                    class="{{ $session->status == 'verified' ? 'bg-green-600' : 'bg-red-600' }} text-white py-1 px-6 rounded-md text-xs">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </div>
                        </div>

                        @if (!is_null($session->admitted_at))
                            <div class="flex justify-between border-gray-200 py-2 mb-4">
                                <h6 class="text-left font-semibold">Time In:</h6>
                                <div class="text-left">
                                    {{ \Carbon\Carbon::parse($session->admitted_at)->format('j F, Y H:i a') }}
                                </div>
                            </div>
                        @endif

                        @if ($session->status == 'pending')
                            <div class="text-center">
                                <button type="button" class="mx-auto bg-red-600 text-white py-2 px-6 rounded-lg"
                                    wire:click.prevent="checkIn({{ $session }})">Check In
                                    <span wire:loading wire:target="checkIn">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="printableArea" class="hidden">
        <div class="flex justify-center items-center h-screen">
            <div class="text-center">
                <h2 class="font-semibold text-5xl mt-8">
                    {{ strtoupper($details->reg_info->lastname) }}
                </h2>
                <h2 class="font-semibold text-5xl">
                    {{ strtoupper($details->reg_info->firstname) }}
                </h2>
            </div>
        </div>
    </div>
</div>
@section('javascripts')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/assets/js/datatables.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            $('.datatable').DataTable({
                searching: false,
                lengthChange: false
            });
        });

        window.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('.datatable').DataTable({
                    searching: false,
                    lengthChange: false
                });
            });
        });

        window.addEventListener('start-printer', event => {
            printPageArea();
        });

        function printPageArea() {
            var prtContent = document.getElementById("printableArea");
            prtContent.style.display = "";
            var printContent = prtContent.innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
