<?php
    include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/


    /*Mit Datenbank verbinden und Abfrage starten*/


    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht

    waehlen.");


     $sql = "SELECT ticket.grund,grund.grund,grund.id ,COUNT(grund.grund) AS grund_count FROM ticket,grund WHERE ticket.grund = grund.id GROUP BY grund.grund ORDER BY grund_count DESC LIMIT 3";

    $adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");


    $anzahl = mysql_num_rows($adressen_query);


	$json = array();
    $index = 0;

    while ($adr = mysql_fetch_array($adressen_query)){

        $json[$index]['grund']=$adr['grund'];
        $json[$index]['grund_count']=$adr["grund_count"];

        $index++;
    }

     print json_encode($json);



?>
