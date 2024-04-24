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
					<li><a href='uzytkownik'><?php echo $_SESSION['uzytkownik'] ?></a></li>
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
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav>
					<a href='../index.php'>REPERTUAR</a>
					<a href='../seanse.php'>SEANSE</a>
					<a href='../miejsca.php'>MIEJSCA</a>
					<a href>O NAS</a>
					<a href>KONTAKT</a>	
			</nav>
        </header>
		<section>
		
			<h2></h2>
			<?php
				if(isset($_SESSION['uzytkownik'])){ 
					$result=$mysqli->query("SELECT IDUzytkownika FROM uzytkownik WHERE login = '".$_SESSION['uzytkownik']."'");
					$id = $result->fetch_array();
					$result=$mysqli->query("SELECT * FROM bilet WHERE IDUzytkownika = ".$id[0]);
					echo "<h2>Bilety:</h2>";
					$i=0;
					echo "<div id='bilety'>";
					while ($row = $result->fetch_array()){
						if($i==0){
							echo "<div class='bilety_kolumna'>";
						}
						echo "<div class='numer_biletu'><b><a href='bilet.php?numer_biletu=".$row[0]."'>".$row[0]."</a></b></div>";	
						$i++;
						if($i==10){
							echo "</div>";
							$i=0;
						}
					}
					if($i!=10){
						echo "</div><div style='clear:both'></div></div>";
					}
					if(isset($_SESSION['komunikat'])){
						echo "<b>".$_SESSION['komunikat']."</b>";
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