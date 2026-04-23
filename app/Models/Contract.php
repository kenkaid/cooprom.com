<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'contractable_id',
        'contractable_type',
        'type',
        'title',
        'description',
        'file_path',
        'signed_file_path',
        'start_date',
        'end_date',
        'status',
        'admin_note',
        'user_created_id',
        'user_updated_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent contractable model (production or visa application).
     */
    public function contractable(): MorphTo
    {
        return $this->morphTo();
    }
}
