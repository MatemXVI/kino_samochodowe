<!doctype html>
<?php
	session_start();
	require_once('../connect.php');
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Kino Samochodowe</title>
		<link rel="stylesheet" href="../style.css">
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['uzytkownik'])){ 							?>
			<div id="logged">
				<ul>
					<li><a href='../uzytkownik'><?php echo $_SESSION['uzytkownik'] ?></a></li>
					<li><a href='../logout.php'>Wyloguj się</a></li>
				</ul>
			</div>
					
<?php		}else{												?>
			<div id="logged">
			 	<ul>
					<li><a href='../logowanie.php'>Zaloguj się</a></li>
					<li><a href='../rejestracja.php'>Zarejestruj się</a></li>
				</ul>
			</div>
<?php 			} 																?>
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav>
				<a href=>WYBIERZ MIEJSCE PARKINGOWE</a>
				<a href=>BILET</a>
				<a href=>DANE OSOBOWE</a>
				<a href>PŁATNOŚĆ</a>
				<a href>PODSUMOWANIE</a>			
			</nav>
        </header>
		<section>
			<?php
				if(isset($_GET['id_seansu'])){
					$id_seansu = $_GET['id_seansu'];
					$query="SELECT seans.*, miejsce_seansu.*, film.tytul FROM `seans` INNER JOIN film on film.IDFilmu = seans.IDFilmu INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca WHERE IDSeansu =".$id_seansu;
					$result= $mysqli->query($query);
					$row = $result->fetch_array();
					echo "<div id='seans_info'><p><b>Seans: </b> ".$row['nazwa']."<br><b>Data: </b>".$row['data']." ".$row['godzina']."<br><b>Film: </b>".$row['tytul']."<br><b>Miejsce seansu: </b>".$row['miejscowosc'].", ".$row['ulica']."<br><b>Rodzaj miejsca:</b> ".$row['rodzaj_miejsca']."<br><b>Maksymalna ilość miejsc na seans wynosi: </b>".$row['ilosc_miejsc_parkingowych']."</p>";
					$result = $mysqli->query("SELECT COUNT(*) FROM `bilet` WHERE IDUzytkownika IS NULL AND IDSeansu=".$id_seansu);
					$miejsca = $result->fetch_array();
 					if($miejsca[0]==0){
						echo "<p><span style='color:red'><b>Brak miejsc na seans!</b></span></p>";
					} 
					else if($miejsca[0]<10){
						echo "<p><span style='color:red'><b>Zostało kilka miejsc parkingowych!</b></span></p>";
					}
					else{ 
						echo "<p>Zostało ".$miejsca[0]." miejsc parkingowych.</p>";
					} 
					$result = $mysqli->query("SELECT NumerMiejscaParkingowego, IDUzytkownika FROM bilet WHERE IDSeansu=".$_GET['id_seansu']);
					$rows=$result->num_rows;
					$i=1;
					echo "</div><table align='center' id='parking'><tr><td class='rzad'>$i</td>";
					while($row = $result->fetch_array()){	
						if($row[1]==NULL){
							?><td style="background-color:green">
									<a href="wybor_biletu.php?id_seansu=<?php echo $id_seansu ?>&numer_miejsca_parkingowego=<?php echo $row[0] ?>"><b><?php echo $row[0] ?></b></a>
							 </td><?php	
						}else{
							echo "<td style='background-color:red'><b>".$row[0]."</b></td>";
							}
						if($row[0] % 10==0){						
							echo"<td class='rzad'>$i</td></tr>";
							$i++;
							if($row[0] != $rows){
								echo "<tr><td class='rzad'>$i</td>";
							}
						}
					}
					if($rows % 10!=0){
						while($rows % 10!=0){
							echo "<td class='puste'></td>";
							$rows++;
						}
						echo"<td class='rzad'>$i</td></tr>";
					}
					$mysqli->close();
				
				}
			?>			
			</table>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<span><b>".$_SESSION['komunikat']."</b></span>";
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