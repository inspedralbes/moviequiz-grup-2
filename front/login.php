<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>

</head>

<a class="waves-effect waves-light btn modal-trigger" href="#modalLogin">LOGIN</a>

<div id="modalLogin" class="modal">
    <div class="col s12">
        <form class="login-form">
            <div class="row">
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">mail_outline</i>
                    <input class="validate" id="email" type="email">
                    <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock_outline</i>
                    <input id="password" type="password">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <a href="#" class="btn waves-effect waves-light col s12" id="buttonLogin">Login</a>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <p class="margin medium-small"><a href="#">Register Now!</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Enrere</a>
            </div>
        </form>
    </div>
</div>

  <script>

  document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.modal');
      var instances = M.Modal.init(elems);
    });

    /*Document.getElementById("buttonLogin").addEventListener('click', function () {
        let textemail= Document.getElementById("email").addEventListener;
        let textpassword= Document.getElementById("password").addEventListener;

        const datosEnvio = new FormData();
            datosEnvio.append('username', textemail);
            datosEnvio.append('pwd', textpassword);

            console.log("textemail");

            fetch(``, {
                method: 'POST',
                body: datosEnvio
            })
                .then(response => response.json())
                .then(data => {
                    
                    
                    if () {
                        
                    }
                    else {
                        
                    }
                });
    })

    var app = angular.module('mainModule', []);

        app.controller('mainController', function($scope, $http){ //o scope liga o js e o template
        $scope.nome = 'Valor Inicial';
            //$http.get().success();
        $scope.reset = function()
        {
            $scope.nome = '';
        }
    });*/
  </script>


<?php
    header('Access-Control-Allow-Origin: *');
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
    $db = "projectePelis ";
    $db = mysqli_connect($servername,$username,$password,$db);

    $myemail = mysqli_real_escape_string($db,$_POST['email']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    echo(" "$myemail);
    echo(" "$mypassword);

    $sql = "SELECT email, password FROM usuari WHERE email = '$myemail' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myemail and $mypassword, table row must be 1 row

    if($count == 1) {
        $_SESSION['login_user'] = $myemail;

        header("location: welcome.php");
    }else {
        $error = "Your Login Name or Password is invalid";
    }

?>

</html>