<?php

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin = $_POST['admin_option'];

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
      header("Location: /ticket.php");
      ldap_close($ldap);

    } else {
      session_start();
      $_SESSION["login"]='';
      header("Location: /index.php?login=wrong_credentials");

    }

}else{
  session_start();
  $_SESSION["login"]='';
  header("Location: /index.php?login=wrong_credentials");

}

?>
