<?php

namespace Takepart\Oreos\Tags;

use Statamic\Tags\Tags;

class OreoTag extends Tags
{
    protected static $handle = 'oreo';

    public static function check(...$arguments): bool
    {
        return true;
    }
}
