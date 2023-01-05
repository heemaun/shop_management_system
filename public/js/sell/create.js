$("#content_loader").on("click","#sells_create_close", function(e){
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

$("#content_loader").on("submit","#sells_create_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let from_select = $("#sells_create_from_select").val();
    let to_select = $("#sells_create_to_select").val();
    let from_id = $("#sells_create_from_id").val();
    let to_id = $("#sells_create_to_id").val();
    let type = $("#sells_create_type").val()
    let status = $("#sells_create_status").val();
    let purchase_id = $("#sells_create_purchase_id").val();
    let sell_id = $("#sells_create_sell_id").val();
    let amount = $("#sells_create_amount").val();

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
            $(".sells-create-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#sells_create_"+key+"_error").text(value);
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
    $("#sells_create_from_text").val("");
    $("#sells_create_from_ul").html("");

    if($("#sells_create_from_select").val() === ""){
        $("#sells_create_from_text").attr("disabled","true");
    }
    else{
        $("#sells_create_from_text").removeAttr("disabled");
    }
}

function searchToTrigger()
{
    $("#sells_create_to_text").val("");
    $("#sells_create_to_ul").html("");

    if($("#sells_create_to_select").val() === ""){
        $("#sells_create_to_text").attr("disabled","true");
    }
    else{
        $("#sells_create_to_text").removeAttr("disabled");
    }
}

function searchFromText()
{
    let type = $("#sells_create_from_select").val();
    let text = $("#sells_create_from_text").val();
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
                $("#sells_create_from_ul").html(response);
                $("#sells_create_from_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#sells_create_from_ul").html("");
        $("#sells_create_from_ul").addClass("hide");
    }
}

function searchToText()
{
    let type = $("#sells_create_to_select").val();
    let text = $("#sells_create_to_text").val();
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
                $("#sells_create_to_ul").html(response);
                $("#sells_create_to_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#sells_create_to_ul").html("");
        $("#sells_create_to_ul").addClass("hide");
    }
}

$("#content_loader").on("click","#sells_create_from_ul .ul-clickable", function(e){
    $("#sells_create_from_text").val($(this).html());
    $("#sells_create_from_id").val($(this).attr("data-id"));
    $("#sells_create_from_ul").addClass("hide");
});

$("#content_loader").on("click","#sells_create_to_ul .ul-clickable", function(e){
    $("#sells_create_to_text").val($(this).html());
    $("#sells_create_to_id").val($(this).attr("data-id"));
    $("#sells_create_to_ul").addClass("hide");
});
