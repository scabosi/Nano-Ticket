<?PHP

session_start();

$session_info = array();

$session_info[0]=$_SESSION["uid"];
$session_info[1]=$_SESSION["mail"];
$session_info[2]=$_SESSION["telephone"];
$session_info[3]=$_SESSION["user"];
print json_encode($session_info);


?>
