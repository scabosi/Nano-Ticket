<?php

	session_start();

	include 'configuration.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/

	$connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die
            ("Datenbankfehler User");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank auth nicht waehlen.");

    $sql = "SELECT id,raum FROM raum ";

    $room_query = mysql_query($sql) or die("DB-Anfrage auth nicht erfolgreich");

    $json = array();
    $index = 0;

    while ($rooms = mysql_fetch_array($room_query)) {
    	$json['raum'][$index]['id']=$rooms['id'];
    	$json['raum'][$index]['raum']=$rooms['raum'];
    	$index++;
    }

    $sql = "SELECT id,grund FROM grund ";

    $room_query = mysql_query($sql) or die("DB-Anfrage auth nicht erfolgreich");


    $index = 0;

    while ($rooms = mysql_fetch_array($room_query)) {
    	$json['grund'][$index]['id']=$rooms['id'];
    	$json['grund'][$index]['raum']=$rooms['grund'];
    	$index++;
    }


    print json_encode($json);



?>
