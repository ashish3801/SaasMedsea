<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['name','company_id', 'price', 'discount_price', 'slug','field_type','dropdown_values'];
    protected $casts = [
        'dropdown_values' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($test) {
            if (!$test->slug) {
                $test->slug = Str::slug($test->name);
            }
        });

        static::updating(function ($test) {
            if ($test->isDirty('name') && !$test->isDirty('slug')) {
                $test->slug = Str::slug($test->name);
            }
        });
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_tests');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_tests');
    }

    public function getFormNameAttribute()
    {
        return Str::slug($this->name) . '_form';
    }
}
