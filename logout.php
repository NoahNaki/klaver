<?php
/**
 * The file that handles user logout.
 *
 * @TODO: Show a message to the user that he has logged out
 */
session_start();

/**
 * Sets the session array empty
 * @var mixed $_SESSION
 */
$_SESSION = array();

/**
 * Destroys the client side session cookie 'session.use_cookies'
 * @var string $params The cookie contents
 * @BUG Illegal string offset
 */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
    /**
     * Gets the current session id
     */
    session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

/**
 * Finally, destroys all data of a session array, and redirect to the home page
 */
session_destroy();
redirect('index.php', false);

/**
 * Redirect function to redirect to other page
 *
 * @param mixed $url
 * @param mixed $statusCode
 * @return void
 */
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
?>
