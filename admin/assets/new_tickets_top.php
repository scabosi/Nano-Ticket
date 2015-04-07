<?php
    include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/


    /*Mit Datenbank verbinden und Abfrage starten*/


    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht

    waehlen.");


     $sql = " SELECT ticket.id,datum,zeit,raum.raum,grund.grund,status,text_user
		FROM ticket, grund,raum
		WHERE ticket.grund = grund.id
		AND ticket.raum=raum.id
		AND status='0'
		ORDER BY datum DESC,zeit DESC LIMIT 5";

    $adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");


    $anzahl = mysql_num_rows($adressen_query);


	$json = array();
    $index = 0;

    while ($adr = mysql_fetch_array($adressen_query)){

        $json[$index]['id']=$adr['id'];
        $json[$index]['datum']=$adr["datum"];
        $json[$index]['zeit']=$adr["zeit"];
        $json[$index]['raum']=$adr["raum"];
        $json[$index]['grund']=$adr["grund"];
        $json[$index]['status']=$adr["status"];
        if (strlen($adr["text_user"]) > 30) {
            $json[$index]['text_user']=substr($adr["text_user"], 0, 30)."...";
         } else {
            $json[$index]['text_user']=substr($adr["text_user"], 0, 30);
         }

        $index++;
    }

     print json_encode($json);



?>
