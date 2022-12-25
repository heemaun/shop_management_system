function home()
{
    $.ajax({
        url: "/home",
        // url: "/products/1",
        type: "GET",
        success: function(response){
            $("#content_loader").html(response);
        }
    })
}

home();

$("#home").click(function(){
    $("html, body").animate({
        scrollTop: $(".content-loader main").offset().top - 40
    },200);
});

$("#products").click(function(){
    $("html, body").animate({
        scrollTop: $(".content-loader section").offset().top - 40
    },200);
});

$("#contacts").click(function(){
    $("html, body").animate({
        scrollTop: $(".content-loader footer").offset().top - 40
    },200);
});

$("#login_trigger").click(function(){
    $("#login_div").removeClass("hide");
});

$("#login_close").click(function(){
    $("#login_div").addClass("hide");
});

$("#register_trigger").click(function(){
    $("#register_div").removeClass("hide");
});

$("#register_close").click(function(){
    $("#register_div").addClass("hide");
});

$("#change_password_trigger").click(function(){
    $("#change_password_div").removeClass("hide");
    $("#nav_options").toggleClass("hide");
});

$("#change_password_close").click(function(){
    $("#change_password_div").addClass("hide");
});

$("#nav_option_trigger").click(function(){
    $("#nav_options").toggleClass("hide");
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$("#admin, #admin_panel").hover(function(){
    $("#admin_panel").toggleClass("hidden");
    $("#admin").css("background","gray");
});

$("#admin, #admin_panel").mouseleave(function(){
    $("#admin").css("background","black");
});

$("#manager, #manager_panel").hover(function(){
    $("#manager_panel").toggleClass("hidden");
    $("#manager").css("background","gray");
});

$("#manager, #manager_panel").mouseleave(function(){
    $("#manager").css("background","black");
});

$("#seller, #seller_panel").hover(function(){
    $("#seller_panel").toggleClass("hidden");
    $("#seller").css("background","gray");
});

$("#seller, #seller_panel").mouseleave(function(){
    $("#seller").css("background","black");
});

$("#customer, #customer_panel").hover(function(){
    $("#customer_panel").toggleClass("hidden");
    $("#customer").css("background","gray");
});

$("#customer, #customer_panel").mouseleave(function(){
    $("#customer").css("background","black");
});

$("#login_form").on("submit", function(e){
    e.preventDefault();
    let user_name = $("#login_user_name").val();
    let password = $("#login_password").val();
    let url = $(this).attr("action");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {
            user_name: user_name,
            password: password,
        },
        beforeSend: function(){
            $(".login-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#login_"+key+"_error").text(value);
                });
            }

            else if(response.status === "error"){
                toastr.error(response.message);
            }

            else{
                window.location = "/";
                toastr.success(response.message);
            }
        },
    });
});

$("#register_form").on("submit", function(e){
    e.preventDefault();
    let name = $("#register_name").val();
    let email = $("#register_email").val();
    let phone = $("#register_phone").val();
    let user_name = $("#register_user_name").val();
    let gender = $("#register_gender").val();
    let password = $("#register_password").val();
    let password_confirmation = $("#register_password_confirmation").val();
    let date_of_birth = $("#register_date_of_birth").val();
    let address = $("#register_address").val();
    let url = $(this).attr("action");

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            email: email,
            phone: phone,
            user_name: user_name,
            gender: gender,
            password_confirmation: password_confirmation,
            date_of_birth: date_of_birth,
            address: address,
            password: password,
            shop_id: 1,
        },
        beforeSend: function(){
            $(".register-error").text("");
        },
        success: function(response){
            if(response.status === "errors"){
                $.each(response.errors,function(key,value){
                    $("#register_"+key+"_error").text(value);
                });
            }

            else if(response.status === "error"){
                toastr.error(response.message);
            }

            else{
                toastr.success(response.message);
                $("#register_div").addClass("hide");
            }
        },
    });
});

$("#dashboard").click(function(e){
    e.preventDefault();
    let url = $(this).children("a").attr("href");
    $.ajax({
        url: url,
        type: "GET",
        data:{
            user_type: "admin",
        },
        success: function(response){
            $("#content_loader").html(response);
        }
    });
});
