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
            let comentarioDiv = ` <li class="collection-item avatar">
                <img src=${comentario.poster} alt="" class="circle">
                <span class="title">${comentario.nom}</span>
                <p>${comentario.comentari}<br></p>
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
}


function cargarRanking() {
    fetch("http://moviequiz2.alumnes.inspedralbes.cat/front/controller.php?action=seleccionartotsusuaris").then(function (res) {
        return res.json();
    }).then(function (datos) {

        let ulUsuarios = document.getElementById("ranking2");
        let str = `<li class="collection-header"><h4>Ranking usuarios</h4></li>`;
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


