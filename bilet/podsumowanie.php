<!doctype html>
<?php
	session_start();
	require_once('../connect.php');
	if(isset ($_POST['platnosc']) && !empty ($_POST['platnosc'])){
		if (isset($_POST['numer_miejsca_parkingowego']) && isset($_POST['id_seansu'])){
			$miejsce_parkingowe = $_POST['numer_miejsca_parkingowego'];
			$wybrany_seans = $_POST['id_seansu'];
			$uzytkownik = $_SESSION['uzytkownik'];
			$query_bilet = "SELECT film.tytul, seans.data, seans.godzina, seans.nazwa,  miejsce_seansu.miejscowosc, miejsce_seansu.ulica, miejsce_seansu.rodzaj_miejsca, bilet.NumerMiejscaParkingowego, bilet.cena   
			FROM `bilet`
			INNER JOIN seans
			ON seans.IDSeansu = bilet.IDSeansu
			INNER JOIN film 
			ON film.IDFilmu = seans.IDFilmu
			INNER JOIN miejsce_seansu
			ON miejsce_seansu.IDMiejsca = seans.IDMiejsca
			WHERE bilet.NumerMiejscaParkingowego = $miejsce_parkingowe
			AND seans.IDSeansu = $wybrany_seans";
			$result_bilet = $mysqli->query($query_bilet);
			$row = $result_bilet->fetch_array();
			$result_uzytkownik = $mysqli->query("SELECT * FROM uzytkownik WHERE login = '$uzytkownik'");
			$user = $result_uzytkownik->fetch_array();
			$_SESSION['id'] = $user[0];
		}else{
			header("Location: ../index.php");
		}
	}else{
		$_SESSION['platnosc'] = "Wybierz płatność.";
		header("Location: platnosc.php");	
	}
?>
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Kino Samochodowe</title>
		<link rel="stylesheet" href="../style.css">
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['uzytkownik'])){ 							?>
			<div id="logged">
				<ul>
					<li><a href='../uzytkownik'><?php echo $_SESSION['uzytkownik'] ?></a></li>
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
				<a href=>WYBIERZ MIEJSCE PARKINGOWE</a>
				<a href=>BILET</a>
				<a href=>DANE OSOBOWE</a>
				<a href>PŁATNOŚĆ</a>
				<a href>PODSUMOWANIE</a>			
			</nav>
        </header>
		<nav class='administrator'>
		<a href='index.php'>Wróć do menu</a>
		</nav>
		<section>
		<h2>Podsumowanie</h2>
		<div id="podsumowanie">
			<div class="pods">
				<div><h4>Film:</h4></div>
				<div>Tytuł filmu:<b><?php echo $row[0] ?></b></div>
				<div>Piątek <b><?php echo $row[1] ?> godz. <?php echo $row[2] ?></b></div>
				<div>Seans: <b><?php echo $row[3] ?></b></div>
				<div>Miejsce: <b><?php echo $row[4] ?>, ul. <?php echo $row[5] ?>, <?php echo $row[6] ?></b></div>
				<div>Numer miejsca: <b><?php echo $row[7] ?></b></div>
				<div>Koszt biletu: <b><?php echo $row[8] ?> zł</b></div>
				<div><b>+ 1.5 zł opłaty internetowej za zakup</b></div>			
			</div>
			<div class="pods">
				<div><h4>Użytkownik:</h4></div>
				<div>Imię i nazwisko:<b><?php echo $user[1]." ".$user[2] ?></b></div>
				<div>Wiek:<b><?php echo $user[3] ?></b></div>
				<div>E-mail:<b><?php echo $user[4] ?></b></div>
				<div>Telefon:<b><?php echo $user[7] ?></b></div>
				<div></div>
				<div>Metoda płatności:<b><?php echo $_POST['platnosc'] ?></b></div>			
			</div>
		</div><br>
		<form action="wygeneruj_bilet.php" method="post">
		<input type="hidden" name="id_seansu" value=<?php echo $wybrany_seans ?> >
			<input type="hidden" name="numer_miejsca_parkingowego" value=<?php echo $miejsce_parkingowe ?> >
			<input type="hidden" name="cena" value=<?php echo $row[8] ?> >
			<input type="submit" value="Zakup bilet">
		</form>
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