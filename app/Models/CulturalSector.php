<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulturalSector extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'allowed_roles',
        'description',
        't_name',
        'version',
        'status',
        'user_created_id',
        'user_updated_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_cultural_sector');
    }
}
