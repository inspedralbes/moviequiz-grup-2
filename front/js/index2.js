


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
            document.getElementById("InfoUser").classList.remove("hide");
            document.getElementById("btnPerfil").classList.remove("hide");
            document.getElementById("btnPerfil-mobile").classList.remove("hide");
            document.getElementById("btnPerfil").href += "?id=" + idUsuario;
            document.getElementById("btnPerfil-mobile").href += "?id=" + idUsuario;
            document.getElementById("aside-ranking").classList.remove("hide");

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


window.addEventListener('load', (event) => {


    cargarDatosUsuario();

});


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
        console.log(datos);
    })
}