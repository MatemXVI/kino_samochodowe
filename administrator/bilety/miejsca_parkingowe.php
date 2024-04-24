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
				if(isset($_GET['id_seansu'])){
					$id_seansu = $_GET['id_seansu'];
					$query="SELECT seans.*, miejsce_seansu.*, film.tytul FROM `seans` INNER JOIN film on film.IDFilmu = seans.IDFilmu INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca WHERE IDSeansu =".$id_seansu;
					$result= $mysqli->query($query);
					$row = $result->fetch_array();
					?><p><b>Seans: </b> <?php echo $row['nazwa'] ?><br><b>Data: </b><?php echo $row['data'] ?> <?php echo $row['godzina'] ?><br><b>Film: </b><?php echo $row['tytul'] ?><br><b>Miejsce seansu: </b><?php echo $row['miejscowosc'] ?>, <?php echo $row['ulica'] ?><br><b>Rodzaj miejsca:</b> <?php echo $row['rodzaj_miejsca'] ?><br><b>Maksymalna ilość miejsc na seans wynosi: </b><?php echo $row['ilosc_miejsc_parkingowych'] ?>.</p><?php
					$result = $mysqli->query("SELECT COUNT(*) FROM `bilet` WHERE IDUzytkownika IS NULL AND IDSeansu=".$id_seansu);
					$miejsca = $result->fetch_array();
 					if($miejsca[0]==0){
						echo "<span style='color:red'><b>Brak miejsc na seans!</b></span><br>";
					} 
					else if($miejsca[0]<10){
						echo "<span style='color:red'><b>Zostało kilka miejsc parkingowych!</b></span><br>";
					}
					else{ 
						echo "Zostało ".$miejsca[0]." miejsc parkingowych.<br>";
					} 
					$result = $mysqli->query("SELECT NumerMiejscaParkingowego, IDUzytkownika, NumerBiletu FROM bilet WHERE IDSeansu=".$_GET['id_seansu']);
					$rows=$result->num_rows;
					$_SESSION['wybrany_seans'] = $_GET['id_seansu'];
					$i=1;
					echo "<br><table align='center' id='parking'><tr><td class='rzad'>$i</td>";
					while($row = $result->fetch_array()){	
						if($row[1]==NULL){
							echo "<td style='background-color:green' title='Nr biletu :".$row[2]."'><b>".$row[0]."</b></td>";	
						}else{							
							echo "<td style='background-color:red'>
									<a href='bilet.php?id_seansu=$id_seansu&miejsce_parkingowe=".$row['NumerMiejscaParkingowego']."' title='Nr biletu: ".$row[2]."'><b>".$row[0]."</b></a>
								 </td>";							
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