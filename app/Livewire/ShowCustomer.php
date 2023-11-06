<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('dashboard.showCustomer')]
class ShowCustomer extends Component
{

    public $customer;

    public function mount($customerId){

        $customer=Customer::with('activities')->find($customerId);
        $this->customer=$customer;

    }
    
    public function render()
    {
        return view('livewire.show-customer');
    }
}
