<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait SluggableTrait
{
    public static function bootSluggableTrait()
    {
        static::creating(function (Model $model) {
            $model->slug = $model->generateSlug($model->name);
        });

        static::updating(function (Model $model) {
            if ($model->isDirty('name')) {
                $model->slug = $model->generateSlug($model->name);
            }
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    protected function generateSlug($name)
    {
        return Str::slug($name);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
