$(document).ready(function(){
    $('.addtocart').on('click', function(event) {
        $.ajax({
            type: "POST",
            url: basePath + "sales/add",
            data: {
                id: $(this).attr("id"),
                cantidad: 1
            },
            dataType: "html",
            success: function(data) {
                $('#msg').html('<div class="alert alert-success flash-msg">Producto agregado a la venta.</div>');
                $('.flash-msg').delay(2000).fadeOut('slow');
            },
            error: function(){
                alert('Tenemos problemas!');
            }
        });
        return false;
    });
    
    $('.addtocart2').on('click', function(event) {
        $.ajax({
            type: "POST",
            url: basePath + "sales/add2",
            data: {
                code: $('#s').val(),
                // code: '100213',
                cantidad: 1
            },
            dataType: "json",
            success: function(data) {
                if(data.cant_productos_encontrados == 0){
                $('#msg').html('<div class="alert alert-danger flash-msg">Producto no encontrado.</div>');
                }else{
                    $('#msg').html('<div class="alert alert-success flash-msg">Producto agregado a la venta.</div>');
                }
                $('.flash-msg').delay(2000).fadeOut('slow');
            },
            error: function(){
                alert('Tenemos problemas!');
            }
        });
        return false;
    });
});