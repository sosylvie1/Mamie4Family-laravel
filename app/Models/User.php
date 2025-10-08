<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /*
    |--------------------------------------------------------------------------
    | Traits
    |--------------------------------------------------------------------------
    */
    use HasApiTokens;              // Gestion des API Tokens (Sanctum)
    use HasFactory;                // Factories pour tests/seeders
    use HasProfilePhoto;           // Gestion photo de profil (Jetstream)
    use Notifiable;                // Notifications (mail, etc.)
    use TwoFactorAuthenticatable;  // Authentification à deux facteurs (Fortify)

    /*
    |--------------------------------------------------------------------------
    | Attributs assignables en masse
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   
    ];

    /*
    |--------------------------------------------------------------------------
    | Attributs masqués
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors calculés
    |--------------------------------------------------------------------------
    */
    protected $appends = [
        'profile_photo_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casting des colonnes
    |--------------------------------------------------------------------------
    */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Méthodes helpers pour les rôles
    |--------------------------------------------------------------------------
    */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isFamille(): bool
    {
        return $this->role === 'famille';
    }

    public function isMamie(): bool
    {
        return $this->role === 'mamie';
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    /**
     * Relation One-to-One avec le profil Famille.
     */
    public function familleProfile()
    {
        return $this->hasOne(FamilleProfile::class);
    }

    /**
     * Relation One-to-One avec le profil Mamie.
     */
    public function mamieProfile()
    {
        return $this->hasOne(MamieProfile::class);
    }

    /**
     * Relation MESSAGES.
     */
    public function sentMessages() {
    return $this->hasMany(Message::class, 'sender_id');
}

public function receivedMessages() {
    return $this->hasMany(Message::class, 'receiver_id');
}

}
