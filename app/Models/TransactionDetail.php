<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';

    // Define the relationship with OrderMaster
    public function order()
    {
        return $this->belongsTo(OrderMaster::class, 'order_id', 'id');
    }
}
