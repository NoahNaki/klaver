
<nav>
<img src="assets/img/xxl.png" alt="logo" width="120" height="60">
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php
        if(isset($_SESSION['loggedIn'])) {
            echo '<li>' . '<a href=logout.php>Uitloggen</a></li>';
        } else {
            echo '<li>' . '<a href=login.php>Inloggen</a></li>';
            echo '<li>' . '<a href=register.php>Registreren</a></li>';
        }
        ?>
        <li><a href="vacancies.php">Vacatures</a></li>
        <li>
            <!-- language selection dropdown -->
            <select name="language-picker-select" id="language-picker-select">
      <option lang="nl" value="dutch">NL</option>
      <option lang="en" value="english" selected>EN</option>
    </select>
        </li>
    </ul>
</nav>
