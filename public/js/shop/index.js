$("#content_loader").on("click","#shops_index_create", function(e){
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

$("#content_loader").on("keyup","#shops_index_search",function(){
    let search = $(this).val();
    $.ajax({
        url: "/shops",
        type: "GET",
        data:{
            search: search,
        },
        success: function(response){
            $("#content_loader #shops_index_table_container").html(response);
        }
    });
});

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
