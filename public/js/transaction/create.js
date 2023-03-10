$("#content_loader").on("click","#transactions_create_close", function(e){
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

$("#content_loader").on("submit","#transactions_create_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let from_select = $("#transactions_create_from_select").val();
    let to_select = $("#transactions_create_to_select").val();
    let from_id = $("#transactions_create_from_id").val();
    let to_id = $("#transactions_create_to_id").val();
    let type = $("#transactions_create_type").val()
    let status = $("#transactions_create_status").val();
    let purchase_id = $("#transactions_create_purchase_id").val();
    let sell_id = $("#transactions_create_sell_id").val();
    let amount = $("#transactions_create_amount").val();

    $.ajax({
        url: url,
        type: "POST",
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
            $(".transactions-create-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#transactions_create_"+key+"_error").text(value);
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

function searchFromTrigger()
{
    $("#transactions_create_from_text").val("");
    $("#transactions_create_from_ul").html("");

    if($("#transactions_create_from_select").val() === ""){
        $("#transactions_create_from_text").attr("disabled","true");
    }
    else{
        $("#transactions_create_from_text").removeAttr("disabled");
    }
}

function searchToTrigger()
{
    $("#transactions_create_to_text").val("");
    $("#transactions_create_to_ul").html("");

    if($("#transactions_create_to_select").val() === ""){
        $("#transactions_create_to_text").attr("disabled","true");
    }
    else{
        $("#transactions_create_to_text").removeAttr("disabled");
    }
}

function searchFromText()
{
    let type = $("#transactions_create_from_select").val();
    let text = $("#transactions_create_from_text").val();
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
                $("#transactions_create_from_ul").html(response);
                $("#transactions_create_from_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#transactions_create_from_ul").html("");
        $("#transactions_create_from_ul").addClass("hide");
    }
}

function searchToText()
{
    let type = $("#transactions_create_to_select").val();
    let text = $("#transactions_create_to_text").val();
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
                $("#transactions_create_to_ul").html(response);
                $("#transactions_create_to_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#transactions_create_to_ul").html("");
        $("#transactions_create_to_ul").addClass("hide");
    }
}

$("#content_loader").on("click","#transactions_create_from_ul .ul-clickable", function(e){
    $("#transactions_create_from_text").val($(this).html());
    $("#transactions_create_from_id").val($(this).attr("data-id"));
    $("#transactions_create_from_ul").addClass("hide");
});

$("#content_loader").on("click","#transactions_create_to_ul .ul-clickable", function(e){
    $("#transactions_create_to_text").val($(this).html());
    $("#transactions_create_to_id").val($(this).attr("data-id"));
    $("#transactions_create_to_ul").addClass("hide");
});
