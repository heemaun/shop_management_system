$("#content_loader").on("keyup","#settings_index_search",function(){
    let search = $(this).val();
    $.ajax({
        url: "/settings",
        type: "GET",
        data:{
            search: search,
        },
        success: function(response){
            $("#content_loader #settings_index_table_container").html(response);
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
