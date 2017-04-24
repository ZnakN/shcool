$(function() {
    $.mask.definitions['~'] = "[+-]";
    $("#phone").mask("+38(099) 999-99-99");

    $("input").blur(function() {
        $("#info").html("Unmasked value: " + $(this).mask());
    }).dblclick(function() {
        $(this).unmask();
    });
});