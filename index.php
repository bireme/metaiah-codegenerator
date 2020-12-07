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
    <link href="css/style.css" rel="stylesheet" media="screen">

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!-- <script src="js/jquery.zclip.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>

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
            <div class="alert alert-success"><?php echo $locale[$lang]['success']; ?></div>
        </div>

        <!-- <div id="clipboard"><em><?php echo $locale[$lang]['clipboard']; ?></em></div> -->
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/scripts.js"></script>

  </body>
</html>
