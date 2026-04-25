<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'logo',
        'phone_number',
        't_name',
        'version',
        'user_created_id',
        'user_updated_id',
    ];

    protected $attributes = [
        'logo' => 'default.png',
        't_name' => 'partners',
        'version' => 1,
    ];
}
