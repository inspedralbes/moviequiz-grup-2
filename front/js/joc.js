

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
                    nom: "Cars"
                },
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BZDEyN2NhMjgtMjdhNi00MmNlLWE5YTgtZGE4MzNjMTRlMGEwXkEyXkFqcGdeQXVyNDUyOTg3Njg@._V1_SX300.jpg",
                    opcions: [2002, 2002, 2003, 2004],
                    nom: "Spider-man"
                },
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BMTg5NzY0MzA2MV5BMl5BanBnXkFtZTYwNDc3NTc2._V1_SX300.jpg",
                    opcions: [2006, 2002, 2003, 2004],
                    nom: "Cars"
                },
                {
                    poster: "https://m.media-amazon.com/images/M/MV5BMTg5NzY0MzA2MV5BMl5BanBnXkFtZTYwNDc3NTc2._V1_SX300.jpg",
                    opcions: [2006, 2002, 2003, 2004],
                    nom: "Cars"
                }

            ]


            preguntas.forEach(element => {

                let preguntasHtml = `<div class="pregunta-pelicula">
                <div class="center-align"><img  src="${element.poster}" width=250 height=350></div>`
                preguntasHtml += `<div class="preguntes center-align">
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
            button.classList.remove("deep-purple");
            button.classList.remove("selected");
        }

        e.target.classList.toggle("deep-purple");
        e.target.classList.toggle("selected");

    }
})