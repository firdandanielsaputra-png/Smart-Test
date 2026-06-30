<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [
        'user_id',
        'quiz_total',
        'average_score',
        'level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
