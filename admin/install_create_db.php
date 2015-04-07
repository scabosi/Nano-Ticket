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
        <?php include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/ ?>

			<?php

			  if(isset($_POST['install']))
			{
			$verbindung = mysql_connect( $mysqlhost, $mysqluser, $mysqlpwd)
			    or die ("verbindung zu sql geht nicht");

			echo "Login in Datenbank erfolgreich!";
			echo "<br>";
			mysql_select_db($mysqldb, $verbindung);

			/*$sql = "DROP DATABASE ticketsystem";
			mysql_query($sql) or die ("<span class='text-danger'>Konnte Datenbank nicht löschen!</span>");
			echo "Alte Datenbank TICKETSYSTEM erfolgreich gelöscht.";*/

			$sql = "CREATE DATABASE ticketsystem";
			mysql_query($sql) or die ("<span class='text-danger'>Konnte Datenbank nicht anlegen!</span>");

			echo "Datenbank TICKETSYSTEM erfolgreich angelegt.";
			echo "<br>";
			mysql_select_db("ticketsystem", $verbindung);
			$sql = "CREATE TABLE ticket (id INT NOT NULL AUTO_INCREMENT,
										PRIMARY KEY(id),
										name VARCHAR(30),
										raum INT,
										datum DATE,
										status INT,
										text_user TEXT,
										zeit TIME,
										grund INT,
										prio INT,
										produktion VARCHAR(30),
										ruf INT,
										text_admin VARCHAR(30))";

										
			mysql_query($sql) or die ("Konnte Tabelle: TICKET nicht erzeugen!");
			echo "Tabelle TICKET erfolgreich angelegt.";
			echo "<br>";



			$sql = "CREATE TABLE grund (id INT NOT NULL AUTO_INCREMENT,
										PRIMARY KEY(id),
										grund VARCHAR(30),							
										abteilung VARCHAR(30))";
										
			mysql_query($sql) or die ("Konnte Tabelle: GRUND nicht erzeugen!");
			echo "Tabelle GRUND erfolgreich angelegt.";
			echo "<br>";

			$sql = "CREATE TABLE raum (id INT NOT NULL AUTO_INCREMENT,
										PRIMARY KEY(id),
										raum VARCHAR(30))";							
															
			mysql_query($sql) or die ("Konnte Tabelle: RAUM nicht erzeugen!");
			echo "Tabelle RAUM erfolgreich angelegt.";
			echo "<br>";

			$sql = "CREATE TABLE user_db (id INT NOT NULL AUTO_INCREMENT,
										PRIMARY KEY(id),
										user_name VARCHAR(30),
										passwort VARCHAR(32),
										vorname VARCHAR(30),
										nachname VARCHAR(30),
										rechte INT)";	
																					
			mysql_query($sql) or die ("Konnte Tabelle: USER nicht erzeugen!");
			echo "Tabelle USER erfolgreich angelegt.";
			echo "<br>";

			$sql = "CREATE TABLE setup_auth (id INT NOT NULL AUTO_INCREMENT,
										PRIMARY KEY(id),
										method INT)";	
																					
			mysql_query($sql) or die ("Konnte Tabelle: SETUP_AUTH nicht erzeugen!");
			echo "Tabelle SETUP_AUTH erfolgreich angelegt.";
			echo "<br>";

			$sql = "CREATE TABLE setup_db (id INT NOT NULL AUTO_INCREMENT,
										PRIMARY KEY(id),
										host VARCHAR(30),
										database_name VARCHAR(30),
										user_name VARCHAR(30),
										passwort VARCHAR(30))";	
																					
			mysql_query($sql) or die ("Konnte Tabelle: SETUP_DB nicht erzeugen!");
			echo "Tabelle SETUP_DB erfolgreich angelegt.";
			echo "<br>";

			$sql = "INSERT INTO USER_DB (user_name,passwort,rechte) VALUES ('admin','1a1dc91c907325c69271ddf0c944bc72','1')";
			mysql_query($sql) or die ("Konnte User nicht anlegen");
			echo "User admin erfolgreich angelegt.";
			echo "<br>";

			$sql = "INSERT INTO SETUP_AUTH (method) VALUES ('1')";
			mysql_query($sql) or die ("Konnte Authentifizierungsmethode nicht setzen");
			echo "Authentifizierungsmethode gesetzt";
			echo "<br>";

			$sql = "INSERT INTO raum (raum) VALUES ('Raum 1')";
			mysql_query($sql) or die ("Konnte Raum nicht einfügen");
			echo "Ein Beispielraum wurde eingefügt";
			echo "<br>";

			$sql = "INSERT INTO grund (grund) VALUES ('Audio')";
			mysql_query($sql) or die ("Konnte Grund nicht einfügen");
			echo "Beispiel-Grund wurde erzeugt";
			echo "<br>";




			mysql_close($verbindung);

			echo "<br>Ticketsystem wurde erfolgreich installiert.<br>Sie können sich jetzt hier mit dem User 'admin' und dem Passwort 'pass'  <a href='http://localhost:8888/ticket2014''>hier</a> anmelden.<br>";
			echo "Bitte ändern Sie das Admin-Passwort so schnell wie möglich und löschen die Datei /admin/install.php";
			}

			?> 






      </div>

    </div><!-- /.container -->

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="../dist/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../dist/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>