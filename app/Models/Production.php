<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'type',
        'description',
        'attachment',
        'status',
        'budget',
        'user_created_id',
        'user_updated_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contracts()
    {
        return $this->morphMany(Contract::class, 'contractable');
    }
}
