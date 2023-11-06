<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\ActivitySchedule;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddActivity extends Component
{

    public $DateCounter=0;
    #[Rule('required|min:2|max:80')]
    public $name;
    #[Rule('required|numeric|min:2')]
    public $price;
    #[Rule(['day_of_weeks.*'=>"required"])]
    public $day_of_weeks=[];
    #[Rule(['start_times.*'=>"required"])]
    public $start_times=[];
    #[Rule(['end_times.*'=>"required"])]
    public $end_times=[];



    public function CreateActivity(){
      
        
       
        $this->validate();

        $activity= new Activity();
        $activity->name=$this->name;
        $activity->price=$this->price;
        $activity->save();

        if (!empty($this->day_of_weeks)) {
            foreach ($this->day_of_weeks as $key => $value) {
                $activitySchedule = ActivitySchedule::create([
                    'day_of_week' => $this->day_of_weeks[$key],
                    'start_time'=>$this->start_times[$key],
                    'end_time'=>$this->end_times[$key],
                    'activity_id'=>$activity->id
                 ]);
            }
        }
        session()->flash('success', 'Activity created successfully.');
        $this->reset(['name', 'price', 'day_of_weeks', 'start_times', 'end_times','DateCounter']);
    }

    public function incrementDateCounter(){

        $this->day_of_weeks[] = '';
        $this->start_times[] = '';
        $this->end_times[] = '';
        $this->DateCounter++;

    }

    public function decrementDateCounter(){

        unset($this->day_of_weeks[$this->DateCounter-1]);
        unset($this->start_times[$this->DateCounter-1]);
        unset($this->end_times[$this->DateCounter-1]);
        $this->DateCounter--;

    }
  
    public function render()
    {
      
        return view('livewire.add-activity');
    }
}
