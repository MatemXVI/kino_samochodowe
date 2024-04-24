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
					if(isset($_GET['id_uzytkownika'])){
			?>
			<h1> Wybierz dane do edycji</h1>
			<div class="formularz">
				<form action='edycja_hasla.php' method='post'>
					<input type="hidden" name="id_uzytkownika" value="<?php echo $zmienHaslo ?>">
					<div class="pole_formularza_maly_odstep"><label>Nowe hasło:<br><input type="text" id="haslo" name="haslo" required/></label></div>
					<div class="pole_formularza_maly_odstep"><label>Powtórz hasło:<br><input type="text" id="powt_haslo" name="powt_haslo" required/></label></div>
					<input type="hidden" name="id_uzytkownika" value=<?php echo $_GET['id_uzytkownika'] ?> >
					<div class="przycisk_formularz"><input type="submit" name="edycja" value="Edytuj" /></div>							
				</form>
			</div>
				<?php
					}
					$mysqli->close();
					if(isset($_SESSION['komunikat'])){
						echo "<b>".$_SESSION['komunikat']."</b>";
						unset($_SESSION['komunikat']);
					}
				}else{
					header('Location: ../administrator_logowanie.php');
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