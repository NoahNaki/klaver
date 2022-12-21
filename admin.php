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
<br>
<form id="form"> 
  <input type="search" id="query" name="q" placeholder="Search...">
  <button>Search</button>

</form>
<form>
<tr>
<div class="box">
    <p>
        accounts
</p>
</div>
<br>
    <div id="vacatures">
        
    </div>
<br>
    <div id="cv">
        
    </div>
</tr>
</form>

<?php
include_once 'includes/footer.inc.php'
?>
</body>
</html>
