<?php

namespace App\Models;

use App\Helpers\ContentHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use Sluggable, HasUuids, HasFactory;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $value;
        $this->attributes['excerpt'] = ContentHelper::generateExcerpt($value);
        $this->attributes['meta_description'] = ContentHelper::generateMetaDescription($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function likes() : HasMany {
        return $this->hasMany(PostLike::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(PostComment::class);
    }
}
