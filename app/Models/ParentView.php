<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentView extends Model
{
    use HasFactory;
    protected $table = 'parent_views';

    protected $fillable = [
        'parent_id',
        'last_payment_date',
        'membership_number',
        'parent_name',
        'parent_email',
        'password',
        'parent_telephone',
        'member_adherent',
        'insured_child',
        'number_child',
        'role',
        'school',
        'school_ids',
        'class_names',
        'class_ids',
    ];

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }
}
