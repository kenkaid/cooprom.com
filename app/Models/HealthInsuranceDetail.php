<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthInsuranceDetail extends Model
{
    protected $fillable = [
        'partner_name',
        'insurance_type',
        'description',
        'coverage_details',
        'contact_info',
        'external_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
