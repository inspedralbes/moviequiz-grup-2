<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>

<style>
    html,
    body {
        height: 100%;
    }
    html {
        display: table;
        margin: auto;
    }
    body {
        display: table-cell;
        vertical-align: middle;
        background: #BFA19F;
    }

    #login-page {
        width: 500px;
    }

    .card {
        position: absolute;
        left: 50%;
        top: 50%;
        -moz-transform: translate(-50%, -50%)
        -webkit-transform: translate(-50%, -50%)
        -ms-transform: translate(-50%, -50%)
        -o-transform: translate(-50%, -50%)
        transform: translate(-50%, -50%);
    }
</style>

</head>
<body ng-app="mainModule" ng-controller="mainController">
<div id="login-page" class="row">
    <div class="col s10 z-depth-6 card-panel">
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

      </form>
    </div>
  </div>

  <script>

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

        function cogerDatos()
        {
            $email = $_POST["email"];
            $password = $_POST["password"];
        }

        public function select($email = "")
        {
            $this->query = "SELECT * FROM PERSONES WHERE email='" . $email . "'";
            $this->get_results_from_query();
            return $this->rows;
        }

        public function select($password = "")
        {
            $this->query = "SELECT * FROM PERSONES WHERE password='" . $password . "'";
            $this->get_results_from_query();
            return $this->rows;
        }
    }

?>

</body>
</html>