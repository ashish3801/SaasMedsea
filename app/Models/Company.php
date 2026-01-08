<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'contact', 'address', 'logo', 'is_active'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
