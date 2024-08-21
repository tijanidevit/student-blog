<?php

namespace App\Enums;

enum PostStatusEnum : string
{
    case APPROVED = 'approved';
    case DECLINED = 'declined';
    case PENDING = 'pending';

    public static function toArray(): array {
        return array_map(fn($case) => $case->value, static::cases());
    }
}
