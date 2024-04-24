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
					if(isset($_GET['id_filmu'])){
						$zmienFilm = $_GET['id_filmu'];					
						$result = $mysqli->query("SELECT * FROM film WHERE IDFilmu = '$zmienFilm'" );
						$row = $result->fetch_array();					
			?>
			<h1>Edytuj film</h1>
			<div class="formularz">
				<form action="edycja.php" method="post">
					<table align="center">
						<tr>
							<td><label>Tytuł:<br><input type="checkbox" id="chbx_tytul" onclick="disable('chbx_tytul','tytul')"><input type="text" id="tytul" name="tytul" value="<?php echo $row['tytul'] ?>" disabled></label></td>
							<td><label>Gatunek:<br><input type="checkbox" id="chbx_gatunek" onclick="disable('chbx_gatunek','gatunek')"><input type="text" id="gatunek" name="gatunek" value="<?php echo $row['gatunek'] ?>" disabled></label></td>						

						</tr>
						<tr>
							<td><label>Reżyseria:<br><input type="checkbox" id="chbx_rezyseria" onclick="disable('chbx_rezyseria','rezyseria')"><input type="text" id="rezyseria" name="rezyseria" value="<?php echo $row['rezyseria'] ?>" disabled></label></td>			
							<td><label>Kraj:<br><input type="checkbox" id="chbx_kraj" onclick="disable('chbx_kraj','kraj')"><input type="text" id="kraj" name="kraj" value="<?php echo $row['kraj'] ?>" disabled></label></td>						

						</tr>
						<tr>					
							<td><label>Obsada:<br><input type="checkbox" id="chbx_obsada" onclick="disable('chbx_obsada','obsada')"><input type="text" id="obsada" name="obsada" value="<?php echo $row['obsada'] ?>" disabled ></label></td>
							<td><label><input type="checkbox" id="chbx_czas" onclick="disable('chbx_czas','czas')">Czas trwania: <input type="number" id="czas" name="czas_trwania" value="<?php echo $row['czas_trwania'] ?>" disabled> min</label></td>
						</tr>
						<tr>
							<td><label>Scenariusz:<br><input type="checkbox" id="chbx_scenariusz" onclick="disable('chbx_scenariusz','scenariusz')"><input type="text" id="scenariusz" name="scenariusz"value="<?php echo $row['scenariusz'] ?>" disabled ></label></td>
							<td><label><input type="checkbox" id="chbx_rok" onclick="disable('chbx_rok','rok')">Rok produkcji: <input type="number" id="rok" name="rok_produkcji" min="1888" value="<?php echo $row['rok_produkcji'] ?>" disabled></label></td>
						</tr>
					</table>
							<label><input type="checkbox" id="chbx_opis" onclick="disable('chbx_opis','opis')">Opis:<br><textarea id="opis"  name="opis" cols="1" rows="5" disabled><?php echo $row['opis'] ?></textarea></label><br>
							<a href="obsluga_plikow.php?id_filmu=<?php echo $zmienFilm ?>&katalog=<?php echo filter_filename($row['tytul']) ?>"><b>OBSŁUGA PLIKÓW</b></a><br><br>
							<input type="hidden" name="id_filmu" value=<?php echo $zmienFilm ?> >
							<input type="submit" name="edycja" value="Edytuj" />
											
				</form>
			</div>
			<?php
					}
				$mysqli->close();					
				if(isset($_SESSION['komunikat'])){
					echo "<b>".$_SESSION['komunikat']."</b>";
					unset($_SESSION['komunikat']);
			}
			?>
			<?php					
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