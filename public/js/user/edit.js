$("#content_loader").on("click","#users_edit_close", function(e){
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

$("#content_loader").on("submit","#users_edit_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let name = $("#users_edit_name").val();
    let initial_balance = $("#users_edit_initial_balance").val();
    let balance = $("#users_edit_balance").val();

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            name: name,
            initial_balance: initial_balance,
            balance: balance,
        },
        beforeSend: function(){
            $(".users-edit-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#users_edit_"+key+"_error").text(value);
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
