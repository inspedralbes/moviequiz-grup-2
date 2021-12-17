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


$respostes= json_decode(file_get_contents('php://input'),true);

$pelicula = new pelicula();

foreach($respostes as $resposta){
    $imdbID = $resposta["id"];
    $anySelected = $resposta["resposta"];

    $dadesPelicula= $pelicula->select($imdbID)[0];
    if($dadesPelicula["estrena"]==$anySelected){
        //AUGMENTAR 3 DE KARMA A L'USUARI
        echo "Encertat! ".$dadesPelicula["nom"]."<br>";
    }else{
        //RESTAR 1 DE KARMA A L'USUARI
    }



    //GUARDAR PARTIDA

}