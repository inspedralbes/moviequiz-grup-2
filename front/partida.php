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

    public function select($imdbID = "")
    {
       /* $this->query = "SELECT * FROM pelicula WHERE imdbID='" . $imdbID . "'";
        $this->get_results_from_query();
        return $this->rows;*/
    }


    public function insert($partida)
    {
        
    }

    public function update($userData = array())
    {
    }

    public function delete($nom = "")
    {
    }
}