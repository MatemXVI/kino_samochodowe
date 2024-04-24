<?php
    header('Content-Type: application/json');
    require_once('../connect.php');

    try{
		$mysqli = new mysqli($host, $username, $password, $db_name);
		if ($mysqli->connect_errno){
		throw new Exception(mysqli_connect_errno);
		}
	}
	catch(Exception $e){
		echo "<span style='color:red'>Wystąpił błąd:<br><i>".$e->getMessage()."<br> Błąd nr: ".$e->getCode()."</i><br>Spróbuj ponownie.</span>";
		header("Refresh: 0");
		exit;		
	}
	if(isset($_GET['numer_miejsca_parkingowego']) && isset($_GET['id_seansu']) && isset($_GET['id_uzytkownika'])){
        $wybrany_seans = $_GET['id_seansu'];
        $miejsce_parkingowe = $_GET['numer_miejsca_parkingowego'];
        $id_uzytkownika = $_GET['id_uzytkownika'];
        $query = "SELECT bilet.NumerBiletu, bilet.data_wygenerowania, bilet.cena, bilet.NumerMiejscaParkingowego, seans.nazwa, seans.data, seans.godzina, film.tytul, miejsce_seansu.miejscowosc, miejsce_seansu.ulica, uzytkownik.imie, uzytkownik.nazwisko
        FROM `bilet`
        INNER JOIN seans
        ON seans.IDSeansu = bilet.IDSeansu
        INNER JOIN uzytkownik
        ON uzytkownik.IDUzytkownika = bilet.IDUzytkownika
        INNER JOIN film 
        ON film.IDFilmu = seans.IDFilmu
        INNER JOIN miejsce_seansu
        ON miejsce_seansu.IDMiejsca = seans.IDMiejsca
        WHERE uzytkownik.IDUzytkownika = $id_uzytkownika 
        AND bilet.NumerMiejscaParkingowego = $miejsce_parkingowe
        AND seans.IDSeansu = $wybrany_seans";
		$result = $mysqli->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();{
            $response = $row;
            }
            $json_response = json_encode($response,JSON_PRETTY_PRINT);
            echo $json_response;
            mysqli_close($mysqli);            
        }
    }

?>