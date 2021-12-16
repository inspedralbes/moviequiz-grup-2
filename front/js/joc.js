let divPreguntes = document.getElementById("question-container");
let jocTriggers = document.getElementsByClassName("joc-trigger");

for (let element of jocTriggers) {
    element.addEventListener("click", function () {
        fetch("http://localhost/pruebas/controller.php").then(function (res) {

            // return res.json();
        }).then(function (/*data*/) {
            //  let preguntas = data.peliculas;
            let html = "";

            let preguntas = [
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BMTg5NzY0MzA2MV5BMl5BanBnXkFtZTYwNDc3NTc2._V1_SX300.jpg",
                    opcions: [2006, 2002, 2003, 2004],
                    nom: "Cars",
                    imdbID: "tt0317219"
                },
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BZDEyN2NhMjgtMjdhNi00MmNlLWE5YTgtZGE4MzNjMTRlMGEwXkEyXkFqcGdeQXVyNDUyOTg3Njg@._V1_SX300.jpg",
                    opcions: [2002, 2002, 2003, 2004],
                    nom: "Spider-man",
                    imdbID: "tt0145487"
                },
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg",
                    opcions: [1994, 2002, 2003, 2004],
                    nom: "Pulp Fiction",
                    imdbID: "tt0110912"
                },
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BMTc3MDY3ODQ2OV5BMl5BanBnXkFtZTgwOTQ2NTYxMTE@._V1_SX300.jpg",
                    opcions: [1987, 2002, 2003, 2004],
                    nom: "Dirty Dancing",
                    imdbID: "tt0092890"
                }

            ]


            preguntas.forEach(element => {

                let preguntasHtml = `<div class="pregunta-pelicula">
                <div class="center-align"><img  src="${element.poster}" width=250 height=350></div>`
                preguntasHtml += `<div class="preguntas center-align">
                <div class="row">
                <div class="col s6"> <a class="waves-effect waves-light btn btn-pregunta">${element.opcions[0]}</a></div> 
                <div class="col s6"><a class="waves-effect waves-light btn btn-pregunta">${element.opcions[1]}</a></div> 
                </div> `;
                preguntasHtml += `<div class="row">
                <div class="col s6"> <a class="waves-effect waves-light btn btn-pregunta">${element.opcions[2]}</a></div>
                 <div class="col s6"><a class="waves-effect waves-light btn btn-pregunta">${element.opcions[3]}</a></div> 
                 </div> `;
                preguntasHtml += "</div></div>";
                html += preguntasHtml;
            });
            divPreguntes.innerHTML = html;
        }).then(function () {

        });
    })
}


document.getElementById("question-container").addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-pregunta")) {

        let divParent = e.target.parentNode.parentNode.parentNode;
        let buttons = divParent.getElementsByClassName("btn-pregunta");

        for (let button of buttons) {
            button.classList.remove("indigo", "darken-1");
            button.classList.remove("selected");
        }

        e.target.classList.toggle("indigo", "darken-1");
        e.target.classList.toggle("selected");
    }
})



document.getElementById("buttonConfirmarJoc").addEventListener("click", function () {
    Swal.fire({
        title: '¿Enviar respostes?',
        showDenyButton: true,
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

            let divPreguntas = document.querySelectorAll(".preguntas");

            for (let div of divPreguntas) {
                let botones = div.getElementsByClassName("btn-pregunta");
                let oneSelected = false;
                for (let boton of botones) {
                    if (boton.classList.contains("selected")) {
                        oneSelected = true;
                    }
                }
                if (!oneSelected) {
                    Swal.fire(
                        'Error',
                        'No has seleccionat totes les respostes!',
                        'error'
                    )
                }
            }


        }
    })
})

















