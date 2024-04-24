<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	
	if(isset($_SESSION['admin'])){	
		if(isset($_POST['dodawanie'])){
			$miejscowosc=$_POST['miejscowosc'];
			$ulica=$_POST['ulica'];
			$rodzaj_miejsca=$_POST['rodzaj_miejsca'];
			$ilosc_miejsc_parkingowych=$_POST['ilosc_miejsc_parkingowych'];
			$dodatkowe_informacje=$_POST['dodatkowe_informacje'];
			if (empty($miejscowosc) || empty($ulica) || empty($ilosc_miejsc_parkingowych)){
				$_SESSION['komunikat']='Podaj miejscowość, ulicę oraz ilość miejsc parkingowych!';
				header("Refresh: 0");
				exit;
			}
			$query = "INSERT INTO miejsce_seansu VALUES(NULL,'$miejscowosc','$ulica','$rodzaj_miejsca', '$ilosc_miejsc_parkingowych', '$dodatkowe_informacje', ".$_SESSION['admin'].")";
			if ($mysqli->query($query)){
				$result=$mysqli->query("SELECT IDMiejsca FROM miejsce_seansu ORDER BY IDMiejsca DESC LIMIT 1");
				$row=$result->fetch_array();
				if (!file_exists($path_miejsce.$row[0]) && !is_dir($path_miejsce.$row[0])) { 
					(mkdir($path_miejsce.$row[0]));
				}
				$_SESSION['komunikat']="<span style='color:green'>Miejsce zostało dodane do bazy.</span>";
				header('Location: index.php');
				$mysqli->close();
				exit;
			} else {
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header("Refresh: 0");
				exit;
			}
			$mysqli->close();
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
<?php		if(isset($_SESSION['admin'])){ 							?>
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
			<h1>Wprowadź miejsce seansu</h1>	
			<div class="formularz">
				<form method="post">
					<div class="pole_formularza_maly_odstep"><label>Miejscowość:<br><input type="text" name="miejscowosc" required></label></div>
					<div class="pole_formularza_maly_odstep"><label>Ulica:<br><input type="text" name="ulica" required></label></div>
					<div class="pole_formularza"><label>Rodzaj miejsca:<br><input type="text" name="rodzaj_miejsca" /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Ilość miejsc parkingowych: <input type="number" name="ilosc_miejsc_parkingowych" min="0" required></label></div>
					<div class="pole_formularza_maly_odstep"><label>Opis:<br><textarea name="dodatkowe_informacje" cols="1" rows="4" id="dodatkowe_informacje"></textarea></label></div>
					<div>Zdjęcia można dodawać przy edycji!</div>
					<div class="przycisk_formularz"><input type="submit" name="dodawanie" value="Dodaj" /></div>
				</form>
			</div>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<span style='color:red'><b>".$_SESSION['komunikat']."</b></span>";
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