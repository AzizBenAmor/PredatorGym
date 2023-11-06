<?php

namespace App\Livewire;

use App\Models\Customer as ModelsCustomer;
use Livewire\Attributes\Url;
use Livewire\Component;

class Customer extends Component
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

    public function addCustomer(){

        return redirect()->route('addCustomer');

    }

    public function delete(ModelsCustomer $customer){

        $customer->delete();

    }

    public function render()
    {
        return view('livewire.customer',[
            'customers'=>ModelsCustomer::with('activities')->search($this->search)
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perpage)
        ]);
    }
}
