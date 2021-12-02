window.onload = function () {



    var elems = document.querySelectorAll(".modal");
    var instances = M.Modal.init(elems);




    let contenedorPelis = document.getElementById("contenedorPelis");
    document.getElementById("buttonSearch").addEventListener("click", function () {
        let parametro = document.getElementById("cercar").value;
        let url = `http://www.omdbapi.com/?apikey=cc87f99c&s=${parametro}`;
        fetch(url)
            .then(function (res) {
                return res.json();
            })
            .then(function (data) {
                let busqueda = data.Search;
                let str = "";
                busqueda.forEach(pelicula => {
                    let divPeliStr = `<div class="card col s6 m3">
                    <div class="card-image">
                      <img src="${pelicula.Poster}" width=250 height=350>
                      <span class="card-title">${pelicula.Title}</span>
                    </div>
                    <div class="card-action">
                    <a class="waves-effect waves-light btn modal-trigger"href="#modalAdd"><i class="material-icons right">add</i>Afegir</a>
                    </div>
                  </div>`;
                    str += divPeliStr;
                });
                contenedorPelis.innerHTML = str;
            })
    });


    document.getElementById("cercar").addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            document.getElementById("buttonSearch").click();
        }
    });


    document.getElementById("buttonAfegir").addEventListener("click", function () {

        let rating = document.querySelector('input[name="rating"]:checked').value;

        let comment = document.getElementById("comentari").value;
        alert(rating);
        alert(comment);


        const datosEnvio = new FormData();

        datosEnvio.append('rating', rating);

        datosEnvio.append('comment', comment);

        fetch(`https://labs.inspedralbes.cat/~a19axechacan/login.php`, {

            method: 'POST',

            body: datosEnvio

        })
            .then(function (res) {
                console.log(res);
            })


    })
}