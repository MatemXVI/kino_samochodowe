<?php
	session_start();
	require_once('connect.php');
	
	if (isset ($_POST['login']) || isset ($_POST['haslo'])){
		$login=htmlentities(trim($_POST['login']), ENT_QUOTES, "UTF-8");
		$haslo=htmlentities(trim($_POST['haslo']), ENT_QUOTES, "UTF-8");
		if (empty($login) || empty($haslo)){
			echo 'Brak loginu lub hasła!';
			exit;
		}
		$query="SELECT * FROM `uzytkownik` WHERE login='$login'";
		$result=$mysqli->query($query);
		if($mysqli->connect_errno){
			echo 'ERROR';
			echo 'Błąd w wykonaniu zapytania!';
			exit;
		}
		$row = $result->fetch_array();
		if($result->num_rows>0 && (password_verify($haslo, $row['haslo']))){
			$_SESSION['uzytkownik']=$login;
			$mysqli->close();
			echo 'SUCCESS';
			exit;
		}else{
			echo 'Brak użytkownika lub niepoprawne dane!';
			$mysqli->close();
			exit;
		} 
		$mysqli->close();
	}
?> 