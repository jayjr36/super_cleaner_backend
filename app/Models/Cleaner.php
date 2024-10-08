<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cleaner extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'email',
        'phone',
        'address',
    ];

    protected function documents()
    {
        return $this->hasMany(CleanerDocument::class, 'cleaner_id');
    }
}
