@section('title', 'Zenith Tech Fair Portal::Master Classes')
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#101010] text-base lg:text-2xl">Master Classes</h2>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg">
        {{-- <livewire:tables.masterclass /> --}}
        <div class='overflow-x-auto w-full'>
            <table
                class='mx-auto w-full whitespace-nowrap rounded-lg divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-50 font-Mulish">
                    <tr class="text-darkskin text-center">
                        <th class="font-semibold text-sm px-6 py-4">
                            #
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Title
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Maximum Participant
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Number Registered
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 font-Mulish text-sm">
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($super_sessions as $item)
                        <tr class="border-2 border-main text-center">
                            <td class="px-6 py-4 font-normal">
                                {{ $count++ }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->title }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->max_participants }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                <span class="bg-red-600 text-white py-1 px-4 rounded-lg font-semibold">
                                    {{ $item->registrations_count }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

