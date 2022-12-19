$("#content_loader").on("mouseenter",".product",function(){
    $(this).children("a").removeClass("hide");
});

$("#content_loader").on("mouseleave",".product",function(){
    $(this).children("a").addClass("hide");
});

$("#content_loader").on("click","#home_product_show_close",function(){
    $("#home_product_show").toggleClass("hide");
});

$("#content_loader").on("click",".product",function(){
    let url = $(this).attr("data-href");
    $.ajax({
        url: url,
        type: "GET",
        datatype: "json",
        data:{
            dataType: "json",
        },
        success: function(response){
            $("#home_product_show img").attr("src","/images/"+response.product.picture);
            $("#home_product_show_name").text(response.product.name);
            $("#home_product_show_category").text(response.product.category);
            $("#home_product_show_price").text(response.product.selling_price);
            $("#home_product_show_status").text(response.product.status);
            $("#home_product_show").toggleClass("hide");
        }
    });
});

$("#content_loader").on("click","#home_product_show_img",function(){
    $("#view_image img").attr("src", $("#home_product_show img").attr("src"));
    $("#view_image").toggleClass("hide");
});

$("#content_loader").on("click","#view_image_close",function(){
    $("#view_image").toggleClass("hide");
});
