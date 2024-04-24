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
			<div class="z_miejscami">
				<div id="wybor_miejsca">
					<form method="get">
						<select class="select_index" name="id_miejsca" onchange="this.form.submit()">
							<?php 
								if(isset ($_GET['id_miejsca']) && ($_GET['id_miejsca']!="all")){
									$miejsce = $_GET['id_miejsca'];
									$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca = $miejsce ORDER BY miejscowosc");
									$dane_miejsca = $result->fetch_array();
									echo "<option value=".$dane_miejsca['IDMiejsca'].">".$dane_miejsca['miejscowosc']." , ul.".$dane_miejsca['ulica']." </option>"; 
									$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca != $miejsce ORDER BY miejscowosc");
									while($row = $result->fetch_array()){
										echo "<option value=".$row['IDMiejsca'].">".$row['miejscowosc']." , ul.".$row['ulica']." </option>";       
									}
								?>
								
								<?php
								}else{
									$result = $mysqli->query("SELECT * FROM miejsce_seansu ORDER BY miejscowosc");			
									echo "<option value='all'>-</option>";
									while($row = $result->fetch_array()){
										echo "<option value=".$row['IDMiejsca'].">".$row['miejscowosc']." , ul.".$row['ulica']." </option>";       
									}
								}
							?>
						</select>
					</form>
				</div>
				<?php 
				if(isset ($_GET['id_miejsca']) && ($_GET['id_miejsca']!="all")){
				?>
				<div id="informacje_miejsce">
					<div class="linia"><b>Miejscowość:</b> <?php echo $dane_miejsca['miejscowosc']." ul. ".$dane_miejsca['ulica'] ?><hr></div>
					<div class="linia"><b>Rodzaj miejsca:</b> <?php echo $dane_miejsca['rodzaj_miejsca'] ?><hr></div>
					<div class="linia"><b>Ilość miejsc:</b> <?php echo $dane_miejsca['ilosc_miejsc_parkingowych'] ?><hr></div>
					<?php 
					if($dane_miejsca['dodatkowe_informacje'] != NULL){
				?><div class="linia"><?php echo $dane_miejsca['dodatkowe_informacje'] ?><hr></div><?php } ?>
				</div>	
					<h3>Zdjęcia miejsca:</h3>
					<div id="zdjecia">
						<?php
							$result=$mysqli->query("SELECT nazwa_zdjecia FROM miejsce_seansu_zdjecia WHERE IDMiejsca =".$_GET['id_miejsca']);
							while($row=$result->fetch_array()){
								?><div class="zdjecie">
									<img src="<?php echo $path_miejsce_index.$dane_miejsca['IDMiejsca']."/".$row['nazwa_zdjecia'] ?> "width="500px" height="250px"></div><?php						
							}
						?>				
					</div>
					<div style="clear:both"></div>
					<div>
					<h3>Najbliższe seanse:</h3>
					<?php
						$result = $mysqli->query("SELECT seans.IDSeansu, seans.nazwa, seans.data, seans.nazwa_plakatu, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina, film.tytul, miejsce_seansu.miejscowosc, miejsce_seansu.ulica FROM seans INNER JOIN film ON film.IDFilmu = seans.IDFilmu INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca WHERE film.IDFilmu = ".$_GET['id_miejsca']." ORDER BY seans.data");
						while($row=$result->fetch_array()){
						?>
							<a href="seans.php?id_seansu=<?php echo $row['IDSeansu'] ?>" title='Informacje o seansie'><?php echo $row['nazwa'] ?></a>
							<a href="bilet/index.php?kup_bilet=<?php echo $row['IDSeansu'] ?>"><b><?php echo $row['godzina'] ?></b></a>
							<div class='krotki_opis'> 
								<?php echo $row['data'] ?> | <?php echo $row['tytul'] ?> | <?php echo $row['miejscowosc'] ?> | <?php echo $row['ulica'] ?><hr>
							</div>									
				<?php } 
				}?>
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