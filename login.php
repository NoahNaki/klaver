<?php
// @TODO: set a max times of incorrect logins before a timeout
// @todo: auto logout afther 15 minutes
// https://stackoverflow.com/questions/37120328/how-to-limit-the-number-of-login-attempts-in-a-login-script
session_start();

require_once('includes/db.inc.php');
global $conn;

$email = $username = $password = $error__message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username'], $_POST['password'])) {
        $error__message = "Voer al uw gegevens in";
        } else if ($stmt = $conn->prepare('SELECT userid, password FROM users WHERE BINARY username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['password'] = $password;
                $_SESSION['id'] = $id;
                $error__message = 'U bent ingelogt';
                //@todo: Proper redirect
            } else {
                $error__message = 'Incorrect username and/or password!';
            }
        } else {
            $error__message = 'Incorrect username and/or password!';
        }
        $stmt->close();
    }
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
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
        <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
            <?php
            echo '<p>' . $error__message . '</p>';
            echo '<pre>';
            var_dump($_REQUEST);
            echo '</pre>';
            ?>
            <label>
                Gebruikersnaam:
                <input type="text" name="username" id="username">
            </label>
            <label>
                Wachtwoord:
                <input type="password" name="password" id="password">
            </label>
            <footer>
                <button>Inloggen &rightarrow;</button>
                &nbsp;
                <a href="resetpassword.php">Ik ben mijn gegevens kwijt &rightarrow;</a>
            </footer>
        </form>
    </section>
</main>
</body>