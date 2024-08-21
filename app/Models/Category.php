<?php

namespace App\Models;

use App\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory, HasUuids, SluggableTrait;

    protected $guarded = ['id'];

    public function posts() : HasMany {
        return $this->hasMany(Post::class);
    }


    public function topCategory() : HasOne {
        return $this->hasOne(TopCategory::class);
    }

    public function navBarCategory() : HasOne {
        return $this->hasOne(NavBarCategory::class);
    }

}
