<?php
	session_start();
	require_once('connect.php');
	if(isset($_POST['login'])){
		$email=$_POST['email'];
		$login=$_POST['login'];
		$haslo=$_POST['haslo'];
		$powt_haslo=$_POST['powt_haslo'];
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		$wiek=$_POST['wiek'];
		$telefon=$_POST['telefon'];
		$email_ctrl= filter_var($email, FILTER_SANITIZE_EMAIL);

		$result = $mysqli->query("SELECT `IDUzytkownika`, `login`, `e-mail` FROM uzytkownik");			
		while($row = $result->fetch_array()){
			if ($login==$row['login']){	
				echo 'Konto już istnieje!';
				exit;
			}
			if ($email==$row['e-mail']){
				echo 'Istnieje już konto z tym e-mailem!';
				exit;
			}
		}

		if ((filter_var($email_ctrl, FILTER_VALIDATE_EMAIL)==false) || ($email_ctrl!=$email)){;	
			echo "E-mail jest niepoprawny!";
			exit;
		}						
		if ((strlen($login)<3) || (strlen($login)>20)){
			echo "Login musi posiadać od 3 do 20 znaków!";
			exit;
		}
		if(ctype_alnum($login)==false){
			echo "Login musi się składać tylko z cyfer i liczb!";
			exit;
		}
		if ((strlen($haslo)<4) || (strlen($haslo)>20)){	
			echo "Hasło musi się składać z 5 do 20 znaków!";
			exit;
		}			
		if ($powt_haslo!=$haslo){	
			echo "Hasła się nie zgadzają!";
			exit;
		}					
		if (empty($email) || empty($login) || empty($haslo) || empty($powt_haslo) || empty($imie) || empty($nazwisko) || empty($wiek)){
			echo "Niektóre dane są puste!";
			exit;
		}
		if (($wiek<1) || ($wiek >150)){	
			echo "Wiek jest niepoprawny!";
			exit;
		}
		if ((strlen($telefon)!=9 || (is_int($telefon))==TRUE) && !empty($telefon)){	
			echo "Numer telefonu jest niepoprawny!";
			exit;
		}		
		if(!isset($_POST['regulamin'])){	
			echo "Zaakceptuj regulamin!";
			exit;
		}
		if(empty($telefon)){
			$telefon = "NULL";
		}
		$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
		$query = "INSERT INTO uzytkownik VALUES(NULL,'$imie','$nazwisko', '$wiek', '$email', '$login', '$haslo_hash', $telefon)";
		if ($mysqli->query($query)) {
			$_SESSION['uzytkownik']=$login;
			$mysqli->close();
			echo 'SUCCESS';
			exit;
			//echo "Witaj, $login. Rozgość się u nas :)";
		}else{
		echo 'ERROR';
		  echo "Error: " . $result . "<br>" . $mysqli->errno."";
		}
	}
?> 