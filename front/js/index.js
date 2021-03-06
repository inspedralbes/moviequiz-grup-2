function loadata(formulario, modalLogin) {


    let promesa = fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=logearUser`, {
        method: 'POST',
        body: formulario,
        credentials: "same-origin"
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
            document.getElementById("btnLogin").classList.add("hide");
            document.getElementById("btnLogin-mobile").classList.add("hide");
            document.getElementById("btnRegistre").classList.add("hide");
            //document.getElementById("btnRegistre").href += "?id=" + a.id;
            document.getElementById("btnRegistre-mobile").classList.add("hide");
           //document.getElementById("btnRegistre-mobile").href += "?id=" + a.id;
            document.getElementById("InfoUser").classList.remove("hide");
            document.getElementById("btnPerfil").classList.remove("hide");
            document.getElementById("btnPerfil").href += "?id=" + a.id;
            document.getElementById("btnPerfil-mobile").classList.remove("hide");
            document.getElementById("btnPerfil-mobile").href += "?id=" + a.id;
            document.getElementById("btnlogout").classList.remove("hide");
            document.getElementById("btnlogout-mobile").classList.remove("hide");
            document.getElementById("aside-ranking").classList.remove("hide");

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Correu o contraseña no coincideixen!',
            })
        }

        let b = JSON.stringify(a);
        let json = JSON.parse(b);


        document.getElementById("avatar").src = json.avatar;
        document.getElementById("dadesusuari").innerHTML = "<h4>Nom d'usuari: " + json.nomUsuari + "</h4><br><h4>Nom real: " + json.nom + "</h4><br><h4>Cognoms: " + json.cognom + "</h4>";


        document.getElementById("karmap").innerHTML = "<h1>" + json.karma + "</h1><br>KARMA";

        document.getElementById("modalLogin").hidden;
        document.getElementsByClassName("modal-trigger")[1].hidden = false;
        document.getElementsByClassName("modal-trigger")[0].hidden = true;

        let email = document.getElementById('email').value;
        let password = document.getElementById("password").value;

        const buscarPelis = new FormData();

        buscarPelis.append('id', json.id);

        let prom = fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=cargaPerfil`, {
            method: 'POST',
            body: buscarPelis
        }).then(function (res) {
            return res.json();
        })
        prom.then((a) => {

            let jsonpelis = a.comentaris;


            for (let peli of jsonpelis) {

                let id = peli.ImdbID;
                let comentari = peli.comentari;
                let votacion = peli.puntuacio;






                let div = document.getElementsByClassName("peliculasopinadas")[0];

                let icono = `<i class="material-icons">favorite</i>`;

                let str = "";
                let comentarioDiv = "<div class='collecttionpelis' id ='" + id + "container'>" +
                    "<div class='gridcarta'><img id ='" + id + "pic' src='https://images.pexels.com/photos/160933/girl-rabbit-friendship-love-160933.jpeg?h=350&auto=compress&cs=tinysrgb' height='100px' width='100px' class='circle'></div>" +
                    "<div class='gridcarta'><h4 class='title' id ='" + id + "'>" + id + "</h4></div>" +
                    " <div class='gridcarta'><p>" + comentari + "</p></div>" +
                    "<div class='gridcarta'><button id='but'" + id + " value='" + id + "'>Eliminar</button>"
                "<a class='punts'>" +
                    "<button id='but" + id + "' value='" + id + "'>";

                for (let index = 0; index < votacion; index++) {
                    comentarioDiv += icono;
                }
                str += comentarioDiv + "</a></div></div>";;

                div.innerHTML += str;

                const ascociarnombreid = new FormData();
                ascociarnombreid.append('idpeli', id);


                let promesapeli = fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=buscaPeliparaUser`, {

                    method: 'POST',
                    body: ascociarnombreid

                }).then(function (res) {

                    return res.json();
                })

                promesapeli.then((a) => {


                    let b = JSON.stringify(a);
                    let pelicula = JSON.parse(b);

                    let peliculavotada = document.getElementById(pelicula[0].ImdbID).innerText;


                    if (peliculavotada == pelicula[0].ImdbID) {
                        document.getElementById(pelicula[0].ImdbID).innerHTML = pelicula[0].nom;
                        document.getElementById(pelicula[0].ImdbID + "pic").src = pelicula[0].poster;


                    }
                })

            }
            let promesapartida = fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=cargapartidasUser`, {
                method: 'POST',
            }).then(function (res) {
                return res.json();
            })

            promesapartida.then((a) => {

                let b = JSON.stringify(a);
                let partida = JSON.parse(b);



                let partidasdiv = document.getElementsByClassName("partidasdiv")[0];
                partidasdiv.innerHTML = "<h1>Les meves partides</h1>";


                for (let game of partida) {

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
}


window.addEventListener('load', (event) => {

    let modalLogin = M.Modal.getInstance(document.getElementById("modalLogin"));
    let formulario = "nada por aqui";

    fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=seleccionartotsusuaris`, {

        method: 'POST',

    }).then(function (res) {
        return res.json()
    })

    loadata(formulario, modalLogin);

});


document.getElementById("buttonLogin").addEventListener("click", function () {


    let email = document.getElementById('email').value;
    let password = document.getElementById("password").value;
    let modalLogin = M.Modal.getInstance(document.getElementById("modalLogin"));

    const datosEnvio = new FormData();

    datosEnvio.append('email', email);
    datosEnvio.append('password', password);


    loadata(datosEnvio, modalLogin);



})


function divis() {
    let divs = document.getElementsByClassName("collecttionpelis");
    for (let div of divs) {

        div.children[3].children[0].addEventListener("click", function () {


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
                    let idpeli = div.children[3].children[0].value;


                    const formulario = new FormData();
                    formulario.append('idpeli', idpeli);

                    fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=borrarPeliUser`, {

                        method: 'POST',
                        body: formulario

                    }).then(function (res) {
                        return res.text()
                    })

                    let divborrar = document.getElementById(idpeli + "container").remove();





                }
            })
        })
    }
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
        fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=registrarUser`, {
            method: 'POST',
            body: datosEnvio
        }).then(function (res) {
            return res.json()
        }).then(function (data) {

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

//document.getElementsByClassName("modal-trigger")[1].addEventListener("click", function () {
document.getElementById("btnlogout").addEventListener("click", function () {

    fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=logoutUser`, {
        method: 'POST',
    })

    location.reload(); //es estupido hacer otro fecth para poner datos vacios

    document.getElementsByClassName("modal-trigger")[1].hidden = true;
    document.getElementsByClassName("modal-trigger")[0].hidden = false;
    document.getElementById("btnPerfil").classList.add("hide");
    document.getElementById("btnlogout").classList.add("hide");
    document.getElementById("btnlogout-mobile").classList.add("hide");
    document.getElementById("aside-ranking").classList.add("hide");
    document.getElementById("btnPerfil-mobile").classList.add("hide");
    document.getElementById("btnRegistre").classList.remove("hide");
    document.getElementById("btnRegistre-mobile").classList.remove("hide");
    document.getElementById("btnLogin").classList.remove("hide");
    document.getElementById("btnLogin-mobile").classList.remove("hide");

})

