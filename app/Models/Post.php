<?php

namespace App\Models;

use App\Enums\PostStatusEnum;
use App\Helpers\ContentHelper;
use App\Traits\HasCreator;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use Sluggable, HasUuids, HasFactory, HasCreator;

    protected $guarded = ['id'];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $value;
        $this->attributes['excerpt'] = ContentHelper::generateExcerpt($value);
        $this->attributes['meta_description'] = ContentHelper::generateMetaDescription($value);
    }

    protected $attributes = [
        'status' => PostStatusEnum::APPROVED->value
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function postLikes() : HasMany {
        return $this->hasMany(PostLike::class);
    }

    public function comments() : HasMany {
        return $this->hasMany(PostComment::class);
    }


    // SCOPES
    public function scopeOnlyApproved() : Builder {
        return $this->whereStatus(PostStatusEnum::APPROVED->value);
    }

    public function scopeOnlyBlocked() : Builder {
        return $this->whereStatus(PostStatusEnum::BLOCKED->value);
    }

    public function scopeOnlyPending() : Builder {
        return $this->whereStatus(PostStatusEnum::PENDING->value);
    }
}
