<?php


if(isset($_POST['username']) && isset($_POST['password'])){

    include 'configuration.php';

    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $admin_option="0";

    $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die
            ("Datenbankfehler");

    mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank auth nicht waehlen.");

    $sql = "SELECT uid FROM administrators WHERE uid='".$username."'";

    $admin_query = mysql_query($sql) or die("Falsche oder fehlende ID");

    $admin_array = array();
    $index = 0;

    while ($items = mysql_fetch_array($admin_query)){
          $admin_array[$index] = $items["uid"];
          $index++;
       }

    if (sizeof($admin_array)>0)  {
      $admin_option="1";
    }


    $ldaprdn  = 'uid='.$username.',cn=users,dc=filmuniversitaet,dc=de';

    $ldap = ldap_connect("ldaps://172.23.6.4")
         or die("Keine Verbindung zum LDAP server möglich.");

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

    if ($bind = ldap_bind($ldap, $ldaprdn, $password)) {
      session_start();
      $sr=ldap_search($ldap," dc=filmuniversitaet,dc=de", "uid=".$username);

      $info = ldap_get_entries($ldap, $sr);

      for ($i=0; $i<$info["count"]; $i++) {
                 $_SESSION["login"]="1";
                 $_SESSION["mail"]= $info[$i]["mail"][0];
                 $_SESSION["telephone"]= $info[$i]["telephonenumber"][0];
                 $_SESSION["user"]=$info[$i]["cn"][0];
                 $_SESSION["uid"]=$info[$i]["uid"][0];

                }

      if ($admin_option=="1") {
        $_SESSION["admin"]="1";
        header("Location: /admin/all_bookings.php");
        ldap_close($ldap);
      } else {
        session_start();
        $_SESSION["login"]='';
        $_SESSION["admin"]='0';
        header("Location: /admin/index.php?login=not_admin");

      }

    } else {

          $connection=mysql_connect($mysqlhost, $mysqluser, $mysqlpwd) or die
                ("Datenbankfehler");

          mysql_select_db($mysqldb, $connection) or die("Konnte die Datenbank auth nicht waehlen.");

          $sql = "SELECT password FROM local_administrators WHERE user='".$username."'";

          $admin_query = mysql_query($sql) or die("Anfragefehler Lokaler Admin");

          $admin_array = array();
          $index = 0;

          while ($items = mysql_fetch_array($admin_query)){
                $admin_array[$index] = $items["password"];
                $index++;
             }


          $local_admin="0";

          for ($y=0;$y<sizeof($admin_array);$y++) {
            if (md5($password)==$admin_array[$y]){
                $local_admin="1";
            }
          }

          if ($local_admin=="1") {
            session_start();
            $_SESSION["login"]="1";
            $_SESSION["user"]=$username;
            $_SESSION["uid"]=$username;
            $_SESSION["admin"]='1';
            header("Location: /admin/all_bookings.php");
            ldap_close($ldap);

          } else {

            session_start();
            $_SESSION["login"]='';
            header("Location: /admin/index.php?login=wrong_credentials");

          }

    }

}else{
  session_start();
  $_SESSION["login"]='';
  header("Location: /admin/index.php?login=wrong_credentials");

}

?>
