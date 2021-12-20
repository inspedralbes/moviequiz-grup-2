<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="front/css/index.css">
    <link rel="stylesheet" href="front/css/perfil.css">
    <title>Pelis Grup 2</title>
</head>

<body>

    <?php
    session_start();
    include("front/header.php");
    ?>


    <div class="row">
        <header class="row" id="profile">
        <div class="col s12  m1 offset-m5" >
            <img id="avatar">
        </div>
        <div class="row">
        <div class="col s12 center-align"  id="nomUsuari"></div>
        <div class="col s12  center-align"  id="nom"></div>
        </div>
      
        </header>
        
        <div class="col s12">
            <ul id="comentaris" class="collection"></ul>
        </div>
    </div>   

    <div id="modalGame" class="modal">
            <div class="modal-content">
                <h4 class="center-align">Joc</h4>
                <input type="text" id="nomPartida" placeholder="Nom de la partida...">
                <div id="question-container"></div>
            </div>
            <div class="modal-footer">
                <a id="buttonConfirmarJoc" href="#!" class="waves-effect waves-green btn-flat">Agree</a>
            </div>
    </div>
    <?php
    include("front/footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="front/js/joc.js"></script>
    <script src="front/js/perfil.js"></script>
    

</body>

</html>