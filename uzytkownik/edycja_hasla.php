<?php
	session_start();
	require_once('../connect.php');
	
	if(isset($_SESSION['uzytkownik'])){
		$id = $_SESSION['uzytkownik'];
		$dodane = FALSE;
		$haslo=$_POST['haslo'];
		$powt_haslo=$_POST['powt_haslo'];
			if (empty($haslo)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_haslo']="<span>Hasło nie może być puste!</span>";
				exit;
			}			
			if ((strlen($haslo)<4) || (strlen($haslo)>20)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_haslo']='<span>Hasło musi się składać z 4 do 20 znaków!</span>';
				exit;
			}				
			if ($powt_haslo!=$haslo){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_haslo']='<span>Hasła się nie zgadzają!</span>';
				exit;
			}
			$haslo = password_hash($haslo, PASSWORD_DEFAULT);
			$result = $mysqli->query("UPDATE uzytkownik SET `haslo` = '$haslo' WHERE IDUzytkownika = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: index.php');
				exit;
			}
			$dodane = TRUE;
		
		
		if($dodane==TRUE){
			$_SESSION['edytuj_haslo']="<span style='color:green'>Hasło zostało zmienione.</span>"; 
			$mysqli->close();
			header('Location: edytuj_uzytkownika.php');
		}else{
			$_SESSION['edytuj_haslo']="<span>Nie zmieniono hasła.</span>"; 
			$mysqli->close();
			header('Location: edytuj_uzytkownika.php');
		}
	}else{
		header('Location: ../index.php');
	}
?>