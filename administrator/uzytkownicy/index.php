<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	//usun_uzytkownika
	if(isset($_SESSION['admin'])){	
		if(isset($_GET['id_uzytkownika'])){
			$id_uzytkownika = $_GET['id_uzytkownika'];							
			if ($mysqli->query("DELETE FROM uzytkownik WHERE IDUzytkownika ='$id_uzytkownika'")) {
				$_SESSION['komunikat']="<span style='color:green'>Użytkownik został usunięty z bazy.</span>"; 
				header("index.php");
				$mysqli->close();
				exit;
			}else {
				$_SESSION['komunikat']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
				header("Location: index.php");
				$mysqli->close();
				exit;
				}		
		}		
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
			<h2>Lista użytkowników:</h2>
				<?php
					$result=$mysqli->query('SELECT COUNT(IDUzytkownika) FROM uzytkownik');
					$row = $result->fetch_array();
					$count = $row[0];
					$page = isset($_GET['page']) ? intval($_GET['page']) - 1 : 0;
					$limit = 5;
					$from = $page * $limit;	
					$allPage = ceil($count / $limit);
				    $result=$mysqli->query("SELECT * FROM uzytkownik LIMIT ".$from. " , ".$limit);
					if($result->num_rows > 0){
					?>	
			<table align="center" class="lista">
				<tr><th>ID Uzytkownik</th><th>Login</th><th>Imię</th><th>Nazwisko</th><th>Telefon</th><th colspan="3">Akcja</th></tr>
				<?php
				while($row = mysqli_fetch_assoc($result)){ ?>
					<tr>
						<td><?php echo $row['IDUzytkownika'] ?></td>
						<td><?php echo $row['login'] ?></td>
						<td><?php echo $row['imie'] ?></td>
						<td><?php echo $row['nazwisko'] ?></td>
						<td><?php echo $row['telefon'] ?></td>
						<td><a href="?id_uzytkownika=<?php echo $row['IDUzytkownika'] ?>"><b>USUŃ</b></a></td>
						<td><a href="edytuj_uzytkownika.php?id_uzytkownika=<?php echo $row['IDUzytkownika'] ?>"><b>EDYTUJ</b></a></td>
						<td><a href="edytuj_haslo.php?id_uzytkownika=<?php echo $row['IDUzytkownika'] ?>"><b>ZMIEŃ HASŁO</b></a></td>
					</tr>						
				<?php } ?>
				</table><p>
				<?php
				if($allPage > 1){
					for($i = 1; $i<=$allPage; $i++){
						echo "<span class='paginator'><a href='index.php?page=".$i."'><b>".$i."</b></a></span>";
					}
				}
				echo "</p>";
				}else{
					echo "<h2>Brak użytkowników</h2>";
				}
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