@section('title', 'Zenith Tech Fair::Dashboard')
@section('styles')
    <link type="text/css" href="/assets/css/datatables.min.css" rel="stylesheet" />
@endsection
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#101010] text-base lg:text-2xl">Dashboard</h2>
                {{-- <a href="#"
                    class="flex items-center space-x-1 lg:space-x-3 py-1 lg:py-2 bg-red-600 text-white rounded-lg px-6 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">Verification</span>
                </a> --}}
            </div>

            {{-- <div id="container" wire:ignore></div> --}}
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
                            Name
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Email
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Phone
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Account Number
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Role
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Sector
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Reason for attending
                        </th>
                        {{-- <th class="font-semibold text-sm px-6 py-4">
                            Interests
                        </th> --}}
                        <th class="font-semibold text-sm px-6 py-4">
                            Status
                        </th>
                        <th class="font-semibold text-sm px-6 py-4">
                            Date Registered
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
                    @foreach ($registrations as $item)
                        <tr class="border-2 border-main text-center">
                            <td class="px-6 py-4 font-normal">
                                {{ $count++ }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->firstname . ' ' . $item->lastname }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->phone }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->account_number }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->role }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->sector }}
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ $item->reason }}
                            </td>
                            {{-- <td class="px-6 py-4 font-normal">
                                <div class="flex space-x-3">
                                    @forelse (json_decode($item->interests) as $interest)
                                    <a href="#" class="bg-[#063970] text-white text-xs rounded-md py-1 px-6">
                                        <span>{{ ucfirst($interest) }}</span>
                                    </a>
                                    @empty

                                    @endforelse
                                </div>
                            </td> --}}
                            <td class="px-6 py-4 font-light flex items-center">
                                <i
                                    class="fas fa-square {{ $item->status == 'verified' ? 'text-[#6dd400]' : 'text-red-600' }}"></i>
                                <label for="" class="ml-2">{{ ucfirst($item->status) }}</label>
                            </td>
                            <td class="px-6 py-4 font-normal">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('j F, Y H:i a') }}
                            </td>
                            <td class="px-6 py-4 font-light text-[#323232] flex space-x-3">
                                <a href="{{ route('portal.view-registration', $item->tokens->token) }}" class="bg-[#063970] text-white py-1 px-2 rounded-md" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('javascripts')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/assets/js/datatables.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            $('.datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel'
                ],
                searching: true,
                lengthChange: false
            });
        });

        window.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('.datatable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel'
                    ],
                    searching: true,
                    lengthChange: false
                });
            });
        });
    </script>
@endsection
