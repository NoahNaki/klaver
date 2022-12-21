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
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Full width -->
<button class="btn" style="width:30%"><i class="fa fa-download"></i> Download CV</button>

<br>

<p>
Lorem Ipsum is simply dummy text of the printing and typesetting industry.
 Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
  when an unknown printer took a galley of type and scrambled it to make a type specimen book.
</p>

<br>

<video width="320" height="240" poster="/images/w3schools_green.jpg" controls>
   <source src="movie.mp4" type="video/mp4">
   <source src="movie.ogg" type="video/ogg">
   Your browser does not support the video tag.
</video>

<?php
include_once 'includes/footer.inc.php'
?>
</body>
</html>
