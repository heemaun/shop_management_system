$("#content_loader").on("click","#sells_index_create", function(e){
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

function sellsIndexTableLoader(){
    let search = $("#sells_index_search").val();
    let from = $("#sells_index_from").val();
    let to = $("#sells_index_to").val();
    let status = $("#sells_index_status").val();

    if(from === ""){
        from = "1970-01-01";
    }

    if(to === ""){
        to = new Date().getFullYear()+"-12-31";
    }

    $.ajax({
        url: "/sells",
        type: "GET",
        // dataType: "json",
        data:{
            status: status,
            search: search,
            from: from,
            to: to,
        },
        success: function(response){
            $("#content_loader #sells_index_table_container").html(response);
            // console.log(response);
        }
    });
}

$("#content_loader").on("change","#sells_index_from", function(){
    $("#sells_index_to").datepicker("option","minDate",$(this).val());
    sellsIndexTableLoader();
});

$("#content_loader").on("change","#sells_index_to", function(){
    $("#sells_index_from").datepicker("option","maxDate",$(this).val());
    sellsIndexTableLoader();
});

