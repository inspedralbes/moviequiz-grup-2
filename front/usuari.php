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

    public function select($user_data = array())
    {

        echo "holaaa ";

        if (array_key_exists("email", $user_data)) {

            $password = $user_data["password"];
            $email = $user_data["email"];


            $this->query = "SELECT nomUsuari ,email, password FROM usuari WHERE email = '$email' and password = '$password'";
            $this->get_results_from_query();

            $username = $this->rows[0]["nomUsuari"];

            echo $this->rows[0]["nomUsuari"];






            if ($this->rows == null) {

                echo "usuari no encontrat";
            } else {

                echo "usuari encontrat";
                $html = file_get_contents(__DIR__ . '/html/welcome.php');
                $html = str_replace('{nombreuser}', $username, $html);

                print $html;





            }


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


            $this->query = "insert into usuari(nomUsuari,nom,cognom,password,email,karma) values ('$nomusuari', '$nom', '$cognom', '$password', '$email', $karma)";

           $success=  $this->execute_single_query();

           print_r($success . " success ");

           if($success == 0){

               echo "usuari no registrat, ja existeix el nom o el email";
           }
           else{

               echo "usuari registrat correctamnet";

           }



        }
    }
}
