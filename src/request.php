<?php
declare(strict_types=1);

namespace Satori\Http\Request;

function protocol(): string
{
    return $_SERVER['SERVER_PROTOCOL'];
}
