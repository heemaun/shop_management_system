$("#content_loader").on("click","#products_edit_close", function(e){
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

$("#content_loader").on("submit","#products_edit_form",function(e){
    e.preventDefault();
    let url = $(this).attr("action");
    let category_id = $("#products_edit_category_id").val();
    let name = $("#products_edit_name").val();
    let status = $("#products_edit_status").val();
    let initial_inventory = $("#products_edit_initial_inventory").val();
    let current_inventory = $("#products_edit_current_inventory").val();
    let purchase_price = $("#products_edit_purchase_price").val();
    let avg_purchase_price = $("#products_edit_avg_purchase_price").val();
    let selling_price = $("#products_edit_selling_price").val();

    $.ajax({
        url: url,
        type: "PUT",
        dataType: "json",
        data: {
            category_id: category_id,
            name: name,
            status: status,
            initial_inventory: initial_inventory,
            current_inventory: current_inventory,
            purchase_price: purchase_price,
            avg_purchase_price: avg_purchase_price,
            selling_price: selling_price,
        },
        beforeSend: function(){
            $(".products-edit-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#products_edit_"+key+"_error").text(value);
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
