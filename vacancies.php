<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="assets/stylesheets/style.css">


<?php
include_once 'includes/nav.inc.php'; 
?>

<br>

<form method="post"> 
  <input type="text" name="search" placeholder="zoeken"/>
  <input type="submit" value="Zoek" />
</form>



<?php
/*Database*/
include('includes/db.inc.php');




/*data verzamel*/

if(isset($_POST['search'])) {
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);


    
    /*haalt info uit vacancies dan tabel naam*/

    $query = $conn->prepare("SELECT * FROM vacancies WHERE type like '%$searchq%' OR bedrijf LIKE '%$searchq%' OR categorie LIKE '%$searchq%' OR plaatsdatum LIKE '%$searchq%' OR opleiding LIKE '%$searchq%' OR tijd LIKE '%$searchq%' OR salaris LIKE '%$searchq%' ") or die("could not search!");
    $query->execute();
    $result = $query->get_result(); 
    $count = $query->num_rows(); 
    if(strlen($count) < 0) {
        $output = 'there was no such result!';
    }
    else {


        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
   echo '<table>';
  echo '<tr>';
    echo '<th>Bedrijf</th>';
    echo '<th>Type</th>';
    echo '<th>Categorie</th>';
    echo '<th>Plaatsdatum</th>';
    echo '<th>Opleiding</th>';
    echo '<th>Tijd</th>';
    echo '<th>Salaris</th>';
    echo '</tr>';


  echo '<tr>';
  echo '<td>' . $row["bedrijf"] . '</td>';
  echo '<td>' . $row["type"] . '</td>';
  echo '<td>' . $row["categorie"] . '</td>';
  echo '<td>' . $row["plaatsdatum"] . '</td>';
  echo '<td>' . $row["opleiding"] . '</td>';
  echo '<td>' . $row["tijd"] . '</td>';
  echo '<td>' . $row["salaris"] . '</td>';
  
  echo '</tr>';
echo '</table>';
                }
        
    }



}

// SQL query for table information
$sql = "SELECT bedrijf, type, categorie, plaatsdatum, opleiding, tijd, salaris  FROM vacancies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //top column for table names
    echo "<table><tr><th>Bedrijf</th><th>Type</th><th>Categorie</th><th>Plaatsdatum</th><th>Opleiding</th><th>Tijd</th><th>Salaris</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["bedrijf"]. "</td><td>" . $row["type"]. "</td><td>" . $row["categorie"]. "</td><td>" . $row["plaatsdatum"]. "</td><td>" . $row["opleiding"]. "</td><td>" . $row["tijd"]. "</td><td>" . $row["salaris"]. "</td><td>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>

<br>

</body>

<?php
include_once 'includes/footer.inc.php';
?>

</html>