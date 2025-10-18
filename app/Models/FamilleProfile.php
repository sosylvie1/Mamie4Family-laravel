<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilleProfile extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | 🔸 Colonnes assignables
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'user_id',
        'adresse',
        'departement',
        'ville',
        'arrondissement',
        'telephone',
        'photo',
        'code_postal',
        'nombre_enfants',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔹 Relations
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enfants()
    {
        // ✅ clé étrangère explicite (important pour éviter les décalages)
        return $this->hasMany(Enfant::class, 'famille_profile_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | 🔸 Accessors / Helpers
    |--------------------------------------------------------------------------
    */
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-famille.png');
    }

    /*
    |--------------------------------------------------------------------------
    | 🔸 Méthode pratique pour compter les enfants
    |--------------------------------------------------------------------------
    */
    public function nombreEnfants()
    {
        return $this->enfants()->count();
    }
}
