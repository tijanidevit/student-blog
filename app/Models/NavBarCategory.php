<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NavBarCategory extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];


    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
