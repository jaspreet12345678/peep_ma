<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnfantView extends Model
{
    use HasFactory;

    protected $table = 'enfants_view';

    protected $fillable = [
        'enfant_id',
        'nom',
        'prenom',
        'class_id',
        'class_name',
        'ecole_id',
        'ecole_name',
        'parent_id',
        'parent_nom',
        'parent_prenom',
        'assurance_scolaire',
        'assurance_frais',
        'attestation_num',
        'parent_telephone',
        'parent_email',
        'dob',
        'adhesion',
        'contribution',
        'last_insurance_paid',
    ];
}
