@section('title', 'Zenith Tech Fair::Participants')
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:gap-x-8 gap-y-5 mb-4">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-[#101010] text-base lg:text-2xl">{{ $item->title }}</h2>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-lg">
        <div class='overflow-x-auto w-full'>
            <livewire:tables.masterclass-participants :params="$param" />
        </div>
    </div>

</div>
