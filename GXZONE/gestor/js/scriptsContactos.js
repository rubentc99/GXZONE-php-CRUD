function ajax() {
    try {
        req = new XMLHttpRequest();
    } catch(err1) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                req = false;
            }
        }
    }
    return req;
}

var borrar = new ajax();
function borrarContacto(id) {
    if (confirm("¿Seguro que quieres borrar el mensaje?")) {
        var myurl = 'llamadas/borrarContacto.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open("GET", modurl, true);
        borrar.onreadystatechange = borrarContactoResponse;
        borrar.send(null);
    }

}

function borrarContactoResponse() {
    if(borrar.readyState == 4){
        if(borrar.status == 200){
            var listaContactos = borrar.responseText;
            // window.location.reload()
            document.getElementById('lista').innerHTML = listaContactos;

        }

    }
}