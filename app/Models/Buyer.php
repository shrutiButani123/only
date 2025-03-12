<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'address', 'mobile_no',
        'buyer_type', 'cut_quality', 'color', 'clarity',
        'carat_weight', 'amount'
    ];

}
