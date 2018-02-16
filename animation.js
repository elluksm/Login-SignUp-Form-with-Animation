//animation when user clicks "Signup" button
$("#signup").click(function () {
    $(".light_background").animate({left: '-95%'}, "slow");
    $("#login_form").animate({opacity: '0'}, "slow").css('display', 'none');
    $("#register_form").css('display', 'block').animate({opacity: '1'}, "slow");
});

//animation when user clicks "Login" button
$("#login").click(function () {
    $(".light_background").animate({left: '-4%'}, "slow");
    $("#register_form").animate({opacity: '0'}, "slow").css('display', 'none');
    $("#login_form").css('display', 'block').animate({opacity: '1'}, "slow");
});

//Event listeners for active input elements- change CSS class and image
$("input").focusin(function () {
    var label = $("label[for='" + $(this).attr("id") + "']");
    $(label).addClass("active");
    var src = $(label).find("img").attr('src');
    if (src == "images/icon1.png") {
        var src_new = "images/icon4.png"
    }
    else if (src == "images/icon2.png") {
        var src_new = "images/icon5.png"
    }
    else {
        var src_new = "images/icon6.png"
    }
    $(label).find("img").attr('src', src_new);
});

$("input").focusout(function () {
    var label = $("label[for='" + $(this).attr("id") + "']");
    $(label).removeClass("active");
    var src = $(label).find("img").attr('src');
    if (src == "images/icon4.png") {
        var src_new = "images/icon1.png"
    }
    else if (src == "images/icon5.png") {
        var src_new = "images/icon2.png"
    }
    else {
        var src_new = "images/icon3.png"
    }
    $(label).find("img").attr('src', src_new);
});



