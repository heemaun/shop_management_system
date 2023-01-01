$("#content_loader").on("click","#shops_create_close", function(e){
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

$("#content_loader").on("submit","#shops_create_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let shop_name = $("#shops_create_name").val();

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {
            shop_name: shop_name,
        },
        beforeSend: function(){
            $(".shops-create-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#shops_create_"+key+"_error").text(value);
                });
            }

            else if(response.status === "exception"){
                toastr.error(response.message);
            }

            else{
                toastr.success(response.message);
                let url = response.url;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response){
                        $("#content_loader").html(response);
                    }
                });
            }
        }
    });
});
