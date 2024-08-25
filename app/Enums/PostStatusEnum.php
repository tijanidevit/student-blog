<?php

namespace App\Enums;

enum PostStatusEnum : string
{
    case APPROVED = 'approved';
    case BLOCKED = 'blocked';
    case PENDING = 'pending';

    public static function toArray(): array {
        return array_map(fn($case) => $case->value, static::cases());
    }
}
