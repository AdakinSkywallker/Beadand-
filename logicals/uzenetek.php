<?php
// Jogosultság védelem: ha nincs belépve valaki, ne is futhasson le a kód
if (!isset($_SESSION['login'])) {
    header("Location: ?oldal=fooldal");
    exit;
}

$hiba = "";
$uzenetekLista = array();

try {
    $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    
    // Lekérdezés fordított időrendben (ORDER BY datum DESC)
    $sql = "SELECT nev, email, szoveg, datum, kuldo_login FROM uzenetek ORDER BY datum DESC";
    $sth = $dbh->query($sql);
    $uzenetekLista = $sth->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $hiba = "Adatbázis hiba: " . $e->getMessage();
}
?>