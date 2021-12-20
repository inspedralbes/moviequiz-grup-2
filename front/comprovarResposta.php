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
require_once "partida.php";


$partida= json_decode(file_get_contents('php://input'),true);
$nomPartida = $partida["nomPartida"];
$pelicula = new pelicula();
$usuari = new usuari();
$modelPartida = new partida(); 

$nEncerts=0;
$nErrors=0;

foreach($partida["respostes"] as $resposta){
    $imdbID = $resposta["id"];
    $anySelected = $resposta["resposta"];

    $dadesPelicula= $pelicula->select($imdbID)[0];
    if($dadesPelicula["estrena"]==$anySelected){
        //AUGMENTAR 3 DE KARMA A L'USUARI
        echo "Encertat! ".$dadesPelicula["nom"]."<br>";
        $usuari->sumarKarma(1);
        $nEncerts++;
    }else{
        //RESTAR 1 DE KARMA A L'USUARI
        echo "Fallat! ".$dadesPelicula["nom"]."<br>";
        $usuari->restarKarma(1);
        $nErrors++;
    }
    $partida["encerts"] = $nEncerts;
    $partida["errors"] = $nErrors;


    //GUARDAR PARTIDA
    print_r ($partida);
    $modelPartida->insert($partida);


}