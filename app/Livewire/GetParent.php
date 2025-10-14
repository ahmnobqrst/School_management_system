<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{MyParent,Student};
use App\Models\National;
use App\Models\Religions;
use App\Models\BloodType;
use App\Traits\ZoomTraitIntegration;

class GetParent extends Component
{
    use ZoomTraitIntegration;

    public function render()
    {

        $section = $this->getSections();
        
        return view('livewire.get-parent', [
            'Nationalities' => National::all(),
            'Type_Bloods' => BloodType::all(),
            'Religions' => Religions::all(),
            'students' => Student::whereHas('Parents')->whereIn('section_id', $section)->paginate(10),
        ]);
    }
}
