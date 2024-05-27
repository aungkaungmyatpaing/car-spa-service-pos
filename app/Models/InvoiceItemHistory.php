<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItemHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_history_id',
        'service_name',
        'quantity',
        'price',
        'total_price',
    ];

    public function invoiceHistory()
    {
        return $this->belongsTo(InvoiceHistory::class);
    }

}
