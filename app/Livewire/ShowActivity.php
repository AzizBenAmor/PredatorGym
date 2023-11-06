<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('dashboard.showActivity')]
class ShowActivity extends Component
{
    public $activity;

    public function mount($activityId){

        $activity=Activity::with('schedules')->find($activityId);
        $this->activity=$activity;

    }

    public function render()
    {
        return view('livewire.show-activity');
    }
}
