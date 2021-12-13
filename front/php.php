<?php


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



comprobauser($conn);

function comprobauser($conn){


    $nom = $_POST["nom"];
    $username = $_POST["username"];

    $cognoms = $_POST["cognoms"];
    $email = $_POST["email"];

    $password = $_POST["password"];
    $passwordr = $_POST["passwordr"];

    $sql = "SELECT * FROM usuari WHERE nomUsuari='" . $username . "'";
    $result = $conn->query($sql);


    
}



