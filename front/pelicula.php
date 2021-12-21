<?php

// magic constant
require_once("DBAbstractModel.php");

class pelicula extends DBAbstractModel
{

    private $nom;
    private $imdbID;
    private $poster;
    private $estrena;

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
    public function selectAll()
    {

        $this->query = "SELECT * FROM pelicula order by nFavorits";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function select($imdbID = "")
    {
        $this->query = "SELECT * FROM pelicula WHERE imdbID='" . $imdbID . "'";
        $this->get_results_from_query();
        return $this->rows;
    }


    public function insert($dadesPeli = array())
    {
        if (array_key_exists("imdbID", $dadesPeli)) {
            $imdbID = $dadesPeli["imdbID"];

            $result = $this->select($imdbID);

            if (count($result) == 0) {
                $nom = $dadesPeli["nom"];
                $poster = $dadesPeli["poster"];
                $year = $dadesPeli["year"];

                $this->query = "INSERT INTO pelicula (imdbID, nom, poster, estrena, nfavorits)
                VALUES ('" . $imdbID . "', '" . $nom . "', '" . $poster . "'," . $year . ",1)";
                $this->execute_single_query();
            }
        }
    }

    public function increaseNFavorits($imdbID)
    {
        $this->query = "UPDATE `pelicula` SET `nFavorits` = nFavorits+1 WHERE `pelicula`.`ImdbID` = '" . $imdbID . "'; ";
        $this->execute_single_query();
    }

    public function update($userData = array())
    {
    }

    public function delete($nom = "")
    {
    }
}
