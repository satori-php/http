<?php

/**
 * @author    Yuriy Davletshin <yuriy.davletshin@gmail.com>
 * @copyright 2017 Yuriy Davletshin
 * @license   MIT
 */

declare(strict_types=1);

namespace Satori\Http\Request;

/**
 * Checks if a request was received through the HTTPS protocol.
 *
 * @return bool
 */
function isHttps(): bool
{
    if (!empty($_SERVER['HTTPS']) && 'off' !== $_SERVER['HTTPS']) {
        return true;
    }

    return false;
}

/**
 * Returns HTTP protocol version.
 *
 * @return string
 */
function getProtocol(): string
{
    return $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Returns request method.
 *
 * @return string
 */
function getMethod(): string
{
    return $_SERVER['REQUEST_METHOD'];
}

/**
 * Returns request scheme.
 *
 * @return string
 */
function getScheme(): string
{
    return $_SERVER['REQUEST_SCHEME'];
}

function getHost(): string
{
    return $_SERVER['HTTP_HOST'];
}

/**
 * Returns server name.
 *
 * @return string
 */
function getServerName(): string
{
    return $_SERVER['SERVER_NAME'];
}

/**
 * Returns server port.
 *
 * @return string
 */
function getServerPort(): string
{
    return $_SERVER['SERVER_PORT'];
}

/**
 * Returns request URI.
 *
 * @return string
 */
function getUri(): string
{
    return $_SERVER['REQUEST_URI'];
}

/**
 * Returns request path.
 *
 * @return string
 */
function getPath(): string
{
    if (isset($_SERVER['QUERY_STRING'])) {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }

    return $_SERVER['REQUEST_URI'];
}

/**
 * Returns query string.
 *
 * @return string
 */
function getQueryString(): string
{
    return $_SERVER['QUERY_STRING'] ?? '';
}

/**
 * Returns header value.
 *
 * @param string $name Header name.
 *
 * @return string|null
 */
function getHeader(string $name)
{
    $key = 'HTTP_' . str_replace('-', '_', strtoupper($name));

    return $_SERVER[$key] ?? null;
}

/**
 * Returns all headers.
 *
 * @return array<string, string>
 */
function getHeaders(): array
{
    $headers = [];
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) == 'HTTP_') {
            $key = substr($key, 5);
            $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
            $headers[$key] = $value;
        }
    }

    return $headers;
}

/**
 * Returns GET/POST parameter.
 *
 * @param string $name    Parameter name.
 * @param string $default Default value.
 *
 * @return string|null
 */
function getParameter(string $name, string $default = null)
{
    return $_REQUEST[$name] ?? $default;
}

/**
 * Returns GET parameter.
 *
 * @param string $name    Parameter name.
 * @param string $default Default value.
 *
 * @return string|null
 */
function getQueryParameter(string $name, string $default = null)
{
    return $_GET[$name] ?? $default;
}

/**
 * Returns POST parameter.
 *
 * @param string $name    Parameter name.
 * @param string $default Default value.
 *
 * @return string|null
 */
function getPostParameter(string $name, string $default = null)
{
    return $_POST[$name] ?? $default;
}

/**
 * Returns PUT parameter.
 *
 * @param string $name    Parameter name.
 * @param string $default Default value.
 *
 * @return string|null
 */
function getPutParameter(string $name, string $default = null)
{
    parse_str(file_get_contents("php://input"), $parameters);

    return $parameters[$name] ?? $default;
}

/**
 * Returns HTTP referer.
 *
 * @return string|null
 */
function getReferrer()
{
    return $_SERVER['HTTP_REFERER'] ?? null;
}

function getCookie(string $name)
{
    return $_COOKIE[$name] ?? null;
}

function getAccept()
{
    return $_SERVER['HTTP_ACCEPT'] ?? null;
}
function hasAccept(string $value)
{
}

function getAcceptLanguage()
{
    return $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;
}
function hasAcceptLanguage(string $value)
{
}

function getAcceptEncoding()
{
    return $_SERVER['HTTP_ACCEPT_ENCODING'] ?? null;
}

function hasAcceptEncoding(string $value)
{
}

function getConnection()
{
    return $_SERVER['HTTP_CONNECTION'] ?? null;
}

function getUserAgent(): string
{
    return $_SERVER['HTTP_USER_AGENT'];
}
