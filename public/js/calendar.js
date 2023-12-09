document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: '700',
        displayEventTime: false,
        businessHours: true,
        locale: 'ja',
        dayCellContent: function(arg){
            return arg.date.getDate();
        },
        buttonText: {
            today: '今月',
        },
        eventSources: [{
            url: '/get_posts',
        }, ],
        dateClick: (e) => {
            const clickedDate = e.date;
            const redirectTo = `/post/create?created_at=${clickedDate.toISOString()}`;
            window.location.href = redirectTo;
        },
        eventDidMount: function(info) {
            if (info.event.start.getMonth() !== calendar.view.currentStart.getMonth()) {
                info.el.style.opacity = '0.15';
            }
        },
    });

    if (window.innerWidth <= 767) {
        calendar.setOption('height', 'auto');
    }

    calendar.render();
});