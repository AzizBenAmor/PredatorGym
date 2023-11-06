<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\ActivitySchedule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
#[Layout('dashboard.editActivity')]
class EditActivity extends Component
{
    

    public $activity;
    #[Rule('required|min:2|max:80')]
    public $name;
    #[Rule('required|numeric|min:2')]
    public $price;
    public $SeanceCounter=0;
    public $DateCounter;
    #[Rule(['day_of_weeks.*'=>"required"],attribute:['day_of_weeks.*'=>'Day'])]
    public $day_of_weeks=[];
    #[Rule(['start_times.*'=>"required"],attribute:['start_times.*'=>'Start Time'])]
    public $start_times=[];
    #[Rule(['end_times.*'=>"required|after:start_times.*"],attribute:['end_times.*'=>'End Time'])]
    public $end_times=[];
    #[Rule(['day_of_weeks_edit.*'=>"required"],attribute:['day_of_weeks_edit.*'=>'Day'])]
    public $day_of_weeks_edit=[];
    #[Rule(['start_times_edit.*'=>"required"],attribute:['start_times_edit.*'=>'Start Time'])]
    public $start_times_edit=[];
    #[Rule(['end_times_edit.*'=>"required|after:start_times_edit.*"],attribute:['end_times_edit.*'=>'End Time'])]
    public $end_times_edit=[];


    public function EditActivity(){

        $this->validate();
        
        for ($i=0; $i < $this->SeanceCounter ; $i++) { 
            $schedule= new ActivitySchedule();
            $schedule->activity_id= $this->activity->id;
            $schedule->day_of_week= $this->day_of_weeks_edit[$i];
            $schedule->start_time= $this->start_times_edit[$i];
            $schedule->end_time= $this->end_times_edit[$i]; 
            $schedule->save();
        }
        for ($i=0; $i < $this->DateCounter ; $i++) { 
            $schedule= ActivitySchedule::findorfail($this->activity->schedules[$i]->id);
            if (isset($this->day_of_weeks[$i])) {
                $schedule->day_of_week= $this->day_of_weeks[$i];
            }
            if (isset($this->start_times[$i])) {
                $schedule->start_time= $this->start_times[$i];
            }
            if (isset($this->end_times[$i])) {
                $schedule->end_time= $this->end_times[$i]; 
            }
            $schedule->update();
        }
        if ($this->name) {
            $this->activity->name=$this->name;
        }
        if ($this->price) {
            $this->activity->price=$this->price;
        }
        $this->activity->save();
        session()->flash('success','activity is modified');
      

    }

    public function AddNewSeance($condition){

        if ($condition) {
            $this->day_of_weeks_edit[$this->SeanceCounter]='';
            $this->start_times_edit[$this->SeanceCounter]='';
            $this->end_times_edit[$this->SeanceCounter]='';
            $this->SeanceCounter++;
        }else{
            unset($this->day_of_weeks_edit[$this->SeanceCounter-1]);
            unset($this->start_times_edit[$this->SeanceCounter-1]);
            unset($this->end_times_edit[$this->SeanceCounter-1]);
            $this->SeanceCounter--;

        }
       

    }

    public function RemoveSeance($id){

        $schedule=ActivitySchedule::findorfail($id);
        $schedule->delete();
        $this->DateCounter--;
        session()->flash('success','Seance Removed');

    }

    public function mount($activityId){

        $this->activity=Activity::with('schedules')->find($activityId);
        $this->price =$this->activity->price;
        $this->name=$this->activity->name;
        $this->DateCounter=count($this->activity->schedules);
        foreach ($this->activity->schedules as $key => $value) {
            
            $this->day_of_weeks[]=$value->day_of_week;
            $this->start_times[]=$value->start_time;
            $this->end_times[]=$value->end_time;

        }

    }

    public function render()
    {
        return view('livewire.edit-activity');
    }
}
