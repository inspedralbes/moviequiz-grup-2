<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

require_once "usuari.php";
require_once "pelicula.php";
require_once "comentariUsuari.php";

$peticions = array("insertarPelicula", "insertarComentarioValoracion", "registrarUser", "logearUser", "logoutUser", "cargaPerfil", "buscaPeliparaUser");

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
            "id" => 2,
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
                $succes = $comentariUsuari->insert($dadesPelicula, $dadesComentari);
                if ($succes == 0) {
                    $result = false;
                } else $result = true;
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


    if ($event === "registrarUser") {
        $dadesUser = array(
            "nomUsuari" => $_POST["user"],
            "nom" => $_POST["nom"],
            "cognom" => $_POST["cognom"],
            "password" => $_POST["password"],
            "email" => $_POST["email"],
            "karma" => 0,

        );


        $usuari = new usuari();
        $usuari->insert($dadesUser);
    }

    if ($event === "logearUser") {



        $dadesUser = array(

            "password" => $_POST["password"],
            "email" => $_POST["email"]
        );


        $usuari = new usuari();
        print($usuari->selecthash($dadesUser));

        $usuari2 = new usuari();
        $usuari2->select($dadesUser);
    }


    if ($event === "logoutUser") {

       // session_destroy();

    }



    
    if ($event === "cargaPerfil") {

        $dadesusu = $_POST["id"];

        $dadespeliuser = new comentariUsuari();

        $dadespeliuser->selectAllFromUser($dadesusu);

        $json = json_encode($dadespeliuser->return_rows());

        print_r($json);


        

     }


    if ($event === "buscaPeliparaUser") {

    $idpeli = $_POST["idpeli"];
    $peli = new pelicula();
    $peliretornada = $peli->select($idpeli);
    $json = json_encode($peliretornada);

    print_r($json);



    }
 


}



handler($peticions);
