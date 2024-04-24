<?php
	session_start();
	if (isset($_SESSION['uzytkownik'])){
		header('Location: index.php');
		exit;
	}
	require_once('connect.php');	
	if (isset($_POST['rejestracja'])){
		$email=$_POST['e-mail'];
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
				header("Refresh: 0");	
				$komunikat='Konto już istnieje!';
				exit;
			}
			if ($login==$row['e-mail']){
				header("Refresh: 0");	
				$komunikat='Istnieje już konto z tym e-mailem!';
				exit;
			}
		}

		if ((filter_var($email_ctrl, FILTER_VALIDATE_EMAIL)==false) || ($email_ctrl!=$email)){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>E-mail jest niepoprawny!</span>";
			exit;
		}						
		if ((strlen($login)<3) || (strlen($login)>20)){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Login musi posiadać od 3 do 20 znaków!</span>";
			exit;
		}
		if(ctype_alnum($login)==false){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Login musi się składać tylko z cyfer i liczb!</span>";
			exit;
		}
		if ((strlen($haslo)<4) || (strlen($haslo)>20)){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Hasło musi się składać z 5 do 20 znaków!</span>";
			exit;
		}			
		if ($powt_haslo!=$haslo){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Hasła się nie zgadzają!</span>";
			exit;
		}					
		if (empty($email) || empty($login) || empty($haslo) || empty($powt_haslo) || empty($imie) || empty($nazwisko) || empty($wiek)){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Niektóre dane są puste!</span>";
			exit;
		}
		if (($wiek<1) || ($wiek >150)){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Wiek jest niepoprawny!</span>";
			exit;
		}
		if ((strlen($telefon)!=9 || (is_int($telefon))==TRUE) && !empty($telefon)){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Numer telefonu jest niepoprawny!</span>";
			exit;
		}		
		if(!isset($_POST['regulamin'])){
			header("Refresh: 0");	
			$komunikat="<span style='color:red'>Zaakceptuj regulamin!</span>";
			exit;
		}
		if(empty($telefon)){
			$telefon = "NULL";
		}
		$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
		$query = "INSERT INTO uzytkownik VALUES(NULL,'$imie','$nazwisko', '$wiek', '$email', '$login', '$haslo_hash', $telefon)";
		if ($mysqli->query($query)) {
			$_SESSION['uzytkownik']=$login;
			header('Location: index.php');
			$mysqli->close();
		}else{
		  $komunikat="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
		  header("Refresh: 0");
		  $mysqli->close();
		}
		$mysqli->close();
	}
?> 
<!doctype html>
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Kino Samochodowe</title>
		<link rel="stylesheet" href="style.css">
		<script src="jquery-3.6.4.min.js"></script>
		<script>
			$(document).ready(function(){			
				$("#przycisk_formularz").click(function(e) {
					$(".information").hide();
					$(".information").hide();
					e.preventDefault();
					var email = $("#e-mail").val();
					var login = $("#login").val();
					var haslo = $("#haslo").val();
					var powt_haslo = $("#powt_haslo").val();
					var imie = $("#imie").val();
					var nazwisko = $("#nazwisko").val();
					var wiek = $("#wiek").val();
					var telefon = $("#telefon").val();
					var regulamin = $("#regulamin").val();
					$.ajax({
						url: 'rejestracja_ajax.php',
						method: 'POST',
						data:{
							email: email,
							login: login,
							haslo: haslo,
							powt_haslo: powt_haslo,
							imie: imie,
							nazwisko: nazwisko,
							wiek: wiek,
							telefon: telefon,
							regulamin: regulamin
						},
						dataType: 'text',
						success: function (response){
							if (response == 'SUCCESS'){
								window.location = "index.php";	
							}else if(response === 'ERROR'){
								setTimeout(function(){
									$(".error").html(response);	
									$(".error").show();}, 50);
							}else{
								setTimeout(function(){	
									console.log(response)
									$(".information").html(response);	
									$(".information").show();}, 50);
							}
						}
					})
				})
			});
		</script>
    </head>
    <body>
		<header>
			<div id="logged">
			</div>
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav>
				<a href='index.php'>REPERTUAR</a>
				<a href='seanse.php'>SEANSE</a>
				<a href='miejsca.php'>MIEJSCA</a>
				<a href>O NAS</a>
				<a href>KONTAKT</a>			
			</nav>
        </header>
		<section>	
			<h1>Zarejestruj się</h1>
			<div class="formularz">
				<form method="post">
					<table align="center">
						<tr>
							<td><label>Adres e-mail<sup>*</sup>:<br><input type="text" id="e-mail" name="e-mail"></label></td>
							<td><label>Login<sup>*</sup>:<br><input type="text" id="login" name="login"></label></td>
						</tr><tr>
							<td><label>Imię<sup>*</sup>:<br><input type="text" id="imie" name="imie"></label></td>					
							<td><label>Hasło<sup>*</sup>:<br><input type="password" id="haslo" name="haslo"></label></td>
						</tr><tr>			
							<td><label>Nazwisko<sup>*</sup>:<br><input type="text" id="nazwisko" name="nazwisko"></label></td>
							<td><label>Potwierdź hasło<sup>*</sup>:<br><input type="password" id="powt_haslo" name="powt_haslo"></label></td>			
						</tr><tr>
							<td><label>Wiek<sup>*</sup>:<br><input type="number" id="wiek" name="wiek" min="1"></label></td>
							<td><label>Telefon:<br><input type="text" id="telefon" name="telefon"></label></td></tr>			
					</table>	
					<div class="przycisk_formularz"><input type="checkbox" id="regulamin" name="regulamin" /><label for='regulamin'>Akceptuję regulamin</label></div>					
					<div class="przycisk_formularz"><input type="submit" id="przycisk_formularz" name="rejestracja" value="Zarejestruj" /></div>							
				</form>
			</div>
			<span class="error"></span>
			<span class="information"></span>
			<?php
				if(isset($komunikat)){
					echo "<b>".$komunikat."</b>";
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