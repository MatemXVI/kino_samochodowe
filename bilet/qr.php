<?php
$url = "img/"; //adres generowanych kodów
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR; //katalog gdzie będą zapisywane kody QR
 
    include "phpqrcode/qrlib.php"; //dołączamy klasę Dominika
 
    //ustawiamy parametry kodu QR
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 10;
 
    $data = 'Defaultowy tekst, jeśli nie zostanie przekazany jako parametr';
    if (isset($_REQUEST['data']) && trim($_REQUEST['data']) != '') {
    $data = $_REQUEST['data'];
    }
 
    $filename = $PNG_TEMP_DIR.'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
 
//generujemy kod!!! i zapisujemy do pliku
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    $link = $url.'qr'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    echo $link;//wyświetlamy link do pliku	
?>