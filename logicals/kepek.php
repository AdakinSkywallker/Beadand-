<?php
$MAPPA = './images/galeria/';
$uzenet = "";

// Mappa létrehozása, ha esetleg nem létezne
if (!file_exists($MAPPA)) {
    mkdir($MAPPA, 0777, true);
}

// Képfeltöltés feldolgozása (CSAK ha be van jelentkezve)
if(isset($_POST['kuld']) && isset($_SESSION['login'])) {
    if(isset($_FILES['kep']) && $_FILES['kep']['error'] == 0) {
        $engedelyezett_kiterjesztesek = array('jpg', 'jpeg', 'png', 'gif');
        $kiterjesztes = strtolower(pathinfo($_FILES['kep']['name'], PATHINFO_EXTENSION));

        if(in_array($kiterjesztes, $engedelyezett_kiterjesztesek)) {
            // Fájl biztonságos mozgatása a galéria mappába
            $cel = $MAPPA . basename($_FILES['kep']['name']);
            if(move_uploaded_file($_FILES['kep']['tmp_name'], $cel)) {
                $uzenet = "Sikeres képfeltöltés!";
            } else {
                $uzenet = "Hiba a fájl mozgatásakor!";
            }
        } else {
            $uzenet = "Hibás formátum! Csak JPG, PNG és GIF engedélyezett.";
        }
    } else {
        $uzenet = "Kérlek, válassz ki egy fájlt a feltöltéshez!";
    }
}

// A meglévő képek beolvasása a mappából a megjelenítéshez
$kepek = array();
$olvaso = opendir($MAPPA);
while (($fajl = readdir($olvaso)) !== false) {
    if (is_file($MAPPA . $fajl)) {
        $kiterjesztes = strtolower(pathinfo($fajl, PATHINFO_EXTENSION));
        if (in_array($kiterjesztes, array('jpg', 'jpeg', 'png', 'gif'))) {
            $kepek[] = $MAPPA . $fajl;
        }
    }
}
closedir($olvaso);
?>