<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');

	if(isset($_SESSION['admin'])){	
		$id = $_GET['id_seansu'];
		$katalog= $_GET['katalog'];
		$result = $mysqli->query("SELECT nazwa_plakatu FROM seans WHERE IDSeansu = ".$id);
		$row = $result->fetch_array();
		
 		if(!file_exists($path_seans.$katalog."/".$row['nazwa_plakatu'])){
			if ($mysqli->query("UPDATE film SET nazwa_plakatu = NULL WHERE IDSeansu ='$id'")) {
				$_SESSION['plakaty']="<span>Wpis o nieistniejącym pliku został usunięty z bazy. Możesz dodać nowy plik.</span>";
			}else {
				$_SESSION['plakaty']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				}	
		} 
		
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'><span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span></span>";
		}
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Panel administracyjny</title>
		<link rel="stylesheet" href="../../style.css">
		<script>
			function disable_chbx(checkbox,form){
				if(document.getElementById(checkbox).checked == true){
					document.getElementById(form).disabled = false
				}else{
					document.getElementById(form).disabled = true
				}
			}
			function disable_radio(radio) {
				for (const element of document.getElementsByClassName("nazwa_zdjecia_input")) element.disabled = true;
				radio.closest("label").querySelector("input[type=text]").disabled = false;
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
				<a href='edytuj_seans.php?id_seansu=<?php echo $id ?>'>Wróć do menu</a>
			</nav>			
        </header>
		<section>
			<h1>Obsługa plików</h1><hr>
			<div class="pliki">
				<h3>Dodaj plakat</h3>
				<form action="operacje_plikow.php" method="post" enctype="multipart/form-data">
<?php 				if($row['nazwa_plakatu'] != NULL){ ?>
						<div class="poster">
							<img src="<?php echo $path_seans.$katalog."/".$row['nazwa_plakatu'] ?>" width="336" height="500">
						</div>
						<div>
							<div class = "plik_formularz">
								<div class="nazwa_pliku">
									<div class="plik">
										<label><input type="checkbox" id="chbx_nazwa_plakatu" onclick="disable_chbx('chbx_nazwa_plakatu','nazwa_plakatu')"><input type="text" id="nazwa_plakatu"  name="nazwa_plakatu" value="<?php echo $row['nazwa_plakatu'] ?>" style="width:450px" disabled ></label>
									</div>
									<div class="przycisk_zmiany">
										<button class="przycisk" type="submit" name="zmien_nazwe_plakatu"/><b>Zmień nazwę</b></button>
										<button class="przycisk" type="submit" name="usun_plakat"/><b>Usuń</b></button></label>
									</div>
									<div style="clear:both;"></div>
								</div>				
<?php 				}else{
							echo "<h3>Brak pliku!</h3>";
						}?>
							<div>
								<label><input type="checkbox" id="chbx_plik" onclick="disable_chbx('chbx_plik','plik')"><input type="file" id="plik" name="nazwa_plakatu" accept="image/jpeg, image/png" disabled>
							</div>
							</div>
							<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
							<input type="hidden" name="id_seansu" value="<?php echo $id ?>" />
							<input type="hidden" name="katalog" value="<?php echo $katalog ?>" />
							<div>
								<input type="submit" name="dodaj_plakat" value="Dodaj" /> 
							</div>
						</div>
				</form><br>
			</div>	
			<?php
				if(isset($_SESSION['plakaty'])){
					echo "<b>".$_SESSION['plakaty']."</b></span>";
					unset($_SESSION['plakaty']);
			}
			?>	
			</div>		
			<div class="pliki">
				<hr><h3>Załadowane pliki</h3>
				<form action="operacje_plikow.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
					<?php
						$result = $mysqli->query("SELECT nazwa_zdjecia FROM seans_zdjecia WHERE IDSeansu = ".$id);
						if($result->num_rows>1){
							$i=0;
							while($row=$result->fetch_array()){
							$i++;
						?><label><input type="radio" name="wybor_zdjecia" id="radio_nazwa_zdjecia<?php echo $i ?>" onclick="disable_radio(this)"><input type="text" class="nazwa_zdjecia_input" id="nazwa_zdjecia<?php echo $i ?>"  name="nazwa_zdjecia" value="<?php echo $row['nazwa_zdjecia'] ?>" style="width:450px" disabled>
						<button class="przycisk" type="submit" name="zmien_nazwe_zdjecia"><b>Zmień nazwę</b></button>
						<button class="przycisk" type="submit" name="usun_zdjecia" /><b>Usuń</b></button></label><br>
					<?php	
							}
						}else if($result->num_rows==1){
							$row=$result->fetch_array();
							?><label><input type="checkbox" id="chbx_nazwa_zdjecia" name="wybor_zdjecia" onclick="disable_chbx('chbx_nazwa_zdjecia', 'nazwa_zdjecia')"><input type="text"  id="nazwa_zdjecia"  name="nazwa_zdjecia" value="<?php echo $row['nazwa_zdjecia'] ?>" style="width:450px" disabled>
						<button class="przycisk" type="submit" name="zmien_nazwe_zdjecia"><b>Zmień nazwę</b></button>
						<button class="przycisk" type="submit" name="usun_zdjecia" /><b>Usuń</b></button></label><br>
						<?php		
						}else{
							echo"<h3>Brak plików</h3>";
						}
					?>
					<input type="hidden" name="id_seansu" value="<?php echo $id ?>" />
					<input type="hidden" name="katalog" value="<?php echo $katalog ?>" />
					<label><br><input type="checkbox" id="chbx_zdjecia" onclick="disable('chbx_zdjecia','zdjecia')"><input type="file" id="zdjecia" name="nazwa_zdjecia" accept="image/jpeg, image/png"></label><br> 																
					<input type="submit" name="dodaj_zdjecie" value="Dodaj" /> 								
				</form><br>			
				<?php
					if(isset($_SESSION['zdjecia'])){
						echo "<b>".$_SESSION['zdjecia']."</b></span>";
						unset($_SESSION['zdjecia']);
				}
				?>	
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