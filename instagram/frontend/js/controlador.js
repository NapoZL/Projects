obtenerUsuarios();

function obtenerUsuarios() {
  axios({
    url: "../backend/api/usuarios.php",
    method: "get",
    dataType: "json",
  })
    .then((res) => {
      for (i = 0; i < res.data.length; i++) {
        document.getElementById(
          "usuario-actual"
        ).innerHTML += `<option value="${res.data[i].codigoUsuario}">${res.data[i].nombre}</option>`;
      }

      document.getElementById("usuario-actual").value = null;
    })
    .catch((error) => {
      console.error(error);
    });
}

function verHistoria(codigoUsuario, codigoHistoria) {
  console.log(`Ver historia ${codigoHistoria} del usuario ${codigoUsuario} `);
  $("#ver-historia").modal("show");
  let usuariohistoria= usuariosHistorias.filter(item=>{
    return item.codigoHistoria== codigoHistoria && item.codigoUsuario == codigoUsuario
  })[0];
  console.log("Informacion filtrada: ", usuariohistoria);
  document.getElementById('detalleHistoria').innerHTML="";
  document.getElementById('usuarioSeleccionado').innerHTML= usuariohistoria.usuario; 
  for(let i=0; i<usuariohistoria.historia.length; i++){
    document.getElementById('detalleHistoria').innerHTML+=
    `<div class="historia">
      <div class="historia-image-post" style="background-image: url(${usuariohistoria.historia[i].imagen})">
          <div class="historia-titulo">${usuariohistoria.historia[i].titulo}</div>
      </div>
    </div>`
  }
}

function comentar(codigoPost) {
  console.log(
    `Comentar el post ${codigoPost} con el comentario ${document.getElementById("comentario-post-" + codigoPost).value}`
  );
  let selectUsuario= document.getElementById("usuario-actual");
  let UsuarioActual= selectUsuario.options[selectUsuario.selectedIndex].text;
      axios({
        url: '../backend/api/comentarios.php',
        method: 'post',
        dataType: 'json',
        data:{
          codigoComentario: 1234,
          codigoPost: codigoPost,
          usuario: UsuarioActual,
          comentario: document.getElementById("comentario-post-" + codigoPost).value
        }
    }).then(res=>{
        console.log(res);
        document.getElementById(`comentarios-${codigoPost}`).innerHTML+=
        `<div>
            <span class="post-user">${UsuarioActual}</span>
            <span class="post-content">${document.getElementById("comentario-post-" + codigoPost).value}</span>
          </div>`;
    }).catch(error=>{
        console.error(error);
    }
    );
}

function cambiarUsuario(){
  mostrarPosts();
  cargarHistorias();
}

var usuariosHistorias;
function cargarHistorias(){
  axios({
    url:
      "../backend/api/historias.php?idUsuario=" +
    document.getElementById("usuario-actual").value,
    method: "get",
    dataType: "json",
  }).then((res) => {
    console.log(res);
    usuariosHistorias= res.data;
    document.getElementById('historias').innerHTML=`
                <div class="card-header">
                  Stories
                </div>`;
    for(let i=0; i<res.data.length; i++){
    document.getElementById('historias').innerHTML+=
    `<div class="px-1 py-2 story-card pointer" onclick="verHistoria(${res.data[i].codigoUsuario},${res.data[i].codigoHistoria});">
        <div class="fl">
          <img class="img-fluid img-thumbnail rounded-circle img-thumbnail-historia" src="${res.data[i].imagenUsuario}">
        </div>  
        <div class="py-1 px-1 fl">
        <small><b>${res.data[i].usuario}(${res.data[i].historia.length})</b></small><br>
        <small class="muted">12/12/2012</small>
        </div>
    </div>`
    }
    }).catch((res)=>{
      console.error(error);
    })
}

function mostrarPosts() {
  console.log(
    "El usuario seleccionado es: " +
      document.getElementById("usuario-actual").value
  );
  axios({
    url:
      "../backend/api/posts.php?idUsuario=" +
    document.getElementById("usuario-actual").value,
    method: "get",
    dataType: "json",
  })
    .then((res) => {
      console.log(res);
      document.getElementById("posts").innerHTML = "";
      for (let i=0; i<res.data.length; i++) {
        const post = res.data[i];
        let comentarios='';
        for(let j=0; j<post.comentarios.length; j++){
          comentarios += `
          <div>
            <span class="post-user">${post.comentarios[j].usuario}</span>
            <span class="post-content">${post.comentarios[j].comentario}</span>
          </div>`;
        }
        document.getElementById("posts").innerHTML += `
            <div class="col-lg-12">
              <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <img class="img-fluid img-thumbnail rounded-circle" src="${post.imagenPerfilUsuario}">    
                    <span>${post.nombre}</span>
                </div>
                <div class="card-body px-0 py-0">
                  <div class="image-post" style="background-image: url(${post.imagen});">

                  </div>
                  <div class="px-3 py-3 post">
                    <span class="pointer" onclick="like(1);"><i class="far fa-heart"></i></span>&nbsp;${post.cantidadLikes}<br>
                    <span class="post-user">${post.nombre}</span>
                    <span class="post-content">${post.contenidoPost}</span>
                    <hr>
                    <b>Comments</b><br>
                    <div id="comentarios-${post.codigoPost}">
                    ${comentarios}
                    </div>
                    <hr>
                    <div class="px-0">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Comment" id="comentario-post-${post.codigoPost}">
                        <div class="input-group-append">
                            <button type="button" onclick="comentar(${post.codigoPost});" class="btn btn-outline-danger"><i class="far fa-paper-plane"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            `;
      }
    })
    .catch((error) => {
      console.error(error);
    });

}

function guardarPost(){
  axios({
    url:"../backend/api/posts.php",
    method: "get",
    dataType: "json",
  }).then((cant) => {
    console.log(cant.data.length);
  axios({
    url:"../backend/api/posts.php",
    method: "post",
    dataType: "json",
    data:{
      codigoPost: cant.data.length + 1,
      codigoUsuario: document.getElementById('usuario-actual').value,
      contenidoPost: document.getElementById('contenido-post').value,
      imagen: document.getElementById('url-imagen').value,
      cantidadLikes: 0
    } 
  }).then((res) => {
      console.log(res);
      mostrarPosts();
      $('#nuevo-post').modal('hide');
    }).catch((error)=>{
      console.error(error);
    })
    }).catch((error)=>{
      console.error(error);
    });
}