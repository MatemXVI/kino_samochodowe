<!doctype html>
<?php
	session_start();
	require_once('connect.php');
	require_once('functions.php');		
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Logowanie</title>
		<link rel="stylesheet" href="style.css">
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['uzytkownik'])){ 							?>
			<div id="logged">
				<ul>
					<li><a href='uzytkownik'><?php echo $_SESSION['uzytkownik'] ?></a></li>
					<li><a href='logout.php'>Wyloguj się</a></li>
				</ul>
			</div>
					
<?php		}else{												?>
			<div id="logged">
			 	<ul>
					<li><a href='logowanie.php'>Zaloguj się</a></li>
					<li><a href='rejestracja.php'>Zarejestruj się</a></li>
				</ul>
			</div>
<?php 			} 																?>
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
			<?php
			if(isset($_GET['id_seansu'])){
				$result=$mysqli->query("SELECT seans.nazwa, seans.data, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina, seans.nazwa_plakatu, film.IDFilmu, film.tytul, film.czas_trwania, miejsce_seansu.*, bilet.cena FROM seans INNER JOIN film ON film.IDFilmu = seans.IDFilmu INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca INNER JOIN bilet ON bilet.IDSeansu = seans.IDSeansu WHERE seans.IDSeansu = ".$_GET['id_seansu']);
				$row=$result->fetch_array();
				$nazwa= filter_filename($row['nazwa']);
			}else{
				header("Location: seanse.php");
			}
				
			?>
			<div id = "content">
				<div id="zdjecie_seansu">
				<img src = "<?php echo $path_seans_index.$nazwa."/".$row['nazwa_plakatu'] ?>" alt="" width="400" height="500"><br>
				</div>
				<div id="description_seans">
					<h2 class="tytul"><?php echo $row['nazwa'] ?></h2>
					<div id="informacje">
						<div class="linia"><b>Nazwa:</b> <?php echo $row['nazwa'] ?><hr></div>
						<div class="linia"><b>Data:</b> <?php echo $row['data'] ?><hr></div>
						<div class="linia"><b>Godzina:</b> <?php echo $row['godzina'] ?><hr></div>
						<div class="linia"><b>Czas trwania:</b> <?php echo $row['czas_trwania'] ?> min<hr></div>
						<div class="linia"><b>Miejscowość:</b> <?php echo $row['miejscowosc']." ul. ".$row['ulica'] ?><hr></div>
						<div class="linia"><b>Rodzaj miejsca:</b> <?php echo $row['rodzaj_miejsca'] ?><hr></div>
						<div class="linia"><b>Ilość miejsc:</b> <?php echo $row['ilosc_miejsc_parkingowych'] ?><hr></div>
						<div class="linia"><b>Cena biletu:</b> <?php echo $row['cena']?> zł<hr></div>
						<h3>Dźwięk z filmu będzie nadawany na stacji radiowej, której częstotliwość podamy przed seansem. W razie problemów technicznych prosimy wezwać pomoc.</h3>					
					</div>
				</div>
				<div style="clear:both"></div>	
				<div id="ktory_film">
					<h1>Film</h1>
					<h3><a href="film.php?id_filmu=<?php echo $row['IDFilmu'] ?>" title="Kliknij aby wyświetlić informacje o filmie"><?php echo $row['tytul'] ?></h3>
				</div>
			</div>	
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