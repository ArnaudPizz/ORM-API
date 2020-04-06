<?php
namespace App\Article;

class Status
{
    const PUBLISH=1;
    const NOT_PUBLISH=2;

    public static function getStatus():array
    {
        return[
            self::PUBLISH,
            self::NOT_PUBLISH,
        ];
    }
}