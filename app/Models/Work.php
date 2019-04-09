<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Work extends Model
{
    protected $table = 'works';

    protected $fillable = [
        'exercise_id', 'training_id',
        'series', 'weight', 'repeat', 'rest',
        'description'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function exercise(): HasOne
    {
        return $this->hasOne(Exercise::class, 'id', 'exercise_id');
    }

    public function training(): HasOne
    {
        return $this->hasOne(Training::class, 'id', 'training_id');
    }
}
