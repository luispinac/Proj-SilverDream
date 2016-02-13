$(document).ready(function(){
    $("#s").autocomplete({
        minLength: 2,
        select: function(event, ui) {
            $("#s").val(ui.item.label);
        },
        source: function(request, response) {
            $.ajax({
                url: basePath + "products/searchjson",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function(data){
                    response($.map(data, function(el, index){
                        return {
                            value: el.Product.code,
                            code: el.Product.code,
                            photo: el.Product.photo,
                            photo_dir: el.Product.photo_dir
                        };
                    }));
                }
            });
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item){
        return $("<li></li>")
        .data("item.autocomplete", item)
        .append("<a><img width='40' src='" + basePath + "files/product/photo/" + item.photo_dir + "/" + item.photo + "' />" + item.code +  "</a>")
        .appendTo(ul)
    };
});