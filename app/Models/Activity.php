<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function customers(){

        return $this->belongsToMany(Customer::class)->withPivot('manque')->withTimestamps();

    }

    public function schedules()
    {
        return $this->hasMany(ActivitySchedule::class);
    }

    public function scopeSearch($query,$value)  {
        
        $query->where('name','like',"%{$value}%")->orWhereHas('customers', function ($query) use ($value) {
            $query->where('name','like',"%{$value}%");
        });

    }
}
