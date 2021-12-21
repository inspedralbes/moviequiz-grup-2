

var sidenavElems = document.querySelectorAll('.sidenav');
var sidenavs = M.Sidenav.init(sidenavElems);


fetch("http://localhost/pruebas/moviequiz-grup-2/front/controller.php?action=cargarPerfilConcreto").then(function (res) {
    return res.json()
}).then(function (usuari) {
    let ulComentarios = document.getElementById("comentaris");
    let str = "";
    let icono = `<i class="material-icons">favorite</i>`;
    usuari.comentaris.forEach(comentario => {
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

    let imgAvatar = document.getElementById("avatar");
    imgAvatar.src = usuari.avatar;


    let ulPartidas = document.getElementById("partidas");
    str = "";
    usuari.partides.forEach(partida => {
        let partidaDiv = ` <li class="collection-item avatar">
        <img src="front/img/gamepad.svg" alt="" class="circle">
        <span class="title">${partida.nom}</span>
        <p><span class="light-green-text darken-3">${partida.encerts}</span><span>-</span><span class="red-text darken-2" >${partida.errors}</span><br>${partida.dia}</p>
        <a href="#!" class="secondary-content"> </a></li>`
        str += partidaDiv;
    });
    ulPartidas.innerHTML = str;


    document.getElementById("nomUsuari").innerHTML = usuari.nomUsuari;
    document.getElementById("nom").innerHTML = usuari.nomUsuari + " " + usuari.cognom;
    let spanKarma = document.getElementById("karma");

    if (usuari.karma < 0) {
        spanKarma.innerHTML = usuari.karma + `
        <i class="material-icons inline-icon ">mood_bad</i>`;
    } else {
        spanKarma.innerHTML = usuari.karma + `
        <i class="material-icons inline-icon ">mood</i>`;
    }

})




