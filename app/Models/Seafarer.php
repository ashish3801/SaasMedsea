<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seafarer extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'f_name',
        'm_name',
        'l_name',
        'phone_no',
        'email',
        'dob',
        'gender',
        'created_by',
        'is_active',
        'pob'
    ];

    public function registration(){
        return $this->hasMany(Registration::class);
    }
}
