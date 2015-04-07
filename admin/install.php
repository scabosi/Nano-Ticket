
<!DOCTYPE html>
<!-- saved from url=(0050)http://getbootstrap.com/examples/starter-template/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Installation</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/template.css" rel="stylesheet">
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../dist/js/bootstrap-select.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../dist/js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Installation Ticketsystem</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
           
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">     
        <p class="lead">
        Mit diesem Setup werden alle erforderlichen Tabellen in der Datenbank erzeugt. 
        Hierzu ist es notwendig, dass die Dateien config.php und /admin/config_admin.php
        entsprechend angepasst werden müssen.<br><br>
        Weiterhin wird ein Adminuser erzeugt, mit dessen Hilfe weitere Anpassungen im Backend
        getätigt werden können.<br>
        Wollen Sie mit dem Setup beginnen? <span class="text-danger">(Alle bestehenden Daten werden gelöscht!!!) </span><br><br></p>
        
        <form method="post" action="install_create_db.php">
          <p class="text-center"><input type="submit" class="btn btn-danger btn-lg" value="Jetzt installieren" name="install"></p> 
        </form>






      </div>

    </div><!-- /.container -->

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="../dist/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../dist/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>