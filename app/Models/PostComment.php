<?php

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostComment extends Model
{
    use HasFactory, HasCreator;

    protected $guarded = ['id'];

    public function post() : BelongsTo {
        return $this->belongsTo(Post::class);
    }
}
