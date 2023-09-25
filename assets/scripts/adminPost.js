// CheEditor 
CKEDITOR.replace( 'contenido' );

// Previsualizacion de las imagenes
const foto = document.getElementById('imagen')
let preview = document.getElementById('preview')

foto.onchange = function () {
  let reader = new FileReader();
  reader.readAsDataURL(foto.files[0])
  reader.onload = () => {
    preview.setAttribute('src', reader.result)
  }
}