<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	require_once('../../functions.php');
	
	if(!isset($_SESSION['admin'])){	
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span>";
		exit;
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
				<a href='../'>Wróć do menu</a>
			</nav>
        </header>
		<section>
			<h2>Miejsca seansu:</h2>
				<?php
					$result=$mysqli->query('SELECT COUNT(IDMiejsca) FROM miejsce_seansu');
					$row = $result->fetch_array();
					$count = $row[0];
					$page = isset($_GET['page']) ? intval($_GET['page']) - 1 : 0;
					$limit = 5;
					$from = $page * $limit;	
					$allPage = ceil($count / $limit);
				    $result=$mysqli->query("SELECT * FROM `miejsce_seansu` LIMIT ".$from. " , ".$limit);
					if($result->num_rows > 0){
					?>	
				<table align="center" class="lista">
					<tr><th>ID Miejsca</th><th>Miejscowosc</th><th>Ulica</th><th>Rodzaj miejsca</th><th>Ilość miejsc parkingowych</th><th colspan="2">Akcja</th></tr>
					<?php
					while($row = mysqli_fetch_assoc($result)){ ?>
						<tr>
							<td><?php echo $row['IDMiejsca'] ?></td>
							<td><?php echo $row['miejscowosc'] ?></td>
							<td><?php echo $row['ulica'] ?></td>
							<td><?php echo $row['rodzaj_miejsca'] ?></td>
							<td><?php echo $row['ilosc_miejsc_parkingowych'] ?></td>
							<td><a href="usun_miejsce_seansu.php?id_miejsca=<?php echo $row['IDMiejsca'] ?>" title="Miejsce dodał administrator nr: <?php echo $row['IDAdministratora'] ?>"><b>USUŃ</b></a></form></td>
							<td><a href="edytuj_miejsce_seansu.php?id_miejsca=<?php echo $row['IDMiejsca'] ?>" title="Miejsce dodał administrator nr: <?php echo $row['IDAdministratora'] ?>"><b>EDYTUJ</b></a></td>
						</tr>						
				<?php } ?>
				</table><p>
				<?php
				if($allPage > 1){
					for($i = 1; $i<=$allPage; $i++){
							echo "<span class='paginator'><a href='index.php?page=".$i."'><b>".$i."</b></a></span>";
					}
				}
				?>
				<p class="dodaj"><a href='dodaj_miejsce_seansu.php'><b>DODAJ NOWE MIEJSCE </b></a></p>	
				<?php
				}else{
						echo "<h2>Brak miejsc</h2>
								<div><a href='dodaj_miejsce_seansu.php'><b>DODAJ MIEJSCE </b></a></div>";
					}
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