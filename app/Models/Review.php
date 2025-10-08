<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'famille_id',
        'mamie_id',
        'note',
        'commentaire',
    ];

    // 🔹 Famille qui a laissé l’avis
    public function famille()
    {
        return $this->belongsTo(User::class, 'famille_id');
    }

    // 🔹 Mamie qui a reçu l’avis
    public function mamie()
    {
        return $this->belongsTo(User::class, 'mamie_id');
    }
}
