<?php
    include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/


    /*Mit Datenbank verbinden und Abfrage starten*/


    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht

    waehlen.");


     $sql = "SELECT MONTH(datum) AS month,count(*) as count FROM ticket GROUP BY MONTH(datum) ORDER BY datum LIMIT 6";

    $adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");


    $anzahl = mysql_num_rows($adressen_query);


	$json = array();
    $index = 0;

    while ($adr = mysql_fetch_array($adressen_query)){

        $json[$index]['month']=$adr['month'];
        $json[$index]['count']=$adr["count"];

        $index++;
    }

     print json_encode($json);



?>
