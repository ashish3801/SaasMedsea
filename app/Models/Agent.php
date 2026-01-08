<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'phone_no',
        'email',
        'is_active',
        'created_by',
        'updated_by',
    ];
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'agent_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
