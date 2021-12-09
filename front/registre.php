<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>">

<label for="username">ID Usuari</label>
<input type="text" name="username" required><br>

<label for="nom">Nom</label>
<input type="text" name="nom" ><br>

<label for="cognoms">Cognoms</label>
<input type="text" name="cognoms" ><br>

<label for="email">Email</label>
<input type="text" name="email" ><br>

<label for="password">Password</label>
<input type="password" name="password" ><br>

<label for="passwordr">Retype Password</label>
<input type="password" name="passwordr" ><br><br>


    <button type="submit">me llamo axel me gusta la ester</button>

</form>

<?php
    comprobauser();



    function comprobauser()
    {

        print_r($_POST);

            $nom = $_POST["nom"];
            $usuari = $_POST["username"];

            $cognoms = $_POST["cognoms"];
            $email = $_POST["email"];

            $passwordu = $_POST["password"];
            $passwordr = $_POST["passwordr"];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "projectePelis";

            $conn = new mysqli($servername, $username, $password, $db);

            if (!$conn->query("INSERT INTO usuari (id, nomUsuari, nom,cognom, password, email, karma )
        VALUES (5, '" . $usuari . "', '" . $nom . "', '" . $cognoms . "', '" . $passwordu . "', '" . $email . "', 0)")) {
                echo("Error description: " . $conn->error);
            }


    }


    function insertuser(){



    }


    function get_results_from_query() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "projectePelis";

        $conn = new mysqli($servername, $username, $password, $db);
        $result = $conn->query("SELECT * from usuari");
        printf("Select returned %d rows.\n", $result->num_rows);

        if ($result = $conn -> query("SELECT * from usuari")) {
            while ($row = $result -> fetch_row()) {
                printf ("%s (%s) %s\n", $row[0], $row[1], $row[2]);
            }
            $result -> free_result();
        }
  }



?>




</body>
</html>