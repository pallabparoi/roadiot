<!DOCTYPE html>
<html><body>
<?php
 
$servername = "localhost";
$dbname = "roadiot";
$username = "root";
$password = "";
 
 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT `id`, `speed`, `overspeed`, `time` FROM `overspeed` ORDER BY id DESC";
 
echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Speed</td> 
        <td>OverSpeed</td>  
        <td>Time</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_speed = $row["speed"];
        $row_overspeed = $row["overspeed"];
        $row_time = $row["time"];
        
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_speed . '</td> 
                <td>' . $row_overspeed. '</td> 
                <td>' . $row_time . '</td> 
              </tr>';
    }
    $result->free();
}
 
$conn->close();
?> 
</table>
</body>
</html>
