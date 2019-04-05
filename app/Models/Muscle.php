<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    protected $table = 'muscles';

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
