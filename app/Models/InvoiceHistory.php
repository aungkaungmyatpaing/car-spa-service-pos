<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'total_price',
        'discount',
        'is_fixed',
        'tax',
        'grand_total',
        'paid',
        'change',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoiceItemHistories()
    {
        return $this->hasMany(InvoiceItemHistory::class);
    }
}
