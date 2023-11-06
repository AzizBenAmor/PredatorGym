<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Customer;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('dashboard.editCustomer')]
class EditCustomer extends Component
{

    public $ActivityEditCounter=0;
    public $activities;
    public $customer;
    public $name;
    public $CIN;
    public $number;
    public $birthday;
    public $ActivityCounter;
    public $manque;
    public $activityEdit=[];

    public function AddNewActivity($condition){

        if ($condition) {
            $this->activityEdit[$this->ActivityEditCounter]='';
            $this->ActivityEditCounter++;
        }else{
            
            unset($this->activityEdit[$this->ActivityEditCounter-1]);
            $this->ActivityEditCounter--;

        }
    }
    public function mount($customerId){

        $this->customer=Customer::with('activities')->findOrFail($customerId);
        $this->name=$this->customer->name;
        $this->CIN=$this->customer->CIN;
        $this->number=$this->customer->number;
        $this->birthday=$this->customer->birthday;
        $this->ActivityCounter=count($this->customer->activities);
        $this->activities=Activity::select('id','name')->get();
        foreach ($this->customer->activities as $key => $value) {
           if ($value->pivot->manque!==null) {
                $this->manque=$value->pivot->manque;
           }
        }
        
    }

    public function render()
    {
        return view('livewire.edit-customer');
    }
}
