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
				if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
					if(isset($_GET['id_administratora'])){
						$zmienadministratora = $_GET['id_administratora'];
						$result = $mysqli->query("SELECT * FROM administrator WHERE IDAdministratora = '$zmienadministratora'" );
						$row = $result->fetch_array();
			?>
			<h1> Wybierz dane do edycji</h1>
			<div class="formularz">
				<form action='edycja.php' method='post'>
					<div class="pole_formularza_maly_odstep"><label>Login:<br><input type="checkbox" id="chbx_login" onclick="disable('chbx_login','login')"><input type="text" id="login" name="login" value="<?php echo $row['login']  ?>"  disabled /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Imię:<br><input type="checkbox" id="chbx_imie" onclick="disable('chbx_imie','imie')"><input type="text" id="imie" name="imie" value="<?php echo $row['imie'] ?>" disabled /></label></div>
					<div class="pole_formularza_maly_odstep"><label>Nazwisko:<br><input type="checkbox" id="chbx_nazwisko" onclick="disable('chbx_nazwisko','nazwisko')"><input type="text" id="nazwisko" name="nazwisko" value="<?php echo $row['nazwisko'] ?>" disabled /></label></div>
					<input type="hidden" name="id_administratora" value=<?php echo $_GET['id_administratora'] ?> >
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