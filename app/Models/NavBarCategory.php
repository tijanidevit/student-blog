<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavBarCategory extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];


    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
