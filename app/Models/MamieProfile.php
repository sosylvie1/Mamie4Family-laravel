<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MamieProfile extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Colonnes assignables en masse
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'user_id',
        'photo',
        'cni',
        'bio',
        'adresse',
        'ville',
        'departement',
        'arrondissement',
        'services',
        'tarif',
        'telephone',
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
    public function getCniUrlAttribute()
    {
        return $this->cni
            ? route('admin.mamies.downloadCni', $this->id)
            : null;
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-mamie.png');
    }
}
