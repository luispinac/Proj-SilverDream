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
});