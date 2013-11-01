<?php
    define(LANG, 'pt');
    $lang = LANG;
    $locale = parse_ini_file('i18n.ini', true);

    if (isset($_GET['lang']) && !empty($_GET['lang']))
        $lang = $_GET['lang'];

    $lang_vector = explode(' ', $locale[$lang]['languages']);

    for ($i=0; $i < count($lang_vector); $i++) {
        $acronyms[$i] = substr($lang_vector[$i], 0, 2);
        $words[$acronyms[$i]] = substr($lang_vector[$i], 3);
    }
/*
    for ($i=1; $i <= count($lang_vector); $i++) {
        if (isset($_POST['op'.$i]) && !empty($_POST['op'.$i])) {
            $acronyms[$i-1] = $_POST['op'.$i];
        }
    }
*/
?>

<!DOCTYPE html>
<html>
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $locale[$lang]['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <style type="text/css">
        .jumbotron {
            margin-bottom: 50px;
            background-color: #333;
            color: white;
        }
        .jumbotron h1 {
            margin-bottom: 30px;
        }
        .form-group {
            margin-top: 10px;
        }
        .container {
            margin: 0 auto;
            text-align: center;
        }
        #inputURL {
            width: 490px;
        }
        textarea {
            margin-bottom: 50px;
            margin-top: 50px;
            min-width: 705px;
        }
        input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
            background-color: #FFF !important;
            cursor: text !important;
        }
        .msg {
            width: 60%;
            margin: 0 auto;
        }
        .notice {
            display: none;
        }
        .alert-success {
            visibility: hidden;
        }
        #clipboard {
            display: none;
            font-size: 16px;
            font-weight: 700;
            color: lime;
        }
        embed {
            margin-bottom: 14px;
        }
        #copy-dynamic:hover {
            text-decoration: none !important;
            color: #428bca !important;
        }
        .language {
            margin-right: 20px;
        }
        .dropdown-toggle {
            background-color: #333 !important;
        }
        #inputLang option { color: black; }
        .empty { color: #AAAAAA; }
    </style>

    <script src="js/jquery.js"></script>
    <script src="js/jquery.zclip.min.js"></script>

    <script>
        $(document).ready(function(){
            $('div a#copy-dynamic').zclip({
                path:'js/ZeroClipboard.swf',
                copy:function(){return $('textarea#showSource').val();},
                afterCopy:function(){
                    $("#clipboard").css({ "display": "block" });
                    $('#clipboard').fadeOut(5000);
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
            $("form").attr('action','gerador.php?lang=' + lang);
            $("form").submit();
        });
    </script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!--ul class="nav navbar-nav pull-right language"-->
    <ul class="nav pull-right language">
        <li class="dropdown">
            <a href="#" id="drop1" name="<?php echo $acronyms[0]; ?>" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $words[$acronyms[0]]; ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
                <?php for ($i=1; $i < count($lang_vector); $i++) { ?>
                    <li><a href="#" id="drop<?php echo $i+1; ?>" name="<?php echo $acronyms[$i]; ?>"><?php echo $words[$acronyms[$i]]; ?> </a></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
    
    <div id="jumbo" class="jumbotron">
            <h1 class="text-center"><?php echo $locale[$lang]['main_title']; ?></h1>
            <p class="text-center"><?php echo $locale[$lang]['info']; ?> <a href="http://wiki.bireme.org/pt/index.php/Pesquisa_MetaIAH_no_WordPress" target="_blank"><?php echo $locale[$lang]['main_title']; ?></a></p>
    </div>

    <div class="container">
        <form class="form-inline" role="form" method="post">
<!--
            <input id="total" name="total" type="hidden" value="<?php echo count($lang_vector); ?>">
            
            <?php for ($i=1; $i <= count($lang_vector); $i++) { ?>
                <input id="op<?php echo $i; ?>" name="op<?php echo $i; ?>" type="hidden" value="<?php echo $acronyms[$i-1]; ?>">
            <?php } ?>
-->
            <div class="form-group">
                <label class="sr-only" for="inputURL">URL da BVS</label>
                <input type="text" class="form-control" id="inputURL" placeholder="<?php echo $locale[$lang]['placeholder']; ?>">
            </div>
            <div class="form-group">
                <label class="sr-only" for="inputLang">Idioma da BVS</label>
                <select class="form-control" id="inputLang">
                    <option value="" id="selected" selected><?php echo $locale[$lang]['selected']; ?></option>
                    <?php for ($i=0; $i < count($lang_vector); $i++) { ?> 
                        <option value="<?php echo $acronyms[$i]; ?>"><?php echo $words[$acronyms[$i]]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="button" id="button" class="btn btn-primary" value="<?php echo $locale[$lang]['button']; ?>">
            </div>
            <div class="form-inline">
                <div class="form-group">
                    <label class="sr-only" for="showSource">Código HTML</label>
                    <textarea class="form-control" id="showSource" rows="10" disabled></textarea>
                </div>
            </div>
            
        </form>

        <div class="msg">
            <div class="notice alert alert-warning warning1"><?php echo $locale[$lang]['warning1']; ?></div>
            <div class="notice alert alert-warning warning2"><?php echo $locale[$lang]['warning2']; ?></div>
            <div class="notice alert alert-danger"><?php echo $locale[$lang]['danger']; ?></div>
            <div class="alert alert-success" id="success"><?php echo $locale[$lang]['success']; ?></div>
        </div>

        <div id="clipboard"><em><?php echo $locale[$lang]['clipboard']; ?></em></div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--script src="js/jquery.js"></script-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#button").click(function () {
                var url = $('#inputURL').val();
                var lang = $('#inputLang').val();
                var labels = [ "pt", "Pesquisar", "es", "Buscar", "en", "Search" ];
                var locate = jQuery.inArray( lang, labels ) + 1;

                if(url == ""){
                    $(".alert-success").css({ "visibility": "hidden" });
                    $(".notice").css({ "display": "none" });
                    $(".warning1").css({ "display": "block" });
                }
                else if(url.substring(0, 7) != "http://"){
                    $(".alert-success").css({ "visibility": "hidden" });
                    $(".notice").css({ "display": "none" });
                    $(".alert-danger").css({ "display": "block" });
                }
                else if(lang == ""){
                    $(".alert-success").css({ "visibility": "hidden" });
                    $(".notice").css({ "display": "none" });
                    $(".warning2").css({ "display": "block" });
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
                }
            });
        });

        $("#inputLang").change(function () {
            if($(this).val() == "") $(this).addClass("empty");
            else $(this).removeClass("empty");
        });

        $("#inputLang").change();
    </script>

  </body>
</html>