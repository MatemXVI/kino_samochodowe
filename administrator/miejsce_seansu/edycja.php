<?php
	session_start();
	require_once('../../connect.php');

	if(isset($_SESSION['admin'])){
		$id = $_POST['id_miejsca'];
		$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca = '$id'" );
		$row = $result->fetch_array();			
		$dodane = FALSE;
		
		if(isset($_POST['miejscowosc'])){
			$miejscowosc=$_POST['miejscowosc'];
			if($miejscowosc==$row['miejscowosc']){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($miejscowosc)){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `miejsce_seansu` SET `miejscowosc` = '$miejscowosc' WHERE IDMiejsca = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);
				exit;
			}	
			$dodane = TRUE;
		}
		if(isset($_POST['ulica'])){
			$ulica=$_POST['ulica'];
			if($ulica==$row['ulica']){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($ulica)){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `miejsce_seansu` SET `ulica` = '$ulica' WHERE IDMiejsca = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['rodzaj_miejsca'])){
			$rodzaj_miejsca=$_POST['rodzaj_miejsca'];
			if($rodzaj_miejsca==$row['rodzaj_miejsca']){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($rodzaj_miejsca)){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `miejsce_seansu` SET `rodzaj_miejsca` = '$rodzaj_miejsca' WHERE IDMiejsca = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['ilosc_miejsc_parkingowych'])){
			$ilosc_miejsc_parkingowych=$_POST['ilosc_miejsc_parkingowych'];
			if($ilosc_miejsc_parkingowych==$row['ilosc_miejsc_parkingowych']){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($ilosc_miejsc_parkingowych)){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `miejsce_seansu` SET `ilosc_miejsc_parkingowych` = '$ilosc_miejsc_parkingowych' WHERE IDMiejsca = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['dodatkowe_informacje'])){
			$dodatkowe_informacje=$_POST['dodatkowe_informacje'];
			if($dodatkowe_informacje==$row['dodatkowe_informacje']){
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}						
			$result = $mysqli->query("UPDATE `miejsce_seansu` SET `dodatkowe_informacje` = '$dodatkowe_informacje' WHERE IDMiejsca = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if($dodane==TRUE){
			$_SESSION['komunikat']="<span style='color:green'>Miejsce zostało zmienione.</span>"; 
			$mysqli->close();
			header('Location: index.php');
		}else{
			$_SESSION['komunikat']="Nie dokonano żadnej zmiany."; 
			$mysqli->close();
			header('Location: edytuj_miejsce_seansu.php?id_miejsca='.$id);
		}	
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
	}
?>