<?php

use App\Livewire\EditActivity;
use App\Livewire\EditCustomer;
use App\Livewire\ShowActivity;
use App\Livewire\ShowCustomer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/Customer', function () {
        return view('dashboard.Customer');
    })->name('customer');
    Route::get('/Activity', function () {
        return view('dashboard.Activity');
    })->name('activity');
    Route::get('/addActivity', function () {
        return view('dashboard.addActivity');
    })->name('addActivity');
    Route::get('/addCustomer', function () {
        return view('dashboard.addCustomer');
    })->name('addCustomer');
    Route::get('/{activityId}/showActivity',ShowActivity::class )->name('showActivity');
    Route::get('/{activityId}/editActivity',EditActivity::class )->name('editActivity');
    Route::get('/{customerId}/showCustomer',ShowCustomer::class )->name('showCustomer');
    Route::get('/{customerId}/editCustomer',EditCustomer::class )->name('editCustomer');


});


