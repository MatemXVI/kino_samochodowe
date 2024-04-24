<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');

	if(isset($_SESSION['admin'])){		
		$id = $_POST['id_seansu'];
		$katalog = $_POST['katalog'];
		
		//PLAKAT
		//zmiana nazwy plakatu 
		if(isset($_POST['zmien_nazwe_plakatu'])){
			$result = $mysqli->query("SELECT nazwa_plakatu FROM seans WHERE IDSeansu = ".$id);
			$row = $result->fetch_array();
			if(isset($_POST['nazwa_plakatu'])){
				$nazwa_plakatu=$_POST['nazwa_plakatu'];
				if($nazwa_plakatu==$row['nazwa_plakatu']){
					header("Location: obsluga_plikow.php?id_seansu=".$id."&katalog=".$katalog);	
					$_SESSION['plakaty']="<span>Dane które edytujesz są takie same!</span>";
					exit;
				}	
				$result = $mysqli->query("SELECT nazwa_zdjecia FROM seans_zdjecia WHERE IDSeansu = $id AND nazwa_zdjecia= '$nazwa_plakatu'");
				$row = $result->fetch_array();
				if ($result->num_rows>0) {
					$_SESSION['plakaty']='Plik już istnieje!';
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
					exit;
				}					
				if (empty($nazwa_plakatu)){
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");	
					$_SESSION['plakaty']="<span>Dane nie mogą być puste!</span>";
					exit;
				}
				$result = $mysqli->query("SELECT nazwa_plakatu FROM seans WHERE IDSeansu = $id");
				$row = $result->fetch_array();
				$oldfile=$path_seans.$katalog."/".$row[0];
				$newfile=$path_seans.$katalog."/".$nazwa_plakatu;
				if(!rename($oldfile, $newfile)){
					$_SESSION['plakaty']='Nie zmieniono nazwy pliku!';
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;
				}else{
					$result = $mysqli->query("UPDATE `seans` SET `nazwa_plakatu` = '$nazwa_plakatu' WHERE IDSeansu = $id");
					if($mysqli->connect_errno){
						$_SESSION['plakaty']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
						header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
						exit;
					}
				}
				$_SESSION['plakaty']="<span style='color:green'>Nazwa pliku została pomyślnie zmieniona.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;	
			}else{
				$_SESSION['plakaty']="<span>Zaznacz plakat.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;			
			}
		//dodanie plakatu	
		}else if(isset($_POST['dodaj_plakat'])){	
			if(isset ($_FILES['nazwa_plakatu']['name'])){	
				if(($_FILES['nazwa_plakatu']['error']) <= 0){	
					if (is_uploaded_file($_FILES['nazwa_plakatu']['tmp_name'])) {											
						if (isset($_FILES['nazwa_plakatu']['type'])) {
							if ($_FILES['nazwa_plakatu']['type'] != 'image/jpeg' && $_FILES['nazwa_plakatu']['type'] != 'image/png'){
								$_SESSION['plakaty']="Niepoprawny typ pliku";
								header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
								exit;
							}	
						}else{
							$_SESSION['plakaty']="<span style='color:red'>Niepożądany błąd!.</span>";
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
							exit;						
						}				
						$nazwa_plakatu=$_FILES['nazwa_plakatu']['name'];
						$result = $mysqli->query("SELECT nazwa_zdjecia FROM seans_zdjecia WHERE IDSeansu = $id AND nazwa_zdjecia= '$nazwa_plakatu'");
						if ($result->num_rows>0) {
							$_SESSION['plakaty']='Plik już istnieje!';
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
							exit;
						}
						$result = $mysqli->query("SELECT nazwa_plakatu FROM seans WHERE IDSeansu = $id AND nazwa_plakatu= '$nazwa_plakatu'");
						$row = $result->fetch_array();
						if ($result->num_rows>0) {
							$_SESSION['plakaty']='Plik już istnieje!';
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
							exit;
						}						
						$result = $mysqli->query("UPDATE seans SET `nazwa_plakatu` = '$nazwa_plakatu' WHERE IDSeansu = $id");
						if($mysqli->connect_errno){
							$_SESSION['plakaty']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
							exit;
						}
						if(!move_uploaded_file($_FILES['nazwa_plakatu']['tmp_name'], $path_seans.$katalog."/".$_FILES['nazwa_plakatu']['name'])){
							$_SESSION['plakaty']='Nie udało się załadować obrazka!';
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
							exit;
						}
						$_SESSION['plakaty']="<span style='color:green'>Plik został pomyślnie dodany.</span>"; 
						$mysqli->close();
						header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
						exit;
					}else{
						$_SESSION['plakaty']="<span style='color:red'>Niepożądany błąd!.<br>Nr błędu:".$_FILES['nazwa_plakatu']['error']."</span>";
						header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
						exit;	
					}			
				}else if($_FILES['nazwa_plakatu']['error'] == 4){
					$_SESSION['plakaty']="<span>Brak pliku do wysłania.</span>"; 
					$mysqli->close();
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;				
				}else if ($_FILES['nazwa_zdjecia']['error'] == 2) {
					$_SESSION['plakaty']='Zbyt duży rozmiar pliku!';
					$mysqli->close();
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
					exit;				
				}else{
					$_SESSION['plakaty']="<span style='color:red'>Wystąpił błąd!.<br>Nr błędu:".$_FILES['nazwa_plakatu']['error']."</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;	
				}			
			}else{
				$_SESSION['plakaty']="<span>Brak pliku do wysłania.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;			
			}
		//usunięcie plakatu
		}else if(isset($_POST['usun_plakat'])){
			if(isset($_POST['nazwa_plakatu'])){
				$nazwa_plakatu=$_POST['nazwa_plakatu'];
				$result = $mysqli->query("UPDATE `seans` SET `nazwa_plakatu` = NULL WHERE IDSeansu = $id");
				if($mysqli->connect_errno){
					$_SESSION['plakaty']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;
				}
				if(unlink($path_seans.$katalog."/".$nazwa_plakatu)){
					$_SESSION['plakaty']="<span style='color:green'>Plakat został usunięty.</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;					
				}else{
					$_SESSION['plakaty']="<span >Wystąpił problem.</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;					
				}
			}else{
				$_SESSION['plakaty']="<span>Zaznacz plakat.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;			
			} 
		}
		
		//ZDJĘCIE
		//zmiana nazwy zdjęcia
		if(isset($_POST['zmien_nazwe_zdjecia'])){
			$result = $mysqli->query("SELECT nazwa_zdjecia FROM seans_zdjecia WHERE IDSeansu = ".$id);
			$row = $result->fetch_array();
			if(isset($_POST['nazwa_zdjecia'])){
				$nazwa_zdjecia=$_POST['nazwa_zdjecia'];
				if($nazwa_zdjecia==$row['nazwa_zdjecia']){
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");	
					$_SESSION['zdjecia']="<span>Dane które edytujesz są takie same!</span>";
					exit;
				}
				$result = $mysqli->query("SELECT nazwa_plakatu FROM seans WHERE IDSeansu = $id AND nazwa_plakatu= '$nazwa_zdjecia'");
				$row = $result->fetch_array();
				if ($result->num_rows>0) {
					$_SESSION['zdjecia']='Plik już istnieje!';
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
					exit;
				}				
				if (empty($nazwa_zdjecia)){
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");	
					$_SESSION['zdjecia']="<span>Dane nie mogą być puste!</span>";
					exit;
				}				
				$result = $mysqli->query("SELECT nazwa_zdjecia FROM seans_zdjecia WHERE IDSeansu = $id");
				$row = $result->fetch_array();
				$oldfile=$path_seans.$katalog."/".$row[0];
				$newfile=$path_seans.$katalog."/".$nazwa_zdjecia;
				
				if(!rename($oldfile, $newfile)){
					$_SESSION['zdjecia']='Nie zmieniono nazwy pliku!';
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;
				}else{
					$result = $mysqli->query("UPDATE `seans_zdjecia` SET `nazwa_zdjecia` = '$nazwa_zdjecia' WHERE IDSeansu = $id");
					if($mysqli->connect_errno){
						$_SESSION['zdjecia']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
						header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
						exit;
					}
				}
				$_SESSION['zdjecia']="<span style='color:green'>Nazwa pliku została pomyślnie zmieniona.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;	
			}else{
				$_SESSION['zdjecia']="<span>Zaznacz zdjęcie.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;			
			}
		}
		//dodanie zdjęcia
		else if(isset($_POST['dodaj_zdjecie'])){
			if(isset ($_FILES['nazwa_zdjecia']['name'])){	
				if(($_FILES['nazwa_zdjecia']['error']) <= 0){	
					if (is_uploaded_file($_FILES['nazwa_zdjecia']['tmp_name'])) {
						$nazwa_zdjecia=$_FILES['nazwa_zdjecia']['name'];
						$result = $mysqli->query("SELECT nazwa_zdjecia FROM seans_zdjecia WHERE IDSeansu = $id AND nazwa_zdjecia= '$nazwa_zdjecia'");
						if ($result->num_rows>0) {
							$_SESSION['zdjecia']='Plik już istnieje!';
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
							exit;
						}
						$result = $mysqli->query("SELECT nazwa_plakatu FROM seans WHERE IDSeansu = $id AND nazwa_plakatu= '$nazwa_zdjecia'");
						$row = $result->fetch_array();
						if ($result->num_rows>0) {
							$_SESSION['zdjecia']='Plik już istnieje!';
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
							exit;
						}
						if (isset($_FILES['nazwa_zdjecia']['type'])) {
							if ($_FILES['nazwa_zdjecia']['type'] != 'image/jpeg' && $_FILES['nazwa_zdjecia']['type'] != 'image/png'){
								$_SESSION['zdjecia']="Niepoprawny typ pliku";
								header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
								exit;
							}	
						}else{
							$_SESSION['zdjecia']="<span style='color:red'>Niepożądany błąd!.</span>";
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
							exit;						
						}				
						$result = $mysqli->query("INSERT INTO seans_zdjecia VALUE ('$nazwa_zdjecia', $id)");
						if($mysqli->connect_errno){
							$_SESSION['zdjecia']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
							exit;
						}
						if(!move_uploaded_file($_FILES['nazwa_zdjecia']['tmp_name'], $path_seans.$katalog."/".$_FILES['nazwa_zdjecia']['name'])){
							$_SESSION['zdjecia']='Nie udało się załadować obrazka!';
							header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
							exit;
						}
						$_SESSION['zdjecia']="<span style='color:green'>Plik został pomyślnie dodany.</span>"; 
						$mysqli->close();
						header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
						exit;
					}else{
						$_SESSION['zdjecia']="<span style='color:red'>Niepożądany błąd!.<br>Nr błędu:".$_FILES['nazwa_zdjecia']['error']."</span>";
						header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
						exit;	
					}			
				}else if($_FILES['nazwa_zdjecia']['error'] == 4){
					$_SESSION['zdjecia']="<span>Nie wykonano żadnej operacji.</span>"; 
					$mysqli->close();
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;				
				}else if ($_FILES['nazwa_zdjecia']['error'] == 2) {
					$_SESSION['zdjecia']='Zbyt duży rozmiar pliku!';
					$mysqli->close();
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");		
					exit;
					}
				
				else{
					$_SESSION['zdjecia']="<span style='color:red'>Wystąpił błąd!.<br>Nr błędu:".$_FILES['nazwa_zdjecia']['error']."</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;	
				}			
			}else{
				$_SESSION['zdjecia']="<span>Nie wykonano żadnej operacji.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;			
			}
		}
		//usunięcie zdjecia
		else if(isset($_POST['usun_zdjecia'])){
			if(isset($_POST['nazwa_zdjecia'])){
				$nazwa_zdjecia=$_POST['nazwa_zdjecia'];
				$result = $mysqli->query("DELETE FROM `seans_zdjecia` WHERE IDSeansu = $id AND nazwa_zdjecia = '$nazwa_zdjecia'");
				if($mysqli->connect_errno){
					$_SESSION['zdjecia']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;
				}
				if(unlink($path_seans.$katalog."/".$nazwa_zdjecia)){
					$_SESSION['zdjecia']="<span style='color:green'>Zdjęcie zostało usunięte.</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;					
				}else{
					$_SESSION['zdjecia']="<span >Wystąpił problem.</span>";
					header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
					exit;					
				}
			}else{
				$_SESSION['zdjecia']="<span>Nie wykonano żadnej operacji.</span>"; 
				$mysqli->close();
				header("Location: obsluga_plikow.php?id_seansu=$id&katalog=$katalog");
				exit;			
			}
		}
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'><span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span></span>";
		}
?> 