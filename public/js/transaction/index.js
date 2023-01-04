$("#content_loader").on("click","#transactions_index_create", function(e){
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

// $("#content_loader").on("keyup","#transactions_index_search",function(){
//     let search = $(this).val();
//     $.ajax({
//         url: "/transactions",
//         type: "GET",
//         data:{
//             search: search,
//         },
//         success: function(response){
//             $("#content_loader #transactions_index_table_container").html(response);
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

function transactionsIndexTableLoader(){
    let search_type = $("#transactions_index_search_type").val();
    let search_text = $("#transactions_index_search_text").val();
    let status = $("#transactions_index_status").val();
    let type = $("#transactions_index_type").val();
    let from = $("#transactions_index_from").val();
    let to = $("#transactions_index_to").val();

    if(from === ""){
        from = "1970-01-01";
    }

    if(to === ""){
        to = new Date().getFullYear()+"-12-31";
    }

    $.ajax({
        url: "/transactions",
        type: "GET",
        data:{
            type: type,
            status: status,
            search_type: search_type,
            search_text: search_text,
            from: from,
            to: to,
        },
        success: function(response){
            $("#content_loader #transactions_index_table_container").html(response);
            // console.log(response);
        }
    });
}

function searchTrigger()
{
    $("#transactions_index_search_text").val("");
    $("#transactions_index_search_ul").addClass("hide");

    if($("#transactions_index_search_type").val() === ""){
        $("#transactions_index_search_text").attr("disabled", "true");
    }
    else{
        $("#transactions_index_search_text").removeAttr("disabled");
    }
    transactionsIndexTableLoader();
}

function getUsersAccounts()
{
    let type = $("#transactions_index_search_type").val();
    let text = $("#transactions_index_search_text").val();
    let url = "";

    if(text !== ""){
        if(type === "user"){
            url = "/users";
        }
        else{
            url = "/accounts";
        }

        $.ajax({
            url: url,
            type: "GET",
            data:{
                key: "from_transaction_index",
                search: text,
            },
            success: function(response){
                $("#transactions_index_search_ul").html(response);
                $("#transactions_index_search_ul").removeClass("hide");
            }
        });
    }
    else{
        $("#transactions_index_search_ul").html("");
        $("#transactions_index_search_ul").addClass("hide");
    }
}

$("#content_loader").on("click",".ul-clickable", function(e){
    $("#transactions_index_search_text").val($(this).html());
    $("#transactions_index_search_ul").addClass("hide");
    transactionsIndexTableLoader();
});

$("#content_loader").on("change","#transactions_index_from", function(){
    $("#transactions_index_to").datepicker("option","minDate",$(this).val());
    transactionsIndexTableLoader();
});

$("#content_loader").on("change","#transactions_index_to", function(){
    $("#transactions_index_from").datepicker("option","maxDate",$(this).val());
    transactionsIndexTableLoader();
});

