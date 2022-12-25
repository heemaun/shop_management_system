$("#content_loader").on("click","#products_show_delete_trigger", function(e){
    $("#products_delete").removeClass("hide");
});

$("#content_loader").on("click","#products_delete_close", function(){
    $("#products_delete").addClass("hide");
});

$("#content_loader").on("click","#products_show_back", function(e){
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

$("#content_loader").on("click","#products_show_edit", function(e){
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

$("#content_loader").on("submit","#products_delete_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let password = $("#products_delete_password").val();
    $.ajax({
        url: url,
        type: "DELETE",
        data: {
            password: password,
        },
        beforeSend: function(){
            $(".products-delete-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#products_delete_"+key+"_error").text(value);
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

$("#content_loader").on("click","#products_show img", function(){
    let src = $(this).attr("src");
    $("#product_show_image_viewer img").attr("src",src);
    $("#product_show_image_viewer").removeClass("hide");
});

$("#content_loader").on("mouseenter","#products_show img,button", function(){
    $("#products_show_change_image").removeClass("hide");
});

$("#content_loader").on("mouseleave","#products_show img,button", function(){
    $("#products_show_change_image").addClass("hide");
});

$("#content_loader").on("click","#product_show_image_viewer_close", function(){
    $("#product_show_image_viewer").addClass("hide");
});

$("#content_loader").on("click","#products_show_change_image", function(e){
    e.preventDefault();
    let input_file = $("#products_show_change_image_file");
    $("#content_loader #products_show_change_image_file").click();
});

$("#content_loader").on("change","#products_show_change_image_file", function(e){
    let image = $("#products_show img");
    let input_image = e.target.files[0];
    let reader = new FileReader();
    reader.onload = ()=>{
        let imgUrl = reader.result;
        image.attr("src",imgUrl);
    }
    reader.readAsDataURL(input_image);
});

$("#content_loader").on("submit","#show_product_change_image_form", function(e){
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
                // $("#products_create_"+key+"_error").text(value);
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
