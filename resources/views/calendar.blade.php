<script src="//unpkg.com/@popperjs/core@2" defer></script>
<script src="//unpkg.com/tippy.js@6" defer></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('title', 'カレンダー')

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth font-semibold">{{ __('Calendar') }}</h2>
    </x-slot>
    <div class="h-full max-w-7xl mx-auto mb-40 p-6 md:p-8 lg:p-12 space-y-20 sm:space-y-36">
        <div class="w-full space-y-5 md:space-y-8 mt-6 sm:mt-12">
            <div id='calendar'></div>
        </div>
    </div>
</x-app-layout>

<style>
    #fc-dom-1 {
        font-size: 22px;
    }

    .fc-toolbar-chunk,
    .fc-event-title {
        font-size: 12px;
    }

    .fc-daygrid-day-number,
    .fc-col-header-cell-cushion {
        font-size: 14px;
    }

    @media screen and (min-width: 768px) {
        #fc-dom-1 {
            font-size: 30px;
        }

        .fc-toolbar-chunk {
            font-size: 14px;
        }

        .fc-daygrid-day-number,
        .fc-col-header-cell-cushion {
            font-size: 16px;
        }
    }
</style>
