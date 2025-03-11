<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;

    protected $table = 'weight_logs';
    // ...

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}