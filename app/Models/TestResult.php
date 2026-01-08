<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'registration_id',
        'category_id',
        'test_id',
        'form_data',
        'status'
    ];

    protected $casts = [
        'form_data' => 'array'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
} 