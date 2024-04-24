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
				<a href='lista.php'>Wróć do menu</a>
			</nav>	
        </header>
		<section>
			<?php
				$url ="http://localhost/kino_samochodowe/bilet/api2.php?id_seansu=".$_GET['id_seansu']."&miejsce_parkingowe=".$_GET['miejsce_parkingowe'];
				$client = curl_init($url);
				curl_setopt($client,CURLOPT_RETURNTRANSFER,true);		   
				$response = curl_exec($client);        
				$result = json_decode($response);
				?>
				<div id ="bilet">
					<div id="left-side">
						<div id="logo"><b>KINO SAMOCHODOWE</b></div>
					</div>
					<div id="main-side">
						<div id="main-information">
							<div id="id-biletu">
								Numer biletu: #<?php echo $result->NumerBiletu ?><br>
								Wygenerowano: <?php echo $result->data_wygenerowania ?><br>
							</div>	
							<div id="seans-information">
								<h1><?php echo $result->nazwa ?></h1>
							</div>
							<div id="rest-information">							
								<div id="title"><b><?php echo $result->tytul ?></b></div>
								Data seansu:
								<b><?php echo $result->data." ".$result->godzina ?></b><br>																	 							
								Numer miejsca parkingowego: <b><?php echo $result->NumerMiejscaParkingowego ?></b><br>												
								Miejsce: <b><?php echo $result->miejscowosc ?> ul.<?php echo $result->ulica ?></b><br>
							</div>
							<div id="announcement">
								<i>Częstotliwość stacji radiowej zostanie udostępniona przed seansem. W razie problemów technicznych proszę wezwać pomoc!</i>
							</div>
							<div id="price">
								<b>Cena: <?php echo $result->cena ?> zł</b> 
							</div>											
						</div>												
					</div>
					<div id="top-right-side">
						<img src = "../../bilet/img/car.png" height="200" width="400">
					</div>
					<div id="bottom-right-side">
						<img src=<?php echo "../../bilet/".$result->nazwa_pliku ?> height="250" width="250">
					</div>				
				</div>
				<div style="clear:both"></div>				
				<!-- <div id ="bilet">
					<div id="wrapper_margin">
						<div id="wrapper">
							<div id="logo"><b>KINO SAMOCHODOWE</b></div>
							<p>Numer biletu: #<?php echo $result->NumerBiletu ?></p>
							<p>Wygenerowano: <?php echo $result->data_wygenerowania ?></p>
							<p>Cena: <?php echo $result->cena ?> zł </p>
							<p><h2><?php echo $result->tytul ?></h2></p>							
							<p>Numer miejsca: <?php echo $result->NumerMiejscaParkingowego ?></p>
							<p><?php echo $result->nazwa ?></p>
							<p><?php echo $result->data ?> <?php echo $result->godzina ?></p>
							<p><?php echo $result->miejscowosc ?> ul.<?php echo $result->ulica ?></p>
							<img src="qr.jpg">
						</div>
					</div>
				</div> -->
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