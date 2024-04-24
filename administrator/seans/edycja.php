<?php
	session_start();
	require_once('../../connect.php');
	
	if(isset($_SESSION['admin'])){
		$id = $_POST['id_seansu'];
		$result = $mysqli->query("SELECT * FROM seans WHERE IDSeansu = '$id'" );
		$row = $result->fetch_array();			
		$dodane = FALSE;
		
		if(isset($_POST['nazwa'])){
			$nazwa=$_POST['nazwa'];
			if($nazwa==$row['nazwa']){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($nazwa)){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}
			$stary_tytul = filter_filename($row['nazwa']);
			$nowy_tytul= filter_filename($nazwa);
			if(!rename($path_seans.$stary_tytul, $path_seans.$nowy_tytul)){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="<span>Nie zmieniono nazwy folderu!</span>";
				exit;				
			}			
			$result = $mysqli->query("UPDATE `seans` SET `nazwa` = '$nazwa' WHERE IDSeansu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_seans.php?id_seansu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['data'])){
			$data=$_POST['data'];
			if($data==$row['data']){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($data)){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `seans` SET `data` = '$data' WHERE IDSeansu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_seans.php?id_seansu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['godzina'])){
			$godzina=$_POST['godzina'];
			if($godzina==$row['godzina']){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($godzina)){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `seans` SET `godzina` = '$godzina' WHERE IDSeansu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_seans.php?id_seansu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['IDFilmu'])){
			$film=$_POST['IDFilmu'];
			if($film==$row['IDFilmu']){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($film)){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `seans` SET `IDFilmu` = '$film' WHERE IDSeansu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_seans.php?id_seansu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['IDMiejsca'])){
			$miejsce=$_POST['IDMiejsca'];
			if($miejsce==$row['IDMiejsca']){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($miejsce)){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `seans` SET `IDMiejsca` = '$miejsce' WHERE IDSeansu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_seans.php?id_seansu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['cena'])){
			$cena=$_POST['cena'];
			if($cena==$row['cena']){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($cena)){
				header('Location: edytuj_seans.php?id_seansu='.$id);	
				$_SESSION['komunikat']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			$result = $mysqli->query("UPDATE `bilet` SET `cena` = '$cena' WHERE IDSeansu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_seans.php?id_seansu='.$id);
				exit;
			}
			$dodane = TRUE;
		}					
		if($dodane==TRUE){
			$_SESSION['komunikat']="<span style='color:green'>Seans został zmieniony.</span>"; 
			$mysqli->close();
			header('Location: index.php');
		}else{
			$_SESSION['komunikat']="Nie dokonano żadnej zmiany."; 
			$mysqli->close();
			header('Location: edytuj_seans.php?id_seansu='.$id);
		}			
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
	}
?>