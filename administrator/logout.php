<?php
session_start();
session_unset();

header("Location: administrator_logowanie.php");

$_SESSION['komunikat']="Zostałeś wylogowany";
?>