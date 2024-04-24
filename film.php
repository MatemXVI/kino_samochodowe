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
<?php		if(isset($_SESSION['uzytkownik'])){ 	
?>
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
			
        </header>
		<section>
			<?php
			if(isset($_GET['id_filmu'])){
				$result=$mysqli->query("SELECT * FROM film WHERE IDFilmu =".$_GET['id_filmu']);
				$row=$result->fetch_array();
				$tytul = filter_filename($row['tytul']);
			}else{
				header("Location: index.php");
			}
				
			?>
			<div id = "content">
				<div id="plakat">
				<img src = "<?php echo $path_film_index.$tytul."/".$row['nazwa_plakatu'] ?>" alt="John Wick 4" width="261" height="377">
				</div>
				<div id="description">
					<h2 class="tytul"><?php echo $row['tytul'] ?></h2>
					<div id="informacje">
						<div class="linia"><b>Czas trwania:</b> <?php echo $row['czas_trwania'] ?> min<hr></div>
						<div class="linia"><b>Gatunek:</b> <?php echo $row['gatunek'] ?><hr></div>
						<div class="linia"><b>Kraj:</b> <?php echo $row['kraj'] ?><hr></div>
						<div class="linia"><b>Rok produkcji:</b> <?php echo $row['rok_produkcji'] ?><hr></div>
						<div class="linia"><b>Reżyseria:</b> <?php echo $row['rezyseria'] ?><hr></div>
						<div class="linia"><b>Scenariusz:</b> <?php echo $row['scenariusz'] ?><hr></div>
						<div class="linia"><b>Obsada:</b> <?php echo $row['obsada'] ?><hr></div>
					</div>
					<div id="opis">
						<b>Opis</b>:<br>
						<?php echo $row['opis'] ?>
					<hr></div>
					<div>
					<h3>Najbliższe seanse:</h3>
					<?php
						$result = $mysqli->query("SELECT seans.IDSeansu, seans.nazwa, seans.data, seans.nazwa_plakatu, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina, film.tytul, miejsce_seansu.miejscowosc, miejsce_seansu.ulica FROM seans INNER JOIN film ON film.IDFilmu = seans.IDFilmu INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca WHERE film.IDFilmu = ".$_GET['id_filmu']." ORDER BY seans.data");
						while($row=$result->fetch_array()){
						?>
							<a href="seans.php?id_seansu=<?php echo $row['IDSeansu'] ?>" title='Informacje o seansie'><?php echo $row['nazwa'] ?></a>
							<a href="bilet/index.php?kup_bilet=<?php echo $row['IDSeansu'] ?>"><b><?php echo $row['godzina'] ?></b></a>
							<div class='krotki_opis'> 
								<?php echo $row['data'] ?> | <?php echo $row['tytul'] ?> | <?php echo $row['miejscowosc'] ?> | <?php echo $row['ulica'] ?><hr>
							</div>
						<?php } ?>								
					</div>
				</div>
				<div style="clear:both"></div>		
					<h3>Zdjęcia filmu:</h3>
					<div id="zdjecia">
						<?php
							$result=$mysqli->query("SELECT nazwa_zdjecia FROM film_zdjecia WHERE IDFilmu =".$_GET['id_filmu']);
							while($row=$result->fetch_array()){
								?><div class="zdjecie">
									<img src="<?php echo $path_film_index.$tytul."/".$row['nazwa_zdjecia'] ?> "width="500px" height="250px"></div><?php						
							}
						?>				
					</div>
					<div style="clear:both"></div>
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