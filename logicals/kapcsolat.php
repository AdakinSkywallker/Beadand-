<?php
$hiba = "";
$sikeres = false;
$elkuldott_adatok = array();

if (isset($_POST['kuld'])) {
    // Adatok tisztítása
    $nev = trim($_POST['nev']);
    $email = trim($_POST['email']);
    $szoveg = trim($_POST['szoveg']);

    // SZERVEROLDALI ELLENŐRZÉS (PHP)
    if (empty($nev) || empty($email) || empty($szoveg)) {
        $hiba = "Minden mező kitöltése kötelező (szerveroldali ellenőrzés)!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hiba = "Hibás e-mail formátum (szerveroldali ellenőrzés)!";
    } else {
        // Ha minden jó, mentés az adatbázisba
        try {
            // Csatlakozás a helyi adatbázishoz (a 7a keretrendszer alapján)
            $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            
            // Bejelentkezett felhasználó azonosítója vagy "Vendég"
            $login = isset($_SESSION['login']) ? $_SESSION['login'] : 'Vendég';
            
            $sql = "INSERT INTO uzenetek (nev, email, szoveg, datum, kuldo_login) 
                    VALUES (:nev, :email, :szoveg, NOW(), :login)";
            $sth = $dbh->prepare($sql);
            $sth->execute(array(':nev'=>$nev, ':email'=>$email, ':szoveg'=>$szoveg, ':login'=>$login));
            
            $sikeres = true;
            
            // Adatok átadása a nézetnek a megjelenítéshez
            $elkuldott_adatok = array(
                'nev' => $nev,
                'email' => $email,
                'szoveg' => $szoveg,
                'login' => $login
            );
            
        } catch (PDOException $e) {
            $hiba = "Adatbázis hiba: " . $e->getMessage();
        }
    }
}
?>