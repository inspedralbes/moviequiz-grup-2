<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="front/css/index.css">
    <title>Pelis Grup 2</title>
</head>

<body>

    <?php
    session_start();
    include("front/header.php");
    ?>

    <div id="main-container">
        <div class="container">
            <div class="search_wrap search_wrap_1">
                <div class="search_box">
                    <input type="text" id="cercar" class="input browser-default" placeholder="Buscar...">
                    <a id="buttonSearch" class="waves-effect waves-light btn-large "><i class="material-icons ">search</i></a>
                </div>
            </div>
        </div>



        <div id="auxiliar">

            <p id="nomaux"></p>
            <p id="comentarioaux"></p>
            <p id="votacionaux"></p>
        </div>




        <div class="avatar">


            <img src="https://www.pngall.com/wp-content/uploads/12/Avatar-Profile.png" width=100px height=100px>



        </div>

        <div class="carrouselvotaciones">


            <div class="carousel">



            </div>



        </div>

        <div class="karmadiv">
            <p id="karmap"></p>


        </div>

        <div class="partidasdiv">

            AQUI VAN LAS PARTIDAS


        </div>





        <div id="contenedorPelis" class="row">
        </div>
        <div id="modalAdd" class="modal">
            <div id="modal-preloader" class="center-align">
                <div class="preloader-wrapper big active ">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>

                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-content" id="modal-content-add">
                <div id="modal-image" class="center-align"></div>
                <h4 id="modal-title" class="left-align">Movie Title</h4>
                <h5 id="modal-director" class="left-align">Movie Director</h5>
                <h6 id="modal-year" class="left-align">Year</h6>
                <p id="modal-plot">Movie plot</p>
                <ul class="collection" id="modal-ratings">
                </ul>
                <div id="modal-review" class="center-align">
                    <label>
                        <input name="rating" type="radio" value="1" />
                        <span>1</span>
                    </label>
                    <label>
                        <input name="rating" type="radio" value="2" />
                        <span>2</span>
                    </label>
                    <label>
                        <input checked name="rating" type="radio" value="3" />
                        <span>3</span>
                    </label>
                    <label>
                        <input name="rating" type="radio" value="4" />
                        <span>4</span>
                    </label>
                    <label>
                        <input name="rating" type="radio" value="5" />
                        <span>5</span>
                    </label>
                </div>
                <div id="modal-comment">
                    <div class="input-field col s12">
                        <textarea id="comentari" name="comentari" class="materialize-textarea"></textarea>
                        <label for="comentari">Comentari</label>
                    </div>
                </div>

            </div>

            <div class="modal-footer" id="modal-footer-add">
                <a href="#!" class=" waves-effect waves-green btn" id="buttonConfirmarAfegir">Confirmar</a>
            </div>
            <input type="hidden" name="year" id="year">
            <input type="hidden" name="imdbID" id="imdbID">
            <input type="hidden" name="nom" id="nom">
            <input type="hidden" name="poster" id="poster">
        </div>

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
                            <p class="margin medium-small"><a class="modal-trigger" id="LoginToRegistre" href="#modalRegistre">Registrat Ja!</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="modal-close waves-effect waves-green btn-flat">Enrere</a>
                    </div>
                </form>
            </div>
        </div>


        <div id="modalRegistre" class="modal">
        <h6 class="center-align">Selecciona una imatge de perfil</h6>
            <div class="row avatars">
                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-anime.svg" class="input-avatar">
                        <img src="front/img/avatar-anime.svg">
                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-batman.svg" class="input-avatar">
                        <img src="front/img/avatar-batman.svg">
                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-chaplin.svg" class="input-avatar">
                        <img src="front/img/avatar-chaplin.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-geisha.svg" class="input-avatar">
                        <img src="front/img/avatar-geisha.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-heisenberg.svg" class="input-avatar">
                        <img src="front/img/avatar-heisenberg.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-jason.svg" class="input-avatar">
                        <img src="front/img/avatar-jason.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-luchador.svg" class="input-avatar">
                        <img src="front/img/avatar-luchador.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-queen.svg" class="input-avatar">
                        <img src="front/img/avatar-queen.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-zombie.svg" class="input-avatar">
                        <img src="front/img/avatar-zombie.svg">

                    </label>
                </div>

                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-einstein.svg" class="input-avatar">
                        <img src="front/img/avatar-einstein.svg">

                    </label>
                </div>


                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-indian.svg" class="browser-default">
                        <img src="front/img/avatar-indian.svg">

                    </label>
                </div>


                <div class="col s4 m2">
                    <label>
                        <input type="radio" name="avatar" value="front/img/avatar-monroe.svg" class="browser-default">
                        <img src="front/img/avatar-monroe.svg">

                    </label>
                </div>

            </div>

            <div class="col s12">
                
                <form class="registre-form">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">assignment_ind</i>
                            <input class="validate" id="username" type="text">
                            <label for="username" data-error="wrong" data-success="right">Nom d'usuari</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">person_outline</i>
                            <input class="validate" id="nomreg" type="text">
                            <label for="nom" data-error="wrong" data-success="right">Nom real</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">person_outline</i>
                            <input class="validate" id="cognoms" type="text">
                            <label for="cognoms" data-error="wrong" data-success="right">Cognoms</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mail_outline</i>
                            <input class="validate" id="emailreg" type="email">
                            <label for="email">Email</label>
                            <span class="helper-text" data-error="El format es incorrecte" data-success="Correcte"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="passwordreg" type="password">
                            <label for="password">Contrasenya</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="passwordr" type="password" class="validate">
                            <label id="passlabel" for="passwordr">Repeteix Contraseña</label>
                            <span class="helper-text" data-error="Les contrasenyes no coincideixen" data-success="Correcte"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <a href="#" class="btn waves-effect waves-light col s12 " id="registre">Registrar</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <p class="margin medium-small">Ja tens una compte? <a class="modal-trigger" id="RegisterToLogin" href="#modalLogin">Login!</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="modal-close waves-effect waves-green btn-flat">Enrere</a>
                    </div>
                </form>
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


        <div class="col s12 m12 l12 center-align">
            <ul class="pagination">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left </i></a></li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </div>

    <?php
    include("front/footer.php");
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="front/js/cercador.js"></script>
    <script src="front/js/joc.js"></script>
    <script src="front/js/index.js"></script>

</body>

</html>