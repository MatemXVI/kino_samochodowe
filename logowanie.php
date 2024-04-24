<!doctype html>
<?php
	session_start();
	if (isset($_SESSION['uzytkownik'])){
		header('Location: index.php');
		exit;
	}
	require_once('connect.php');
	if (isset($_POST['logowanie'])){
	$login=htmlentities(trim($_POST['login']), ENT_QUOTES, "UTF-8");
	$haslo=htmlentities(trim($_POST['haslo']), ENT_QUOTES, "UTF-8");
	if (empty($login) || empty($haslo)){
		$_SESSION['komunikat']='Brak loginu lub hasła!';
		header("Refresh: 0");
		exit;
	}
	$query="SELECT * FROM `uzytkownik` WHERE login='$login'";
	$result=$mysqli->query($query);
	if($mysqli->connect_errno){
		$_SESSION['komunikat']="<span style='color:red'>Błąd w wykonaniu zapytania!</span>";
		header("Refresh: 0");
		exit;
	}
	$row = $result->fetch_array();
	if($result->num_rows>0 && (password_verify($haslo, $row['haslo']))){
		$_SESSION['uzytkownik']=$login;
		header('Location: index.php');
	}else{
		$_SESSION['komunikat']="<span style='color:red'>Brak użytkownika lub niepoprawne dane!</span>"; 
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
		<link rel="stylesheet" href="style.css">
		<script src="jquery-3.6.4.min.js"></script>
		<script>
			$(document).ready(function(){			
				$("#przycisk_formularz").click(function(e) {
					$(".information").hide();
					$(".error").hide();
					e.preventDefault();
					var login = $("#login").val();
					var haslo = $("#haslo").val();
					$.ajax({
						url: 'logowanie_ajax.php',
						method: 'POST',
						data:{
							login: login,
							haslo: haslo
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
			<div class = "formularz">
				<h1>Zaloguj się</h1>
				<form action="logowanie.php" method="POST" id="logowanie">
					<div class="pole_formularza"><label>Login:<br><input type="text" id="login" name="login" ></label></div>
					<div class="pole_formularza"><label>Hasło:<br><input type="password" id="haslo" name="haslo" required></label></div>
					<div class="przycisk_formularz"><input type="submit" id ="przycisk_formularz" name="logowanie" value="Zaloguj się"></div>
				</form>
			</div>
			<span class="information"></span>
			<span class="error"></span>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<b>".$_SESSION['komunikat']."</b>";
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