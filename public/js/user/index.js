$("#content_loader").on("click","#users_index_create", function(e){
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

// $("#content_loader").on("keyup","#users_index_search",function(){
//     let search = $(this).val();
//     $.ajax({
//         url: "/users",
//         type: "GET",
//         data:{
//             search: search,
//         },
//         success: function(response){
//             $("#content_loader #users_index_table_container").html(response);
//         }
//     });
// });

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

function usersIndexTableLoader(){
    let search = $("#users_index_search").val();
    let status = $("#users_index_status").val();
    let role = $("#users_index_role").val();
    $.ajax({
        url: "/users",
        type: "GET",
        data:{
            search: search,
            status: status,
            role: role,
        },
        success: function(response){
            $("#content_loader #users_index_table_container").html(response);
        }
    });
}
