<?php
    header('Content-Type: application/json');
    require_once('../connect.php');

	if(isset($_GET['miejsce_parkingowe']) && isset($_GET['id_seansu'])){
		$miejsce_parkingowe = $_GET['miejsce_parkingowe'];
		$id_seansu = $_GET['id_seansu'];
		$query = "SELECT bilet.*, seans.nazwa, seans.data, seans.godzina, film.tytul, miejsce_seansu.miejscowosc, miejsce_seansu.ulica, uzytkownik.imie, uzytkownik.nazwisko
		FROM `bilet`
		INNER JOIN seans
		ON seans.IDSeansu = bilet.IDSeansu
		INNER JOIN uzytkownik
		ON uzytkownik.IDUzytkownika = bilet.IDUzytkownika
		INNER JOIN film 
		ON film.IDFilmu = seans.IDFilmu
		INNER JOIN miejsce_seansu
		ON miejsce_seansu.IDMiejsca = seans.IDMiejsca
		WHERE bilet.NumerMiejscaParkingowego = $miejsce_parkingowe
		AND seans.IDSeansu = $id_seansu";
		$result = $mysqli->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();{
            $response = $row;
            }
            $json_response = json_encode($response,JSON_PRETTY_PRINT);
            echo $json_response;
            mysqli_close($mysqli);            
        }
	}else if(isset($_GET['numer_biletu'])){
		$query = "SELECT bilet.*, seans.nazwa, seans.data, seans.godzina, film.tytul, miejsce_seansu.miejscowosc, miejsce_seansu.ulica, uzytkownik.imie, uzytkownik.nazwisko
		FROM `bilet`
		INNER JOIN seans
		ON seans.IDSeansu = bilet.IDSeansu
		INNER JOIN uzytkownik
		ON uzytkownik.IDUzytkownika = bilet.IDUzytkownika
		INNER JOIN film 
		ON film.IDFilmu = seans.IDFilmu
		INNER JOIN miejsce_seansu
		ON miejsce_seansu.IDMiejsca = seans.IDMiejsca
		WHERE bilet.NumerBiletu=".$_GET['numer_biletu'];
		$result = $mysqli->query($query);
          if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $response = $row;
            $json_response = json_encode($response,JSON_PRETTY_PRINT);
            echo $json_response;
            mysqli_close($mysqli);            
        }
	}
?>