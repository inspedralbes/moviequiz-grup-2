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





    comprobauser($conn);

    function comprobauser($conn)
    {


        $nom = $_POST["nom"];
        $username = $_POST["username"];

        $cognoms = $_POST["cognoms"];
        $email = $_POST["email"];

        $password = $_POST["password"];
        $passwordr = $_POST["passwordr"];

        $sql = "SELECT * FROM usuari WHERE nomUsuari ='" . $username . "'";
        $conn->query($sql);
    }



    function get_results_from_query() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "projectePelis";

        $conn = new mysqli($servername, $username, $password, $db);

    $result = $this->conn->query($this->query);
    for ($i=0;$i<$result->num_rows;$i++)
      $this->rows[$i]=$result->fetch_assoc();
    $result->close();
    $this->close_connection();
  }



?>




</body>
</html>