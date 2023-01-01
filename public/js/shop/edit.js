$("#content_loader").on("click","#shops_edit_close", function(e){
    e.preventDefault();
    let url = $(this).attr("href");
    $.ajax({
        url: url,
        type: "GET",
        success: function(response){
            $("#content_loader").html(response);
        }
    });
});

$("#content_loader").on("submit","#shops_edit_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let shop_name = $("#shops_edit_shop_name").val();

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            shop_name: shop_name,
        },
        beforeSend: function(){
            $(".shops-edit-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#shops_edit_"+key+"_error").text(value);
                });
            }

            else if(response.status === "exception"){
                toastr.error(response.message);
            }

            else{
                toastr.success(response.message);
                $.ajax({
                    url: response.url,
                    type: "GET",
                    success: function(response){
                        $("#content_loader").html(response);
                    }
                });
            }
        }
    });
});
