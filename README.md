# HTTP functions

Requires PHP 7

## Usage

### Request
```php
declare(strict_types=1);

use Satori\Http\Request;

/*
 * Get server property.
 *
 * $_SERVER['SERVER_PROTOCOL']
 * $_SERVER['SERVER_NAME']
 * $_SERVER['SERVER_PORT']
 */
$protocol = Request\getProtocol();
$server = Request\getServerName();
$port = Request\getServerPort();

/*
 * Get request property.
 *
 * $_SERVER['REQUEST_METHOD']
 * $_SERVER['REQUEST_SCHEME']
 * $_SERVER['REQUEST_URI']
 */
$method = Request\getMethod();
$scheme = Request\getScheme();
$uri = Request\getUri();

/*
 * Get request path.
 */
$path = Request\getPath();

/*
 * Get query string.
 *
 * $_SERVER['QUERY_STRING']
 */
$queryString = Request\getQueryString();

/*
 * Get request parameter by name.
 *
 * $_REQUEST['title']
 * $_GET['search']
 * $_POST['email']
 * { php://input }
 */
$title = Request\getParameter('title');
$search = Request\getQueryParameter('search');
$email = Request\getPostParameter('email');
$password = Request\getPutParameter('password');

/*
 * Get all headers.
 */
$headers = Request\getHeaders();

/*
 * Get the header by name.
 *
 * $_SERVER['HTTP_REFERER']
 * $_SERVER['HTTP_USER_AGENT']
 * $_SERVER['HTTP_ACCEPT_LANGUAGE']
 */
$header1 = Request\getHeader('Referer');
$header2 = Request\getHeader('User-Agent');
$header3 = Request\getHeader('Accept-Language');

/*
 * Get frequently used header.
 *
 * $_SERVER['HTTP_REFERER']
 * $_SERVER['HTTP_USER_AGENT']
 * $_SERVER['HTTP_ACCEPT_LANGUAGE']
 */
$referer = Request\getReferer();
$userAgent = Request\getUserAgent();
$language = Request\getAcceptLanguage();

/*
 * Get the cookie by name.
 *
 * $_COOKIE['lang']
 */
$lang = Request\getCookie('lang');
```

### Response
```php
declare(strict_types=1);

use Satori\Http\Response;

/*
 * Send status line.
 */
Response\sendStatusLine('1.1', 200);

/*
 * Send the header.
 */
Response\sendHeader('X-My-Header', 'My');

/*
 * Send headers.
 */
Response\sendHeaders([
    'X-Header-Foo' => 'Foo',
    'X-Header-Bar' => 'Bar',
]);

/*
 * Send body content.
 */
Response\sendBody('<html><body>Hello</body></html>');
```

### Session
```php
declare(strict_types=1);

use Satori\Http\Session;

/*
 * Start the session.
 */
Session\start();

/*
 * Set session variable.
 */
Session\set('foo', 'Foo');

/*
 * Check if session variable is set.
 */
if (Session\has('foo')) {
    /*
     * Get session variable value.
     */
    $foo = Session\get('foo');
}

/*
 * Regenerate the session ID.
 */
Session\regenerate();

/*
 * Write and close the session.
 */
Session\release();

/*
 * Destroy the session and delete session cookie.
 */
Session\destroy();
```

## License
MIT License
