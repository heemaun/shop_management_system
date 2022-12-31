$("#content_loader").on("click","#settings_edit_close", function(e){
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

$("#content_loader").on("click","#settings_edit_tmp_img", function(){
    $("#content_loader #settings_edit_picture").click();
});

$("#content_loader").on("change","#settings_edit_picture",function(e){
    let img = e.target.files[0];
    let reader = new FileReader();
    reader.onload = ()=>{
        let imgUrl = reader.result;
        $("#settings_edit_tmp_img").attr("src",imgUrl);
    }
    reader.readAsDataURL(img);
});

$("#content_loader").on("submit","#settings_edit_form",function(e){
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
            $(".settings-edit-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#settings_edit_"+key+"_error").text(value);
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
