@section('title', 'Zenith Tech Fair::Attendances')
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-8 gap-y-5 mb-4">
        <div class="lg:col-span-2">
            <div class="bg-white mb-4">
                <div class="border-b-2 border-gray-400 py-3 px-8">
                    <h3 class="font-semibold">Attendance</h3>
                </div>
                <div class="p-8">
                    <form class="space-y-3" method="POST">
                        @csrf
                        <div>
                            <label for="event_day"
                                class="w-full md:w-4/5 block font-semibold text-[#544837] mb-2">Event Day</label>
                            <select name="event_day" id="event_day"
                                class="w-full px-4 py-2 rounded border-2 border-[#ccd1d9] outline-none focus:border-[#063970]"
                                required>
                                <option value="">Select...</option>
                                <option value="2023-11-22">Day 1</option>
                                <option value="2023-11-23">Day 2</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($param)
    <div class="p-4 bg-white rounded-lg">
        <div class='overflow-x-auto w-full'>
            <livewire:tables.masterclass :params="$param" />
        </div>
    </div>
    @endif
</div>
@section('javascripts')
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            $('#event_day').on('change', function(event) {
                let selected = $(this).val();
                if (selected != "") {
                    window.location.href = "/portal/attendance/"+selected;
                }
            })
        });
    </script>
@endsection
