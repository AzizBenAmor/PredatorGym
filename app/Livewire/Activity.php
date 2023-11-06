<?php

namespace App\Livewire;

use App\Models\Activity as ModelsActivity;
use Livewire\Attributes\Url;
use Livewire\Component;

class Activity extends Component
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

    public function addActivity(){

        return redirect()->route('addActivity');

    }
    public function delete(ModelsActivity $activity){

        $activity->delete();

    }

    public function render()
    {
        return view('livewire.activity',[
            'activities'=>ModelsActivity::with('customers')->search($this->search)
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perpage)
        ]);
    }
}
