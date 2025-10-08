<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilleProfile extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Colonnes assignables en masse
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'user_id',
        'adresse',
        'ville',
        'arrondissement',
        'departement',
        'telephone',
        'nombre_enfants',
        'enfants',
        'photo',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-famille.png');
    }
}
