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

function sellsCreateUserSearch()
{
    let text = $("#sells_create_user_text").val();
    let url = "/users";

    if(text !== ""){
        $.ajax({
            url: url,
            type: "GET",
            data:{
                key_sell: "key_sell",
                search: text,
            },
            success: function(response){
                $("#sells_create_user_ul").html(response);
                $("#sells_create_user_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#sells_create_user_ul").html("");
        $("#sells_create_user_ul").addClass("hide");
    }
}

$("#content_loader").on("click","#sells_create_user_ul .ul-clickable", function(e){
    $("#sells_create_user_text").val($(this).html());
    $("#sells_create_user_id").val($(this).attr("data-id"));
    $("#sells_create_user_ul").addClass("hide");
});

function sellsCreateProductSearch()
{
    let text = $("#sells_create_product_text").val();
    let url = "/products";

    if(text !== ""){
        $.ajax({
            url: url,
            type: "GET",
            data:{
                key_sell: "key_sell",
                search: text,
            },
            success: function(response){
                $("#sells_create_product_ul").html(response);
                $("#sells_create_product_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#sells_create_product_ul").html("");
        $("#sells_create_product_ul").addClass("hide");
    }
}

$("#content_loader").on("click","#sells_create_product_ul .ul-clickable", function(e){
    $("#sells_create_product_text").val($(this).html());
    $("#sells_create_product_id").val($(this).attr("data-id"));
    $("#sells_create_product_ul").addClass("hide");

    let unit_price = $(this).attr("data-unit-price");

    $("#sells_create_product_units").val(1);
    $("#sells_create_product_discount").val(0);
    $("#sells_create_product_unit_price").text(unit_price);
    $("#sells_create_product_subtotal").html(unit_price);
    $("#sells_create_product_total").text(unit_price);
});

function sellsCreateAccountSearch()
{
    let text = $("#sells_create_account_text").val();
    let url = "/accounts";

    if(text !== ""){
        $.ajax({
            url: url,
            type: "GET",
            data:{
                key_sell: "key_sell",
                search: text,
            },
            success: function(response){
                $("#sells_create_account_ul").html(response);
                $("#sells_create_account_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#sells_create_account_ul").html("");
        $("#sells_create_account_ul").addClass("hide");
    }
}

$("#content_loader").on("click","#sells_create_account_ul .ul-clickable", function(e){
    $("#sells_create_account_text").val($(this).html());
    $("#sells_create_account_id").val($(this).attr("data-id"));
    $("#sells_create_account_ul").addClass("hide");
});

$("#content_loader").on("click","#sells_create_product_add",function (e){
    e.preventDefault();
    let url = $("#sells_create_product_add").attr("href");
    let sell_id = $("#sells_create_product_add").attr("data-sell-id");
    let product_id = $("#sells_create_product_id").val();
    let units = $("#sells_create_product_units").val();
    let discount = $("#sells_create_product_discount").val();
    let status = "pending";

    $.ajax({
        url: url,
        type: "POST",
        // dataType: 'json',
        data:{
            sell_id: sell_id,
            product_id: product_id,
            units: units,
            discount: discount,
            status: status,
        },
        beforeSend: function(){
            console.log(url,sell_id,product_id,units,discount,status);
        },
        success: function(response){
            console.log(response);
            $("#sells_create_orders_table").html(response);
        }
    });
});

function productDetailsChange()
{
    let units = $("#sells_create_product_units").val();
    let discount = $("#sells_create_product_discount").val();
    let unit_price = $("#sells_create_product_unit_price").text();

    let subtotal = unit_price * units;
    let total = subtotal - discount;

    $("#sells_create_product_subtotal").html(subtotal);
    $("#sells_create_product_total").html(total);
}
