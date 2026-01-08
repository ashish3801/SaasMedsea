<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'category',
        'food_handler',
        'watchkeeper',
        'created_by',
    ];
}
