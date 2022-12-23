$("#content_loader").on("click","#accounts_create_close", function(e){
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

$("#content_loader").on("submit","#accounts_create_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let name = $("#accounts_create_name").val();
    let initial_balance = $("#accounts_create_initial_balance").val();

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            initial_balance: initial_balance,
        },
        beforeSend: function(){
            $(".accounts-create-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#accounts_create_"+key+"_error").text(value);
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
