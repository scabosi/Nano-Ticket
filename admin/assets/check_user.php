<?php 
session_start();  
if (!isset($_SESSION['angemeldet']) || !$_SESSION['angemeldet']) {
     header("Location: ./");
      exit;
      }
?> 