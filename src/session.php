<?php

/**
 * @author    Yuriy Davletshin <yuriy.davletshin@gmail.com>
 * @copyright 2017 Yuriy Davletshin
 * @license   MIT
 */

declare(strict_types=1);

namespace Satori\Http\Session;

/**
 * Checks if a session variable is set.
 *
 * @param string $key The session variable name.
 *
 * @return bool
 */
function has(string $key): bool
{
    return isset($_SESSION[$key]);
}

/**
 * Returns a session variable value.
 *
 * @param string $key     The session variable name.
 * @param mixed  $default The default value if the session variable does not exist.
 *
 * @return mixed
 */
function get(string $key, $default = null)
{
    return $_SESSION[$key] ?? $default;
}

/**
 * Sets a session variable.
 *
 * @param string $key   The session variable name.
 * @param mixed  $value The value.
 */
function set(string $key, $value)
{
    if (isset($_SESSION)) {
        $_SESSION[$key] = $value;
    }
}

/**
 * Removes a session variable.
 *
 * @param string $key The session variable name.
 */
function remove(string $key)
{
    unset($_SESSION[$key]);
}

/**
 * Starts a session.
 *
 * @param string $name The session name.
 */
function start(string $name = null)
{
    if (isset($name)) {
        session_name($name);
    }
    session_start();
}

/**
 * Writes and closes the session.
 */
function release()
{
    session_write_close();
}

/**
 * Regenerates the session ID.
 *
 * @return bool True if the regeneration was successful.
 */
function regenerate(): bool
{
    return session_regenerate_id(true);
}

/**
 * Destroys the session and deletes the session cookie.
 */
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
