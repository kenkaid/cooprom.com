<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'start_date',
        'end_date',
        'location',
        'address',
        'city',
        'country',
        'latitude',
        'longitude',
        'image',
        'technical_file',
        'max_participants',
        'entry_fee',
        'budget_allocated',
        'actual_expenses',
        'status',
        'is_featured',
        'metadata',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'entry_fee' => 'decimal:2',
        'budget_allocated' => 'decimal:2',
        'actual_expenses' => 'decimal:2',
        'is_featured' => 'boolean',
        'metadata' => 'json',
    ];

    /**
     * Boot function for the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . uniqid();
            }
        });
    }

    /**
     * Scope for featured events.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for published events.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
    /**
     * Les membres inscrits à cet événement.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('notes', 'status')->withTimestamps();
    }

    /**
     * Calcule le nombre de places restantes.
     */
    public function getRemainingPlacesAttribute()
    {
        if (!$this->max_participants) {
            return null; // Illimité
        }

        $confirmedInscriptions = $this->users()->count();
        return max(0, $this->max_participants - $confirmedInscriptions);
    }

    /**
     * Vérifie si l'événement est complet.
     */
    public function isFull()
    {
        if (!$this->max_participants) {
            return false;
        }

        return $this->users()->count() >= $this->max_participants;
    }
}
