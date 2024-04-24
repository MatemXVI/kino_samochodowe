<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	if(isset($_SESSION['admin'])){
		/* $data = date('Y-m-d');
		$result = $mysqli->query("DELETE FROM `seans` WHERE seans.data < '$data'"); */
	}
	else{
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
				<a href='../'>Wróć do menu</a>
			</nav>            
        </header>
		<section>
			<h2>Bilety na seans:</h2>
				<?php
					$result=$mysqli->query('SELECT COUNT(IDSeansu) FROM seans');
					$row = $result->fetch_array();
					$count = $row[0];
					$page = isset($_GET['page']) ? intval($_GET['page']) - 1 : 0;
					$limit = 5;
					$from = $page * $limit;	
					$allPage = ceil($count / $limit);
				    $result=$mysqli->query("SELECT seans.*, bilet.cena FROM seans LEFT JOIN bilet ON bilet.IDSeansu = seans.IDSeansu GROUP BY bilet.IDSeansu LIMIT ".$from. " , ".$limit);
					if($result->num_rows > 0){
					?>			
				<table align="center" class="lista">
					<tr><th>ID Seansu</th><th>Nazwa</th><th>Data</th><th>Godzina</th><th colspan="2">Akcja</th></tr>
					<?php
					while($row = mysqli_fetch_assoc($result)){ ?>
						<tr>								
							<td><?php echo $row['IDSeansu'] ?></td>
							<td><?php echo $row['nazwa'] ?></td>
							<td><?php echo $row['data'] ?></td>
							<td><?php echo $row['godzina'] ?></td>
							<td><a href="lista.php?id_seansu=<?php echo $row['IDSeansu'] ?>"><b>LISTA BILETÓW</b></a></td>
							<td><a href="miejsca_parkingowe.php?id_seansu=<?php echo $row['IDSeansu'] ?>"><b>MIEJSCA PARKINGOWE</b></a></td>
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
				<?php 
				}else{
						echo "<h2>Brak biletów</h2>
								<a href='dodaj_seans.php'><b>DODAJ SEANS </b></a>";
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