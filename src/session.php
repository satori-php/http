<?php

/**
 * @author    Yuriy Davletshin <yuriy.davletshin@gmail.com>
 * @copyright 2017 Yuriy Davletshin
 * @license   MIT
 */

declare(strict_types=1);

namespace Satori\Http\Session;

function has(string $key): bool
{
    return isset($_SESSION[$key]);
}

function get(string $key, $default = null)
{
    return $_SESSION[$key] ?? $default;
}

function set(string $key, $value)
{
    if (isset($_SESSION)) {
        $_SESSION[$key] = $value;
    }
}

function remove(string $key)
{
    unset($_SESSION[$key]);
}

function regenerate(): bool
{
    return session_regenerate_id(true);
}

function start(string $name = null)
{
    if (isset($name)) {
        session_name($name);
    }
    session_start();
}

function release()
{
    session_write_close();
}

function destroy()
{
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}
