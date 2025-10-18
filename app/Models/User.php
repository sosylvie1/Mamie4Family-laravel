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
    | Mass assignable attributes
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
    | Hidden attributes
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
    | Accessors / Appended attributes
    |--------------------------------------------------------------------------
    */
    protected $appends = [
        'profile_photo_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute casting
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
    | Role helper methods
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
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * One-to-One relationship with AdminProfile
     */
    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class, 'user_id');
    }

    /**
     * One-to-One relationship with FamilleProfile
     */
    public function familleProfile()
    {
        return $this->hasOne(FamilleProfile::class, 'user_id');
    }

    /**
     * One-to-One relationship with MamieProfile
     */
    public function mamieProfile()
    {
        return $this->hasOne(MamieProfile::class, 'user_id');
    }

    /**
     * One-to-Many relationship with sent messages
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * One-to-Many relationship with received messages
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
