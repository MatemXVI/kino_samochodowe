<?php
ini_set('display_errors', 1);
$host = "localhost";
$username = "root";
$password = "";
$db_name = "kino_samochodowe";

	try{
		$mysqli = new mysqli($host, $username, $password, $db_name);
		if ($mysqli->connect_errno){
		throw new Exception(mysqli_connect_errno);
		}
	}
	catch(Exception $e){
		echo "<span style='color:red'><b>Wystąpił błąd (nr: ".$e->getCode()."):<br><i>".$e->getMessage()."</i><br>Spróbuj ponownie.</b></span>";
		header("Refresh: 0");
		exit;		
	}
	mysqli_query($mysqli,"SET NAMES utf8");

$path_film = "../../img/film/";
$path_seans = "../../img/seans/";
$path_miejsce = "../../img/miejsce_seansu/";
$path_film_index = "img/film/";
$path_seans_index ="img/seans/";
$path_miejsce_index ="img/miejsce_seansu/";
?>