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
        'other_sector',
        'name',
        'last_name',
        'designation',
        'email',
        'role_type',
        'habitation_place',
        'burida_number',
        'cni_number',
        'pseudonym',
        'company_name',
        'manager_name',
        'registration_number_mc',
        'implementation_place',
        'cnps_number',
        'profession',
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

    public function getPhotoAttribute($value)
    {
        if ($value && !str_starts_with($value, 'http')) {
            // Si c'est l'image par défaut, on la cherche dans assets
            if ($value === 'user-default.png' || $value === 'user_default.jpg' || $value === 'user_default.png') {
                return asset('assets/admin/images/avatars/user-default.png');
            }
            return asset('storage/' . $value);
        }
        return $value ?: asset('assets/admin/images/avatars/user-default.png'); // Image par défaut si vide
    }

    public function visaApplications()
    {
        return $this->hasMany(VisaApplication::class);
    }

    /**
     * Les événements auxquels l'utilisateur est inscrit.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot('notes', 'status')->withTimestamps();
    }

    public function attributeValues()
    {
        return $this->morphMany(AttributeValue::class, 'attributable');
    }
}
