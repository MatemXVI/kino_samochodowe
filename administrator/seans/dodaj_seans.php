<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');		
	require_once('../../functions.php');
	
	if(isset($_SESSION['admin'])){		
		if(isset($_POST['dodawanie'])){		
			$nazwa=$_POST['nazwa'];
			$data=$_POST['data'];
			$godzina=$_POST['godzina'];
			$film=$_POST['film'];
			$miejsce=$_POST['miejsce'];
			$cena=$_POST['cena'];
			$max_rozmiar = 1024*1024;
			if (empty($nazwa) || empty($data) || empty($godzina) || empty($film) || empty($miejsce) || empty($miejsce)){
				$_SESSION['komunikat']='Podaj wszystkie dane!';
				header("Refresh: 0");
				exit;
			}
			if(isset ($_FILES['plakat']['name'])){	
				$nazwa_pliku=$_FILES['plakat']['name'];
				if (is_uploaded_file($_FILES['plakat']['tmp_name'])) {
					if ($_FILES['plakat']['size'] > $max_rozmiar) {
						$_SESSION['komunikat']='Zbyt duży rozmiar pliku!';
						header("Refresh: 0");
						exit;							
					}
					if (isset($_FILES['plakat']['type'])) {
						if ($_FILES['plakat']['type'] != 'image/jpeg' && $_FILES['plakat']['type'] != 'image/png'){
							$_SESSION['komunikat']="Niepoprawny typ pliku";
							header("Refresh: 0");
							exit;
						}	
					}else{
						$_SESSION['komunikat']="<span style='color:red'>Niepożądany błąd!.</span>";
						header("Refresh: 0");
						exit;						
					}
				}else if ($_FILES['plakat']['error']==4);
				 else{
					$_SESSION['komunikat']="<span style='color:red'>Wystąpił błąd!.<br>Nr błędu:".$_FILES['plakat']['error']."</span>";
					header("Refresh: 0");
					exit;	
				}
			}						
			$query = "INSERT INTO seans VALUES(NULL,'$nazwa','$data','$godzina', '$film', '$miejsce' ,'$nazwa_pliku', ".$_SESSION['admin'].")";
			$katalog = filter_filename($nazwa);
			if ($mysqli->query($query)) {
				if (!file_exists($path_seans.$katalog) && !is_dir($path_seans.$katalog)) { 
					(mkdir($path_seans.$katalog));
				}
				if (is_uploaded_file($_FILES['plakat']['tmp_name'])) {
					if(!move_uploaded_file($_FILES['plakat']['tmp_name'], $path_seans.katalog."/".$nazwa_pliku)){
						$_SESSION['komunikat']="<span style='color:green'>Seans został dodany do bazy.</span><br>Nie udało się załadować obrazka!";
						header("Refresh: 0");
						$mysqli->close();
						exit;
					}
				}else if ($_FILES['plakat']['error']==4);
				else{
					$_SESSION['komunikat']="<span style='color:red'>Wystąpił błąd!.<br>Nr błędu:".$_FILES['plakat']['error']."</span>";
					header("Refresh: 0");
					exit;	
				}
				$_SESSION['komunikat']="<span style='color:green'>Seans został dodany do bazy.</span>";
				header('Location: index.php');
				$query=$mysqli->query("SELECT ilosc_miejsc_parkingowych FROM miejsce_seansu WHERE IDMiejsca = '$miejsce'");
				$row=$query->fetch_array();
				$ilosc_miejsc=$row['ilosc_miejsc_parkingowych'];			
				$query=$mysqli->query("SELECT IDSeansu FROM seans ORDER BY IDSeansu DESC LIMIT 1");
				$row=$query->fetch_array();				
				$id_seansu=$row['IDSeansu'];
				for($i=1; $i<=$ilosc_miejsc; $i++){
					$bilet = "INSERT INTO bilet (NumerBiletu, cena, NumerMiejscaParkingowego, IDSeansu) VALUES (NULL, $cena, '$i', '$id_seansu')";
					$mysqli->query($bilet);		
				}				
				$mysqli->close();
				exit;
			}else{
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno;"</span>";
				header("Refresh: 0");
				exit;
			}
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
			<h1>Wprowadź seans</h1>	
			<div class="formularz">
				<form method="post" enctype="multipart/form-data">
					<div class="pole_formularza_maly_odstep"><label>Nazwa:<br><input type="text" name="nazwa" required></label></div>
					<div class="pole_formularza_maly_odstep"><label>Data_seansu:<br><input type="date" name="data" required></label></div>
					<div class="pole_formularza_maly_odstep"><label>Godzina:<br><input type="time" name="godzina" required></label></div>
					<div class="pole_formularza_maly_odstep"><label>Film:<br>
					<select name="film" required>
					<?php
						$result = $mysqli->query("SELECT * FROM film");
						while($row = $result->fetch_array()){
							echo "<option value=".$row['IDFilmu'].">".$row['tytul']." </option>";       
						}
					?>
						</select></label></div>
					<div class="pole_formularza"><label>Miejsce:<br>
					<select name="miejsce" required>
					<?php
						$result = $mysqli->query("SELECT * FROM miejsce_seansu");
						while($row = $result->fetch_array()){
							echo "<option value=".$row['IDMiejsca'].">".$row['miejscowosc']." , ul.".$row['ulica']." </option>";       
							}
						$mysqli->close();
					?>
					</select></label></div>
					<div class="pole_formularza_maly_odstep"><label>Cena biletu: <input type="number" name="cena" min="4.00" step="0.01" required> zł</label></div>
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
					<div class="pole_formularza_maly_odstep"><label>Plakat:<br><input type="file" name="plakat" accept="image/jpeg, image/png" enctype="multipart/form-data"></label></div>			
					<div class="przycisk_formularz"><input type="submit" name="dodawanie" value="Dodaj" /></div>
				</form>
			</div>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<b>".$_SESSION['komunikat']."</b>";
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