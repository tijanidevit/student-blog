<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getShowImageAttribute() : string {
        return $this->image ?? 'http://via.placeholder.com/280x280';
    }
}
