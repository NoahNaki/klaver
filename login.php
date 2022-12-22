<?php
/**
 * file that handles user logins.
 *
 * @TODO: set a max times of incorrect logins before a timeout
 * @todo: auto logout afther 15 minutes
 */

session_start();

include('includes/db.inc.php');
global $conn;

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

$email = $username = $password = $error__message = "";

/**
 * If the method is post, handles userlogin
 *
 * @TODO: refactor if else
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username'], $_POST['password'])) {
        $error__message = "Voer al uw gegevens in";
    } else if ($stmt = $conn->prepare('SELECT userID, userPassword, userType, userRole FROM users WHERE BINARY userName = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        // begin the transaction
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userID, $userPassword, $userType, $userRole);
            $stmt->fetch();
            if (password_verify($_POST['password'], $userPassword)) {
                /**
                 * User roles & types:
                 * Roles: user, admin and system admin
                 * Types: regular, company
                 * @var string $userrole string is the user a company or a regular foe?
                 * @var string $userype string the user role saved as a variable
                 * @TODO: refactor if else
                 */
                if ($userRole != 'user') {
                    $_SESSION['userRole'] = 'user';
                } else if ($userRole != 'admin') {
                    $_SESSION['userRole'] = 'admin';
                }
                if ($userType != 'regular') {
                    $_SESSION['userType'] = 'regular';
                } else if ($userType != 'company') {
                    $_SESSION['userType'] = 'company';
                }
                    session_regenerate_id();
                    $_SESSION['loggedIn'] = TRUE;
                    $_SESSION['userName'] = $_POST['username'];
                    $_SESSION['id'] = $userID;
                    $error__message = 'U bent ingelogt';
                    redirect('index.php', false);

            } else {
                $error__message = 'Incorrect username and/or password!';
            }
        } else {
            $error__message = 'Incorrect username and/or password!';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<body>
<head>
    <?php include_once 'includes/head.inc.php' ?>
</head>
<header>
</header>
<?php include 'includes/nav.inc.php'; ?>
<main>
    <br>
    <section>
        <h1>Inloggen op uw account</h1>
    </section>
    <br>
    <section id="login__form">
        <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php
            /**
             * Checks if the message is set, if so outputs it above the form
             *
             * @var string $error__message the message for the user
             */
            if (isset($error__message)) {
                echo '<p>' . $error__message . '</p>';
            }
            ?>
            <label>
                Gebruikersnaam:
                <input type="text" name="username" id="username">
            </label>
            <label>
                Wachtwoord:
                <input type="password" name="password" id="password">
            </label>
            <label>
                <input type="checkbox" name="corp" id="corp">Ik ben een organisatie
            </label>
            <footer>
                <button>Inloggen &rightarrow;</button>
                <a href="reset-password.php">Wachtwoord vergeten &rightarrow;</a>
            </footer>
        </form>
    </section>
</main>
</body>
