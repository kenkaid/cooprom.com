<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseModel
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'cultural_sector_id',
        'name',
        'last_name',
        'designation',
        'email',
        'address',
        'photo',
        'phone_number',
        'facebook',
        'twitter',
        'linkedin',
        'vimeo',
        'status',
        'password',
        'user_created_id',
        'user_updated_id',
    ];

    /**
     * Relations
     */
    public function culturalSector()
    {
        return $this->belongsTo(CulturalSector::class, 'cultural_sector_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'user_updated_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function visaApplications()
    {
        return $this->hasMany(VisaApplication::class);
    }
}
