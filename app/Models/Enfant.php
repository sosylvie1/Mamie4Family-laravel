<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    use HasFactory;

    protected $fillable = [
        'famille_profile_id',
        'nom',
        'age',
    ];

    /**
     * Relation : un enfant appartient à un profil famille
     */
    public function familleProfile()
    {
        return $this->belongsTo(FamilleProfile::class);
    }
}
