<?php

	session_start();

	include 'configuration.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/

    $ticket_id=$_POST['ticket_id'];

	$connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die
            ("Datenbankfehler User");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank auth nicht waehlen.");

    $sql = "SELECT ticket.id,raum.raum,datum,status,text_user,zeit,grund.grund,produktion,text_admin FROM ticket,raum,grund WHERE ticket.grund = grund.id AND ticket.raum=raum.id AND ticket.id='".$ticket_id."'";


    $ticket_query = mysql_query($sql) or die("DB-Anfrage auth nicht erfolgreich");

    $ticket = mysql_fetch_array($ticket_query);

    $ticket_id  = $ticket["id"];
    $raum       = $ticket["raum"];
    $datum      = $ticket["datum"];
    $status     = $ticket["status"];
    $text_user  = $ticket["text_user"];
    $zeit       = $ticket["zeit"];
    $grund      = $ticket["grund"];
    $produktion = $ticket["produktion"];
    $text_admin = $ticket["text_admin"];

    $json = array(     'ticket_id' => "$ticket_id",
                       'raum' => "$raum",
                       'datum' => "$datum",
                       'status' => "$status",
                       'text_user' => "$text_user",
                       'zeit' => "$zeit",
                       'grund' => "$grund",
                       'produktion' => "$produktion",
                       'text_admin' => "$text_admin"
                       );

    print json_encode($json);

?>
