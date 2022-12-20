<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "mysql1234";
$dbname = "klaver";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT type, company, category, placedate, education, time, salary  FROM vacancies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>type</th><th>company</th><th>category</th><th>placedate</th><th>education</th><th>time</th><th>salary</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["type"]. "</td><td>" . $row["company"]. "</td><td>" . $row["category"]. "</td><td>" . $row["placedate"]. "</td><td>" . $row["education"]. "</td><td>" . $row["time"]. "</td><td>" . $row["salary"]. "</td><td>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>