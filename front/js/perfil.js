

var sidenavElems = document.querySelectorAll('.sidenav');
var sidenavs = M.Sidenav.init(sidenavElems);


fetch("http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=cargaPerfil").then(function (res) {
    return res.json()
}).then(function (usuari) {
    let ulComentarios = document.getElementById("comentaris");
    let str = "";
    let icono = `<i class="material-icons">favorite</i>`;
    console.log(usuari.comentaris)
    usuari.comentaris.forEach(comentario => {
        let comentarioDiv = ` <li class="collection-item avatar">
            <img src=${comentario.poster} alt="" class="circle">
            <span class="title">${comentario.nom}</span>
            <p>${comentario.comentari}<br></p>
            <a href="#!" class="secondary-content">`;
        for (let index = 0; index < comentario.puntuacio; index++) {
            comentarioDiv += icono;
        }
        str += comentarioDiv + "</a></li>";;
    });
    ulComentarios.innerHTML = str;
})




