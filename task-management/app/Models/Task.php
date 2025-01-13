<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'created_by',
        'due_date'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->due_date) {
                $model->due_date = Carbon::now()->addDays(7);  // Set default to 7 days from now
            }
        });
    }
  
}
