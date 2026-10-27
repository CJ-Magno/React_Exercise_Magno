<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
