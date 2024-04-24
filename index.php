<!doctype html>
<?php
	session_start();
	require_once('connect.php');
	require_once('functions.php');
	
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Kino Samochodowe</title>
		<link rel="stylesheet" href="style.css">
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
				<div class="pasek_z_menu" style="margin-left:611px;">
					<div class = "menu">
						<a href='index.php'>REPERTUAR</a>
						<a href='seanse.php'>SEANSE</a>
						<a href='miejsca.php'>MIEJSCA</a>
						<a href>O NAS</a>
						<a href>KONTAKT</a>		
					</div>
					<div class="wybor">
						<form method="get" id="repertuar" class="users">
							<select class="select_index" name="miejsce" onchange="this.form.submit()">
								<?php 
								if(isset ($_GET['miejsce']) && ($_GET['miejsce']!="all")){
									$miejsce = $_GET['miejsce'];
									$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca = $miejsce ORDER BY miejscowosc");
									$row = $result->fetch_array();
									echo "<option value=".$row['IDMiejsca'].">".$row['miejscowosc'].", ul. ".$row['ulica']." </option>";       
									$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca != $miejsce ORDER BY miejscowosc");
									while($row = $result->fetch_array()){
										echo "<option value=".$row['IDMiejsca'].">".$row['miejscowosc'].", ul. ".$row['ulica']." </option>";       
										}
									echo "<option value='all'>Wszystkie miejsca</option>";
								}else{	
									$result = $mysqli->query("SELECT * FROM miejsce_seansu ORDER BY miejscowosc");
									echo "<option value='all'>Wszystkie miejsca</option>";
									while($row = $result->fetch_array()){
										echo "<option value=".$row['IDMiejsca'].">".$row['miejscowosc'].", ul. ".$row['ulica']." </option>";       
										}
								}
								?>
							</select>	
					</div>
					<div style="clear:both"></div>
				</div>
			</nav>
        </header>
		<section>		
			<div class="tydzien">				
					<div class="dni">
						<ul>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value=<?php echo date("Y-m-d"); ?> ><div><?php echo dni($First); ?></div><div><?php echo date("d.m"); ?></div></button></li>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value=<?php echo date("Y-m-d", strtotime("+1 day")); ?> ><div><?php echo dni($Second); ?></div><div><?php echo date("d.m", strtotime("+1 day")); ?></div></button></li>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value= <?php echo date("Y-m-d", strtotime("+2 day")); ?>><div><?php echo dni($Third); ?></div><div><?php echo date("d.m", strtotime("+2 day")); ?></div></button></li>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value=<?php echo date("Y-m-d", strtotime("+3 day")); ?> ><div><?php echo dni($Fourth); ?></div><div><?php echo date("d.m", strtotime("+3 day")); ?></div></button></li>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value=<?php echo date("Y-m-d", strtotime("+4 day")); ?> ><div><?php echo dni($Fifth); ?></div><div><?php echo date("d.m", strtotime("+4 day")); ?></div></button></li>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value=<?php echo date("Y-m-d", strtotime("+5 day")); ?> ><div><?php echo dni($Sixth); ?></div><div><?php echo date("d.m", strtotime("+5 day")); ?></div></button></li>
							<li class="dzien"><button type='submit' class='przycisk'  name='data' value=<?php echo date("Y-m-d", strtotime("+6 day")); ?> ><div><?php echo dni($Seventh); ?></div><div><?php echo date("d.m", strtotime("+6 day")); ?></div></button></li>
						</ul>
					</div>
					<div class="data_pasek">Wybierz inną datę: <label><input type="checkbox" id="chbx_data" onclick="disable('chbx_data','data')"><input type="date" id="data" name='data' title="Wybierz datę" onchange="this.form.submit()" disabled></label></div>
					<div class="all">
						<button type='submit' class='przycisk' name="wszystko"><b>Pokaż repertuar na tydzień</b></button>	
					</div>	
				</form>	
				<?php
				if(isset ($_GET['miejsce']) && ($_GET['miejsce']!="all")){
					$miejsce = $_GET['miejsce'];
					$result = $mysqli->query("SELECT * FROM miejsce_seansu WHERE IDMiejsca = $miejsce");
					$row = $result->fetch_array();
					echo "<h3>Filmy w: ".$row['miejscowosc'].", ul.".$row['ulica']."</h3>";
				}
				?>
			</div>					
			<div class="movies">
			<?php	
				if(!isset ($_GET['miejsce']) || ($_GET['miejsce']=="all")){	
					if(isset($_GET['data'])){
						$data = $_GET['data'];
						$result = $mysqli->query("SELECT DISTINCT film.* FROM `film` INNER JOIN seans ON seans.IDFilmu = film.IDFilmu WHERE seans.data LIKE '$data%' ORDER BY seans.data");
					}
					else if(isset($_GET['wszystko'])){
						header('Location: index.php');
					}
					else{
						$result = $mysqli->query("SELECT DISTINCT film.* FROM `film` INNER JOIN seans ON seans.IDFilmu = film.IDFilmu ");
					}
					$i=0;
					while($row = $result->fetch_array()){
						if($i==0){
							echo "<div class = 'linia_repertuaru'>";
						}
						$tytul = filter_filename($row['tytul']);
						echo "<div class='repertuar'><div><img src = '".$path_film_index.$tytul."/".$row['nazwa_plakatu']."' alt='' width='261' height='377'></div>
						<a href='film.php?id_filmu=".$row['IDFilmu']."' title='Informacje o filmie'>".$row['tytul']."</a> ";
						if(isset($_GET['data'])){
							$data = $_GET['data'];
							$result_hour = $mysqli->query("SELECT seans.IDSeansu, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina FROM `seans` INNER JOIN film ON film.IDFilmu = seans.IDFilmu WHERE film.IDFilmu=".$row['IDFilmu']." AND seans.data= '$data' ORDER BY `godzina` ASC");
						}else{
							$result_hour = $mysqli->query("SELECT seans.IDSeansu, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina FROM `seans` INNER JOIN film ON film.IDFilmu = seans.IDFilmu WHERE film.IDFilmu=".$row['IDFilmu']." ORDER BY `godzina` ASC");
						}
						while($godzina = $result_hour->fetch_array()){							
							echo "<a href='bilet/index.php?id_seansu=".$godzina['IDSeansu']."'><b>".$godzina['godzina']."</b></a> ";
						}
			?>				
						<div class='krotki_opis'>
							<?php echo $row['gatunek'] ?> | <?php echo $row['czas_trwania'] ?> min | <?php echo $row['kraj'] ?> | (<?php echo $row['rok_produkcji'] ?>)
						</div></div>					
			<?php
						$i++;
						if($i%3==0){
							echo "</div><div style='clear:both'></div><hr>";
						}				
					}
						if($i%3!=0){
							echo "</div><div style='clear:both'></div><hr>";
							$i=0;
						}
					}else{
					$miejsce = $_GET['miejsce'];
					if(isset($_GET['data'])){
						$data = $_GET['data'];						
						$result = $mysqli->query("SELECT DISTINCT film.* FROM `film` INNER JOIN seans ON seans.IDFilmu = film.IDFilmu WHERE seans.data LIKE '$data%' AND seans.IDMiejsca = $miejsce  ORDER BY seans.data");
					}
					else if(isset($_GET['wszystko'])){
						header('Location: index.php?miejsce='.$miejsce);
					}
					else{
						$result = $mysqli->query("SELECT DISTINCT film.* FROM `film` INNER JOIN seans ON seans.IDFilmu = film.IDFilmu WHERE seans.IDMiejsca = $miejsce");
					}
					$i=0;
					while($row = $result->fetch_array()){
						if($i==0){
							echo "<div class = 'linia_repertuaru'>";
						}						
						$tytul = filter_filename($row['tytul']);
						echo "<div class='repertuar'><div><img src='".$path_film_index.$tytul."/".$row['nazwa_plakatu']."' alt='' width='261' height='377'></div>
						<a href='film.php?id_filmu=".$row['IDFilmu']."' title='Informacje o filmie'>".$row['tytul']."</a> ";
						if(isset($_GET['data'])){
						$data = $_GET['data'];
						$result_hour = $mysqli->query("SELECT seans.IDSeansu, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina FROM `seans` INNER JOIN film ON film.IDFilmu = seans.IDFilmu WHERE film.IDFilmu=".$row['IDFilmu']." AND seans.IDMiejsca = $miejsce AND seans.data = '$data' ORDER BY `godzina` ASC");	
						}
						else{
							$result_hour = $mysqli->query("SELECT seans.IDSeansu, DATE_FORMAT(seans.godzina, '%H:%i') AS godzina FROM `seans` INNER JOIN film ON film.IDFilmu = seans.IDFilmu WHERE film.IDFilmu=".$row['IDFilmu']." AND seans.IDMiejsca = $miejsce ORDER BY `godzina` ASC");
						}
						while($godzina = $result_hour->fetch_array()){
							echo "<a href='bilet/index.php?id_seansu=".$godzina['IDSeansu']."'><b>".$godzina['godzina']."</b></a> ";
						}
			?>				
						<div class='krotki_opis'>
							<?php echo $row['gatunek'] ?> | <?php echo $row['czas_trwania'] ?> min | <?php echo $row['kraj'] ?> | (<?php echo $row['rok_produkcji'] ?>)
						</div></div>	
			<?php
						$i++;
						if($i%3==0){
							echo "</div><div style='clear:both'></div><hr>";
						}				
					}
						if($i%3!=0){
							echo "</div><div style='clear:both'></div><hr>";
							$i=0;
						}
					}
					echo "</div>";
				$mysqli->close();
				if(isset($_SESSION['komunikat'])){
					echo "<b>".$_SESSION['index']."</b>";
					if(isset($_SESSION['pam_email'])) unset($_SESSION['pam_email']);
					if(isset($_SESSION['pam_login'])) unset($_SESSION['pam_login']);
					if(isset($_SESSION['pam_haslo'])) unset($_SESSION['pam_haslo']);
					if(isset($_SESSION['pam_powt_haslo'])) unset($_SESSION['pam_powt_haslo']);
					if(isset($_SESSION['pam_imie'])) unset($_SESSION['pam_imie']);
					if(isset($_SESSION['pam_nazwisko'])) unset($_SESSION['pam_nazwisko']);
					if(isset($_SESSION['pam_wiek'])) unset($_SESSION['pam_wiek']);
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