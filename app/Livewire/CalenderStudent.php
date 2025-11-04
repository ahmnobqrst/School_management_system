<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class CalenderStudent extends Component
{
    public $events;
    public $locale;

    public function mount()
    {
        $this->locale = app()->getLocale();
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $locale = app()->getLocale();
        
        $this->events = json_encode(
            Event::all()->map(function ($event) use ($locale) {
                $title = '';
                if (is_array($event->title)) {
                    $title = $event->title[$locale] ?? $event->title['en'] ?? '';
                } elseif (method_exists($event, 'getTranslation')) {
                    $title = $event->getTranslation('title', $locale);
                } else {
                    $title = $event->title;
                }
                
                return [
                    'id'    => $event->id,
                    'title' => $title,
                    'start' => $event->start,
                    'allDay' => true,
                ];
            })->toArray()
        );
    }

    // استماع لتغيير اللغة
    protected $listeners = ['languageChanged' => 'refreshCalendar'];

    public function refreshCalendar()
    {
        $this->locale = app()->getLocale();
        $this->loadEvents();
        $this->dispatch('calendarRefresh');
    }

    public function render()
    {
        return view('livewire.calender-student');
    }
}