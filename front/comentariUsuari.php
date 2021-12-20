<?php

// magic constant
require_once("DBAbstractModel.php");

class comentariUsuari extends DBAbstractModel
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
    public function selectAll($imdbID = "", $idUsuari = "")
    {

        $this->query = "SELECT * from usu_peli where id='" . $idUsuari . "' and imdbID='" . $imdbID . "'";
        $this->get_results_from_query();

        return $this->rows;
    }

    public function select($imdbID = "", $idUsuari = "")
    {
        $this->query = "SELECT * from usu_peli where id='" . $idUsuari . "' and imdbID='" . $imdbID . "'";
        $this->get_results_from_query();

        return $this->rows;
    }

    public function selectAllFromUser($idUsuari = "")
    {
        $this->query = "SELECT usu_peli.imdbID,comentari, puntuacio,nom, poster from usu_peli, pelicula where id= " . $idUsuari . " AND usu_peli.ImdbID=pelicula.ImdbID";
        $this->get_results_from_query();

        return $this->rows;
    }

    public function return_rows(){


        return $this->rows;
    }



    public function insert($dadesPeli = array(), $dadesComentari = array())
    {
        $imdbID = $dadesPeli["imdbID"];
        $idUsuari = $dadesComentari["id"];
        $comment =  $dadesComentari["comentari"];
        $rating = $dadesComentari["rating"];
        $this->query = "INSERT INTO usu_peli (id, imdbID, comentari, puntuacio)
        VALUES ($idUsuari, '" . $imdbID . "', '" . $comment . "'," . $rating . ")";
        return $this->execute_single_query();
    }

    public function update($userData = array())
    {
    }

    public function delete($idusuari = "", $idpeli = "")
    {

        $idusuari = $idusuari;
        $idpeli = $idpeli;

        $this->query = "DELETE FROM usu_peli WHERE id = $idusuari and imdbID = '".$idpeli."'";
        echo  $this->query;
        $this->execute_single_query();



    }
}
