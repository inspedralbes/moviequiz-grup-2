<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
  die();
}

require_once("back/sql/config.php");

$db = $config["db"];




// Create connection
$conn = new mysqli($db["server"], $db["username"], $db["password"], $db["db"]);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}







$rating = $_POST["rating"];
$comment = $_POST["comment"];
$year = $_POST["year"];
$imdbID = $_POST["imdbID"];
$nom = $_POST["nom"];
$poster = $_POST["poster"];




$sql = "SELECT * FROM pelicula WHERE imdbID='" . $imdbID . "'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {

  $sql = "INSERT INTO pelicula (imdbID, nom, poster, estrena)
    VALUES ('" . $imdbID . "', '" . $nom . "', '" . $poster . "'," . $year . ")";
  $conn->query($sql);
}



$sql = "INSERT INTO usu_peli (id, imdbID, comentari, puntuacio)
VALUES (1, '" . $imdbID . "', '" . $comment . "'," . $rating . ")";


if ($conn->query($sql) === TRUE) {
  echo "OK";
} else {
  echo "ERROR";
}