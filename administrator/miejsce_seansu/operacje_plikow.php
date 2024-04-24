<!doctype html>
<?php
	session_start();
	require_once('../../connect.php');

	if(isset($_SESSION['admin'])){		
		$id = $_POST['id_miejsca'];
		$katalog = $_POST['id_miejsca'];
		
		//ZDJĘCIE
		//zmiana nazwy zdjęcia
		if(isset($_POST['zmien_nazwe_zdjecia'])){
			$result = $mysqli->query("SELECT nazwa_zdjecia FROM miejsce_seansu_zdjecia WHERE IDMiejsca = ".$id);
			$row = $result->fetch_array();
			if(isset($_POST['nazwa_zdjecia'])){
				$nazwa_zdjecia=$_POST['nazwa_zdjecia'];
				if($nazwa_zdjecia==$row['nazwa_zdjecia']){
					header('Location: obsluga_plikow.php?id_miejsca='.$id);	
					$_SESSION['zdjecia']="<span>Dane które edytujesz są takie same!</span>";
					exit;
				}				
				if (empty($nazwa_zdjecia)){
					header('Location: obsluga_plikow.php?id_miejsca='.$id);	
					$_SESSION['zdjecia']="<span>Dane nie mogą być puste!</span>";
					exit;
				}				
				$result = $mysqli->query("SELECT nazwa_zdjecia FROM miejsce_seansu_zdjecia WHERE IDMiejsca = $id");
				$row = $result->fetch_array();
				$oldfile=$path_miejsce.$katalog."/".$row[0];
				$newfile=$path_miejsce.$katalog."/".$nazwa_zdjecia;
				
				if(!rename($oldfile, $newfile)){
					$_SESSION['zdjecia']=$oldfile."   ".$newfile;
					header('Location: obsluga_plikow.php?id_miejsca='.$id);
					exit;
				}else{
					$result = $mysqli->query("UPDATE `miejsce_seansu_zdjecia` SET `nazwa_zdjecia` = '$nazwa_zdjecia' WHERE IDMiejsca = $id");
					if($mysqli->connect_errno){
						$_SESSION['zdjecia']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
						header('Location: obsluga_plikow.php?id_miejsca='.$id);
						exit;
					}
				}
				$_SESSION['zdjecia']="<span style='color:green'>Nazwa pliku została pomyślnie zmieniona.</span>"; 
				$mysqli->close();
				header('Location: obsluga_plikow.php?id_miejsca='.$id);
				exit;	
			}else{
				$_SESSION['zdjecia']="<span>Zaznacz zdjęcie.</span>"; 
				$mysqli->close();
				header('Location: obsluga_plikow.php?id_miejsca='.$id);
				exit;
			}
		}
		//dodanie zdjęcia
		else if(isset($_POST['dodaj_zdjecie'])){
			if(isset ($_FILES['nazwa_zdjecia']['name'])){	
				if(($_FILES['nazwa_zdjecia']['error']) <= 0){	
					if (is_uploaded_file($_FILES['nazwa_zdjecia']['tmp_name'])) {
						$nazwa_zdjecia=$_FILES['nazwa_zdjecia']['name'];
						$result = $mysqli->query("SELECT nazwa_zdjecia FROM miejsce_seansu_zdjecia WHERE IDMiejsca = $id AND nazwa_zdjecia= '$nazwa_zdjecia'");
						if ($result->num_rows>0) {
							$_SESSION['zdjecia']='Plik już istnieje!';
							header('Location: obsluga_plikow.php?id_miejsca='.$id);		
							exit;
						}
						if (isset($_FILES['nazwa_zdjecia']['type'])) {
							if ($_FILES['nazwa_zdjecia']['type'] != 'image/jpeg' && $_FILES['nazwa_zdjecia']['type'] != 'image/png'){
								$_SESSION['zdjecia']="Niepoprawny typ pliku";
								header('Location: obsluga_plikow.php?id_miejsca='.$id);
								exit;
							}	
						}else{
							$_SESSION['zdjecia']="<span style='color:red'>Niepożądany błąd!.</span>";
							header('Location: obsluga_plikow.php?id_miejsca='.$id);
							exit;						
						}				
						$result = $mysqli->query("INSERT INTO miejsce_seansu_zdjecia VALUE ('$nazwa_zdjecia', $id)");
						if($mysqli->connect_errno){
							$_SESSION['zdjecia']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
							header('Location: obsluga_plikow.php?id_miejsca='.$id);
							exit;
						}
						move_uploaded_file($_FILES['nazwa_zdjecia']['tmp_name'], $path_miejsce.$katalog."/".$_FILES['nazwa_zdjecia']['name']);
						$_SESSION['zdjecia']="<span style='color:green'>Plik został pomyślnie dodany.</span>"; 
						$mysqli->close();
						header('Location: obsluga_plikow.php?id_miejsca='.$id);
						exit;
					}else{
						$_SESSION['zdjecia']="<span style='color:red'>Niepożądany błąd!.<br>Nr błędu:".$_FILES['nazwa_zdjecia']['error']."</span>";
						header('Location: obsluga_plikow.php?id_miejsca='.$id);
						exit;	
					}			
				}else if($_FILES['nazwa_zdjecia']['error'] == 4){
					$_SESSION['zdjecia']="<span>Nie wykonano żadnej operacji.</span>"; 
					$mysqli->close();
					header('Location: obsluga_plikow.php?id_miejsca='.$id);
					exit;				
				}else if ($_FILES['nazwa_zdjecia']['error'] == 2) {
					$_SESSION['zdjecia']='Zbyt duży rozmiar pliku!';
					$mysqli->close();
					header('Location: obsluga_plikow.php?id_miejsca='.$id);		
					exit;
					}
				
				else{
					$_SESSION['zdjecia']="<span style='color:red'>Wystąpił błąd!.<br>Nr błędu:".$_FILES['nazwa_zdjecia']['error']."</span>";
					header('Location: obsluga_plikow.php?id_miejsca='.$id);
					exit;	
				}			
			}else{
				$_SESSION['zdjecia']="<span>Nie wykonano żadnej operacji.</span>"; 
				$mysqli->close();
				header('Location: obsluga_plikow.php?id_miejsca='.$id);
				exit;			
			}
		}
		//usunięcie zdjecia
		else if(isset($_POST['usun_zdjecia'])){
			if(isset($_POST['nazwa_zdjecia'])){
				$nazwa_zdjecia=$_POST['nazwa_zdjecia'];
				$result = $mysqli->query("DELETE FROM `miejsce_seansu_zdjecia` WHERE IDMiejsca = $id AND nazwa_zdjecia = '$nazwa_zdjecia'");
				if($mysqli->connect_errno){
					$_SESSION['zdjecia']="<span style='color:red'>Error: " . $result . "<br>" . $mysqli->errno."</span>";
					header('Location: obsluga_plikow.php?id_miejsca='.$id);
					exit;
				}
				if(unlink($path_miejsce.$katalog."/".$nazwa_zdjecia)){
					$_SESSION['zdjecia']="<span style='color:green'>Zdjęcie zostało usunięte.</span>";
					header('Location: obsluga_plikow.php?id_miejsca='.$id);
					exit;					
				}else{
					$_SESSION['zdjecia']="<span>Wystąpił problem.</span>";
					header('Location: obsluga_plikow.php?id_miejsca='.$id);
					exit;					
				}
			}else{
				$_SESSION['zdjecia']="<span>Nie wykonano żadnej operacji.</span>"; 
				$mysqli->close();
				header('Location: obsluga_plikow.php?id_miejsca='.$id);
				exit;			
			}
		}
	}else{
		header('Location: ../administrator_logowanie.php');
		$_SESSION['komunikat']="<span style='color:red'><span style='color:red'>Panel dostępny tylko dla osób upoważnionych!</span></span>";
		}
?> 