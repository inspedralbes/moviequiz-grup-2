<?php
require_once("DBAbstractModel.php");

class usuari extends DBAbstractModel
{
    private $id;
    private $nomusuari;
    private $nom;
    private $cognoms;
    private $password;
    private $email;
    private $karma;



    public function selectAll($fields = array())
    {

        $this->query = "SELECT ";
        $firstField = true;
        for ($i = 0; $i < count($fields); $i++) {
            if ($firstField) {
                $this->query .= $fields[$i];
                $firstField = false;
            } else $this->query .= ", " . $fields[$i];
        }
        $this->query .= " FROM usuari";
        $this->get_results_from_query();
        return $this->rows;
    }


    public function selecthash($user_data = array())
    {

        $email = $user_data["email"];
        $pass = $user_data["password"];



        $this->query = "SELECT password FROM usuari WHERE email = '$email' ";
        $this->get_results_from_query();
        $hash = $this->rows[0]["password"];
        return password_verify($pass, $hash);
    }

    public function select($user_data = array())
    {


        if (array_key_exists("email", $user_data)) {

            $email = $user_data["email"];
            
            $this->query = "SELECT * FROM usuari WHERE email = '$email'";
            $this->get_results_from_query();

            if ($this->rows == null) {
            } else {
                return $this->rows;
            }
        }
    }

    public function select_from_id($id)
    {
            $this->query = "SELECT nomUsuari, nom, cognom, email, avatar, karma FROM usuari WHERE id = '$id'";
            $this->get_results_from_query();

            if ($this->rows == null) {
            } else {
                return $this->rows;
            }
        
    }

    public function sumarKarma($id)
    {

        if (!empty($id)) {


            $this->query = "UPDATE `usuari` SET `karma` = karma+3 WHERE `id` = $id";
            $this->execute_single_query();
        }
    }

    public function restarKarma($id)
    {

        if (!empty($id)) {

            $this->query = "UPDATE `usuari` SET `karma` = karma-1 WHERE `id` = $id";
            $this->execute_single_query();
        }
    }

    public function update()
    {
    }

    public function delete()
    {
    }


    public function insert($user_data = array())
    {


        if (array_key_exists("nomUsuari", $user_data)) {

            $nomusuari = $user_data["nomUsuari"];
            $nom = $user_data["nom"];
            $cognom = $user_data["cognom"];
            $password = $user_data["password"];
            $email = $user_data["email"];
            $karma = $user_data["karma"];
            $avatar = $user_data["avatar"];

            $hashed = password_hash($password, PASSWORD_BCRYPT);

            $this->query = "insert into usuari(nomUsuari,nom,cognom,password,email,karma,avatar) values ('$nomusuari', '$nom', '$cognom', '$hashed', '$email', $karma, '$avatar')";

            return $this->execute_single_query();

        }
    }
}
