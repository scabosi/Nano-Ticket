<?php

$_GET["login"];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Abteilung 2 Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script src="js/ie-emulation-modes-warning.js"></script>

    <script>

      $(document).ready(function() {


        <?php if ($_GET["login"]=="wrong_credentials") {
          echo "$('#inputEmail').css('background-color','#f2dede');";
          echo "$('#inputPassword').css('background-color','#f2dede');";

        } ?>

      });



    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

        <div id="logo_div">

        </div>

        <br><br>

          <form method="post" action="assets/ldap.php" class="form-signin">
            <h3 class="form-signin-heading">Abteilung 2 | Login</h3>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Name" name="username" required autofocus>
            <label for="inputPassword" class="sr-only">Passwort</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <br><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Anmelden</button>

          </form>


    <div class="login_info"><br><br>
      Bitte melden Sie sich mit dem Benutzernamen ihrer E-Mail-Adresse und dem dazugehörigem Passwort an.
    </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <link href="css/style.css" rel="stylesheet">
  </body>
</html>
