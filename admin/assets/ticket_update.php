<?php

 include 'configuration_admin.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/


$text= $_POST['text_admin'];
$index= $_POST['index'];
$status=$_POST['status'];
$update_date=date("Y-m-d H:i:s");



 $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die

    ("Verbindungsversuch fehlgeschlagen");

 mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank nicht waehlen.");

$sql = "UPDATE ticket SET text_admin = '".$text."' ,status='".$status."' ,update_date='".$update_date."' WHERE ticket.id ='".$index."'";

mysql_query($sql) or die ("sql eintrag fehler");

mysql_close($verbindung);

print "OK";


?>
