<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function book() {
        return $this->hasOne(Book::class)->latest();
    }

    public function activeBooks() {
        return $this->hasMany(Book::class)->where('is_active', 1);
    }

    public function inactiveBooks() {
        return $this->hasMany(Book::class)->where('is_active', 0);
    }
}
