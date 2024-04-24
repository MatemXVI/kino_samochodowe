<!doctype html>
<?php
session_start();
?> 
<html>
    <head>
		<meta charset="UTF-8" />
        <title>Panel administracyjny</title>
		<link rel="stylesheet" href="../style.css">
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['admin'])){ 							?>
				<div id="logged">
					<ul>
						<li><a href='logout.php'>Wyloguj się</a></li>
					</ul>
				</div>
<?php		}																?>		
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav class='administrator'>	
				<a href='../'>Cofnij się do panelu użytkownika</a>
			</nav>
        </header>
		<section>
			<?php
				if(isset($_SESSION['admin'])){
			?>
					<div id='menu'>
						<h1>Panel administracyjny</h1>
						<div><a href='seans/'>Seanse</a></div>
						<div><a href='film/'>Filmy</a></div>
						<div><a href='miejsce_seansu/'>Miejsca</a></div>
<?php 				if($_SESSION['admin'] == 1){ 					?>
						<div><a href='administratorzy/'>Administratorzy</a></div>
<?php } ?>
						<div><a href='uzytkownicy/'>Użytkownicy</a></div>
						<div><a href='bilety/'>Bilety</a></div>
					</div>	
			<?php						
				}
				else{
					header('Location: administrator_logowanie.php');
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