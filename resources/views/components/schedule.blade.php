<div class="card">
    <div class="card-body">
        <div id='calendar'></div>
    </div>
</div>

@push('js-stack')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                firstDay: 1,
                height: "auto",
                themeSystem: 'bootstrap',
                events: "{{ route('schedules.search') }}",
                eventDidMount: function(info) {
                    tippy(info.el, {
                        theme: 'light',
                        allowHTML: true,
                        content: 'Loading...',
                        onShow: (instance) => {
                            const scheduleSummaryUrl =
                                "{{ route('schedules.summary', ['date' => ':date', 'schedule' => ':schedule']) }}";
                            console.log(scheduleSummaryUrl);
                            httpService.get(
                                scheduleSummaryUrl
                                .replace(':date', moment(info.event.start).format(
                                    "YYYY-MM-DD"))
                                .replace(':schedule', info.event.extendedProps.id)
                            ).then(response => {
                                instance.setContent(`
             <div class="container p-0 m-0">
         <div class="row pl-3 pr-3 bg-dark"> <h5 class="mx-auto">${info.event.title}</h5></div>
         <div class="row pl-3 pr-3 pt-1"><label>{{ __('app.fields.time') }} : ${info.event.extendedProps.time}</label></div>
         <div class="row pl-3 pr-3 pt-1"><label>{{ __('app.fields.currentNumber') }} : ${response.data.number}</label></div>
         <div class="row pl-3 pr-3 pt-1"><label>{{ __('app.fields.estimatedTime') }} : ${response.data.time}</label></div>
         <div class="row pl-3 pr-3 pt-1"><label>{{ __('app.fields.channelingFee') }} : ${response.data.channeling_fee_text}</label></div>
         </div>`);
                            });
                        }
                    });
                },
                eventClick: handleScheduleClick
            });
            calendar.render();
        });
    </script>
@endpush