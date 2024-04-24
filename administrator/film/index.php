<!doctype html>
<?php
	//usun_film
	session_start();
	require_once('../../connect.php');
	require_once('../../functions.php');
	
	if(!isset($_SESSION['admin'])){		
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
			<h2>Filmy:</h2>
				<?php
					$result=$mysqli->query('SELECT COUNT(IDFilmu) FROM film');
					$row = $result->fetch_array();
					$count = $row[0];
					$page = isset($_GET['page']) ? intval($_GET['page']) - 1 : 0;
					$limit = 5;
					$from = $page * $limit;	
					$allPage = ceil($count / $limit);
				    $result=$mysqli->query("SELECT film.*, administrator.login FROM film INNER JOIN administrator ON administrator.IDAdministratora = film.IDAdministratora LIMIT ".$from. " , ".$limit);
					if($result->num_rows > 0){
					?>			
				<table align="center" class="lista">
					<tr><th>ID Filmu</th><th>Tytuł</th><th>Reżyseria</th><th>Gatunek</th><th>Czas trwania</th><th>Rok produkcji</th><th colspan="2">Akcja</th></tr>
					<?php
					while($row = mysqli_fetch_assoc($result)){ ?>
						<tr>
							<td><?php echo $row['IDFilmu'] ?></td>
							<td style="min-width:375px"><?php echo $row['tytul'] ?></td>
							<td><?php echo $row['rezyseria'] ?></td>
							<td style="max-width:200px"><?php echo $row['gatunek'] ?></td>
							<td><?php echo $row['czas_trwania'] ?> min</td>
							<td><?php echo $row['rok_produkcji'] ?></td>						
							<td><a href="usun_film.php?id_filmu=<?php echo $row['IDFilmu'] ?>" title="Film dodał administrator:  <?php echo $row['login'] ?>"><b>USUŃ</b></td>
							<td><a href="edytuj_film.php?id_filmu=<?php echo $row['IDFilmu'] ?>" title="Film dodał administrator: <?php echo $row['login'] ?>"><b>EDYTUJ</b></a></td>
						</tr>						
					<?php }  ?>
				</table><p>
				<?php
				if($allPage > 1){
					for($i = 1; $i<=$allPage; $i++){
							echo "<span class='paginator'><a href='index.php?page=".$i."'><b>".$i."</b></a></span>";
					}
				}
				?>
					</p><p class="dodaj"><a href='dodaj_film.php'><b>DODAJ FILM </b></a></p>
				<?php
					 }else{
						echo "<h2>Brak filmów</h2>
								<div><a href='dodaj_film.php'><b>DODAJ FILM </b></a></div>";
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