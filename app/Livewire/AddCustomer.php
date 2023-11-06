<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Customer;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddCustomer extends Component
{
    public $ActivityCounter=1;
    public $showManque='';

    #[Rule('required|min:2|max:80')]
    public $name;
    #[Rule('required|numeric|digits:8')]
    public $number;
    #[Rule('nullable|unique:customers,CIN|digits:8')]
    public $CIN;
    #[Rule('required|date_format:Y-m-d')]
    public $birthday;
    #[Rule(['activity.*'=>"required|exists:activities,id"])]
    public $activity=[];
    #[Rule('nullable|numeric')]
    public $manque;

    public function incrementActivityCounter(){

        $this->activity[] = '';
        $this->ActivityCounter++;

    }

    public function decrementActivityCounter(){

        unset($this->activity[$this->ActivityCounter-1]);
        $this->ActivityCounter--;

    }

    public function CreateCustomer(){

        $this->validate();
        $customer= new Customer();
        $customer->name=$this->name;
        if ($this->CIN) {
            $customer->CIN=$this->CIN;
        }
        $customer->birthday=$this->birthday;
        $customer->number=$this->number;
        $customer->save();

        if (!empty($this->activity)) {

            if ($this->showManque== 1) {

                $customer->activities()->attach($this->activity[0], ['manque' => $this->manque]);
                for ($i=1; $i <count($this->activity) ; $i++) { 
                    $customer->activities()->attach($this->activity[$i]);
                }
            }
            else {
                for ($i=0; $i <count($this->activity) ; $i++) { 
                    $customer->activities()->attach($this->activity[$i]);
                }
            }
           
        }
        $this->reset();
        session()->flash('success', 'Customer created successfully.');
       

    }

    public function mount(){

        $this->activity[] = '';
      
        
    }

    public function render()
    {
        $activities=Activity::select('id','name')->get();
        return view('livewire.add-customer',compact('activities'));
    }
}
