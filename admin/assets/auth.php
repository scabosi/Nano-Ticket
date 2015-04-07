<?php

include 'configuration.php'; /*Datenbankzugang und Links aus der Konfiguration lesen*/ 

 	$connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die
			("Datenbankfehler Auth-Methode");

 	mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank auth nicht waehlen.");
	
	$sql = "SELECT method FROM setup_auth";
			 
	$auth_query = mysql_query($sql) or die("DB-Anfrage auth nicht erfolgreich1");
	
	$auth = mysql_fetch_array($auth_query);
	
	$auth_method= $auth["method"];
	

//Anmeldung an ein LDAP Verzeichnis (OpenDirectory OSX-Server)


$pass=$_POST['password'];
$user=$_POST['username'];

$user=str_replace(' ','',$user); 


$connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die
            ("Datenbankfehler User");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank auth nicht waehlen.");


    
    $sql = "SELECT user_name,passwort,rechte,vorname,nachname FROM user_db WHERE user_name LIKE '".$user."'";

                 
    $user_query = mysql_query($sql) or die("DB-Anfrage auth nicht erfolgreich3");
    
    $user_ms = mysql_fetch_array($user_query);
    
    $user_temp  = $user_ms["user_name"];
    $pass_temp  = $user_ms["passwort"];
    $rechte_temp= $user_ms["rechte"];
    $vorname     =utf8_encode($user_ms["vorname"]);
    $nachname    =utf8_encode($user_ms["nachname"]);
   
    
    if ($pass==$pass_temp) {         
            session_start(); 
            $start=time();
            $_SESSION['time_start']=$start;
            $_SESSION["user"] = $user;
            $_SESSION["angemeldet"]="true";
            $session_id=session_id();
            $status='true';    

            $json = array(  'code' => "$status", 
                            'session' => "$session_id",
                            'vorname' => "$vorname",
                            'nachname' => "$nachname",
                            'rechte' => "$rechte_temp",
                       );

            error_log($nachname);

            print json_encode($json);
             
        }
        
    else {
            $status='false';
            $session_id=session_id();

            $json = array( 'code' => "$status", 
                       'session' => "$session_id" );
            print json_encode($json);
        
        }



  	
?>
