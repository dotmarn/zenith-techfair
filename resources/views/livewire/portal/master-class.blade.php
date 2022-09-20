@section('title', 'Zenith Tech Fair Portal::Master Classes')
@section('styles')
    <link type="text/css" href="/assets/css/datatables.min.css" rel="stylesheet" />
@endsection
<div class="container mx-auto px-6 py-8" x-data="app()" x-init="init()">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#101010] text-base lg:text-2xl">Master Classes</h2>
                <a href="#"
                    class="flex items-center space-x-1 lg:space-x-3 py-1 lg:py-2 bg-red-600 text-white rounded-lg px-6 text-xs" @click.prevent="toggleModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold">Add New</span>
                </a>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg">
        <div class='overflow-x-auto w-full'>
            <table
                class='mx-auto w-full whitespace-nowrap rounded-lg divide-y divide-gray-300 overflow-hidden datatable'>
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
                        <th class="font-semibold text-sm px-6 py-4">
                            Description
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
                            <td class="px-6 py-4 font-normal whitespace-normal">
                                {{ $item->description }}
                            </td>

                            <td class="px-6 py-4 font-light text-[#323232] flex space-x-3">
                                <a href="" class="bg-[#063970] text-white py-1 px-2 rounded-md" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="#" class="bg-gray-600 text-white py-1 px-2 rounded-md" title="Edit" @click.prevent="toggleEditModal({{ $item }})">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Class Modal --}}
    <div x-show="showModal"
        class="fixed z-30 transition duration-300 transform bg-black bg-opacity-50 inset-0 overflow-y-none"
        x-transition:enter="transition ease-in duration-300 transform"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click.away="showModal = false" style="display: none">
        <div class="lg:w-1/3 lg:float-right font-Poppins max-h-[-webkit-fill-available] overflow-y-scroll">
            <div class="py-8 px-12 bg-[#f5f6f9] min-h-screen">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-semibold text-lg">Create Master Class</h2>
                    <a href="#" @click="showModal = false">
                        <i class="far fa-times-circle fa-2x"></i>
                    </a>
                </div>
                <form class="space-y-5 font-Poppins" wire:submit.prevent="createNew">
                    {{ csrf_field() }}
                    <div>
                        <label for="" class="w-full md:w-4/5 block font-semibold text-[#544837] mb-2">Title</label>
                        <input type="text" wire:model.defer="title" class="w-full px-4 py-2 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                        @error('title') <p class="text-red-600 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="" class="w-full md:w-4/5 block font-semibold text-[#544837] mb-2">Needed Participants</label>
                        <input type="number" wire:model.defer="needed_participants" class="w-full px-4 py-2 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]">
                        @error('needed_participants') <p class="text-red-600 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="" class="w-full md:w-4/5 block font-semibold text-[#544837] mb-2">Description</label>
                        <textarea type="text" wire:model.lazy="description" class="w-full px-4 py-2 rounded border border-[#ccd1d9] outline-none focus:border-[#063970]"></textarea>
                        @error('description') <p class="text-red-600 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <button
                            class="mt-4 w-full py-3 rounded bg-red-600 text-white font-normal shadow-sm">
                            Submit
                            <i class="fas fa-spinner fa-spin" wire:loading wire:target="createNew"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Ends here --}}
</div>
@section('javascripts')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/assets/js/datatables.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            $('.datatable').DataTable({
                searching: true,
                lengthChange: false
            });
        });

        window.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('.datatable').DataTable({
                    searching: true,
                    lengthChange: false
                });
            });
        });

        function app() {
            return {
                init() {
                    showModal = false,
                    showEditModal = false
                },
                toggleModal() {
                    this.showModal = true;
                },
                toggleEditModal(item) {
                    this.showEditModal = true;
                    Livewire.emit('edit_data_updated', item);
                }
            }
        }
    </script>
@endsection
