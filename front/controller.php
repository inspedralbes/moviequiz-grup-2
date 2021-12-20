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
require_once "partida.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$peticions = array("insertarPelicula","logearRefresh","cargapartidasUser", "insertarComentarioValoracion","borrarPeliUser", "registrarUser", "logearUser", "logoutUser", "cargaPerfil", "buscaPeliparaUser", "generarPartida", "comprobarPartida", "cargarPerfilConcreto");
function handler($peticions)
{
    $refresco = 0;

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
            "id" => $_SESSION["idUsuari"],
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
        if ($result) {
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
            "avatar"=> $_POST["avatar"]

        );
        $usuari = new usuari();
        $result = $usuari->insert($dadesUser);

        $json = array("result" => "");
        if ($result) {
            $json["result"] = "OK";
        } else {
            $json["result"] = "FALSE";
        }
        echo json_encode($json);
    }

    if ($event === "logearUser") {

        if($refresco == 0) {
            $dadesUser = array(

                "password" => $_POST["password"],
                "email" => $_POST["email"]
            );


            $usuari = new usuari();
            $resultat = $usuari->selecthash($dadesUser);

            $json = array();
            if ($resultat) {
                $json["result"] = "OK";
                $selectedUser = $usuari->select($dadesUser);
                $_SESSION["idUsuari"] = $selectedUser[0]["id"];


                $json = $selectedUser[0];
                $json["result"] = "OK";

            } else {
                $json["result"] = "FALSE";
            }

        }
        else{
            $usuari = new usuari();
            $selectedUser = $usuari->selectrefresh($_SESSION["idUsuari"]);
            $json = $selectedUser[0];
            $json["result"] = "OK";



        }
        echo json_encode($json);
    }


    if ($event === "logoutUser") {

        // session_destroy();

    }




    if ($event === "cargaPerfil") {

       
        $id = $_SESSION["idUsuari"];

        $dadespeliuser = new comentariUsuari();

        $dadespeliuser->selectAllFromUser($id);

        $usuari = new usuari();

        $dadesUsuari= $usuari->select_from_id($id);
        $dadesUsuari[0]["comentaris"]= $dadespeliuser->return_rows();
        $json= json_encode($dadesUsuari[0]);
        print_r($json);
    }



    if ($event === "cargarPerfilConcreto") {

       
        $id = 2;

        $dadespeliuser = new comentariUsuari();

        $dadespeliuser->selectAllFromUser($id);

        $usuari = new usuari();
        $partida=new partida();

        $dadesUsuari= $usuari->select_from_id($id);
        $dadesUsuari[0]["comentaris"]= $dadespeliuser->return_rows();
        $partidas = $partida->select_partidas_from_user($id);
        
        $json= json_encode($dadesUsuari[0]);
        print_r($json);
    }


    if ($event === "buscaPeliparaUser") {

        $idpeli = $_POST["idpeli"];
        $peli = new pelicula();
        $peliretornada = $peli->select($idpeli);
        $json = json_encode($peliretornada);

        print_r($json);
    }


    if ($event === "generarPartida") {

        $comentariUsuari = new comentariUsuari();
        $pelicula = new pelicula();

        $json = array(
            "id_partida" => 10,
            "peliculas" => array("")
        );


        
        $favorits = $comentariUsuari->selectAllFromUser($_SESSION["idUsuari"]);
        

        $pelisKeys = array_rand($favorits, 5);
        $pelicules = array();

        for ($i = 0; $i < count($pelisKeys); $i++) {
            $imdbID = $favorits[$pelisKeys[$i]]["imdbID"];
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
    }
    if ($event === "comprobarPartida") {

        $partida = json_decode(file_get_contents('php://input'), true);
        $nomPartida = $partida["nomPartida"];
        $pelicula = new pelicula();
        $usuari = new usuari();
        $modelPartida = new partida();

        $nEncerts = 0;
        $nErrors = 0;

        foreach ($partida["respostes"] as $resposta) {
            $imdbID = $resposta["id"];
            $anySelected = $resposta["resposta"];

            $dadesPelicula = $pelicula->select($imdbID)[0];
            if ($dadesPelicula["estrena"] == $anySelected) {
                //AUGMENTAR 3 DE KARMA A L'USUARI

                $usuari->sumarKarma($_SESSION["idUsuari"]);
                $nEncerts++;
            } else {
                //RESTAR 1 DE KARMA A L'USUARI

                $usuari->restarKarma($_SESSION["idUsuari"]);
                $nErrors++;
            }
            $partida["encerts"] = $nEncerts;
            $partida["errors"] = $nErrors;
            $partida["idUsuari"] = $_SESSION["idUsuari"];
        }

        $result = $modelPartida->insert($partida);

        $json = array("result" => "");
        if ($result == 1) {
            $json["result"] = "OK";
        } else {
            $json["result"] = "FALSE";
        }
        echo json_encode($json);
    }


    if ($event === "borrarPeliUser") {

        $idpeli = $_POST["idpeli"];
        print_r($idpeli);
        $dadesusu = $_SESSION["idUsuari"];

        $dadespeliuser = new comentariUsuari();

        $dadespeliuser->delete($dadesusu, $idpeli);
    }

    if ($event === "cargapartidasUser") {

        $user = $_SESSION["idUsuari"];
        $partidauser = new partida();
        $partidauser->selectAllFromUser($user);
         $partidauser->return_rows();
         $json = json_encode($partidauser->return_rows());
         echo $json;

    }

    if ($event === "logearRefresh") {

    
        $user = $_SESSION["idUsuari"];
        $refresco = 1;
        echo $user;


    }


}



handler($peticions);
