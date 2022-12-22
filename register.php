<?php
/**
 * This file handles all the registration.
 *
 * It validates user input, and puts this in the db.
 *
 * @TODO: need to know if the registered person is a company or not
 */

/**
 * Enables the db connection to be used anywhere
 *
 * @var string $conn db connection string
 */
require_once('includes/db.inc.php');
global $conn;


$email = $username = $password = $error__message = "";

/**
 * If the method is post, handles userlogin
 *
 * @TODO: refactor if else
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        $error__message = 'Vul all uw gegevens in';
    } elseif (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        $error__message = 'Vul all uw gegevens in';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error__message = 'Is dit wel een E-mail?';
    } elseif (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
        $error__message = "Uw Gebruikersnaam is verkeerd";
    } elseif (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        $error__message = "Uw Wachtwoord moet tussen de 5 en 20 characters lang zijn";
    } else {
        if ($stmt = $conn->prepare('SELECT userID, userPassword FROM users WHERE userName = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error__message = 'Username exists, please choose another!';
            } else {
                //if ($stmt = $conn->prepare("INSERT INTO users (username, password, email, createdat, usertype, userrole) VALUES (?, ?, ?, current_timestamp(), 'regular', 'user')")) {
                  if ($stmt = $conn->prepare("INSERT INTO users (userName, userCreatedTime, userPassword, userEmail, userType, userRole) VALUES (?, current_timestamp(), ?, ?, 'regular', 'user') ")) {
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                    $stmt->execute();
                    $error__message = '<pre>' . var_export($stmt,false) . '</pre>';
                    $_SESSION["username"] = $_POST['username'];
                } else {
                    $error__message = 'Could not prepare statement!';
                }
            }
        } else {
            $error__message = 'Could not prepare statement!';
        }
        $conn->close();
    }
}

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
<!DOCTYPE html>
<body>
<html lang="nl">
<head>
    <?php include_once 'includes/head.inc.php' ?>
</head>
<header>
</header>
<?php include 'includes/nav.inc.php'; ?>
<main>
    <br>
    <section>
        <h1>Registreer een account</h1>
    </section>
    <br>
    <section>
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
                <input type="text" name="username" id="username" value="<?php echo $username; ?>">
            </label>
            <label>
                E-mail:
                <input type="text" name="email" id="email" value="<?php echo $email; ?>">
            </label>
            <label>
                Wachtwoord:
                <input type="password" name="password" id="password">
            </label>
            <label>
                <input type="checkbox" name="corp" id="corp">Ik ben een organisatie
            </label>
            <footer>
                <input type="submit" value="registreer"></input>
                <button type="reset">Reset</button>
            </footer>
        </form>
    </section>
</main>
</body>
</html>
