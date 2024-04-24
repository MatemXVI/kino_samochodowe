<?php
	session_start();
	require_once('../../connect.php');
	
	if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
		$id = $_POST['id_administratora'];
		$result = $mysqli->query("SELECT * FROM administrator WHERE IDAdministratora = '$id'" );
		$row = $result->fetch_array();		
		$dodane = FALSE;
		
		if(isset($_POST['imie'])){
			$imie=$_POST['imie'];
			if($imie==$row['imie']){
				header('Location: edytuj_administratora.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($imie)){
				header('Location: edytuj_administratora.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}		
			$result = $mysqli->query("UPDATE administrator SET `imie` = '$imie' WHERE IDAdministratora = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_administratora.php?id_administratora='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['nazwisko'])){
			$nazwisko=$_POST['nazwisko'];
			if($nazwisko==$row['nazwisko']){
				header('Location: edytuj_administratora.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($nazwisko)){
				header('Location: edytuj_administratora.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}		
			$result = $mysqli->query("UPDATE administrator SET `nazwisko` = '$nazwisko' WHERE IDAdministratora = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_administratora.php?id_administratora='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['login'])){
			$login=$_POST['login'];
			if($login==$row['login']){
				header('Location: edytuj_administratora.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($login)){
				header('Location: edytuj_administratora.php?id_administratora='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE administrator SET `login` = '$login' WHERE IDAdministratora = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_administratora.php?id_administratora='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		
		if($dodane==TRUE){
			$_SESSION['komunikat']="<span style='color:green'>Dane administratora zostały zmienione.</span>"; 
			$mysqli->close();
			header('Location: index.php');
		}else{
			$_SESSION['komunikat']="Nie dokonano żadnej zmiany."; 
			$mysqli->close();
			header('Location: edytuj_administratora.php?id_administratora='.$id);
		}
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
	}
?>