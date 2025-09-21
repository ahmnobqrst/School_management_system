<div>
    <div>

        <style>
        #calendar-container {
            width: 100%;
        }

        #calendar {
            padding: 10px;
            margin: 10px;
            width: 100%;
            height: 610px;
            border: 2px solid black;
        }
        </style>
    </div>

    <div>
        <div id='calendar-container'>
            <div id='calendar' wire:ignore data-events="{{ $events }}"></div>
        </div>
    </div>

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) {
            console.error('Calendar element not found');
            return;
        }

        let eventsData = [];
        try {
            const eventsAttr = calendarEl.getAttribute('data-events');
            console.log('Raw events attribute:', eventsAttr);

            if (eventsAttr) {
                eventsData = JSON.parse(eventsAttr);
            }
            console.log('Parsed events data:', eventsData);
        } catch (e) {
            console.error('Failed to parse events data:', e);
            eventsData = [];
        }

        console.log('Livewire available:', !!window.Livewire);

        const translations = {
            title_ar_prompt: "{{ __('Students_trans.Enter_Event_Title') }}",
            title_ar_required: "{{ __('Students_trans.title_required') }}",
            title_en_prompt: "{{ __('Students_trans.Enter_Event_Title_en') }}",
            title_en_required: "{{ __('Students_trans.title_en_required') }}",
            success_message: "{{ __('Students_trans.Done_events') }}",
            error_message: "{{ __('Students_trans.Event_add_failed') }}"
        };

        let lastAddedEvent = null;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            events: eventsData,
            editable: true,
            selectable: true,
            allDayDefault: true,
            displayEventTime: false,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            dateClick(info) {
                try {
                    console.log('dateClick triggered with:', info);
                    let title_ar = prompt(translations.title_ar_prompt);
                    console.log('title_ar:', title_ar);
                    if (!title_ar || title_ar.trim() === '') {
                        alert(translations.title_ar_required);
                        return;
                    }

                    let title_en = prompt(translations.title_en_prompt);
                    console.log('title_en:', title_en);
                    if (!title_en || title_en.trim() === '') {
                        alert(translations.title_en_required);
                        return;
                    }

                    let locale = '{{ app()->getLocale() }}';
                    console.log('Locale:', locale);
                    if (!locale || !['ar', 'en'].includes(locale)) {
                        console.warn('Invalid locale, defaulting to en:', locale);
                        locale = 'en';
                    }
                    let title_to_show = (locale === 'ar') ? title_ar : title_en;
                    console.log('title_to_show:', title_to_show);

                    lastAddedEvent = calendar.addEvent({
                        id: 'temp-' + Date.now(),
                        title: title_to_show,
                        start: info.dateStr,
                        allDay: true
                    });
                    console.log('Event added to calendar:', lastAddedEvent);

                    if (!lastAddedEvent) {
                        throw new Error('Failed to add event to calendar');
                    }

                    if (window.Livewire) {
                        let eventData = {
                            title_ar: title_ar.trim(),
                            title_en: title_en.trim(),
                            start: info.dateStr
                        };
                        console.log('Dispatching to Livewire with data:', eventData);
                        Livewire.dispatch('addevent', eventData);
                    } else {
                        console.error('Livewire is not initialized');
                        alert(translations.error_message + ': Livewire is not initialized');
                        lastAddedEvent.remove();
                        lastAddedEvent = null;
                    }
                } catch (e) {
                    console.error('Error in dateClick:', e);
                    alert(translations.error_message + ': ' + e.message);
                    if (lastAddedEvent) {
                        lastAddedEvent.remove();
                        lastAddedEvent = null;
                    }
                }
            },
            eventDrop(info) {
                try {
                    if (window.Livewire) {
                        // Get the date in YYYY-MM-DD format directly from the calendar
                        let droppedDate = info.event
                        .startStr; // This should give us YYYY-MM-DD for all-day events

                        // If startStr doesn't work, extract date manually
                        if (!droppedDate || droppedDate.includes('T')) {
                            // Create date in local timezone to avoid UTC conversion
                            let localDate = new Date(info.event.start.getTime() - (info.event.start
                                .getTimezoneOffset() * 60000));
                            droppedDate = localDate.toISOString().split('T')[0];
                        }

                        let eventData = {
                            id: info.event.id,
                            start: droppedDate
                        };

                        console.log('Event dropped details:');
                        console.log('- Original start object:', info.event.start);
                        console.log('- StartStr from FullCalendar:', info.event.startStr);
                        console.log('- Calculated date:', droppedDate);
                        console.log('- Event data being sent:', eventData);

                        Livewire.dispatch('eventDrop', eventData);
                    } else {
                        console.error('Livewire is not initialized');
                    }
                } catch (e) {
                    console.error('Error in eventDrop:', e);
                    info.revert(); // Revert the event move if there's an error
                }
            }
        });

        try {
            calendar.render();
            console.log('Calendar rendered successfully with', eventsData.length, 'events');
        } catch (e) {
            console.error('Failed to render calendar:', e);
        }

        // Function to refresh calendar events
        window.refreshCalendarEvents = function() {
            if (window.Livewire) {
                Livewire.dispatch('refreshEvents');
            }
        };

        if (window.Livewire) {
            Livewire.on('event-added', (data) => {
                console.log('Event added:', JSON.stringify(data, null, 2));

                // Show success alert with event name
                const successMessage = data.message ||
                    `Event "${data.title || 'Untitled'}" added successfully`;
                alert(successMessage);

                if (lastAddedEvent && data.id) {
                    lastAddedEvent.setProp('id', data.id);
                    lastAddedEvent = null;
                }

                // Refresh the entire calendar to get updated events
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            });

            Livewire.on('event-add-failed', (data) => {
                console.error('Event add failed:', JSON.stringify(data, null, 2));
                alert(data.message || translations.error_message);
                if (lastAddedEvent) {
                    lastAddedEvent.remove();
                    lastAddedEvent = null;
                }
            });

            // Listen for events refresh
            Livewire.on('events-refreshed', (data) => {
                console.log('Events refreshed, updating calendar');
                if (data.events) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(JSON.parse(data.events));
                    calendar.refetchEvents();
                }
            });

            // Listen for event moved confirmation
            Livewire.on('event-moved', (data) => {
                console.log('Event moved confirmation:', data);
                // Optionally refresh calendar to ensure consistency
                setTimeout(() => {
                    calendar.refetchEvents();
                }, 500);
            });
        }
    });
    </script>
    @endpush
</div>