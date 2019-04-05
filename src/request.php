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
 * Returns an HTTP protocol version.
 *
 * @return string
 */
function getProtocol(): string
{
    return $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Returns a request method.
 *
 * @return string
 */
function getMethod(): string
{
    return $_SERVER['REQUEST_METHOD'];
}

/**
 * Returns a request scheme.
 *
 * @return string
 */
function getScheme(): string
{
    return $_SERVER['REQUEST_SCHEME'];
}

/**
 * Returns a server name.
 *
 * @return string
 */
function getServerName(): string
{
    return $_SERVER['SERVER_NAME'];
}

/**
 * Returns a server port.
 *
 * @return string
 */
function getServerPort(): string
{
    return $_SERVER['SERVER_PORT'];
}

/**
 * Returns a request URI.
 *
 * @return string
 */
function getUri(): string
{
    return $_SERVER['REQUEST_URI'];
}

/**
 * Returns a request path.
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
 * Returns a query string.
 *
 * @return string
 */
function getQueryString(): string
{
    return $_SERVER['QUERY_STRING'] ?? '';
}

/**
 * Returns a header value.
 *
 * @param string $name The header name.
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
 * Returns a request parameter.
 *
 * @param string $name    The parameter name.
 * @param string $default The default value.
 *
 * @return string|null
 */
function getParameter(string $name, string $default = null)
{
    return $_REQUEST[$name] ?? $default;
}

/**
 * Returns a GET parameter.
 *
 * @param string $name    The parameter name.
 * @param string $default The default value.
 *
 * @return string|null
 */
function getQueryParameter(string $name, string $default = null)
{
    return $_GET[$name] ?? $default;
}

/**
 * Returns a POST parameter.
 *
 * @param string $name    The parameter name.
 * @param string $default The default value.
 *
 * @return string|null
 */
function getPostParameter(string $name, string $default = null)
{
    return $_POST[$name] ?? $default;
}

/**
 * Returns a PUT parameter.
 *
 * @param string $name    The parameter name.
 * @param string $default The default value.
 *
 * @return string|null
 */
function getPutParameter(string $name, string $default = null)
{
    parse_str(file_get_contents("php://input"), $parameters);

    return $parameters[$name] ?? $default;
}

/**
 * Returns a cookie value.
 *
 * @param string $name The cookie name.
 *
 * @return string|null
 */
function getCookie(string $name)
{
    return $_COOKIE[$name] ?? null;
}

/**
 * Returns the domain name of the server.
 *
 * @return string|null
 */
function getHost(): string
{
    return $_SERVER['HTTP_HOST'] ?? null;
}

/**
 * Returns an HTTP referer.
 *
 * A web page from which a link to the currently requested page was followed.
 *
 * @return string|null
 */
function getReferer()
{
    return $_SERVER['HTTP_REFERER'] ?? null;
}

/**
 * Returns an HTTP referer.
 *
 * A web page from which a link to the currently requested page was followed.
 *
 * @return string|null
 */
function getReferrer()
{
    return $_SERVER['HTTP_REFERER'] ?? null;
}

/**
 * Returns content types that are acceptable.
 *
 * @return string|null
 */
function getAccept()
{
    return $_SERVER['HTTP_ACCEPT'] ?? null;
}

/**
 * Returns character sets that are acceptable.
 *
 * @return string|null
 */
function getAcceptCharset()
{
    return $_SERVER['HTTP_ACCEPT_CHARSET'] ?? null;
}

/**
 * Returns list of acceptable encodings.
 *
 * @return string|null
 */
function getAcceptEncoding()
{
    return $_SERVER['HTTP_ACCEPT_ENCODING'] ?? null;
}

/**
 * Returns list of acceptable human languages for response.
 *
 * @return string|null
 */
function getAcceptLanguage()
{
    return $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;
}

/**
 * Returns the user agent string of the user agent.
 *
 * @return string|null
 */
function getUserAgent(): string
{
    return $_SERVER['HTTP_USER_AGENT'];
}
