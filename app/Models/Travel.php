<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'travels';

    protected $fillable = [
        'uuid',
        'title',
        'destination',
        'description',
        'departure_date',
        'return_date',
        'type',
        'status',
        'user_created_id',
        'user_updated_id',
    ];

    public function visaApplications()
    {
        return $this->hasMany(VisaApplication::class);
    }
}
