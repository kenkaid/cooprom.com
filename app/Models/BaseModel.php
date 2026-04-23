<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

abstract class BaseModel extends Authenticatable
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Génération de l'UUID si le modèle en possède un champ
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            // Remplissage automatique de l'ID de l'utilisateur créateur et modificateur à la création
            if (in_array('user_created_id', $model->getFillable()) && empty($model->user_created_id)) {
                $model->user_created_id = Auth::id() ?? 1;
            }
            if (in_array('user_updated_id', $model->getFillable()) && empty($model->user_updated_id)) {
                $model->user_updated_id = Auth::id() ?? 1;
            }
        });

        static::updating(function ($model) {
            // Remplissage automatique de l'ID de l'utilisateur modificateur
            if (in_array('user_updated_id', $model->getFillable()) && empty($model->user_updated_id)) {
                $model->user_updated_id = Auth::id() ?? 1;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
