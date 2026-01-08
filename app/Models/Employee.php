<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'emp_id',
        'emp_name',
        'phone_no',
        'email',
        'dgs_approval_number',
        'certificate_issued_by',
        'certificate_issue_date',
        'sign_upload',
        'stamp_upload',
        'created_by',
        'is_active',
        'clinic_id'
    ];

    public function clinic(){
        return $this->belongsTo(Clinic::class, 'clinic_id ');
    }

    public function registration(){
        return $this->hasMany(Registration::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permissionName)
    {
        return $this->role && $this->role->permissions->contains('name', $permissionName);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
