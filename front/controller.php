<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}


require_once "pelicula.php";

$peticions = array("insertarPelicula", "insertarComentarioValoracion");

function handler($peticions)
{
    $uri = $_SERVER['REQUEST_URI'];


    foreach ($peticions as $peticio)
        if (strpos($uri, $peticio) == true)
            $event = $peticio;
    if ($event === "insertarPelicula") {

        $dadesPelicula = array(
            "year" => $_POST["year"],
            "imdbID" => $_POST["imdbID"],
            "nom" => $_POST["nom"],
            "poster" => $_POST["poster"]
        );
        $pelicula = new pelicula();
        $pelicula->insert($dadesPelicula);
        echo $pelicula->message;
    }
}



handler($peticions);
