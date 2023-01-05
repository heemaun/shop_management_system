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
    let from_select = $("#transactions_edit_from_select").val();
    let to_select = $("#transactions_edit_to_select").val();
    let from_id = $("#transactions_edit_from_id").val();
    let to_id = $("#transactions_edit_to_id").val();
    let type = $("#transactions_edit_type").val()
    let status = $("#transactions_edit_status").val();
    let purchase_id = $("#transactions_edit_purchase_id").val();
    let sell_id = $("#transactions_edit_sell_id").val();
    let amount = $("#transactions_edit_amount").val();

    // console.log(url,name,email,phone,transaction_name,status,gender,role,salary,date_of_birth,address);

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            from_select: from_select,
            to_select: to_select,
            from_id: from_id,
            to_id: to_id,
            type: type,
            status: status,
            purchase_id: purchase_id,
            sell_id: sell_id,
            amount: amount,
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

function searchEditFromTrigger()
{
    $("#transactions_edit_from_text").val("");
    $("#transactions_edit_from_ul").html("");

    if($("#transactions_edit_from_select").val() === ""){
        $("#transactions_edit_from_text").attr("disabled","true");
    }
    else{
        $("#transactions_edit_from_text").removeAttr("disabled");
    }
}

function searchEditToTrigger()
{
    $("#transactions_edit_to_text").val("");
    $("#transactions_edit_to_ul").html("");

    if($("#transactions_edit_to_select").val() === ""){
        $("#transactions_edit_to_text").attr("disabled","true");
    }
    else{
        $("#transactions_edit_to_text").removeAttr("disabled");
    }
}

function searchEditFromText()
{
    let type = $("#transactions_edit_from_select").val();
    let text = $("#transactions_edit_from_text").val();
    let url = "";

    if(text !== ""){
        if(type === "user"){
            url = "/users";
        }
        else{
            url = "/accounts";
        }

        $.ajax({
            url: url,
            type: "GET",
            data:{
                key: "from_transaction_index",
                search: text,
            },
            success: function(response){
                $("#transactions_edit_from_ul").html(response);
                $("#transactions_edit_from_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#transactions_edit_from_ul").html("");
        $("#transactions_edit_from_ul").addClass("hide");
    }
}

function searchEditToText()
{
    let type = $("#transactions_edit_to_select").val();
    let text = $("#transactions_edit_to_text").val();
    let url = "";

    if(text !== ""){
        if(type === "user"){
            url = "/users";
        }
        else{
            url = "/accounts";
        }

        $.ajax({
            url: url,
            type: "GET",
            data:{
                key: "to_transaction_index",
                search: text,
            },
            success: function(response){
                $("#transactions_edit_to_ul").html(response);
                $("#transactions_edit_to_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#transactions_edit_to_ul").html("");
        $("#transactions_edit_to_ul").addClass("hide");
    }
}

$("#content_loader").on("click","#transactions_edit_from_ul .ul-clickable", function(e){
    $("#transactions_edit_from_text").val($(this).html());
    $("#transactions_edit_from_id").val($(this).attr("data-id"));
    $("#transactions_edit_from_ul").addClass("hide");
});

$("#content_loader").on("click","#transactions_edit_to_ul .ul-clickable", function(e){
    $("#transactions_edit_to_text").val($(this).html());
    $("#transactions_edit_to_id").val($(this).attr("data-id"));
    $("#transactions_edit_to_ul").addClass("hide");
});
