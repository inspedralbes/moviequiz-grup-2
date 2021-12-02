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
                    <a class="waves-effect waves-light btn modal-trigger buttonAfegir" href="#modalAdd" id="${pelicula.imdbID}" ><i class="material-icons right">add</i>Afegir</a>
                    </div>
                  </div>`;
                    str += divPeliStr;
                });
                contenedorPelis.innerHTML = str;


                contenedorPelis.addEventListener("click", function (e) {
                    if (e.target.classList.contains("buttonAfegir")) {
                        let url = `http://www.omdbapi.com/?apikey=cc87f99c&i=${e.target.id}`
                        fetch(url).then(function (res) {
                            return res.json()
                        }).then(function (data) {
                            let info = data;

                            document.getElementById("modal-title").innerHTML = info.Title;
                            document.getElementById("modal-image").innerHTML = ` <img class="center-align"src="${info.Poster}" width=250 height=350>`
                            document.getElementById("modal-plot").innerHTML = info.Plot;
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

            })



    });


    document.getElementById("cercar").addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            document.getElementById("buttonSearch").click();
        }
    });


    document.getElementById("buttonConfirmarAfegir").addEventListener("click", function () {

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