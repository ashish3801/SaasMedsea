<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
   use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'address',
        'city_id',
        'logo',
        'stamp',
        'phone',
        'email',
        'is_active',
        'branch'
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function registration(){
        return $this->hasMany(Registration::class);
    }

    public function employee(){
        return $this->hasMany(Employee::class);
    }
}
