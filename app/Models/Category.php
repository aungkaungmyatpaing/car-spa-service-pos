<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category', 'description'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
