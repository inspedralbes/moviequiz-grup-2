let divPreguntes = document.getElementById("question-container");
let jocTriggers = document.getElementsByClassName("joc-trigger");

for (let element of jocTriggers) {
    element.addEventListener("click", function () {
        fetch("http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=generarPartida").then(function (res) {

            return res.json();
        }).then(function (data) {
            let preguntas = data.peliculas;
            let html = "";

            preguntas.forEach(element => {

                let preguntasHtml = `<div class="pregunta-pelicula">
                <input type="hidden" value=${element.imdbID}>
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


    let nomPartida = document.getElementById("nomPartida").value
    let data = new Date();
    let dia = data.getDay();
    let mes = data.getMonth();
    let año = data.getFullYear();


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
            let error = false;
            let joc = {
                nomPartida: nomPartida,
                dataPartida: año + "-" + mes + "-" + dia,
                respostes: []
            };
            for (let div of divPreguntas) {
                let imdbID = div.parentElement.getElementsByTagName("input")[0].value;
                let botones = div.getElementsByClassName("btn-pregunta");
                let oneIsSelected = false;
                for (let boton of botones) {
                    if (boton.classList.contains("selected")) {

                        let resposta = {
                            id: imdbID,
                            resposta: boton.innerHTML
                        }
                        joc.respostes.push(resposta)
                        oneIsSelected = true;
                    }
                }
                if (!oneIsSelected) {
                    error = true;
                    break;
                }
            }
            if (!error) {

                let modal = M.Modal.getInstance(document.getElementById("modalGame"));
                fetch(`http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=comprobarPartida`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(joc)
                }).then(function (res) {
                    return res.json();
                }).then(function (result) {
                    if (result.result === "OK") {
                        Swal.fire('Partida completada!', '', 'success')
                        modal.close();
                    } else {
                        Swal.fire(
                            'Error',
                            'Algo no ha funcionat correctament',
                            'error'
                        )
                    }
                });

            } else {
                Swal.fire(
                    'Error',
                    'No has seleccionat totes les respostes!',
                    'error'
                )
            }
        }
    })

})

















