<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'last_name',
        'email',
        'phone',
        'message',
        't_name',
        'status',
        'version',
        'user_created_id',
        'user_updated_id',
    ];

    protected $attributes = [
        't_name' => 'contacts',
        'status' => 1,
        'version' => 1,
        'user_created_id' => 1,
        'user_updated_id' => 1,
    ];
}
