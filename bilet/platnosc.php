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
    </head>
    <body>
		<header>
<?php		if(isset($_SESSION['uzytkownik'])){ 							?>
			<div id="logged">
				<ul>
					<li><a href='../uzytkownik'><?php echo $_SESSION['uzytkownik'] ?></a></li>
					<li><a href='../logout.php'>Wyloguj się</a></li>
				</ul>
			</div>
					
<?php		}else{												?>
			<div id="logged">
			 	<ul>
					<li><a href='../logowanie.php'>Zaloguj się</a></li>
					<li><a href='../rejestracja.php'>Zarejestruj się</a></li>
				</ul>
			</div>
<?php 			} 																?>
			<h1><a href='index.php'>KINO SAMOCHODOWE</a></h1>
			<nav>
				<a href=>WYBIERZ MIEJSCE PARKINGOWE</a>
				<a href=>BILET</a>
				<a href=>DANE OSOBOWE</a>
				<a href>PŁATNOŚĆ</a>
				<a href>PODSUMOWANIE</a>			
			</nav>
        </header>
		<nav class='administrator'>
		<a href='index.php'>Wróć do menu</a>
		</nav>
		<section>
			<h2>Wybierz sposób płatności</h2>
			<form action="podsumowanie.php" method="post">
				<table align="center" id="platnosc">			
					<tr><td><label><input type="radio" name="platnosc" value="Karta płatnicza">Karta płatnicza</input></label><img src="img/visa_mastercard.png" height="34"></td></tr>
					<tr><td><label><input type="radio" name="platnosc" value="Google Pay">Google Pay</input></label><img src="img/google_pay.png" height="34"></td></tr>
					<tr><td><label><input type="radio" name="platnosc" value="BLIK">BLIK</input></label><img src="img/blik.png" height="34"></td></tr>
					<tr><td><label><input type="radio" name="platnosc" value="Przelew online">Przelew online</input></label><img src="img/payu.png" height="34"></td></tr>
					<tr><td><label><input type="radio" name="platnosc" value="Paypal">Paypal</input></label><img src="img/paypal.png" height="34"></td></tr>				
				</table>
				<input type="hidden" name="id_seansu" value=<?php echo $_GET['id_seansu'] ?> >
				<input type="hidden" name="numer_miejsca_parkingowego" value=<?php echo $_GET['numer_miejsca_parkingowego'] ?> >
				<input type="submit" value="Wybierz płatność">
			</form><br>
			<?php
				if(isset($_SESSION['komunikat'])){
					echo "<span><b>".$_SESSION['komunikat']."</b></span>";
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