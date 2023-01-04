$("#content_loader").on("click","#transactions_edit_close", function(e){
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

$("#content_loader").on("submit","#transactions_edit_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let name = $("#transactions_edit_name").val();
    let email = $("#transactions_edit_email").val();
    let phone = $("#transactions_edit_phone").val();
    let transaction_name = $("#transactions_edit_transaction_name").val();
    let status = $("#transactions_edit_status").val();
    let gender = $("#transactions_edit_gender").val();
    let role = $("#transactions_edit_role").val();
    let salary = $("#transactions_edit_salary").val();
    let date_of_birth = $("#transactions_edit_date_of_birth").val();
    let address = $("#transactions_edit_address").val();

    // console.log(url,name,email,phone,transaction_name,status,gender,role,salary,date_of_birth,address);

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            name: name,
            email: email,
            phone: phone,
            transaction_name: transaction_name,
            status: status,
            gender: gender,
            role: role,
            salary: salary,
            date_of_birth: date_of_birth,
            address: address,
        },
        beforeSend: function(){
            $(".transactions-edit-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#transactions_edit_"+key+"_error").text(value);
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
