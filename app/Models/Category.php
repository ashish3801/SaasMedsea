<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','package_id', 'name', 'price', 'discount_price'];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'category_tests', 'category_id', 'test_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_categories');
    }
}
