document.getElementById("buttonLogin").addEventListener("click", function () {

    console.log("click");

    let email = document.getElementById('email').value;
    let password = document.getElementById("password").value;

    console.log(email);
    console.log(password);

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

        let b = JSON.stringify(a);
        console.log(b);
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
            console.log(jsonpelis);

            for (let peli of jsonpelis) {

                let id = peli.ImdbID;
                let comentari = peli.comentari;
                let votacion = peli.puntuacio;

                console.log(comentari + votacion);
                document.getElementById("comentarioaux").innerHTML = comentari;
                document.getElementById("votacionaux").innerHTML = votacion;

                let div = document.getElementsByClassName("carousel")[0];

                div.innerHTML += "  <div class=\"card\">\n" +
                    /*"    <div class=\"card-image waves-effect waves-block waves-light\">\n" +
                    "      <img class=\"activator\" src=\"images/office.jpg\">\n" +
                    "    </div>\n" +*/
                    "    <div class=\"card-content\">\n" +
                    "      <span class=\"card-title activator grey-text text-darken-4\" id=" + id + ">" + id + "</span>" +
                    "      <span class=\"card-title activator blue-text text-darken-4\" id='com" + id + "'>" + comentari + "</span>" +
                    "      <span class=\"card-title activator red-text text-darken-4\" id ='vot" + id + "'>" + votacion + "</span>" +
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
                    let peliculavotada = document.getElementById(pelicula[0].ImdbID).innerText;

                    if (peliculavotada == pelicula[0].ImdbID) {
                        document.getElementById(pelicula[0].ImdbID).innerHTML = pelicula[0].nom;

                    }
                })
            }
        })

    })

})

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.carousel');
    var instances = M.Carousel.init(elems, 200);
});


document.getElementById("registre").addEventListener("click", function () {

    let usuari = document.getElementById("username").value;
    let nom = document.getElementById("nomreg").value;
    let cognoms = document.getElementById("cognoms").value;
    let email = document.getElementById("emailreg").value;
    let password = document.getElementById("passwordreg").value;

    const datosEnvio = new FormData();

    datosEnvio.append('user', usuari);
    datosEnvio.append('nom', nom);
    datosEnvio.append('cognom', cognoms);
    datosEnvio.append('email', email);
    datosEnvio.append('password', password);

    fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=registrarUser`, {

        method: 'POST',
        body: datosEnvio

    }).then(function (res) {
        return res.text()
    })
});

document.getElementsByClassName("modal-trigger")[1].addEventListener("click", function () {

    fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=logoutUser`, {

    })

    document.getElementsByClassName("modal-trigger")[0].hidden = false;
    document.getElementsByClassName("modal-trigger")[1].hidden = true;

})
