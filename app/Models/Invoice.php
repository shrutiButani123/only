<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 'invoice_date', 'gross_total',
        'discount', 'total_amount', 'customer_name', 'customer_email'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

}
