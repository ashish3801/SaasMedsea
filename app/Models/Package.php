<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','name', 'package_details','category_id', 'test_id','report_id', 'other_category', 'other_test', 'price', 'discount_price'];
    protected $casts = [
        'test_id' => 'array',
        'report_id' => 'array',
    ];



    public function categories()
    {
        return $this->belongsToMany(Category::class, 'package_categories')
                ->withPivot('company_id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'package_tests')
                ->withPivot('company_id');
    }

    public function registrations()
    {
        return $this->belongsToMany(Registration::class, 'user_packages', 'package_id', 'registration_id');
    }
}
