<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');

	if(isset($_SESSION['admin'])){	
		$id = $_GET['id_miejsca'];

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
				<a href='edytuj_miejsce_seansu.php?id_miejsca=<?php echo $id ?>'>Wróć do menu</a>
			</nav>			
        </header>
		<section>
			<h1>Obsługa plików</h1><hr>
			<div class="pliki">
				<h3>Załadowane pliki</h3>
				<form action="operacje_plikow.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
					<?php
						$result = $mysqli->query("SELECT nazwa_zdjecia FROM miejsce_seansu_zdjecia WHERE IDMiejsca = ".$id);
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
					<input type="hidden" name="id_miejsca" value="<?php echo $id ?>" />
					<label><br><input type="checkbox" id="chbx_plik" onclick="disable_chbx('chbx_plik','plik')"><input type="file" id="plik" name="nazwa_zdjecia" accept="image/jpeg, image/png"disabled ></label><br> 																
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