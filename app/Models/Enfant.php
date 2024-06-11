<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    use HasFactory;
    protected $table = 'enfants';

    // protected $fillable = ['parent_id', 'role', 'school', 'class'];

    public function ecole()
    {
        return $this->belongsTo(Ecole::class); // Adjust the column names if necessary
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
