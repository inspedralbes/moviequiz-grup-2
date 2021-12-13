

let divPreguntes = document.getElementById("question-container");
let jocTriggers = document.getElementsByClassName("joc-trigger");
for (let element of jocTriggers) {
    element.addEventListener("click", function () {
        fetch("http://localhost/pruebas/joc.php").then(function (res) {

            return res.json();
        }).then(function (data) {
            let preguntas = data.peliculas;
            let html = "";
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
            document.getElementById("question-container").addEventListener("click", function (e) {
                if (e.target.classList.contains("btn-pregunta")) {
                    console.log("toggle")
                    e.target.classList.toggle("deep-purple");
                    e.target.classList.toggle("selected");
                    if (e.target.classList.contains("selected")) {
                        console.log("SELECTED!")
                    } else {
                        console.log("UNSELECTED!")
                    }
                }
            })
        });
    })
}