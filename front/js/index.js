


document.getElementById("buttonLogin").addEventListener("click", function () {


    let email = document.getElementById('email').value;
    let password = document.getElementById("password").value;
    let modalLogin = M.Modal.getInstance(document.getElementById("modalLogin"));

    const datosEnvio = new FormData();

    datosEnvio.append('email', email);
    datosEnvio.append('password', password);

    let promesa = fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=logearUser`, {
        method: 'POST',
        body: datosEnvio
    }).then(function (res) {
        return res.json();
    })
    promesa.then((a) => {
        if (a.result == "OK") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Login realitzat correctament',
                showConfirmButton: false,
                timer: 1000
            })
            modalLogin.close();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Correu o contraseña no coincideixen!',
            })
        }

        let b = JSON.stringify(a);
        let json = JSON.parse(b);

        document.getElementById("karmap").innerHTML = json.karma + " puntos de karma";
        document.getElementById("modalLogin").hidden;
        document.getElementsByClassName("modal-trigger")[1].hidden = false;
        document.getElementsByClassName("modal-trigger")[0].hidden = true;

        let email = document.getElementById('email').value;
        let password = document.getElementById("password").value;

        const buscarPelis = new FormData();

        buscarPelis.append('id', json.id);

        let prom = fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=cargaPerfil`, {
            method: 'POST',
            body: buscarPelis
        }).then(function (res) {
            return res.json();
        })
        prom.then((a) => {
            let b = JSON.stringify(a);
            let jsonpelis = JSON.parse(b);

            for (let peli of jsonpelis) {

                let id = peli.ImdbID;
                let comentari = peli.comentari;
                let votacion = peli.puntuacio;


                let div = document.getElementsByClassName("row")[0];



                div.innerHTML += "<div class='col s1>'><div class=\"card cartas\" >\n" +
                    "    <div class=\"card-image\">\n" +
                    " <img id = '"+id+"pic' src='https://images.pexels.com/photos/160933/girl-rabbit-friendship-love-160933.jpeg?h=350&auto=compress&cs=tinysrgb'>" +
                            "<span className='card-title' id=" + id + ">"+id+"</span>" +
                    "</div>" +
                    "      <span class=\'card-content\' id='com" + id + "'>" + comentari + "</span>" +
                    "      <span class=\'card-content\' id='vot" + id + "'>" + votacion + "</span>" +
                    "  <button id =" + id + "button value=" + id + "><i class=\"material-icons\">highlight_off</i></button> " +
                    "    </div>\n" +
                    "  </div>";



                const ascociarnombreid = new FormData();
                ascociarnombreid.append('idpeli', id);

                let promesapeli = fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=buscaPeliparaUser`, {

                    method: 'POST',
                    body: ascociarnombreid

                }).then(function (res) {

                    return res.json();
                })

                promesapeli.then((a) => {

                    let b = JSON.stringify(a);
                    let pelicula = JSON.parse(b);
                    console.log(pelicula[0].ImdbID);
                    let peliculavotada = document.getElementById(pelicula[0].ImdbID).innerText;
                    console.log(peliculavotada);

                    if (peliculavotada == pelicula[0].ImdbID) {
                        document.getElementById(pelicula[0].ImdbID).innerHTML = pelicula[0].nom;
                        document.getElementById(pelicula[0].ImdbID + "pic").src= pelicula[0].poster;


                    }
                })

            }
            let promesapartida =  fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=cargapartidasUser`, {
                method: 'POST',
            }).then(function (res) {
                return res.json();
            })

            promesapartida.then((a) => {

                let b = JSON.stringify(a);
                let partida = JSON.parse(b);

                console.log(partida);

                let partidasdiv = document.getElementsByClassName("partidasdiv")[0];


                for(let game of partida){

                    let nompartida = game.nom;
                    let diapartida = game.dia;
                    let encerts = game.encerts;
                    let errors = game.errors;



                    partidasdiv.innerHTML += "<div class='col s1>'><div class=\"card\" >\n" +
                        "      <span class=\'card-content\' > Nom de la partida: " + nompartida + "</span>" +
                        "      <span class=\'card-content\' > Dia de la partida: " + diapartida + "</span>" +
                        "      <span class=\'card-content\' > Nº de encerts: " + encerts + "</span>" +
                        "      <span class=\'card-content\' > Nº d'errors: " + errors + "</span>" +
                        "    </div>\n" +
                        "  </div>";
                }

            })



            divis();

        })


    })



})


function divis() {
    let divs = document.getElementsByClassName("col s6 m3");
    for (let div of divs) {


        div.children[0].children[3].addEventListener("click", function () {


            Swal.fire({
                title: '¿Vols eliminar aquesta pelicula?',
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
                    let idpeli = div.children[0].children[3].value;


                    const formulario = new FormData();
                    formulario.append('idpeli', idpeli);

                    fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=borrarPeliUser`, {

                        method: 'POST',
                        body: formulario

                    }).then(function (res) {
                        return res.text()
                    })
                }
            })
        })
    }
}



function carouselizador() {



}

document.getElementById("registre").addEventListener("click", function () {

    let usuari = document.getElementById("username").value;
    let nom = document.getElementById("nomreg").value;
    let cognoms = document.getElementById("cognoms").value;
    let email = document.getElementById("emailreg").value;
    let password = document.getElementById("passwordreg").value;
    let passwordRepeat = document.getElementById("passwordr").value;
    let avatar = document.querySelector('input[name="avatar"]:checked').value;



    let modalRegistre = M.Modal.getInstance(document.getElementById("modalRegistre"));
    let modalLogin = M.Modal.getInstance(document.getElementById("modalLogin"));

    const datosEnvio = new FormData();

    datosEnvio.append('user', usuari);
    datosEnvio.append('nom', nom);
    datosEnvio.append('cognom', cognoms);
    datosEnvio.append('email', email);
    datosEnvio.append('password', password);
    datosEnvio.append('avatar', avatar);




    let error = false;
    if (usuari == null || usuari == "", nom == null || nom == "", cognoms == null || cognoms == "", email == null || email == "", password == null || password == "", passwordRepeat == null || passwordRepeat == "") {
        error = true;
    }
    if (password != passwordRepeat) {
        document.getElementById("passwordr").classList.add("invalid");
        error = true;
    }

    if (!email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    )) {
        document.getElementById("emailreg").classList.add("invalid");
        error = true;
    }



    if (!error) {
        fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=registrarUser`, {
            method: 'POST',
            body: datosEnvio
        }).then(function (res) {
            return res.json()
        }).then(function (data) {
            console.log(data);
            if (data.result == "OK") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registre realitzat correctament',
                    showConfirmButton: false,
                    timer: 1000
                })
                modalRegistre.close();
                modalLogin.open();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Correu o contraseña ja existeixen!',
                })
            }
        });
    }
})

