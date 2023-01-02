$("#content_loader").on("click","#users_show_delete_trigger", function(e){
    $("#users_delete").removeClass("hide");
});

$("#content_loader").on("click","#users_delete_close", function(){
    $("#users_delete").addClass("hide");
});

$("#content_loader").on("click","#users_show_back", function(e){
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

$("#content_loader").on("click","#users_show_edit", function(e){
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

$("#content_loader").on("submit","#users_delete_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let password = $("#users_delete_password").val();
    $.ajax({
        url: url,
        type: "DELETE",
        data: {
            password: password,
        },
        beforeSend: function(){
            $(".users-delete-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#users_delete_"+key+"_error").text(value);
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

$("#content_loader").on("click","#users_show img", function(){
    let src = $(this).attr("src");
    $("#user_show_image_viewer img").attr("src",src);
    $("#user_show_image_viewer").removeClass("hide");
});

$("#content_loader").on("mouseenter","#users_show img,button", function(){
    $("#users_show_change_image").removeClass("hide");
});

$("#content_loader").on("mouseleave","#users_show img,button", function(){
    $("#users_show_change_image").addClass("hide");
});

$("#content_loader").on("click","#user_show_image_viewer_close", function(){
    $("#user_show_image_viewer").addClass("hide");
});

$("#content_loader").on("click","#users_show_change_image", function(e){
    e.preventDefault();
    let input_file = $("#users_show_change_image_file");
    $("#content_loader #users_show_change_image_file").click();
});

$("#content_loader").on("change","#users_show_change_image_file", function(e){
    let image = $("#users_show img");
    let input_image = e.target.files[0];
    let reader = new FileReader();
    reader.onload = ()=>{
        let imgUrl = reader.result;
        image.attr("src",imgUrl);
    }
    reader.readAsDataURL(input_image);

    $("#show_user_change_image_form button").removeClass("hide");
});

$("#content_loader").on("submit","#show_user_change_image_form", function(e){
   e.preventDefault();
   let url = $(this).attr("action");
   let form_data = new FormData(this);

   $.ajax({
    url: url,
    data: form_data,
    dataType: "json",
    type: "POST",
    contentType: false,
    processData: false,
    success: function(response){
        if(response.status === "errors"){
            $.each(response.errors,function(key,value){
                // $("#users_create_"+key+"_error").text(value);
                toastr.error(value);
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
