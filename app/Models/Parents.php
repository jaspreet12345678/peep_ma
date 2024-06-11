<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parents';

    public function enfants()
    {
        return $this->hasMany(Enfant::class, 'parent_id', 'id');
    }
}
