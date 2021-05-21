<div class="card">
    <div class="card-body">
        <div id='calendar'></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            firstDay: 1,
            themeSystem: 'bootstrap',
            events: "{{ route('schedules.search') }}",
            eventDidMount: function(info) {
                tippy(info.el, {
                    theme: 'light',
                    content: `
     <div class="container p-0 m-0">
 <div class="row pl-3 pr-3 bg-dark"> <h5 class="mx-auto">${info.event.title}</h5></div>
 <div class="row pl-3 pr-3 pt-1"><label>{{ __('app.fields.time') }} : ${info.event.extendedProps.time}</label></div>
 </div>`,
                    allowHTML: true,
                });
            },
            eventClick: handleScheduleClick
        });
        calendar.render();
    });
</script>