<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_id',
        'attributable_type',
        'attributable_id',
        'value',
        'user_created_id',
        'user_updated_id',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributable()
    {
        return $this->morphTo();
    }
}
