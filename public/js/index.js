var url = 'http:/api.run/ProductosController.php';
function getProductos() {
    $('contenido').empty();
    $.ajax({
        type:'GET',
        url: url,
        dataType: 'json',
        success: function(respuesta){
            var productos = respuesta;
            if (productos.length > 0){
                jQuery.each(productos,function(i,prod){
                    var btnEditar = '<button type="button" class="btn btn-warning">Editar</button>'
                    var btnEliminar = '<button type="button" class="btn btn-danger">Borrar</button>'                                   
                });
            }
        }
    });
}