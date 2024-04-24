<!doctype html>
<?php
	session_start();
	require_once('../connect.php');

	if (isset($_POST['logowanie'])){
		$login=htmlentities(trim($_POST['login']), ENT_QUOTES, "UTF-8");
		$haslo=htmlentities(trim($_POST['haslo']), ENT_QUOTES, "UTF-8");
		if (empty($login) || empty($haslo)){
			$_SESSION['komunikat']='Brak loginu lub hasła!';
			header("Refresh: 0");
			exit;
		}
		try{
			$mysqli = new mysqli($host, $username, $password, $db_name);
			if ($mysqli->connect_errno){
				throw new Exception(mysqli_connect_errno);
			}
		}
		catch(Exception $e){
			$_SESSION['komunikat']="<span style='color:red'>Wystąpił błąd:<br><i>".$e->getMessage()."<br> Błąd nr: ".$e->getCode()."</i><br>Spróbuj ponownie.</span>";
			header("Refresh: 0");
			exit;		
		}
		$query="SELECT * FROM `administrator` WHERE login='$login'";
		$result=$mysqli->query($query);
		if($mysqli->connect_errno){
			$_SESSION['komunikat']='Błąd w wykonaniu zapytania!';
			header("Refresh: 0");
			exit;
		}
		$row = $result->fetch_array();
		if($result->num_rows>0 && (password_verify($haslo, $row['haslo']))){
			$result=$mysqli->query("SELECT IDAdministratora FROM administrator WHERE login='$login'");
			$id_usera = $result->fetch_array();
			$_SESSION['admin']=$id_usera[0];
			$_SESSION['login_administratora']=$login;
			header('Location: index.php');
		}else{
			$_SESSION['komunikat']="Brak użytkownika lub niepoprawne dane!"; 
			header("Refresh: 0");
			exit;
		}
		$mysqli->close();
	}
	
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Logowanie</title>
		<link rel="stylesheet" href="../style.css">
    </head>
    <body>
		<header>			
<?php		if(isset($_SESSION['admin'])){ 
				header('Location: index.php');
				exit;
			}else{
				echo "<div id='logged'></div>";
			}
?>			
				<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>		
				<nav class='administrator'>
					<a href='../'>Cofnij się do panelu użytkownika</a>
				</nav>
        </header>
		<section>
			<h1>Zaloguj się</h1>
			<div class="formularz">
				<h4>Panel administratora</h4>		
				<form method="POST">
					<div class="pole_formularza"><label>Login:<br><input type="text" name="login" required></label></div>
					<div class="pole_formularza"><label>Hasło:<br><input type="password" name="haslo" required></label></div>
					<div class="przycisk_formularz"><input type="submit" name="logowanie" value="Zaloguj się"></div>
				</form>
			</div>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<span style='color:red'><b>".$_SESSION['komunikat']."</b></span><br>";
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