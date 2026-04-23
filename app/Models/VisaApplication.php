<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaApplication extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'travel_id',
        'country',
        'visa_type',
        'required_documents',
        'status',
        'admin_note',
        'submission_date',
        'user_created_id',
        'user_updated_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function contracts()
    {
        return $this->morphMany(Contract::class, 'contractable');
    }
}
