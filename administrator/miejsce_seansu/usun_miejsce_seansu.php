<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');
	require_once('../../functions.php');
	
	if(isset($_SESSION['admin'])){	
		if(isset($_GET['usun_id'])){
			$id_miejsca = $_GET['usun_id'];							
			if ($result = $mysqli->query("SELECT IDMiejsca FROM `miejsce_seansu` WHERE IDMiejsca ='$id_miejsca'")) {
				$row = $result->fetch_array();
				$katalog=filter_filename($row['IDMiejsca']);
				if($mysqli->query("DELETE FROM miejsce_seansu WHERE IDMiejsca ='$id_miejsca'")){	
					deleteDirectory($path_seans.$katalog);
				}				
				$_SESSION['komunikat']="<span style='color:green'>Miejsce zostało usunięte z bazy.</span>";
				header("Location: index.php");
				$mysqli->close();
				exit;
			}else{
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
			<?php
				if(isset($_SESSION['admin'])){ 
					echo "Czy chcesz usunąć miejsce seansu?"
					?>
					<div id="user">
						<div class="ustawienia_user">
							<a href="?usun_id=<?php echo $_GET['id_miejsca'] ?>"><b>Tak</b></a>				
						</div>
						<div class="ustawienia_user">
							<a href="index.php"><b>Nie</b></a>
						</div>					
					</div>
					<?php
					if(isset($_SESSION['komunikat'])){
						echo "<span style='color:red'><b>".$_SESSION['komunikat']."</b></span>";
						unset($_SESSION['komunikat']);
					}	
				}else{
					header("Location: index.php");
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