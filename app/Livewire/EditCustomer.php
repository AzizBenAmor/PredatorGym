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
    public $showManque='';
    public $EditManque;
    public $idManque;

    public function UpdateCustomer(){

        $this->customer->name=$this->name;
        $this->customer->CIN=$this->CIN;
        $this->customer->number=$this->number;
        $this->customer->birthday=$this->birthday;
        $this->customer->update();
        if ($this->manque) {
            
            $this->customer->activities()->updateExistingPivot($this->idManque, ['manque' => $this->manque]);

        }
        if ($this->ActivityEditCounter !== 0) {
        if ($this->showManque== 1) {

            $this->customer->activities()->attach($this->activityEdit[0], ['manque' => $this->EditManque,'date'=>now()]);
            $this->ActivityCounter++;
                $this->ActivityEditCounter--;
            for ($i=1; $i <count($this->activityEdit) ; $i++) { 
                $this->customer->activities()->attach($this->activityEdit[$i],['date'=>now()]);
                $this->ActivityCounter++;
                $this->ActivityEditCounter--;
            }
        }
        else {
            for ($i=0; $i <count($this->activityEdit) ; $i++) { 
                $this->customer->activities()->attach($this->activityEdit[$i],['date'=>now()]);
                $this->ActivityCounter++;
                $this->ActivityEditCounter--;
            }
        }
    }else{

        $this->customer->activities()->updateExistingPivot($this->customer->activities[0],['manque' => $this->EditManque]);

    }
        $this->reset('showManque','EditManque'); 
        $this->mount($this->customer->id);       
        session()->flash('success','Customer Edited Successfully');
    }

    public function DeleteActivity($id){

        foreach ($this->customer->activities as $key => $value) {
                
            if ($value->id == $id) {
                if ($value->pivot !== null) {
                    $this->manque=null;
                }
            }

        }
        $this->customer->activities()->detach($id);
        $this->customer=Customer::findorfail($this->customer->id);
        $this->ActivityCounter--;
        session()->flash('success'," Activity Has been Removed");

    }

    public function Renouvellement($id){

        $activity=Activity::findorfail($id);
        $this->customer->activities()->updateExistingPivot($activity, ['date' => now()]);
        session()->flash('success',"$activity->name Subscription Has been Renewal");

    }

    public function RemoveManque(){

        foreach ($this->customer->activities as $key => $value) {
            if ($value->pivot->manque!==null) {
                $this->customer->activities()->updateExistingPivot($value, ['manque' => null]);

            }
            $this->manque=null;
         }

    }

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
                $this->idManque=$value;
           }
        }
        
    }

    public function render()
    {
        return view('livewire.edit-customer');
    }
}
