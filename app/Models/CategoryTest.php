<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTest extends Model
{
    use HasFactory;
    protected $table = 'category_tests';
    protected $fillable = ['company_id', 'category_id', 'test_id'];
}
