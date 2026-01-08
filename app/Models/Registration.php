<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{

    use HasFactory;
    protected $fillable = [
        'company_id',
        'indos_no',
        'seafarer_id',
        'passport_no',
        'cdc_no',
        'aadhaar_no',
        'rank_id',
        'nationality_id',
        'clinic_id',
        'company_name',
        'address',
        'vessel_name',
        'vessel_type',
        'route',
        'referred_by',
        'created_by',
        'is_qr_register',
        'signature',
        'profile',
        'is_active',
        'employee_id',
        'package_id'

    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'clinic_id');
    }

    public function seafarer()
    {
        return $this->belongsTo(Seafarer::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'user_packages');
    }
    public function medicalapproval()
    {
        return $this->hasOne(MedicalDataApproval::class);
    }
}
