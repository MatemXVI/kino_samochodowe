<?php
//biblioteka PHP QR Code
	function qrCode($dane){
	$url = "qr_img/"; //adres generowanych kodów
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qr_img'.DIRECTORY_SEPARATOR; //katalog gdzie będą zapisywane kody QR
 
    include "phpqrcode/qrlib.php"; //dołączamy klasę z biblioteki PHP QR Code
 
    //ustawiamy parametry kodu QR
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 10;
 
    $dane;
    if (isset($_REQUEST['data']) && trim($_REQUEST['data']) != '') {
    $dane = $_REQUEST['data'];
    }
 
    $filename = $PNG_TEMP_DIR.'qr'.md5($dane.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
 
//generujemy kod!!! i zapisujemy do pliku
    QRcode::png($dane, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    $link = $url.'qr'.md5($dane.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    return $link;//wyświetlamy link do pliku	
	
	}	
	//////////////////////////////
	session_start();
	require_once('../connect.php');
	if(isset($_SESSION['uzytkownik']) && isset($_POST['numer_miejsca_parkingowego'])){
		$miejsce_parkingowe = $_POST['numer_miejsca_parkingowego'];
		$wybrany_seans = $_POST['id_seansu'];
		$cena = $_POST['cena'];
		$id_uzytkownika = $_SESSION['uzytkownik'];
		$data = date('Y-m-d H:i:s');
		$query="UPDATE `bilet` SET `IDUzytkownika` = $id_uzytkownika, cena = $cena, data_wygenerowania = '$data' WHERE NumerMiejscaParkingowego = '$miejsce_parkingowe' AND IDSeansu = '$wybrany_seans'" ;
		if($result = $mysqli->query($query)){
			$result = $mysqli->query("SELECT NumerBiletu FROM Bilet WHERE NumerMiejscaParkingowego = '$miejsce_parkingowe' AND IDSeansu = '$wybrany_seans'");
			$numer_biletu = $result->fetch_array();
			$dane = $numer_biletu[0]." ".$wybrany_seans." ".$miejsce_parkingowe." ".$id_uzytkownika;
			$kod_qr = qrCode($dane);
			$result = $mysqli->query("UPDATE `bilet` SET `nazwa_pliku` = '$kod_qr' WHERE NumerBiletu = ".$numer_biletu[0]);
			$_SESSION['komunikat'] = "<span style='color:green'>Bilet został zakupiony. Pamiętaj, że tylko z nim możesz wejść na seans.<br> Zeskanuj kod QR przy wjeździe na parking.<br>Życzymy miłego seansu!<br></span>";
			header('Location: ../uzytkownik/bilet.php?numer_biletu='.$numer_biletu[0]);			
		}else{
			$_SESSION['komunikat'] = "<span style='color:red'>Wystąpił błąd z dodaniem biletu. </span>";
			header('platnosc.php');
		}
		$mysqli->close();
		if(isset($_SESSION['komunikat'])){
			echo "<span><b>".$_SESSION['komunikat']."</b></span>";
			unset($_SESSION['komunikat']);
	}
	}else{
			$_SESSION['komunikat']="Musisz się zalogować, aby móc kupić bilet.";
			header('Location: ../logowanie.php');
		}		
?>