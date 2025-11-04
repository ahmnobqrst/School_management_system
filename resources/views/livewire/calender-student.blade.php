<div>
    <style>
        #calendar-container {
            width: 100%;
            padding: 20px;
        }

        #calendar {
            padding: 15px;
            margin: 10px auto;
            max-width: 1200px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* تثبيت التصميم */
        .fc {
            font-family: 'Cairo', sans-serif !important;
        }

        .fc .fc-toolbar {
            margin-bottom: 20px !important;
        }

        .fc .fc-button {
            padding: 6px 12px !important;
            font-size: 14px !important;
        }

        .fc-theme-standard td, 
        .fc-theme-standard th {
            border: 1px solid #ddd !important;
        }

        .fc-daygrid-day {
            min-height: 100px !important;
        }

        .fc-day-today {
            background-color: #fff3cd !important;
        }

        .fc-event {
            cursor: pointer;
            border-radius: 4px;
            padding: 2px 4px;
        }
    </style>

    <!-- للتأكد من البيانات (يمكن حذفها بعد التأكد) -->
    <!-- <pre>{{ json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre> -->

    <div id='calendar-container'>
        <div id='calendar' wire:ignore data-events="{{ $events }}" data-locale="{{ app()->getLocale() }}"></div>
    </div>

    @push('scripts')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/ar.js'></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeCalendar();
    });

    // استماع لتغيير اللغة في Livewire
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', (message, component) => {
            // إعادة تهيئة التقويم عند تحديث Livewire
            setTimeout(() => {
                initializeCalendar();
            }, 100);
        });
    });

    function initializeCalendar() {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) {
            console.error('Calendar element not found');
            return;
        }

        // الحصول على اللغة الحالية
        let currentLocale = calendarEl.getAttribute('data-locale') || 'ar';
        console.log('Current locale:', currentLocale);

        let eventsData = [];
        try {
            const eventsAttr = calendarEl.getAttribute('data-events');
            if (eventsAttr) {
                eventsData = JSON.parse(eventsAttr);
            }
            console.log('Events loaded:', eventsData);
        } catch (e) {
            console.error('Failed to parse events data:', e);
            eventsData = [];
        }

        // إزالة التقويم القديم إن وجد
        if (calendarEl._calendar) {
            calendarEl._calendar.destroy();
        }

        // إنشاء التقويم الجديد
        const calendar = new FullCalendar.Calendar(calendarEl, {
            events: eventsData,
            editable: false,
            selectable: false,
            displayEventTime: false,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            locale: currentLocale, // تطبيق اللغة ديناميكياً
            direction: currentLocale === 'ar' ? 'rtl' : 'ltr', // تغيير الاتجاه حسب اللغة
            eventColor: '#3788d8',
            height: 'auto',
            contentHeight: 'auto',
            aspectRatio: 1.8,
            
            // إعدادات إضافية لتثبيت التصميم
            dayMaxEvents: true,
            moreLinkClick: 'popover',
            
            // تنسيق عرض التاريخ
            dayHeaderFormat: { 
                weekday: currentLocale === 'ar' ? 'long' : 'short'
            },
            
            // تحسين عرض الأحداث
            eventDisplay: 'block',
            
            // معالجة النقر على الحدث
            eventClick: function(info) {
                alert('الحدث: ' + info.event.title);
            }
        });

        calendar.render();
        
        // حفظ مرجع للتقويم
        calendarEl._calendar = calendar;
        
        console.log('Calendar rendered with locale:', currentLocale);
    }
    </script>
    @endpush
</div>