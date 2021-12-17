<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

require_once "comentariUsuari.php";
require_once "pelicula.php";



$comentariUsuari = new comentariUsuari();
$pelicula = new pelicula();

$json = array(
    "id_partida" => 10,
    "peliculas" => array("")
);


$favorits = $comentariUsuari->selectAllFromUser(2);
$pelisKeys = array_rand($favorits, 5);
$pelicules = array();

for ($i = 0; $i < count($pelisKeys); $i++) {
    $imdbID = $favorits[$pelisKeys[$i]]["ImdbID"];
    array_push($pelicules, $pelicula->select($imdbID));
}


$preguntes = array();

foreach ($pelicules as $key => $pelicula) {
    $vectorAnys = [-15, -10, -5, -2, +2, +5, +10, +15];

    $preguntes[$key] = array(
        "imdbID" => $pelicula[0]["ImdbID"],
        "nom" => $pelicula[0]["nom"],
        "poster" => $pelicula[0]["poster"],
        "opcions" => array($pelicula[0]["estrena"], 0, 0, 0)
    );


    for ($i = 1; $i < count($preguntes[$key]["opcions"]); $i++) {
        $rand = rand(0, count($vectorAnys) - 1);
        $preguntes[$key]["opcions"][$i] = $pelicula[0]["estrena"] + $vectorAnys[$rand];
        unset($vectorAnys[$rand]);
        $vectorAnys = array_values($vectorAnys);
    }
}


foreach ($preguntes as &$pregunta) {
    shuffle($pregunta["opcions"]);
}


$json["peliculas"] = $preguntes;



echo json_encode($json);
