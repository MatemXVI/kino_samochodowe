<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');

	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != 1){ 
		if(isset($_POST['rejestracja'])){
			$login=$_POST['login'];
			$haslo=$_POST['haslo'];
			$powt_haslo=$_POST['powt_haslo'];
			$imie=$_POST['imie'];
			$nazwisko=$_POST['nazwisko'];
			
			$_SESSION['pam_login']=$login;
			$_SESSION['pam_haslo']=$haslo;
			$_SESSION['pam_powt_haslo']=$powt_haslo;
			$_SESSION['pam_imie']=$imie;
			$_SESSION['pam_nazwisko']=$nazwisko;		
			$result = $mysqli->query("SELECT login FROM administrator");									   
			while($row = $result->fetch_array()){
				if ($login==$row['login']){
					$_SESSION['komunikat']='Konto już istnieje';
					header("Refresh: 0");
					exit;  
				}
			}
			if ((strlen($login)<3) || (strlen($login)>20)){
				header("Refresh: 0");	
				$_SESSION['komunikat']='Login musi posiadać od 3 do 20 znaków!';
				exit;
			}
			if(ctype_alnum($login)==false){
				header("Refresh: 0");	
				$_SESSION['komunikat']='Login musi się składać tylko z cyfer i liczb!';
				exit;
			}
			if ((strlen($haslo)<4) || (strlen($haslo)>20)){
				header("Refresh: 0");	
				$_SESSION['komunikat']='Hasło musi się składać z 4 do 20 znaków!';
				exit;
			}			
			if ($powt_haslo!=$haslo){
				$_SESSION['komunikat']='Hasła się nie zgadzają!';
				header("Refresh: 0");
				exit;
			}
			if (empty($login) || empty($haslo) || empty($powt_haslo) || empty($imie) || empty($nazwisko)){
				$_SESSION['komunikat']='Niektóre dane są puste!';
				header("Refresh: 0");
				exit;
			}
			$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
			$query = "INSERT INTO administrator VALUES(NULL,'$imie','$nazwisko', '$login', '$haslo_hash')";
			if ($mysqli->query($query)) {
				$_SESSION['komunikat']="<span style='color:green'>administrator został zarejestrowany.</span>";
				header('Location: index.php');
				$mysqli->close();
				exit;
			}	
			else{
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header("Refresh: 0");
				$mysqli->close();
				exit;
			}
		}	
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
	}
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Panel administracyjny</title>
		<link rel="stylesheet" href="../../style.css">
    </head>
    <body>		
		<header>
<?php		if(isset($_SESSION['administrator'])){ 							?>
				<div id="logged">
					<ul>
						<li><a href='../logout.php'>Wyloguj się</a></li>
					</ul>
				</div>
<?php		}																?>	
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav class='administrator'>
				<a href='index.php'>Wróć do menu</a>
			</nav>			
        </header>
		<section>
			<h1>Zarejestruj administratora</h1>
			<div class="formularz">
				<form method="POST">
					<table align="center">
						<tr>
							<td><label>Login:<br><input type="text" name="login" value="<?php
				if(isset($_SESSION['pam_login'])){
					echo $_SESSION['pam_login'];
					unset($_SESSION['pam_login']);
				}
				?>"/></label></td>
							<td><label>Hasło:<br><input type="password" name="haslo" value="<?php
				if(isset($_SESSION['pam_haslo'])){
					echo $_SESSION['pam_haslo'];
					unset($_SESSION['pam_haslo']);
				}
				?>" /></label></td>
						</tr><tr>
							<td><label>Imię:<br><input type="text" name="imie" value="<?php
				if(isset($_SESSION['pam_imie'])){
					echo $_SESSION['pam_imie'];
					unset($_SESSION['pam_imie']);
				}
				?>" /></label></td>					
							<td><label>Potwierdź hasło:<br><input type="password" name="powt_haslo" value="<?php
				if(isset($_SESSION['pam_powt_haslo'])){
					echo $_SESSION['pam_powt_haslo'];
					unset($_SESSION['pam_powt_haslo']);
				}
				?>"/></label></td>
						</tr><tr>
							<td><label>Nazwisko:<br><input type="text" name="nazwisko" value="<?php
				if(isset($_SESSION['pam_nazwisko'])){
					echo $_SESSION['pam_nazwisko'];
					unset($_SESSION['pam_nazwisko']);
				}
				?>"/></label></td></tr><br>
					</table><br>
							<input type="submit" name="rejestracja" value="Zarejestruj" />						
				</form></div>
			<?php	
				if(isset($_SESSION['komunikat'])){	
					echo "<b>".$_SESSION['komunikat']."</b>";
					if(isset($_SESSION['pam_login'])) unset($_SESSION['pam_login']);
					if(isset($_SESSION['pam_haslo'])) unset($_SESSION['pam_haslo']);
					if(isset($_SESSION['pam_powt_haslo'])) unset($_SESSION['pam_powt_haslo']);
					if(isset($_SESSION['pam_imie'])) unset($_SESSION['pam_imie']);
					if(isset($_SESSION['pam_nazwisko'])) unset($_SESSION['pam_nazwisko']);
					unset($_SESSION['komunikat']);
			}
			?>
        </section>
		<footer>
			<ul>
				<li><a href>Kino Samochodowe</a></li>
				<li><a href>Newsletter</a></li>
				<li><a href>Kontakt</a></li>
			</ul>
			<ul>
				<li><a href>Regulacje</a></li>
				<li><a href>Polityka prywatności</a></li>
				<li><a href>Polityka cookies</a></li>
			</ul>
			<ul>
				<li><a href>Facebook</a></li>
				<li><a href>Instagram</a></li>
				<li><a href>Twitter</a></li>
			</ul><br>
        </footer>
    </body>
</html>