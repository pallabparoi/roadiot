<?php 

$servername = "localhost";
$dbname = "roadiot";
$username = "root";
$password = "";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if (!$conn){
    die("connection failed :". mysqli_connect_error()  );

}
echo "Database Connected";

if(isset($_POST["speed"]) && isset($_POST["overspeed"])) {
    $speed = $_POST["speed"];
    $overspeed = $_POST["overspeed"];

    $sql = " INSERT INTO overspeed (`speed`, `overspeed`) VALUES (".$speed.",".$overspeed.") ";

    if (mysqli_query($conn,$sql)){
      echo "New data recorted";
    }

    else {
     echo "Error :". $sql. "<br>" . mysqli_errno($conn);
    }

}

?>
