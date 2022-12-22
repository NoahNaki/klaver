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

    $query = $conn->prepare("SELECT * FROM vacancies WHERE type like '%$searchq%' OR company LIKE '%$searchq%' OR category LIKE '%$searchq%' OR placedate LIKE '%$searchq%' OR education LIKE '%$searchq%' OR time LIKE '%$searchq%' OR salary LIKE '%$searchq%' ") or die("could not search!");
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
    echo '<th>Company</th>';
    echo '<th>Type</th>';
    echo '<th>Category</th>';
    echo '<th>Placedate</th>';
    echo '<th>Education</th>';
    echo '<th>Time</th>';
    echo '<th>Salary</th>';
    echo '</tr>';


  echo '<tr>';
  echo '<td>' . $row["company"] . '</td>';
  echo '<td>' . $row["type"] . '</td>';
  echo '<td>' . $row["category"] . '</td>';
  echo '<td>' . $row["placedate"] . '</td>';
  echo '<td>' . $row["education"] . '</td>';
  echo '<td>' . $row["time"] . '</td>';
  echo '<td>' . $row["salary"] . '</td>';
  
  echo '</tr>';
echo '</table>';
                }
        
    }



}

// SQL query for table information
$sql = "SELECT company, type, category, placedate, education, time, salary  FROM vacancies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //top column for table names
    echo "<table><tr><th>Company</th><th>Type</th><th>Category</th><th>Placedate</th><th>Education</th><th>Time</th><th>Salary</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["company"]. "</td><td>" . $row["type"]. "</td><td>" . $row["category"]. "</td><td>" . $row["placedate"]. "</td><td>" . $row["education"]. "</td><td>" . $row["time"]. "</td><td>" . $row["salary"]. "</td><td>";
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