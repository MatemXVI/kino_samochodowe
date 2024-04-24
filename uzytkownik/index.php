<!doctype html>
<?php
	session_start();
	require_once('../connect.php');
	
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Logowanie</title>
		<link rel="stylesheet" href="../style.css">
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['uzytkownik'])){ 							?>
			<div id="logged">
				<ul>
					<li><a href='../index.php'><?php echo $_SESSION['uzytkownik'] ?></a></li>
					<li><a href='../logout.php'>Wyloguj się</a></li>
				</ul>
			</div>
					
<?php		}else{												?>
			<div id="logged">
			 	<ul>
					<li><a href='../logowanie.php'>Zaloguj się</a></li>
					<li><a href='../rejestracja.php'>Zarejestruj się</a></li>
				</ul>
			</div>
<?php 			} 																?>
			<h1><a href='../index.php'>KINO SAMOCHODOWE</a></h1>
			<nav>
					<a href='../index.php'>REPERTUAR</a>
					<a href='../seanse.php'>SEANSE</a>
					<a href='../miejsca.php'>MIEJSCA</a>
					<a href>O NAS</a>
					<a href>KONTAKT</a>	
			</nav>
        </header>
		<section>
			<?php
				if(isset($_SESSION['uzytkownik'])){ 
					$result=$mysqli->query("SELECT login FROM uzytkownik WHERE login = '".$_SESSION['uzytkownik']."'");
					$row = $result->fetch_array();
					echo "<h2>".$row['login']."</h2>";
					?>
					<div id="user">
						<div class="ustawienia_user">
						<b><a href="bilety.php">Bilety</a></b>
						</div>
						<div class="ustawienia_user">
						<b><a href="edytuj_uzytkownika.php">Zmień dane</a></b>
						</div>					
					</div>
					<?php
					if(isset($_SESSION['komunikat'])){
						echo "<span style='color:red'><b>".$_SESSION['komunikat']."</b></span>";
						unset($_SESSION['komunikat']);
					}	
				}else{
					header("Location: index.php");
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
			</ul>
        </footer>
    </body>
</html>