$("#content_loader").on("click","#categories_index_create", function(e){
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

function categoriesIndexTableLoader(){
    let search = $("#categories_index_search").val();
    let status = $("#categories_index_status").val();
    $.ajax({
        url: "/categories",
        type: "GET",
        data:{
            search: search,
            status: status,
        },
        success: function(response){
            $("#content_loader #categories_index_table_container").html(response);
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
