var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

// Boton galeria en editar producto
document.addEventListener('DOMContentLoaded', function(){

    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search');
    if (btn_search) {
        btn_search.addEventListener('click', function (e) {
            e.preventDefault();
            if (form_search.style.display === 'block') {
                form_search.style.display = 'none';
            } else {
                form_search.style.display = 'block';
            }
        });
    }

    if (route == "product_edit") {
        var btn_product_file_image = document.getElementById('btn_product_file_image');
        var product_file_image = document.getElementById('product_file_image');

        btn_product_file_image.addEventListener('click', function(){
            product_file_image.click();
        }, false);

        product_file_image.addEventListener('change', function(){
            document.getElementById('form_product_gallery').submit();
        });
    } 
    // Resaltar el menú activo del sidebar 
    route_active = document.getElementsByClassName('lk-'+route)[0].classList.add('active');

    btn_delete = document.getElementsByClassName('btn_delete');
    for (i = 0; i < btn_delete.length; i++) {
        btn_delete[i].addEventListener('click', delete_object);
    }
});

$(document).ready(function() {
    editor_init('editor');
});

// Editor text area 
function editor_init(field) {
    CKEDITOR.replace(field, {
        toolbar: [
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote'] },
            { name: 'document', items: ['CodeSnipped', 'EmojiPanel', 'Preview', 'Source'] }
        ]
    });
}

function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/' + action;
    var title, texto, icono;
    if (action == "delete") {
        title = "¿Estas seguro de eliminar este elemento?";
        texto = "Esto ara un borrado lógico del elemento, podrá restaurarlo si lo necesita.";
        icono = "warning";
    }
    if (action == "restore") {
        title = "¿Quieres restaurar este elemento?";
        texto = "Esta acción restaurará este elemento, estara nuevamente activo en la base de datos.";
        icono = "info";
    }
    Swal({
        title: title,
        text: texto,
        icon: icono,
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = url;
        
        } 
    });
}