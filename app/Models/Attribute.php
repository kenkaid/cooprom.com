<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends BaseModel
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'label',
        'type',
        'options',
        'is_required',
        'validation_rules',
        'allowed_roles',
        'target_type',
        'order_column',
        'user_created_id',
        'user_updated_id',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function culturalSectors()
    {
        return $this->belongsToMany(CulturalSector::class, 'attribute_cultural_sector');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
