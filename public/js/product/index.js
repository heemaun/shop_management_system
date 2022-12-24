$("#content_loader").on("click","#products_index_create", function(e){
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

function productsIndexTableLoader(){
    let search = $("#products_index_search").val();
    let status = $("#products_index_status").val();
    let category_id = $("#products_index_category_id").val();
    $.ajax({
        url: "/products",
        type: "GET",
        data:{
            search: search,
            status: status,
            category_id: category_id,
        },
        success: function(response){
            $("#content_loader #products_index_table_container").html(response);
        }
    });
}

$("#content_loader").on("click",".clickable",function(){
    let url = $(this).attr("data-href");
    $.ajax({
        url: url,
        type: "GET",
        success: function(response){
            $("#content_loader").html(response);
        }
    });
});
