<?php
	session_start();
	require_once('../../connect.php');
	
	if(isset($_SESSION['admin'])){
		try{
			$mysqli = new mysqli($host, $username, $password, $db_name);
			if ($mysqli->connect_errno){
				throw new Exception(mysqli_connect_errno);
			}
		}
		catch(Exception $e){
			$_SESSION['komunikat']="<span style='color:red'>Wystąpił błąd:<br><i>".$e->getMessage()."<br> Błąd nr: ".$e->getCode()."</i><br>Spróbuj ponownie.</span>";
			header('Location: edytuj_haslo.php');
			exit;		
		}
		$id = $_POST['id_uzytkownika'];
		$dodane = FALSE;
		$haslo=$_POST['haslo'];
		$powt_haslo=$_POST['powt_haslo'];
			if (empty($haslo)){
				header('Location: edytuj_haslo.php');	
				$_SESSION['komunikat']="<span style='color:red'>Hasło nie może być puste!</span>";
				exit;
			}			
			if ((strlen($haslo)<4) || (strlen($haslo)>20)){
				header('Location: edytuj_haslo.php');	
				$_SESSION['komunikat']='Hasło musi się składać z 4 do 20 znaków!';
				exit;
			}				
			if ($powt_haslo!=$haslo){
				header('Location: edytuj_haslo.php');	
				$_SESSION['komunikat']='Hasła się nie zgadzają!';
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
			$_SESSION['komunikat']="<span style='color:green'>Hasło zostało zmienione.</span>"; 
			$mysqli->close();
			unset ($_SESSION['id_uzytkownika']);
			header('Location: index.php');
		}else{
			$_SESSION['komunikat']="Nie zmieniono hasła."; 
			$mysqli->close();
			header('Location: edytuj_haslo.php');
		}
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
	}
?>