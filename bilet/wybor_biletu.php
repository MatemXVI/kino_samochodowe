<!doctype html>
<?php
	session_start();
	require_once('../connect.php');
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
		<aside>

		</aside>
		<section>
			<?php
				if(isset($_SESSION['uzytkownik']) && $_GET['numer_miejsca_parkingowego'] ){			
					$miejsce_parkingowe = $_GET['numer_miejsca_parkingowego'];
					$wybrany_seans = $_GET['id_seansu'];
					$data = date('Y-m-d H:i:s');
					$query_bilet = "SELECT film.tytul, seans.data, seans.godzina, seans.nazwa,  miejsce_seansu.miejscowosc, miejsce_seansu.ulica, bilet.NumerMiejscaParkingowego, bilet.cena     
					FROM `bilet`
					INNER JOIN seans
					ON seans.IDSeansu = bilet.IDSeansu
					INNER JOIN film 
					ON film.IDFilmu = seans.IDFilmu
					INNER JOIN miejsce_seansu
					ON miejsce_seansu.IDMiejsca = seans.IDMiejsca
					AND bilet.NumerMiejscaParkingowego = $miejsce_parkingowe
					AND seans.IDSeansu = $wybrany_seans";
					$result_bilet = $mysqli->query($query_bilet);
					$row = $result_bilet->fetch_array();
					//echo "<p>Cena: ".$row[0]." zł </p><p>Numer miejsca: ".$row[1]."</p><p>".$row[2]."</p><p>".$row[3]." ".$row[4]."</p><p>".$row[5]."</p><p>".$row[6]." ul.".$row[7]."</p>";
					?>
			<div id="wybor_biletu">
				<h3><?php echo $row[0] ?></h3>
				<p>Piątek <?php echo $row[1] ?> godz. <?php echo $row[2] ?></p>
				<p><?php echo $row[3] ?></p>
				<p><?php echo $row[4] ?>, ul. <?php echo $row[5] ?></p>
				Numer miejsca: <?php echo $row[6] ?>
				<p>Koszt biletu: <?php echo $row[7] ?> zł<br>
				+ 1.5 zł opłaty internetowej za zakup</p>
				<form action = "platnosc.php" method="get">
					<input type="hidden" name="numer_miejsca_parkingowego" value=<?php echo $miejsce_parkingowe ?> >
					<input type="hidden" name="id_seansu" value=<?php echo $wybrany_seans ?> >
					<input type="submit" value="Zatwierdź i podaj dane osobowe">
				</form>
			</div>
					<?php
					$mysqli->close();
					if(isset($_SESSION['komunikat'])){
						echo "<span><b>".$_SESSION['komunikat']."</b></span>";
						unset($_SESSION['komunikat']);
					}
				}
				else{
					$_SESSION['komunikat']="Musisz się zalogować, aby móc kupić bilet.";
					header('Location: ../logowanie.php');
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