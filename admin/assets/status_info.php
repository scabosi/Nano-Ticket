<?php
    include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/


    /*Mit Datenbank verbinden und Abfrage starten*/



    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht

    waehlen.");


     $sql = "SELECT status, COUNT(status) AS count FROM ticket GROUP BY status";

    $adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");


    $anzahl = mysql_num_rows($adressen_query);

	$index=0;

    while ($adr = mysql_fetch_array($adressen_query)){

        $json[$index]['status']=$adr['status'];
        $json[$index]['count']=$adr["count"];
        $index++;
    }

     print json_encode($json);



?>
