var codigoArtistaActual;
var codigoAlbum;

function verPlaylist(codigoPlaylist){
    console.log('Ver playlist con codigo: ' + codigoPlaylist);
    $("#vista-playlist").show();
    $("#vista-artista").hide();
}

function verArtista(codigoArtista){
    console.log('Ver artista con codigo: ' + codigoArtista);
    $("#vista-artista").show();
    $("#vista-playlist").hide();
}

function eliminarCancion(codigoCancion){
    console.log("Eliminar cancion "+codigoCancion);
}

function obtenerArtistas() {
    document.getElementById('artistas').innerHTML="";
    axios({
        url:'../backend/api/artistas.php',
        method:'get',
        responseType:'json'
    }).then((res)=>{
        for(let i=0; i<res.data.length; i++){
            document.getElementById('artistas').innerHTML+=
            `<li class="nav-item"><div class="nav-link" onclick="verArtista(${res.data[i].codigoArtista})"><i class="fas fa-music"></i>${res.data[i].nombreArtista}</div></li>`;
        }
        //document.getElementById('artistas').value = null;
    }).catch((error)=>{
        console.error(error);
    });
}

obtenerArtistas();

function verArtista(codigoArtista){
    codigoArtistaActual = codigoArtista;
    $("#vista-artista").show();
    $("#vista-playlist").hide();
    axios({
        url:'../backend/api/artistas.php',
        method:'get',
        dataType:'json'
    }).then((res)=>{
        document.getElementById('albumes').innerHTML ='';
        for(i=0; i<res.data.length; i++){
            if(res.data[i].codigoArtista== codigoArtista){
                for(j=0; j<res.data[i].albumes.length; j++){
                    let canciones= "";
                    for(k=0; k<res.data[i].albumes[j].canciones.length; k++){
                        canciones+=
                        `<div class="row song-item" >
                        <div class="col-1"><i class="fas fa-play"></i></div>
                        <div class="col-10">
                            <div class="song-title">${res.data[i].albumes[j].canciones[k].nombreCancion}</div>
                            <div class="song-description">${res.data[i].nombreArtista} - ${res.data[i].albumes[j].nombreAlbum}</div>
                        </div>
                        <div class="col-1">
                            <span>${res.data[i].albumes[j].canciones[k].duracion}</span>
                            <button onclick="eliminarCancion(${res.data[i].codigoArtista}, ${j}, ${k})" class="btn btn-outline-success" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>`
                    }
                    document.getElementById('albumes').innerHTML+=
                    `<div class="row">
                        <div class="col-4 text-center"  >
                        <div  class="cover-image" style="background-image:url(${res.data[i].albumes[j].caratulaAlbum});">
                        </div><br>
                    <h5 class="text-muted">${res.data[i].albumes[j].nombreAlbum}</h5>
                    <button onclick="obtenerCodigoAlbum(${j})" class="btn btn-success"type="button" data-toggle="modal" data-target="#modal-canciones">Agregar canción</button>
                    </div>
                        <div class="col-8">
                            ${canciones}
                        </div>
                    </div>
                    <br>`;
                }
            }
        }
    }).catch((error)=>{
        console.error(error);
    });
}

function guardarArtista(){
    axios({
        url: '../backend/api/artistas.php',
        method: 'post',
        dataType: 'json',
        data:{
            "codigoArtista":0,
            "nombreArtista": document.getElementById('nombreArtista').value,
            "albumes":[]
        }
    }).then(res=>{
        console.log(res);
        obtenerArtistas();
    }).catch(error=>{
        console.error(error);
    });
}

function guardarAlbum(){
    console.log(codigoArtistaActual);
    axios({
        url: '../backend/api/albumes.php?codigoArtista='+codigoArtistaActual,
        method: 'post',
        dataType: 'json',
        data:{
            "nombreAlbum":document.getElementById('nombreAlbum').value,
            "caratulaAlbum":document.getElementById('urlCaratula').value,
            "canciones":[]
        }
    }).then(res=>{
        console.log(res);
        document.getElementById('nombreAlbum').value= "";
        document.getElementById('urlCaratula').value= "";
        verArtista(codigoArtistaActual);
    }).catch(error=>{
        console.error(error);
    });
}

var codigoAlbum;
function obtenerCodigoAlbum(j){
    codigoAlbum=j
}

function guardarCancion(){
    console.log(codigoAlbum);
    console.log(codigoArtistaActual);

    axios({
        url: '../backend/api/canciones.php?codigoArtista='+codigoArtistaActual+'&codigoAlbum='+codigoAlbum,
        method: 'post',
        dataType: 'json',
        data:{
            "nombreCancion":document.getElementById('nombreCancion').value,
            "duracion":document.getElementById('duracion').value
        }
    }).then(res=>{
        console.log(res);
        document.getElementById('nombreCancion').value ="";
        document.getElementById('duracion').value ="";
        verArtista(codigoArtistaActual);
    }).catch(error=>{
        console.error(error);
    });

}

function eliminarCancion(artista, album, cancion){
    console.log(artista);
    console.log(album);
    console.log(cancion);
    axios({
        url: '../backend/api/canciones.php?codigoArtista='+artista+'&codigoAlbum='+album+'&codigoCancion='+cancion,
        method: 'delete',
        dataType: 'json',
    }).then(res=>{
        console.log(res);
        verArtista(artista);
    }).catch(error=>{
        console.error(error);
    });
}