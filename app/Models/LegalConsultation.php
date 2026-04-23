<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalConsultation extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'subject',
        'message',
        'category',
        'status',
        'admin_response',
        'answered_at',
        'answered_by',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answerer()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }
}
