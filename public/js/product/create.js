$("#content_loader").on("click","#products_create_close", function(e){
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

$("#content_loader").on("submit","#products_create_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let form_data = new FormData(this);

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: form_data,
        beforeSend: function(){
            $(".products-create-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#products_create_"+key+"_error").text(value);
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

$("#content_loader").on("click","#products_create_tmp_img", function(){
    $("#content_loader #products_create_picture").click();
});

$("#content_loader").on("change","#products_create_picture",function(e){
    let img = e.target.files[0];
    let reader = new FileReader();
    reader.onload = ()=>{
        let imgUrl = reader.result;
        $("#products_create_tmp_img").attr("src",imgUrl);
    }
    reader.readAsDataURL(img);
});
