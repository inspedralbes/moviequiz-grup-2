function logout() {
    fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=logoutUser`, {
        credentials: 'same-origin'
    })
};
function cargarDatosUsuario() {


    let datos = new FormData();
    datos.append("id", "this");
    fetch("http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=cargarPerfilConcreto", {
        method: "POST",
        body: datos,
        credentials: 'same-origin'
    }).then(function (res) {
        return res.json();
    }).then(function (datos) {
        let str = `<div class="card small">
        <div class="card-image">
          <img src=${datos.avatar} height="150">
        </div>
        <div class="card-content">
          <div class="card-title">${datos.nomUsuari}</div>
          <div class="center-aling">${datos.nom} ${datos.cognom}</div>
          <div class="center-aling">Karma: ${datos.karma}</div>
        </div>
      </div>`;
        document.getElementById("datos").innerHTML = str;




        let ulComentarios = document.getElementById("comentaris");
        str = "";
        let icono = `<i class="material-icons">favorite</i>`;
        datos.comentaris.forEach(comentario => {
            let comentarioDiv = ` <li class="collection-item avatar" id=${comentario.ImdbID}>
                <img src=${comentario.poster} alt="" class="circle">
                <span class="title">${comentario.nom}</span>
                <p>${comentario.comentari}<br></p>
                <button  value="${comentario.ImdbID}">Eliminar pelicula</button>;

                
                <a href="#!" class="secondary-content">`;
            for (let index = 0; index < comentario.puntuacio; index++) {
                comentarioDiv += icono;
            }
            str += comentarioDiv + "</a></li>";
        });
        ulComentarios.innerHTML = str;




        let ulPartidas = document.getElementById("partidas");
        str = "";
        datos.partides.forEach(partida => {
            let partidaDiv = ` <li class="collection-item avatar">
        <img src="front/img/gamepad.svg" alt="" class="circle">
        <span class="title">${partida.nom}</span>
        <p><span class="light-green-text darken-3">${partida.encerts}</span><span>-</span><span class="red-text darken-2" >${partida.errors}</span><br>${partida.dia}</p>
        <a href="#!" class="secondary-content"> </a></li>`
            str += partidaDiv;
        });
        ulPartidas.innerHTML = str;


    })
    borrarPeli();
}


function cargarRanking() {
    fetch("http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=seleccionartotsusuaris").then(function (res) {
        return res.json();
    }).then(function (datos) {

        let ulUsuarios = document.getElementById("ranking2");
        let str = `<li class="collection-header"><h4>Ranking usuarios</h4></li>`;
        datos.usuaris.forEach(usuario => {

            let usuarioLi = ` <li class="collection-item avatar">
                    <a href="perfil.php?id=${usuario.id}"> <img src=${usuario.avatar} alt="" class="circle "></a>
                    <span class="title">${usuario.nomUsuari}</span>
                    <p>${usuario.nom} ${usuario.cognom}<br></p>
                    <a  class="secondary-content"> ${usuario.karma}</a></li>`
            str += usuarioLi;
        });
        ulUsuarios.innerHTML = str;
    })
}

function borrarPeli() {
    let divs = document.getElementsByClassName("collection-item avatar");
    for (let div of divs) {

        div.children[3].addEventListener("click", function () {


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
                    let idpeli = div.children[3].value;


                    const formulario = new FormData();
                    formulario.append('idpeli', idpeli);

                    fetch(`http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=borrarPeliUser`, {

                        method: 'POST',
                        body: formulario

                    }).then(function (res) {
                        return res.text()
                    })

                     document.getElementById(idpeli).remove();





                }
            })
        })
    }
}









cargarDatosUsuario();
cargarRanking();

document.getElementById("buttonLogin").addEventListener("click", function () {
    let email = document.getElementById('email').value;
    let password = document.getElementById("password").value;
    let modalLogin = M.Modal.getInstance(document.getElementById("modalLogin"));

    const datosEnvio = new FormData();

    datosEnvio.append('email', email);
    datosEnvio.append('password', password);


    fetch("http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=logearUser", {
        method: 'POST',
        body: datosEnvio,
        credentials: "same-origin"
    }).then(function (res) {
        return res.json();
    }).then(function (datos) {


        if (datos.result == "OK") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Login realitzat correctament',
                showConfirmButton: false,
                timer: 1000
            })
            modalLogin.close();
            let idUsuario = datos.id;

            document.getElementById("btnRegistre").classList.add("hide");
            document.getElementById("btnRegistre").href += "?id=" + idUsuario;
            document.getElementById("btnRegistre-mobile").classList.add("hide");
            document.getElementById("btnRegistre-mobile").href += "?id=" + idUsuario;
            document.getElementById("btnPerfil").classList.remove("hide");
            document.getElementById("btnPerfil-mobile").classList.remove("hide");
            document.getElementById("btnPerfil").href += "?id=" + idUsuario;
            document.getElementById("btnPerfil-mobile").href += "?id=" + idUsuario;


            cargarDatosUsuario();

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Algo no ha funcionat!',
            })
        }
    });
})


document.getElementById("btnlogout").addEventListener("click", function () {
    logout();
});
document.getElementById("btnlogout-mobile").addEventListener("click", function () {
    logout();
});


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