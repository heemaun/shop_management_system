$("#content_loader").on("click","#categories_create_close", function(e){
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

$("#content_loader").on("submit","#categories_create_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let name = $("#categories_create_name").val();
    let status = $("#categories_create_status").val();

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            status: status,
        },
        beforeSend: function(){
            $(".categories-create-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#categories_create_"+key+"_error").text(value);
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
