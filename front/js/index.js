


document.getElementById("buttonLogin").addEventListener("click", function () {

    console.log("click");

    let email = document.getElementById('email').value;
    let password = document.getElementById("password").value;

    console.log(email);
    console.log(password);

    const datosEnvio = new FormData();

    datosEnvio.append('email', email);
    datosEnvio.append('password', password);

    let promesa = fetch(`http://localhost/pruebas/controller.php?action=logearUser`, {


        method: 'POST',
        body: datosEnvio


    }).then(function (res) {

        return res.json();
    })


    promesa.then((a) => {


        let b = JSON.stringify(a);
        console.log(b);
        let json = JSON.parse(b);

        console.log(json.nomUsuari);
        console.log(json.id);

        document.getElementById("welcome").innerHTML = "Benvingut " + json.nomUsuari;
        document.getElementById("modalLogin").hidden;

        document.getElementsByClassName("modal-trigger")[1].hidden = false;

        document.getElementsByClassName("modal-trigger")[0].hidden = true;






        let email = document.getElementById('email').value;
        let password = document.getElementById("password").value;

        console.log(email);
        console.log(password);

        const buscarPelis = new FormData();

        buscarPelis.append('id', json.id);

        let prom = fetch(`http://localhost/pruebas/controller.php?action=CargaPerfil`, {


            method: 'POST',
            body: datosEnvio


        }).then(function (res) {

            return res.json();
        })



        prom.then((a) => {


            let b = JSON.stringify(a);
            console.log(b);

        })




    })

})

document.getElementsByClassName("modal-trigger")[1].addEventListener("click", function (){


    document.getElementsByClassName("modal-trigger")[0].hidden = false;
    document.getElementsByClassName("modal-trigger")[1].hidden = true;






})
