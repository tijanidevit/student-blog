<?php

namespace App\Models;

use App\Enums\PostStatusEnum;
use App\Helpers\ContentHelper;
use App\Traits\SluggableTrait;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use SluggableTrait, HasUuids, HasFactory;

    protected $guarded = ['id'];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = $value;
        $this->attributes['excerpt'] = ContentHelper::generateExcerpt($value);
        $this->attributes['meta_description'] = ContentHelper::generateMetaDescription($value);
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


    // SCOPES
    public function scopeOnlyApproved() : Builder {
        return $this->whereStatus(PostStatusEnum::APPROVED->value);
    }

    public function scopeOnlyDeclined() : Builder {
        return $this->whereStatus(PostStatusEnum::DECLINED->value);
    }

    public function scopeOnlyPending() : Builder {
        return $this->whereStatus(PostStatusEnum::PENDING->value);
    }
}
