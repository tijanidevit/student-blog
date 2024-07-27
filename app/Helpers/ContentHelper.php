<?php

namespace App\Helpers;

class ContentHelper
{
    public static function generateExcerpt($content, $length = 150)
    {
        $cleanContent = strip_tags($content);
        return mb_strimwidth($cleanContent, 0, $length, '...');
    }

    public static function generateMetaDescription($content, $length = 160)
    {
        $cleanContent = strip_tags($content);
        return mb_strimwidth($cleanContent, 0, $length, '...');
    }
}
