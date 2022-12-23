$("#content_loader").on("click","#accounts_index_create", function(e){
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

$("#content_loader").on("keyup","#accounts_index_search",function(){
    let search = $(this).val();
    $.ajax({
        url: "/accounts",
        type: "GET",
        data:{
            search: search,
        },
        success: function(response){
            $("#content_loader #accounts_index_table_container").html(response);
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
