<?php
/*db connetie #2 moet er eigenlijk uit */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "klaver";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    echo '<th>Type></th>';

    
   
  echo '</tr>';
  echo '<tr>';
  echo '<td>' . $row['company'] . '</td>';
  echo '<td>' . $row['type'] . '</td>';
  echo '<td>' . $row['category'] . '</td>';
  echo '<td>' . $row['placedate'] . '</td>';
  echo '<td>' . $row['education'] . '</td>';
  echo '<td>' . $row['time'] . '</td>';
  echo '<td>' . $row['salary'] . '</td>';
  
  echo '</tr>';
echo '</table>';
                }
        
    }



}
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




</body>
<?php
include_once 'includes/footer.inc.php';
?>
</html>