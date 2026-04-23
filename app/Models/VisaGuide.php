<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaGuide extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'country',
        'visa_type',
        'description',
        'required_documents',
        'procedure_steps',
        'useful_links',
        'is_active',
        'user_created_id',
        'user_updated_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'user_updated_id');
    }
}
