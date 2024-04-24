<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
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
					if(isset($_GET['id_miejsca'])){
						$zmienMiejsce = $_GET['id_miejsca'];					
						$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca = '$zmienMiejsce'" );
						$row = $result->fetch_array();
						$mysqli->close();
			?>		
			<h1>Edytuj miejsce seansu</h1>
			<div class="formularz">
				<form action="edycja.php" method="post">
					<div class="pole_formularza_maly_odstep"><label>Miejscowość:<br><input type="checkbox" id="chbx_miejscowosc" onclick="disable('chbx_miejscowosc','miejscowosc')"><input type="text" id="miejscowosc" name="miejscowosc" value="<?php echo $row['miejscowosc'] ?>" disabled/></label></div>
					<div class="pole_formularza_maly_odstep"><label>Ulica:<br><input type="checkbox" id="chbx_ulica" onclick="disable('chbx_ulica','ulica')"><input type="text" id="ulica" name="ulica" value="<?php echo $row['ulica'] ?>" disabled/></label></div>
					<div class="pole_formularza"><label>Rodzaj miejsca:<br><input type="checkbox" id="chbx_rodzaj_miejsca" onclick="disable('chbx_rodzaj_miejsca','rodzaj_miejsca')"><input type="text" id="rodzaj_miejsca" name="rodzaj_miejsca" value="<?php echo $row['rodzaj_miejsca'] ?>" disabled/></label></div>
					<div class="pole_formularza_maly_odstep"><label><input type="checkbox" id="chbx_ilosc_miejsc" onclick="disable('chbx_ilosc_miejsc','ilosc_miejsc')">Ilość miejsc parkingowych: <input type="number" id="ilosc_miejsc" name="ilosc_miejsc_parkingowych" value="<?php echo $row['ilosc_miejsc_parkingowych'] ?>" min="1" disabled/></label></div>
					<div class="pole_formularza_maly_odstep"><label><input type="checkbox" id="chbx_dodatkowe_informacje" onclick="disable('chbx_dodatkowe_informacje','dodatkowe_informacje')">Opis:<br><textarea name="dodatkowe_informacje" cols="1" rows="4" id="dodatkowe_informacje" disabled><?php echo $row['dodatkowe_informacje'] ?></textarea></label></div>
					<div><a href="obsluga_plikow.php?id_miejsca=<?php echo $row['IDMiejsca'] ?>"><b>OBSŁUGA PLIKÓW</b></a></div>
					<input type="hidden" name="id_miejsca" value=<?php echo $_GET['id_miejsca'] ?> >
					<div class="przycisk_formularz"><input type="submit" name="edycja" value="Edytuj" /></div>
				</form>
			</div>
				
			<?php					
					}
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