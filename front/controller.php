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
require_once "comentariUsuari.php";

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
        $dadesComentari = array(
            "id" => 1,
            "comentari" => $_POST["comment"],
            "rating" => $_POST["rating"]
        );

        $comentariUsuari = new comentariUsuari();
        $pelicula = new pelicula();


        $result = false;
        if ($pelicula->select($dadesPelicula["imdbID"])) {
            //La peli està guardada en la base de dades

            if ($comentariUsuari->select($dadesPelicula["imdbID"], $dadesComentari["id"])) {
                //La peli ja la té guardada l'usuari
                $result = false;
            } else {
                //La peli no la té guardada l'usuari
                $pelicula->increaseNFavorits($dadesPelicula["imdbID"]);
                $comentariUsuari->insert($dadesPelicula, $dadesComentari);
                $result = true;
            }
        } else {
            //La peli no està guardada en la base de dades

            $pelicula->insert($dadesPelicula);
            $result = $comentariUsuari->insert($dadesPelicula, $dadesComentari);
        }



        $json = array("result" => "");
        if ($result == true) {
            $json["result"] = "OK";
        } else {
            $json["result"] = "FALSE";
        }
        echo json_encode($json);
    }
}



handler($peticions);
