<?php

// magic constant
require_once("DBAbstractModel.php");

class partida extends DBAbstractModel
{

    public $message;

    function __construct()
    {
        $this->db_name = "projectePelis";
    }

    function __toString()
    {
        return "WIP";
    }

    function __destruct()
    {
    }

    //select dels camps passats de tots els registres
    //stored in $rows property
    public function selectAll($fields = array())
    {
        /*
        $this->query = "SELECT ";
        $firstField = true;
        for ($i = 0; $i < count($fields); $i++) {
            if ($firstField) {
                $this->query .= $fields[$i];
                $firstField = false;
            } else $this->query .= ", " . $fields[$i];
        }
        $this->query .= " FROM persones";
        $this->get_results_from_query();
        return $this->rows;*/
    }

    public function selectAllFromUser($idUsuari = "")
    {
        $this->query = "SELECT * from partida where id_usuari=" . $idUsuari . "";
        $this->get_results_from_query();

        return $this->rows;
    }
    public function return_rows(){


        return $this->rows;
    }




    public function select($imdbID = "")
    {
        /* $this->query = "SELECT * FROM pelicula WHERE imdbID='" . $imdbID . "'";
        $this->get_results_from_query();
        return $this->rows;*/
    }


    public function select_partidas_from_user($id)
    {
        $this->query = "SELECT partida.nom,dia, encerts, errors, json_partida FROM partida, usuari WHERE usuari.id= $id AND usuari.id=partida.id_usuari;";
        $this->get_results_from_query();
        return $this->rows;
    }


    public function insert($partida = array())
    {
        $dia = $partida["dataPartida"];
        $nom = $partida["nomPartida"];
        $encerts = $partida["encerts"];
        $errors = $partida["errors"];
        $idUsuari = $partida["idUsuari"];
        $json_partida = json_encode($partida["respostes"]);
        $this->query = "INSERT INTO partida (nom, dia, encerts, errors, json_partida, id_usuari)
        VALUES ('" . $nom . "', '" . $dia . "', '" . $encerts . "', '" . $errors . "', '" . $json_partida . "'," . $idUsuari . ")";

        return $this->execute_single_query();
    }

    public function update($userData = array())
    {
    }

    public function delete($nom = "")
    {
    }
}
