<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEnfantDetails extends Model
{
    use HasFactory;
    protected $table = 'order_enfant_details';

    // Define the relationship with OrderMaster
    public function order()
    {
        return $this->belongsTo(OrderMaster::class, 'order_id', 'id');
    }
    public function ecole()
    {
        return $this->belongsTo(Ecole::class, 'school_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
