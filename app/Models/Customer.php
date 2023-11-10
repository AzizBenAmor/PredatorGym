<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'CIN',
        'number',
        'birthday',
    ];

    public function activities(){

        return $this->belongsToMany(Activity::class)->withPivot('manque','date')->withTimestamps();

    }

    public function scopeSearch($query,$value)  {
        
        $query->where('name','like',"%{$value}%")->orWhere('CIN','like',"%{$value}%");

    }
}
