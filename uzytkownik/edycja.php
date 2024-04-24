<?php
	session_start();
	require_once('../connect.php');
	
	if(isset($_SESSION['uzytkownik'])){
		$id = $_SESSION['uzytkownik'];
		$result = $mysqli->query("SELECT * FROM uzytkownik WHERE IDUzytkownika = '$id'" );
		$row = $result->fetch_array();
		$dodane = FALSE;
		
		if(isset($_POST['e-mail'])){
			$email=$_POST['e-mail'];
			$email_ctrl= filter_var($email, FILTER_SANITIZE_EMAIL);
			if (empty($email)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			if($email_ctrl==$row['e-mail']){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}	
			if ((filter_var($email_ctrl, FILTER_VALIDATE_EMAIL)==false) || ($email_ctrl!=$email)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']='E-mail jest niepoprawny!';
				exit;
			}
			$result = $mysqli->query("UPDATE uzytkownik SET `e-mail` = '$email' WHERE IDUzytkownika = $id");
			if($mysqli->connect_errno){
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_uzytkownika.php');
				exit;
			}
			$dodane = TRUE;
		}
		
		if(isset($_POST['login'])){
			$login=$_POST['login'];
			if (empty($login)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane nie mogą być puste!</span>";
				exit;
			}			
			if($login==$row['login']){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}				
			if ((strlen($login)<3) || (strlen($login)>20)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']='Login musi posiadać od 3 do 20 znaków!';
				exit;
			}
			if(ctype_alnum($login)==false){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']='Login musi się składać tylko z cyfer i liczb!';
				exit;
			}			
			$result = $mysqli->query("UPDATE uzytkownik SET `login` = '$login' WHERE IDUzytkownika = $id");
			if($mysqli->connect_errno){
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_uzytkownika.php');
				exit;
			}
			$dodane = TRUE;
		}
		
		if(isset($_POST['imie'])){
			$imie=$_POST['imie'];
			if($imie==$row['imie']){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($imie)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane nie mogą być puste!</span>";
				exit;
			}
			$result = $mysqli->query("UPDATE uzytkownik SET `imie` = '$imie' WHERE IDUzytkownika = $id");			
			if($mysqli->connect_errno){
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_uzytkownika.php');
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['nazwisko'])){
			$nazwisko=$_POST['nazwisko'];
			if($nazwisko==$row['nazwisko']){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (empty($nazwisko)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane nie mogą być puste!</span>";
				exit;
			}
			$result = $mysqli->query("UPDATE uzytkownik SET `nazwisko` = '$nazwisko' WHERE IDUzytkownika = $id");			
			if($mysqli->connect_errno){
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_uzytkownika.php');
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['wiek'])){			
			$wiek=$_POST['wiek'];
			if (empty($wiek)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane nie mogą być puste!</span>";
				exit;
			}				
			if($wiek==$row['wiek']){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if (($wiek<1) || ($wiek >150)){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']='Wiek jest niepoprawny!';
				exit;
			}		
			$result = $mysqli->query("UPDATE uzytkownik SET `wiek` = '$wiek' WHERE IDUzytkownika = $id");
			if($mysqli->connect_errno){
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_uzytkownika.php');
				exit;
			}
			$dodane = TRUE;
		}
		if(isset($_POST['telefon'])){
			$telefon=$_POST['telefon'];
			if($telefon==$row['telefon']){
				header('Location: edytuj_uzytkownika.php');	
				$_SESSION['edytuj_uzytkownika']="<span>Dane które edytujesz są takie same!</span>";
				exit;
			}			
			if ((strlen($telefon)!=9 || (is_int($telefon))==TRUE) && !empty($telefon)){
				header("Location: edytuj_uzytkownika.php");	
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Numer telefonu jest niepoprawny. Musi się składać z 9 cyfr!</span>";
				exit;
		}
			$result = $mysqli->query("UPDATE uzytkownik SET `telefon` = '$telefon' WHERE IDUzytkownika = $id");		
			if($mysqli->connect_errno){
				$_SESSION['edytuj_uzytkownika']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header('Location: edytuj_uzytkownika.php');
				exit;
			}
			$dodane = TRUE;
		}
		
		if($dodane==TRUE){
			$_SESSION['edytuj_uzytkownika']="<span style='color:green'>Dane użytkownika zostały zmienione.</span>"; 
			$mysqli->close();
			header('Location: edytuj_uzytkownika.php');
		}else{
			$_SESSION['edytuj_uzytkownika']="Nie dokonano żadnej zmiany."; 
			$mysqli->close();
			header('Location: edytuj_uzytkownika.php');
		}
	}else{
		header('Location: ../index.php');
	}
?>