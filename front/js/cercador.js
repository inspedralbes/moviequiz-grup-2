window.onload = function () {


    //INICIALIZAR MODALS
    let elem = document.getElementById("modalAdd");
    let instances = M.Modal.init(elem);

    var sidenavElems = document.querySelectorAll('.sidenav');
    var sidenavs = M.Sidenav.init(sidenavElems);

    var elemsLogin = document.querySelectorAll('#modalLogin');
    var instancesLogin = M.Modal.init(elemsLogin);

    var elemsRegistre = document.querySelectorAll('#modalRegistre');
    var instancesRegistre = M.Modal.init(elemsRegistre);

    var elemGame = document.querySelectorAll('#modalGame');
    var instancesGame = M.Modal.init(elemGame);

    //GENERAR LAS PELICULAS Y SU MODAL CON INFORMACIÓN
    let contenedorPelis = document.getElementById("contenedorPelis");
    document.getElementById("buttonSearch").addEventListener("click", function () {
        let parametro = document.getElementById("cercar").value;
        document.getElementById("cercar").value = "";
        let url = `https://www.omdbapi.com/?apikey=cc87f99c&type=movie&s=${parametro}`;
        fetch(url)
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                if (data.Response == "True") {
                    let busqueda = data.Search;
                    let str = "";

                    busqueda.forEach(pelicula => {
                        let divPeliStr = `<div class=" col s6 m3">
                    <div class="card">
                    <div class="card-image">
                      <img src="${pelicula.Poster}" width=250 height=350>
                      <span class="card-title">${pelicula.Title}</span>
                    </div>
                    <div class="card-action">
                    <a class="waves-effect waves-light btn modal-trigger buttonAfegir" href="#modalAdd" id="${pelicula.imdbID}" ><i class="material-icons right">add</i>Afegir</a>
                    </div>
                    </div>
                  </div>`;
                        str += divPeliStr;
                    });
                    document.getElementById("contenedorPelis").classList.remove("hide");
                    contenedorPelis.innerHTML = str;


                    contenedorPelis.addEventListener("click", function (e) {
                        if (e.target.classList.contains("buttonAfegir")) {
                            let preloader = document.getElementById("modal-preloader");
                            preloader.classList.remove("hide")
                            document.getElementById("modal-content-add").classList.add("hide");
                            document.getElementById("modal-footer-add").classList.add("hide");
                            let url = `https://www.omdbapi.com/?apikey=cc87f99c&i=${e.target.id}`
                            fetch(url).then(function (res) {
                                return res.json()
                            }).then(function (data) {
                                document.getElementById("modal-preloader").classList.add("hide");
                                document.getElementById("modal-content-add").classList.remove("hide");
                                document.getElementById("modal-footer-add").classList.remove("hide");
                                let info = data;
                                document.getElementById("modal-title").innerHTML = info.Title;
                                document.getElementById("modal-image").innerHTML = ` <img class="center-align"src="${info.Poster}" width=250 height=350>`
                                document.getElementById("modal-plot").innerHTML = info.Plot;
                                document.getElementById("modal-year").innerHTML = info.Year;
                                document.getElementById("modal-director").innerHTML = info.Director;

                                document.getElementById("year").value = info.Year;
                                document.getElementById("imdbID").value = e.target.id;
                                document.getElementById("nom").value = info.Title;
                                document.getElementById("poster").value = info.Poster;


                                let ulRatings = document.getElementById("modal-ratings");
                                let str = "";
                                info.Ratings.forEach(rating => {
                                    let img = "front/img/user-icon.svg"
                                    if (rating.Source === "Rotten Tomatoes") {
                                        img = "front/img/Rotten_Tomatoes.svg"
                                    } else if (rating.Source === "Metacritic") {
                                        img = "front/img/Metacritic.svg"
                                    } else if (rating.Source === "Internet Movie Database") {
                                        img = "front/img/IMDb.svg"
                                    }
                                    let ratingsDiv = ` <li class="collection-item avatar">
                                <img src=${img} alt="" class="circle">
                                <span class="title">${rating.Source}</span>
                                <p>${rating.Value} <br>
                                   
                                </p>
                              </li>`
                                    str += ratingsDiv;
                                });
                                ulRatings.innerHTML = str;
                            })
                        }
                    })

                } else {
                    Swal.fire(
                        'Error',
                        'No hem trobat cap pel-lícula :(',
                        'error'
                    )
                }
            })
    });


    //BUSCAR PELICULAS AL PULSAR ENTER EN LA BARRA DE BUSQUEDA
    document.getElementById("cercar").addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            document.getElementById("buttonSearch").click();
        }
    });


    //ENVIAR DATOS AL PULSAR CONFIRMAR
    document.getElementById("buttonConfirmarAfegir").addEventListener("click", function () {

        let modal = M.Modal.getInstance(document.getElementById("modalAdd"));

        Swal.fire({
            title: '¿Vols enviar aquesta crítica?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Sí',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {


                let year = document.getElementById("year").value;
                let imdbID = document.getElementById("imdbID").value;
                let nom = document.getElementById("nom").value;
                let poster = document.getElementById("poster").value;
                let rating = document.querySelector('input[name="rating"]:checked').value;
                let comment = document.getElementById("comentari").value;

                const datosEnvio = new FormData();

                datosEnvio.append('rating', rating);
                datosEnvio.append('comment', comment);
                datosEnvio.append('year', year);
                datosEnvio.append('imdbID', imdbID);
                datosEnvio.append('nom', nom);
                datosEnvio.append('poster', poster);



                fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=insertarPelicula`, {

                    method: 'POST',
                    body: datosEnvio,
                    credentials: 'same-origin'

                }).then(function (res) {
                    return res.json()
                }).then(function (result) {

                    if (result.result === "OK") {
                        Swal.fire('Saved!', '', 'success')
                        modal.close();
                    } else {
                        Swal.fire(
                            'Error',
                            'Algo no ha funcionat correctament',
                            'error'
                        )
                    }
                })

            }
        })
    })

    //BOTON LOGO
    document.getElementById("logo").addEventListener('click', function () {
        document.getElementById("contenedorPelis").classList.add("hide");
    })

    //CANVIS DE MODALS
    document.getElementById("RegisterToLogin").addEventListener('click', function () {
        let modalRegistre = M.Modal.getInstance(document.getElementById("modalRegistre"));
        modalRegistre.close();

        var instancesLogin = M.Modal.getInstance(elemsLogin);
        instancesLogin.open();
    })

    document.getElementById("LoginToRegistre").addEventListener('click', function () {
        let modalLogin = M.Modal.getInstance(document.getElementById("modalLogin"));
        modalLogin.close();

        var instancesRegistre = M.Modal.getInstance(elemsRegistre);
        instancesLogin.open();
    })

    document.getElementById("InfoUser").classList.add("hide");
    document.getElementById("btnPerfil").classList.add("hide");
    document.getElementById("btnlogout").classList.add("hide");
    document.getElementById("btnlogout-mobile").classList.add("hide");
    document.getElementById("btnPerfil-mobile").classList.add("hide");
    document.getElementById("aside-ranking").classList.add("hide");
    document.getElementById("btnRegistre").classList.remove("hide");
    document.getElementById("btnRegistre-mobile").classList.remove("hide");
    document.getElementById("btnLogin").classList.remove("hide");
    document.getElementById("btnLogin-mobile").classList.remove("hide");

}