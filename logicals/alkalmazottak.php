<?php

try {

    $dbh = new PDO(
        'mysql:host=localhost;dbname=gyakorlat7',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    $dbh->query('SET NAMES utf8');

    $sql = "SELECT * FROM alkalmazottak ORDER BY id";

    $sth = $dbh->query($sql);

    $alkalmazottak = $sth->fetchAll(PDO::FETCH_ASSOC);

}
catch (PDOException $e) {

    $hiba = "Adatbázis hiba történt!";

    $alkalmazottak = [];

}

?>

