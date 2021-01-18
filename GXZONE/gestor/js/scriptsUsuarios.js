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
function borrarUsuario(id) {
    if (confirm("¿Seguro que quieres borrar este usuario?")) {
        var myurl = 'llamadas/borrarUsuario.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open("GET", modurl, true);
        borrar.onreadystatechange = borrarUsuarioResponse;
        borrar.send(null);
    }

}

function borrarUsuarioResponse() {
    if(borrar.readyState == 4){
        if(borrar.status == 200){
            var listaUsuarios = borrar.responseText;
            // window.location.reload()
            document.getElementById('lista').innerHTML = listaUsuarios;

        }

    }
}