document.getElementById("btnlogout-mobile").addEventListener("click", function () {

    fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=logoutUser`, {
        method: 'POST',
    })

    location.reload(); //es estupido hacer otro fecth para poner datos vacios

    document.getElementsByClassName("modal-trigger")[1].hidden = true;
    document.getElementsByClassName("modal-trigger")[0].hidden = false;
    document.getElementById("btnPerfil").classList.add("hide");
    document.getElementById("btnlogout").classList.add("hide");
    document.getElementById("btnlogout-mobile").classList.add("hide");
    document.getElementById("aside-ranking").classList.add("hide");
    document.getElementById("btnPerfil-mobile").classList.add("hide");
    document.getElementById("btnRegistre").classList.remove("hide");
    document.getElementById("btnRegistre-mobile").classList.remove("hide");
    document.getElementById("btnLogin").classList.remove("hide");
    document.getElementById("btnLogin-mobile").classList.remove("hide");

})


fetch("http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=seleccionartotsusuaris").then(function (res) {
    return res.json();
}).then(function (datos) {

    let ulUsuarios = document.getElementById("ranking");
    let str = "";
    datos.usuaris.forEach(usuario => {
        console.log(usuario)
        let usuarioLi = ` <li class="collection-item avatar">
                <a href="perfil.php?id=${usuario.id}"> <img src=${usuario.avatar} alt="" class="circle "></a>
                <span class="title">${usuario.nomUsuari}</span>
                <p>${usuario.nom} ${usuario.cognom}<br></p>
                <a  class="secondary-content"> ${usuario.karma}</a></li>`
        str += usuarioLi;
    });
    ulUsuarios.innerHTML = str;
})



