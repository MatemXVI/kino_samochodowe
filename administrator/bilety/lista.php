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
			if(isset($_SESSION['admin'])){
				if(isset($_GET['id_seansu'])){
					$id_seansu=$_GET['id_seansu'];
					$query="SELECT seans.*, film.tytul, miejsce_seansu.miejscowosc, miejsce_seansu.ulica FROM `seans` 
					INNER JOIN film on film.IDFilmu = seans.IDFilmu 
					INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca 
					WHERE seans.IDSeansu='$id_seansu'"; 
					$result = $mysqli->query($query);
					$row = $result->fetch_array();
					echo "<p><b>Seans:</b> ".$row['nazwa']."<br><b>Data:</b> ".$row['data']." ".$row['godzina']."<br><b>Film:</b> ".$row['tytul']."<br><b>Miejsce:</b> ".$row['miejscowosc'].", ".$row['ulica']."<br></p>";							
				}else{
					header('Location: ../');
				}
			}else{
				header('Location: ../administrator_logowanie.php');
				$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
			}
			?>
			<table align="center" class="lista">
				<tr>
					<th>Numer Biletu</th>
					<th>Numer miejsca parkingowego</th>						
					<th>Data wygenerowania</th>
					<th>Cena</th>
					<th>Akcja</th>	
				</tr>
				<?php
					$result=$mysqli->query('SELECT COUNT(NumerBiletu) FROM bilet WHERE IDSeansu='.$id_seansu);
					$row = $result->fetch_array();
					$count = $row[0];
					$page = isset($_GET['page']) ? intval($_GET['page']) - 1 : 0;
					$limit = 30;
					$from = $page * $limit;	
					$allPage = ceil($count / $limit);
					$query="SELECT bilet.*, miejsce_seansu.miejscowosc, film.tytul FROM bilet 
					INNER JOIN seans ON seans.IDSeansu = bilet.IDSeansu
					INNER JOIN miejsce_seansu ON miejsce_seansu.IDMiejsca = seans.IDMiejsca
					INNER JOIN film ON film.IDFilmu = seans.IDFilmu
					WHERE seans.IDSeansu='$id_seansu' LIMIT ".$from. " , ".$limit;
					$result = $mysqli->query($query);
					if($result->num_rows > 0){
						while($row = $result->fetch_array()){
							echo"<tr>
								<td>".$row['NumerBiletu']."</td>
								<td>".$row['NumerMiejscaParkingowego']."</td>							
								<td>".$row['data_wygenerowania']."</td>
								<td>".$row['cena']." zł</td>";
							if($row['IDUzytkownika']!=NULL){
								echo "<td><a href='bilet.php?id_seansu=$id_seansu&miejsce_parkingowe=".$row['NumerMiejscaParkingowego']."' title='Nr biletu: ".$row[2]."'><b>ZOBACZ BILET</b></td>";
							}
							echo "</tr>";
							}
						for($i = 1; $i<=$allPage; $i++){
							echo "<span class='paginator'><a href='lista.php?id_seansu=".$id_seansu."&page=".$i."'><b>".$i."</b></a></span>";
						}	
					}else{
						echo "<h2>Brak biletów</h2>";
					}
					$mysqli->close();
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