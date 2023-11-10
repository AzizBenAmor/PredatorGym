<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Customer;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Statistic extends Component
{
    public function render()
    {
        $act=Activity::select('id','price')->with('customers')->get();
        $value = 0;

        foreach ($act as $key => $acti) {
            $price = $acti->price;
            $count = count($acti->customers);
            $value += $price * $count;
        }
        Cache::put(date('m'), $value, 60);
        Cache::put(date('y'), $value, 60);
       $perMonth = Cache::get(date('m'));
       $perYear = Cache::get(date('y'));
        $customers=count(Customer::all());
        $activities=count(Activity::all());
        return view('livewire.statistic',compact('customers','activities','perMonth','perYear'));
    }
}
