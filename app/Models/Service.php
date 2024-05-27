<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'duration_id',
        'name',
        'size_id',
        'price',
        'barcode',
        'note'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function invoiceItemHistories()
    {
        return $this->hasMany(InvoiceItemHistory::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
