<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySchedule extends Model
{
    use HasFactory;

    protected $table = 'activity_schedule';
    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
       'activity_id'
    ];

    public function activity()
{
    return $this->belongsTo(Activity::class);
}
}
