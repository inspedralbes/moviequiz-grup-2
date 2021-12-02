<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

$servername = "localhost";
$username = "root";
$password = "";
$db = "projectePelis";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";






$rating = $_POST["rating"];
$comment = $_POST["comment"];
$year = $_POST["year"];
$imdbID = $_POST["imdbID"];
$nom = $_POST["nom"];
$poster = $_POST["poster"];




$sql = "SELECT * FROM pelicula WHERE imdbID='".$imdbID."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "error";
  } else {
    $sql = "INSERT INTO pelicula (imdbID, nom, poster, estrena)
    VALUES ('".$imdbID."', '".$nom."', '".$poster."',".$year.")";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>