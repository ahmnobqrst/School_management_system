<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events;

    protected $listeners = ['addevent', 'eventDrop', 'refreshEvents'];

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = json_encode(
            Event::all()->map(function ($event) {
                $locale = app()->getLocale();
                $title = '';
                
                // Handle different ways the title might be stored
                if (is_array($event->title)) {
                    $title = $event->title[$locale] ?? $event->title['en'] ?? '';
                } elseif (method_exists($event, 'getTranslation')) {
                    $title = $event->getTranslation('title', $locale);
                } else {
                    // If title is a simple string
                    $title = $event->title;
                }
                
                return [
                    'id'    => $event->id,
                    'title' => $title,
                    'start' => $event->start,
                    'allDay' => true, // Ensure all events are treated as all-day
                ];
            })
        );
    }

    // Handle Livewire event with proper parameter handling
    public function addevent(...$params)
    {
        \Log::debug('addevent called with params:', ['params' => $params]);
        
        // Handle different parameter formats
        $event = null;
        if (count($params) === 1 && is_array($params[0])) {
            // Single array parameter
            $event = $params[0];
        } elseif (count($params) >= 3) {
            // Multiple parameters (title_ar, title_en, start)
            $event = [
                'title_ar' => $params[0],
                'title_en' => $params[1],
                'start' => $params[2]
            ];
        } elseif (count($params) === 1 && is_object($params[0])) {
            // Convert object to array
            $event = (array) $params[0];
        }

        \Log::debug('Processed event data:', ['event' => $event]);

        if (is_null($event) || !is_array($event)) {
            $errorMessage = 'Invalid event data format';
            \Log::error($errorMessage, ['params' => $params]);
            $this->dispatch('event-add-failed', ['message' => $errorMessage]);
            return;
        }

        // Validate required fields
        if (!isset($event['title_ar']) || !isset($event['title_en']) || !isset($event['start'])) {
            $errorMessage = 'Missing required fields: title_ar, title_en, start';
            \Log::error($errorMessage, ['event' => $event]);
            $this->dispatch('event-add-failed', ['message' => $errorMessage]);
            return;
        }

        if (empty(trim($event['title_ar'])) || empty(trim($event['title_en']))) {
            $errorMessage = 'Title fields cannot be empty';
            \Log::error($errorMessage, ['event' => $event]);
            $this->dispatch('event-add-failed', ['message' => $errorMessage]);
            return;
        }

        try {
            $startDate = \Carbon\Carbon::parse($event['start']);
            if (!$startDate->isValid()) {
                throw new \Exception('Invalid start date format: ' . $event['start']);
            }

            $newEvent = Event::create([
                'title' => [
                    'en' => trim($event['title_en']),
                    'ar' => trim($event['title_ar']),
                ],
                'start' => $startDate->toDateString(),
            ]);

            $this->loadEvents();
            
            // Get the appropriate title based on current locale
            $locale = app()->getLocale();
            $eventTitle = $locale === 'ar' ? trim($event['title_ar']) : trim($event['title_en']);
            
            $this->dispatch('event-added', [
                'message' => 'Event "' . $eventTitle . '" added successfully', 
                'id' => $newEvent->id,
                'title' => $eventTitle
            ]);
        } catch (\Exception $e) {
            $errorMessage = 'Failed to add event: ' . $e->getMessage();
            \Log::error($errorMessage, ['exception' => $e, 'event' => $event]);
            $this->dispatch('event-add-failed', ['message' => $errorMessage]);
        }
    }

    public function eventDrop(...$params)
    {
        \Log::debug('eventDrop called with params:', ['params' => $params]);
        
        // Handle different parameter formats
        $event = null;
        if (count($params) === 1 && is_array($params[0])) {
            // Single array parameter
            $event = $params[0];
        } elseif (count($params) >= 2) {
            // Multiple parameters (id, start)
            $event = [
                'id' => $params[0],
                'start' => $params[1]
            ];
        } elseif (count($params) === 1 && is_object($params[0])) {
            // Convert object to array
            $event = (array) $params[0];
        }

        if (is_null($event) || !isset($event['id']) || !isset($event['start'])) {
            \Log::error('Invalid or missing event data for eventDrop:', ['params' => $params]);
            return;
        }

        try {
            $eventData = Event::find($event['id']);
            if ($eventData) {
                $originalDate = $eventData->start;
                $receivedDate = $event['start'];
                
                \Log::debug('Event drop details:', [
                    'event_id' => $event['id'],
                    'original_date' => $originalDate,
                    'received_date' => $receivedDate,
                    'app_timezone' => config('app.timezone', 'UTC'),
                    'server_timezone' => date_default_timezone_get()
                ]);
                
                // If the received date is already in Y-m-d format, use it directly
                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $receivedDate)) {
                    $dateOnly = $receivedDate;
                    \Log::debug('Date already in Y-m-d format:', ['date' => $dateOnly]);
                } else {
                    // Parse the date and convert to Y-m-d
                    $parsedDate = \Carbon\Carbon::parse($receivedDate);
                    $dateOnly = $parsedDate->format('Y-m-d');
                    \Log::debug('Parsed and formatted date:', [
                        'original' => $receivedDate,
                        'parsed' => $parsedDate->toDateTimeString(),
                        'formatted' => $dateOnly
                    ]);
                }
                
                $eventData->start = $dateOnly;
                $eventData->save();
                
                \Log::debug('Event updated successfully:', [
                    'id' => $event['id'], 
                    'old_date' => $originalDate,
                    'new_date' => $dateOnly,
                    'saved_date' => $eventData->fresh()->start
                ]);
                
                $this->loadEvents();
                
                // Optionally dispatch success event
                $this->dispatch('event-moved', [
                    'message' => 'Event moved successfully',
                    'old_date' => $originalDate,
                    'new_date' => $dateOnly
                ]);
                
            } else {
                \Log::error('Event not found for ID: ' . $event['id']);
            }
        } catch (\Exception $e) {
            \Log::error('Failed to update event: ' . $e->getMessage(), [
                'exception' => $e, 
                'event' => $event,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function refreshEvents()
    {
        $this->loadEvents();
        $this->dispatch('events-refreshed', ['events' => $this->events]);
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}