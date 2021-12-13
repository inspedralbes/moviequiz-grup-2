

<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
die();


?>


<?php


}
  /*  header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
        die();
    }


    echo("El fetch funciona");

    // email and password sent from form

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "projectepelis";
    $db = mysqli_connect($servername,$username,$password,$db);
echo "llego aqui2";


    if($_POST) {

        $myemail = $_POST['email'];
        $mypassword =  $_POST['password'];

        echo "llego aqui";

        $sql = "SELECT email, password FROM usuari WHERE email = '$myemail' and password = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active = $row['active'];

        $count = mysqli_num_rows($result);

        // If result matched $myemail and $mypassword, table row must be 1 row

        if ($count == 1) {
            $_SESSION['login_user'] = $myemail;

            header("location: welcome.php");
        } else {
            $error = "Your Login Name or Password is invalid";
        }
    }*/

?>

</html>