<?php
	/*Zugang zur Datenbank*/
	
    $mysqlhost="localhost"; // MySQL-Host angeben
	$mysqluser="root"; // MySQL-User angeben
	$mysqlpwd="root"; // Passwort angeben
	$mysqldb="ticketsystem"; // Gewuenschte Datenbank angeben
    $optiontab; //Tabellenzeilen einschränken
    
    /*Links des Adminbereichs*/
    
    $alle_tickets_link="/admin/tickets_view_all.php?optiontab=1";
    $neue_tickets_link="/admin/tickets_view_new.php?optiontab=1";
    $offene_tickets_link="/admin/tickets_view_open.php?optiontab=1";
	$geschlossene_tickets_link="/admin/tickets_view_closed.php?optiontab=1";
	
	$filter_raum_link="/admin/tickets_filter_room.php?optiontab=1";
	$filter_user_link="/admin/tickets_filter_user.php?optiontab=1";
	$filter_grund_link="/admin/tickets_filter_grund.php?optiontab=1";
	$ticket_suchen_link="/admin/tickets_suchen.php?optiontab=1";
	
	$setup_user_link="/admin/system_setup_user.php?optiontab=1";
	$setup_admin_link="#";
	$setup_raum_link="/admin/system_setup_raum.php?optiontab=1";
	$setup_grund_link="/admin/system_setup_grund.php?optiontab=1";
	$setup_system_link="/admin/system_setup.php";
        
?>