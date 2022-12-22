<?php
/**
 * The main page of our website
 *
 */

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/stylesheets/style.css">
    <title>Title</title>
</head>
<body>
<?php
/**
 * Includes the navbar for better code re-usability
 *
 */
include_once 'includes/nav.inc.php'
?>
<main>
    <section>
        <br>
        <h1>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<p>' . 'Welkom, '. $_SESSION['userName'] . '!</p>';
            }
            ?>
        </h1>
    </section>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
        a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
        Lorem Ipsum passages, </p>
</main>
</body>
</html>
