$("#inputLang").change(function () {
    if($(this).val() == "") $(this).addClass("empty");
    else $(this).removeClass("empty");
});

$("#inputLang").change();
