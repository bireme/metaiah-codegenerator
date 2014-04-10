$(document).ready(function(){
    $('div a#copy-dynamic').zclip({
        path:'js/ZeroClipboard.swf',
        copy:function(){return $('textarea#showSource').val();},
        afterCopy:function(){
            $("#clipboard").css({ "color": "lime" });
            $("#clipboard").animate({ "color": "#FFF" }, 5000);
        }
    });

    $("#button").click(function () {
        var url = $('#inputURL').val();
        var lang = $('#inputLang').val();
        var labels = [ "pt", "Pesquisar", "es", "Buscar", "en", "Search" ];
        var locate = jQuery.inArray( lang, labels ) + 1;

        if(url == ""){
            $(".alert-success").css({ "visibility": "hidden" });
            $(".notice").css({ "display": "none" });
            $(".warning1").css({ "display": "block" });
            $("html, body").animate({ scrollTop: $(document).height()-630 }, "slow");
        }
        else if(url.substring(0, 7) != "http://"){
            $(".alert-success").css({ "visibility": "hidden" });
            $(".notice").css({ "display": "none" });
            $(".alert-danger").css({ "display": "block" });
            $("html, body").animate({ scrollTop: $(document).height()-630 }, "slow");
        }
        else if(lang == ""){
            $(".alert-success").css({ "visibility": "hidden" });
            $(".notice").css({ "display": "none" });
            $(".warning2").css({ "display": "block" });
            $("html, body").animate({ scrollTop: $(document).height()-630 }, "slow");
        }
        else {
            var text = "<script src=\"http://reddes.bvsalud.org/support/js/metasearch-widget.js\"><\/script>\n";
            text = text.concat("<form name=\"searchForm\" action=\"#\" method=\"post\" onsubmit=\"return(executeSearch());\" target=\"_blank\">\n");
            text = text.concat("    <input type=\"hidden\" name=\"address\" value=\"" + url + "/\"\/>\n");
            text = text.concat("    <input type=\"hidden\" name=\"lang\" value=\"" + lang + "\"/>\n");
            text = text.concat("    <input type=\"hidden\" name=\"engine\" value=\"metaiah\"\/>\n");
            text = text.concat("    <input type=\"hidden\" name=\"view\" value=\"PAGE\"\/>\n");
            text = text.concat("    <input type=\"text\" name=\"expression\" class=\"vhl-search-input\" placeholder=\"" + labels[locate] + "\"\/>\n");
            text = text.concat("    <input type=\"submit\" value=\"Pesquisar\" name=\"submit\" class=\"submit\"\/>\n");
            text = text.concat("<\/form>");

            $("#showSource").val(text);
            $(".notice").css({ "display": "none" });
            $(".alert-success").css({ "visibility": "visible" });
            $("html, body").animate({ scrollTop: $(document).height()-$(window).height() }, "slow");
            //$("html, body").animate({ scrollTop: $("#footer").offset().top }, "slow");
        }
    });
});

$(document).on('click','.dropdown ul a',function(){
/*
    var cont = $('#total').val();
    var text = $(this).text();
    var name_text = $(this).attr('name');
    var selected = $(this).closest('.dropdown').children('a.dropdown-toggle').text();
    var name_selected = $(this).closest('.dropdown').children('a.dropdown-toggle').attr('name');
    $(this).attr('name', name_selected);
    $(this).closest('.dropdown').children('a.dropdown-toggle').attr('name', name_text);
    //$(this).text(selected);
    //$(this).closest('.dropdown').children('a.dropdown-toggle').html(text + "<b class=\"caret\"></b>");

    for (var i = 1; i <= cont; i++) {
        $('#op'+i).val($('#drop'+i).attr('name'));
    };
*/
    var lang = $(this).attr('name');
    $("form").attr('action','index.php?lang=' + lang);
    $("form").submit();
});
