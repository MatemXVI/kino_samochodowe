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
		<script>
			function disable(checkbox,form){
				if(document.getElementById(checkbox).checked == true){
					document.getElementById(form).disabled = false
				}else{
					document.getElementById(form).disabled = true
				}
			}
		</script>
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['uzytkownik'])){ 							?>
				<div id="logged">
					<ul>
						<li><a href='uzytkownik'><?php echo $_SESSION['uzytkownik'] ?></a></li>
						<li><a href='../logout.php'>Wyloguj się</a></li>
					</ul>
				</div>
<?php		}																?>	
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav>
					<a href='../index.php'>REPERTUAR</a>
					<a href='../seanse.php'>SEANSE</a>
					<a href='../miejsca.php'>MIEJSCA</a>
					<a href>O NAS</a>
					<a href>KONTAKT</a>	
			</nav>
        </header>
		<section>			
			<?php
				if(isset($_SESSION['uzytkownik'])){
						$zmienUzytkownika = $_SESSION['uzytkownik'];
						$result = $mysqli->query("SELECT * FROM uzytkownik WHERE IDUzytkownika = '$zmienUzytkownika'" );
						$row = $result->fetch_array();
			?>
			<h1> Wybierz dane do edycji</h1>
			<div class="formularz">
				<form action='edycja.php' method='post'>
					<div class="pole_formularza_maly_odstep"><label>Adres e-mail:<br><input type="checkbox" id="chbx_e-mail" onclick="disable('chbx_e-mail','e-mail')"><input type="text" id="e-mail" name="e-mail" value="<?php echo $row['e-mail']  ?>"  disabled /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Login:<br><input type="checkbox" id="chbx_login" onclick="disable('chbx_login','login')"><input type="text" id="login" name="login" value="<?php echo $row['login']  ?>"  disabled /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Imię:<br><input type="checkbox" id="chbx_imie" onclick="disable('chbx_imie','imie')"><input type="text" id="imie" name="imie" value="<?php echo $row['imie'] ?>" disabled /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Nazwisko:<br><input type="checkbox" id="chbx_nazwisko" onclick="disable('chbx_nazwisko','nazwisko')"><input type="text" id="nazwisko" name="nazwisko" value="<?php echo $row['nazwisko'] ?>" disabled /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Telefon:<br><input type="checkbox" id="chbx_tel" onclick="disable('chbx_tel','tel')"><input type="text" id="tel" name="telefon" value="<?php echo $row['telefon'] ?>" disabled /></label></div>				
					<div class="pole_formularza"><label>Wiek:<input type="checkbox" id="chbx_wiek" onclick="disable('chbx_wiek','wiek')"><input type="number" id="wiek" name="wiek" value="<?php echo $row['wiek'] ?>" disabled /></label></div>			
					<div class="przycisk_formularz"><input type="submit" name="edycja" value="Zmień dane" /></div>						
				</form>	
			</div>
			<?php
				if(isset($_SESSION['edytuj_uzytkownika'])){
					echo "<b>".$_SESSION['edytuj_uzytkownika']."</b>";
					unset($_SESSION['edytuj_uzytkownika']);
				}
			?>
			<hr>
			<h2>Zmień hasło</h2>
			<div class="formularz">
				<form action='edycja_hasla.php' method='post'>
					<div class="pole_formularza_maly_odstep"><label>Nowe hasło:<br><input type="password" id="haslo" name="haslo" required/></label></div>	
					<div class="pole_formularza_maly_odstep"><label>Powtórz hasło:<br><input type="password" id="powt_haslo" name="powt_haslo" required/></label></div>	
					<div class="przycisk_formularz"><input type="submit" name="edycja" value="Zmień hasło" /></div>							
				</form>	
			</div>
				<?php
					$mysqli->close();
					if(isset($_SESSION['edytuj_haslo'])){
						echo "<b>".$_SESSION['edytuj_haslo']."</b>";
						unset($_SESSION['edytuj_haslo']);
					}
				}else{
					header('Location: ../index.php');
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