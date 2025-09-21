<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Counter extends Component
{
    
   
    public $search = 'ahmed';
 
    public function render()
    {
        return view('livewire.counter', [
            'users' => User::where('name', $this->search)->get(),
        ]);
    }
}
