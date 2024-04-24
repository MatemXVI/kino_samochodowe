<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	require_once('../../functions.php');

	if(isset($_SESSION['admin'])){	
		if(isset($_POST['dodawanie'])){
			$tytul=trim($_POST['tytul']);
			$rezyseria=trim($_POST['rezyseria']);
			$obsada=trim($_POST['obsada']);
			$scenariusz=trim($_POST['scenariusz']);
			$gatunek=trim($_POST['gatunek']);
			$czas_trwania=trim($_POST['czas_trwania']);
			$kraj=trim($_POST['kraj']);
			$rok_produkcji=trim($_POST['rok_produkcji']);
			$opis=trim($_POST['opis']);
			$max_rozmiar = 1024*1024;
			if (empty($tytul)){
				$_SESSION['komunikat']="Podaj tytuł filmu!";
				header("Refresh: 0");
				exit;
			}
/* 			if (empty($czas_trwania)){
				$_SESSION['komunikat']="Podaj czas trwania!";
				header("Refresh: 0");
				exit;
			} */
			if(isset ($_FILES['plakat']['name'])){	
				if (is_uploaded_file($_FILES['plakat']['tmp_name'])) {
					$nazwa_pliku=$_FILES['plakat']['name'];
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
			$query = "INSERT INTO film VALUES(NULL,'$tytul','$rezyseria', '$obsada', '$scenariusz', '$gatunek', '$czas_trwania', '$kraj', '$rok_produkcji', '$opis', '$nazwa_pliku', ".$_SESSION['admin'].")";	
			$katalog = filter_filename($tytul);
			if ($mysqli->query($query)) {
				if (!file_exists($path_film.$katalog) && !is_dir($path_film.$katalog)) { 
					(mkdir($path_film.$katalog));
				}
				if (is_uploaded_file($_FILES['plakat']['tmp_name'])) {
					if(!move_uploaded_file($_FILES['plakat']['tmp_name'], $path_film.$katalog."/".$nazwa_pliku)){
						$_SESSION['komunikat']="<span style='color:green'>Film został dodany do bazy.</span><span style='color:red'>Nie udało się załadować obrazka!</span>";
						header("Refresh: 0");
						exit;
					}
				}else if ($_FILES['plakat']['error']==4);
				else{
					$_SESSION['komunikat']="<span style='color:red'>Wystąpił błąd!.<br>Nr błędu:".$_FILES['plakat']['error']."</span>";
					header("Refresh: 0");
					exit;	
				}
				$_SESSION['komunikat']="<span style='color:green'>Film został dodany do bazy.</span>";
				header('Location: index.php');
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
		$_SESSION['komunikat']="<span style='color:red'><span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span></span>";
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
			<h1>Wprowadź film</h1>
			<div class="formularz">
				<form method="post" enctype="multipart/form-data">
					<table align="center">
						<tr>
							<td><label>Tytuł:<br><input type="text" name="tytul"/></label></td>
							<td><label>Gatunek:<br><input type="text" name="gatunek" /></label></td>
						</tr>
						<tr>
							<td><label>Reżyseria:<br><input type="text" name="rezyseria" /></label></td>
							<td><label>Kraj:<br><input type="text" name="kraj" /></label></td>					
						</tr>
						<tr>
							<td><label>Obsada:<br><input type="text" name="obsada" /></label></td>
							<td><label>Czas trwania: <input type="number" id="number" name="czas_trwania" /> min</label></td>	
						</tr>
						<tr>						
							<td><label>Scenariusz:<br><input type="text" name="scenariusz" /></label></td>
							<td><label>Rok produkcji: <input type="number" id="number" name="rok_produkcji" min="1888" /></label></td>							
						</tr>	
					</table>
							<div><label>Opis:<br><textarea name="opis" cols="1" rows="5" id="opis" title = "Proszę nie dodawać apostrofów, np. It's."></textarea></label>
							<input type="hidden" name="MAX_FILE_SIZE" value="1048576" /></div>
							<label>Plakat:<br><input type="file" name="plakat" accept="image/jpeg, image/png"></label><br>
							<div class="przycisk_formularz"><input type="submit" name="dodawanie" value="Dodaj" /></div>						
				</form>
			</div>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<b>".$_SESSION['komunikat']."</b></span>";
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