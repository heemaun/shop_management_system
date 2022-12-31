$("#content_loader").on("click","#settings_show_delete_trigger", function(e){
    $("#settings_delete").removeClass("hide");
});

$("#content_loader").on("click","#settings_delete_close", function(){
    $("#settings_delete").addClass("hide");
});

$("#content_loader").on("click","#settings_show_back", function(e){
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

$("#content_loader").on("click","#settings_show_edit", function(e){
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

$("#content_loader").on("submit","#settings_delete_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let password = $("#settings_delete_password").val();
    $.ajax({
        url: url,
        type: "DELETE",
        data: {
            password: password,
        },
        beforeSend: function(){
            $(".settings-delete-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#settings_delete_"+key+"_error").text(value);
                });
            }

            else if(response.status === "exception"){
                toastr.error(response.message);
            }

            else if(response.status === "error"){
                toastr.error(response.message);
            }

            else{
                toastr.warning(response.message);
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
