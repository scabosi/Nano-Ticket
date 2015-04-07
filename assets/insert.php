<?php
    session_start();
    
    include 'configuration.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/

    /*if (!isset($_POST['abschicken'])) {
    include('neues_ticket.htm');
    exit; }*/

    $table    = "ticket";

    $verbindung = mysql_connect($mysqlhost, $mysqluser, $mysqlpwd)
        or die ("Fehler in Datenbankverbindung");

    mysql_select_db($mysqldb, $verbindung);

    $raum=$_POST['raum'];

    $name=$_SESSION["user"];

    /*$mail=$_SESSION["mail"];*/

    $inhalt=$_POST['note'];
    $grund=$_POST['grund'];
    $prio=$_POST['prio'];
    $status=$_POST['status'];
    $datum=date('Y-m-d',time());
    $zeit=date('H:i',time());
    $produktion=$_POST['produktion'];
    $ruf=$_POST['ruf'];
    $sql = "INSERT INTO $table (name,text_user,raum,datum,zeit,grund,prio,produktion,ruf,status)
            VALUES ('". $name."', '". $inhalt."','". $raum ."','". $datum ."','". $zeit ."','". $grund ."','". $prio ."','". $produktion ."','". $ruf ."','". $status ."')";

    $result = mysql_query($sql);

    mysql_close($verbindung);

    echo $result;

    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht

    waehlen.");


    $sql = "SELECT * FROM raum WHERE raum.id='". $raum ."'";

    $adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");

	$adr = mysql_fetch_array($adressen_query);

	$raum_string=$adr["raum"];

    $sender = "tbor@gmx.net";
    $empfaenger = "tbor@gmx.net";
    $betreff = "Ein neues Ticket wurde eingereicht";
    $mailtext = "
    Name:        $name
    Raum:        $raum_string
    Ticket:      $inhalt";

    mail($empfaenger, $betreff, $mailtext, "From: $sender ");

?>
