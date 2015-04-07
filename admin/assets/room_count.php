<?php
    include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/


    /*Mit Datenbank verbinden und Abfrage starten*/


    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht

    waehlen.");


     $sql = "SELECT ticket.raum,raum.raum,raum.id ,COUNT(raum.raum) AS raum_count FROM ticket,raum WHERE ticket.raum = raum.id GROUP BY raum.raum ORDER BY raum_count DESC LIMIT 3";

    $adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");


    $anzahl = mysql_num_rows($adressen_query);


	$json = array();
    $index = 0;

    while ($adr = mysql_fetch_array($adressen_query)){

        $json[$index]['raum']=$adr['raum'];
        $json[$index]['raum_count']=$adr["raum_count"];

        $index++;
    }

     print json_encode($json);



?>
