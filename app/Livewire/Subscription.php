<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Url;
use Livewire\Component;

class Subscription extends Component
{
    #[Url(history:true)]
    public $perpage=5;
    #[Url(history:true)]
    public $sortBy="created_at";
    #[Url(history:true)]
    public $sortDir="DESC";
    #[Url(history:true)]
    public $search='';
    
    public function setSortBy($value){
       
        if ($value == $this->sortBy) {
            $this->sortDir= ($this->sortDir=="DESC")? "ASC" :"DESC";
        }
       
        $this->sortBy=$value;

    }
    
    public function delete(Customer $customer){

        $customer->delete();

    }

    public function render()
    {
        return view('livewire.subscription',[
            'customers'=>Customer::with('activities')
            ->whereHas('activities',function ($query){
                $query->where('date','<',now()->subDays(24));
            })
            ->search($this->search)
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perpage)
        ]);
    }
}
