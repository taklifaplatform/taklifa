<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use RectorLaravel\Set\LaravelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::NAMING,
        SetList::PHP_82,
        SetList::TYPE_DECLARATION,
        LaravelSetList::LARAVEL_100,
    ]);
};
