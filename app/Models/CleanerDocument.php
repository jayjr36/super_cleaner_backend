<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleanerDocument extends Model
{
    use HasFactory;

    protected $fillable =[
        'cleaner_id',
        'document_path',
    ];

    protected function cleaner()
    {
        return $this->belongsTo(Cleaner::class);
    }
}
