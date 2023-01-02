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
    let email = $("#users_edit_email").val();
    let phone = $("#users_edit_phone").val();
    let user_name = $("#users_edit_user_name").val();
    let status = $("#users_edit_status").val();
    let gender = $("#users_edit_gender").val();
    let role = $("#users_edit_role").val();
    let salary = $("#users_edit_salary").val();
    let date_of_birth = $("#users_edit_date_of_birth").val();
    let address = $("#users_edit_address").val();

    // console.log(url,name,email,phone,user_name,status,gender,role,salary,date_of_birth,address);

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            name: name,
            email: email,
            phone: phone,
            user_name: user_name,
            status: status,
            gender: gender,
            role: role,
            salary: salary,
            date_of_birth: date_of_birth,
            address: address,
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
