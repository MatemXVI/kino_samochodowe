<?php
	session_start();
	require_once('../../connect.php');
	
	if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
		$id = $_POST['id_administratora'];
		$dodane = FALSE;
		$haslo=$_POST['haslo'];
		$powt_haslo=$_POST['powt_haslo'];
			if (empty($haslo)){
				header('Location: edytuj_haslo.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span style='color:red'>Hasło nie może być puste!</span>";
				exit;
			}				
			if ((strlen($haslo)<4) || (strlen($haslo)>20)){
				header('Location: edytuj_haslo.php?id_administratora='.$id);	
				$_SESSION['komunikat']='Hasło musi się składać z 4 do 20 znaków!';
				exit;
			}				
			if ($powt_haslo!=$haslo){
				header('Location: edytuj_haslo.php?id_administratora='.$id);	
				$_SESSION['komunikat']='Hasła się nie zgadzają!';
				exit;
			}
			$haslo = password_hash($haslo, PASSWORD_DEFAULT);
			$result = $mysqli->query("UPDATE administrator SET `haslo` = '$haslo' WHERE IDAdministratora = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: index.php');
				exit;
			}
			$dodane = TRUE;
		
		
		if($dodane==TRUE){
			$_SESSION['komunikat']="<span style='color:green'>Hasło zostało zmienione.</span>"; 
			$mysqli->close();
			header('Location: index.php');
			unset ($_SESSION['id_administratora']);
		}else{
			$_SESSION['komunikat']="Nie zmieniono hasła."; 
			$mysqli->close();
			header('Location: edytuj_haslo.php?id_administratora='.$id);
		}
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
	}
?>