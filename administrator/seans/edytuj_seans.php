<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	require_once('../../functions.php');
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Panel administracyjny</title>
		<link rel="stylesheet" href="../../style.css">
		<script>
			function disable(checkbox,form){
				if(document.getElementById(checkbox).checked == true){
					document.getElementById(form).disabled = false
				}else{
					document.getElementById(form).disabled = true
				}
			}
		</script>
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
			<?php
				if(isset($_SESSION['admin'])){
					if(isset($_GET['id_seansu'])){
						$zmienSeans = $_GET['id_seansu'];
						$result = $mysqli->query("SELECT seans.*, bilet.cena FROM seans INNER JOIN bilet ON bilet.IDSeansu = seans.IDSeansu WHERE seans.IDSeansu = '$zmienSeans'" );
						$row = $result->fetch_array();
			?>
			<h1>Wybierz dane do edycji</h1>
			<div class="formularz">
				<form action='edycja.php' method='post' enctype="multipart/form-data">
					<div class="pole_formularza_maly_odstep"></label>Nazwa:<br><input type="checkbox" id="chbx_nazwa" onclick="disable('chbx_nazwa','nazwa')"><input type='text' id="nazwa" name="nazwa" value='<?php echo $row['nazwa'] ?>' disabled></label></div>
					<div class="pole_formularza_maly_odstep"></label>Data_seansu:<br><input type="checkbox" id="chbx_data" onclick="disable('chbx_data','data')"><input type='date' id="data" name="data" value='<?php echo $row['data'] ?>' disabled></label></div>
					<div class="pole_formularza_maly_odstep"></label>Godzina:<br><input type="checkbox" id="chbx_godzina" onclick="disable('chbx_godzina','godzina')"><input type='time' id="godzina" name="godzina" value='<?php echo $row['godzina'] ?>' disabled></label></div>
					<div class="pole_formularza_maly_odstep"></label>Film:<br><input type="checkbox" id="chbx_film" onclick="disable('chbx_film','film')">
					<select id="film" name="IDFilmu" disabled/>";				
					<?php 
						$result = $mysqli->query("SELECT film.IDFilmu, tytul FROM film INNER JOIN seans ON seans.IDFilmu = film.IDFilmu WHERE seans.IDSeansu = ".$row['IDSeansu']); 
						$film = $result->fetch_array();
						echo "<option value=".$film['IDFilmu'].">".$film['tytul']." </option>";
						$result = $mysqli->query("SELECT IDFilmu, tytul FROM film");
						while($film = $result->fetch_array()){
							echo "<option value=".$film['IDFilmu'].">".$film['tytul']." </option>";       
						}?>
					</select></label></div>
					<div class="pole_formularza"></label>Miejsce<br><input type="checkbox" id="chbx_miejsce" onclick="disable('chbx_miejsce','miejsce')">
					<select id="miejsce" name="IDMiejsca" disabled/>";									
					<?php 
						$result = $mysqli->query("SELECT miejsce_seansu.IDMiejsca, miejscowosc, ulica FROM miejsce_seansu INNER JOIN seans ON seans.IDMiejsca = miejsce_seansu.IDMiejsca WHERE seans.IDSeansu = ".$row['IDSeansu']); 
						$miejsce = $result->fetch_array();
						echo  "<option value=".$miejsce['IDMiejsca'].">".$miejsce['miejscowosc']." , ul.".$miejsce['ulica']." </option>";					
					    $result = $mysqli->query("SELECT * FROM miejsce_seansu");
						while($miejsce = $result->fetch_array()){
							echo  "<option value=".$miejsce['IDMiejsca'].">".$miejsce['miejscowosc']." , ul.".$miejsce['ulica']." </option>";       
						}?>
					</select></label></div>
					<div class="pole_formularza_maly_odstep"></label><input type="checkbox" id="chbx_cena" onclick="disable('chbx_cena','cena')">Cena biletu: <input type="number" id="cena" name="cena" min="4.00" step="0.01" value='<?php echo $row['cena'] ?>' disabled> zł</label></div>
					<div class="przycisk_formularz"><a href="obsluga_plikow.php?id_seansu=<?php echo $zmienSeans ?>&katalog=<?php echo filter_filename($row['nazwa']) ?>"><b>OBSŁUGA PLIKÓW</b></a></div>
					<input type="hidden" name="id_seansu" value=<?php echo $_GET['id_seansu'] ?> >
					<div class="przycisk_formularz"><input type="submit" name="edycja" value="Edytuj" /></div>
					</form>
				</div>		
				<?php
					}
					$mysqli->close();
					if(isset($_SESSION['komunikat'])){
						echo "<b>".$_SESSION['komunikat']."</b>";
						unset($_SESSION['komunikat']);
					}
				}else{
					header('Location: ../administrator_logowanie.php');
					$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
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