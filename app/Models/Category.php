<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->name = strtoupper($model->name);
        });

        static::retrieved(function ($model) {
            $model->name = strtolower($model->name);
        });
    }
}
