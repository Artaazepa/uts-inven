<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSchedule extends Model
{
    protected $fillable = [
        'item_name', 
        'scheduled_date', 
        'description',
        'status'
    ];
    protected $casts = [
        'scheduled_date' => 'date',
    ];
    
}

