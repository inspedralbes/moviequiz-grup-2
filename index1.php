

<?php
session_start();
print_r($_SESSION);

?>

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




    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">Logo</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="modal-trigger" href="#modalLogin">Login</a></li>
                <li><a class="modal-trigger" href="#modalLogout" hidden>Logout</a></li>
                <li><a class="modal-trigger " href="#modalRegistre">Registre</a></li>
                <li><a class="modal-trigger joc-trigger" href="#modalGame">Jugar</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a class="modal-trigger" href="#modalLogin">Login</a></li>
        <li><a class="modal-trigger" href="#modalLogout">Logout</a></li>
        <li><a class="modal-trigger" href="#modalRegistre">Registre</a></li>
        <li><a class="modal-trigger joc-trigger" href="#modalGame">Jugar</a></li>
    </ul>


    <div id="main-container">


        <div class="container">
            <div class="search_wrap search_wrap_1">
                <div class="search_box">
                    <input type="text" id="cercar" class="input browser-default" placeholder="Buscar...">
                    <a id="buttonSearch" class="waves-effect waves-light btn-large "><i
                            class="material-icons ">search</i></a>
                </div>
            </div>
        </div>



        <div class="welcomecontainer">

            <h1 id="welcome"></h1>

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
                            <p class="margin medium-small"><a class="modal-trigger" id="LoginToRegistre"
                                    href="#modalRegistre">Registrat Ja!</a></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a id="atrasLogin" class="modal-close waves-effect waves-green btn-flat">Enrere</a>
                    </div>
                </form>
            </div>
        </div>


        <div id="modalRegistre" class="modal">
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
                            <input class="validate" id="nom" type="text">
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
                            <input class="validate" id="email" type="email">
                            <label for="email" data-error="wrong" data-success="right">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="password" type="password">
                            <label for="password">Contrasenya</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="passwordr" type="password">
                            <label for="passwordr">Repeteix Contraseña</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <a href="#" class="btn waves-effect waves-light col s12" id="buttonLogin">Registrar</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <p class="margin medium-small">Ja tens una compte? <a class="modal-trigger"
                                    id="RegisterToLogin" href="#modalLogin">Login!</a></p>
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
                <div id="question-container"></div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>



    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="front/js/cercador.js"></script>
    <script src="front/js/joc.js"></script>

</body>

<script>




    document.getElementById("buttonLogin").addEventListener("click", function () {

        console.log("click");

        let email = document.getElementById('email').value;
        let password = document.getElementById("password").value;

        console.log(email);
        console.log(password);

        const datosEnvio = new FormData();

        datosEnvio.append('email', email);
        datosEnvio.append('password', password);

        let promesa = fetch(`http://localhost/pruebas/controller.php?action=logearUser`, {


            method: 'POST',
            body: datosEnvio


        }).then(function (res) {

            return res.json();
        })


        promesa.then((a) => {


            let b = JSON.stringify(a);
            console.log(b);
            let json = JSON.parse(b);

            console.log(json.nomUsuari);

            document.getElementById("welcome").innerHTML = "Benvingut " + json.nomUsuari;
            document.getElementById("modalLogin").hidden;

            document.getElementsByClassName("modal-trigger")[1].hidden = false;

            document.getElementsByClassName("modal-trigger")[0].hidden = true;


        })

    })

    document.getElementsByClassName("modal-trigger")[1].addEventListener("click", function (){


        document.getElementsByClassName("modal-trigger")[0].hidden = false;
        document.getElementsByClassName("modal-trigger")[1].hidden = true;






    })



</script>



</html>