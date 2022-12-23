$("#content_loader").on("click",".click",function(){
    $(this).siblings(".content").toggleClass("show");
    let height = $(this).siblings(".content.show").children("ul").height();
    if(height === undefined){
        height = 0;
    }
    $(this).siblings(".content").height(height);
    $(this).children("span").toggleClass("svg-rotate");
});

$("#content_loader").on("click","#dashboard .content li",function(e){
    e.preventDefault();
    let url = $(this).children("a").attr("href");
    $.ajax({
        url: url,
        type: "GET",
        success: function(response){
            $("#content_loader").html(response);
        }
    });
});
