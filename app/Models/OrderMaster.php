<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    use HasFactory;
    protected $table = 'order_master';

    protected $fillable = [
        'code',
        'total_amount',
        'adhesion',
        'contribution',
        'mode',
        'user_id',
        'payment_status',
        'payment_id'
    ];

    public function enfants()
    {
        return $this->hasMany(OrderEnfantDetails::class, 'order_id', 'id');
    }

    // Define the relationship with TransactionDetail
    public function transaction()
    {
        return $this->hasOne(TransactionDetail::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parents()
    {
        return $this->belongsTo(Parents::class);
    }

    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }
}
