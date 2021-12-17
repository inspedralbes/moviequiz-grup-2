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
require_once "usuari.php";


$respostes= json_decode(file_get_contents('php://input'),true);

$pelicula = new pelicula();
$usuari = new usuari();

foreach($respostes as $resposta){
    $imdbID = $resposta["id"];
    $anySelected = $resposta["resposta"];

    $dadesPelicula= $pelicula->select($imdbID)[0];
    if($dadesPelicula["estrena"]==$anySelected){
        //AUGMENTAR 3 DE KARMA A L'USUARI
        echo "Encertat! ".$dadesPelicula["nom"]."<br>";
        $usuari->sumarKarma(1);
    }else{
        //RESTAR 1 DE KARMA A L'USUARI
        echo "Fallat! ".$dadesPelicula["nom"]."<br>";
        $usuari->restarKarma(1);
    }



    //GUARDAR PARTIDA

}