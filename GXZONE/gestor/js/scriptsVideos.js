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
function borrarVideo(id) {
    if (confirm("¿Seguro que quieres borrar el video?")) {
        var myurl = 'llamadas/borrarVideo.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open("GET", modurl, true);
        borrar.onreadystatechange = borrarVideoResponse;
        borrar.send(null);
    }

}

function borrarVideoResponse() {
    if(borrar.readyState == 4){
        if(borrar.status == 200){
            var listaVideos = borrar.responseText;
            // window.location.reload()
            document.getElementById('lista').innerHTML = listaVideos;

        }

    }
}