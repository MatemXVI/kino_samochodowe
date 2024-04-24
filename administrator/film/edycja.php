<?php
	session_start();
	require_once('../../connect.php');
	require_once('../../functions.php');
	
	if(isset($_SESSION['admin'])){
		$id = $_POST['id_filmu'];
		$result = $mysqli->query("SELECT * FROM film WHERE IDFilmu = '$id'" );
		$row = $result->fetch_array();			
		$dodane = FALSE;
		
		if(isset($_POST['tytul'])){
			$tytul=$_POST['tytul'];
			if($tytul==$row['tytul']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}			
			if (empty($tytul)){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane nie mogą być puste!";
				exit;
			}
			$stary_tytul = filter_filename($row['tytul']);
			$nowy_tytul=filter_filename($tytul);
			if(!rename($path_film.$stary_tytul, $path_film.$nowy_tytul)){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Nie zmieniono nazwy folderu!";
				exit;				
			}
			$result = $mysqli->query("UPDATE film SET `tytul` = '$tytul' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['rezyseria'])){
			$rezyseria=$_POST['rezyseria'];
			if($rezyseria==$row['rezyseria']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}					
			$result = $mysqli->query("UPDATE film SET `rezyseria` = '$rezyseria' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['obsada'])){
			$obsada=$_POST['obsada'];
			if($obsada==$row['obsada']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}					
			$result = $mysqli->query("UPDATE film SET `obsada` = '$obsada' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['scenariusz'])){
			$scenariusz=$_POST['scenariusz'];
			if($scenariusz==$row['scenariusz']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}						
			$result = $mysqli->query("UPDATE film SET `scenariusz` = '$scenariusz' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['gatunek'])){
			$gatunek=$_POST['gatunek'];
			if($gatunek==$row['gatunek']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}					
			$result = $mysqli->query("UPDATE film SET `gatunek` = '$gatunek' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}	
		if(isset($_POST['czas_trwania'])){
				$czas_trwania=$_POST['czas_trwania'];
			if($czas_trwania==$row['czas_trwania']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}			
			if (empty($czas_trwania)){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane nie mogą być puste!";
				exit;
			}				
				$result = $mysqli->query("UPDATE film SET `czas_trwania` = '$czas_trwania' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['kraj'])){
			$kraj=$_POST['kraj'];
			if($kraj==$row['kraj']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}					
			$result = $mysqli->query("UPDATE film SET `kraj` = '$kraj' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['rok_produkcji'])){
			$rok_produkcji=$_POST['rok_produkcji'];
			if($rok_produkcji==$row['rok_produkcji']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}					
			$result = $mysqli->query("UPDATE film SET `rok_produkcji` = '$rok_produkcji' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['opis'])){
			$opis=$_POST['opis'];
			if($opis==$row['opis']){
				header('Location: edytuj_film.php?id_filmu='.$id);	
				$_SESSION['komunikat']="Dane które edytujesz są takie same!";
				exit;
			}					
			$result = $mysqli->query("UPDATE film SET `opis` = '$opis' WHERE IDFilmu = $id");
			if($mysqli->connect_errno){
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_film.php?id_filmu='.$id);
				exit;
			}
			$dodane = TRUE;
		}		
		
		if($dodane==TRUE){
			$_SESSION['komunikat']="<span style='color:green'>Film został zmieniony.</span>"; 
			$mysqli->close();
			header('Location: index.php');
		}else{
			$_SESSION['komunikat']="Nie dokonano żadnej zmiany."; 
			$mysqli->close();
			header('Location: edytuj_film.php?id_filmu='.$id);
		}
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!";
	}
?>