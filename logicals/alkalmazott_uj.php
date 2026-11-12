
<?php

if (!isset($_SESSION['login'])) {
    header("Location: belepes");
    exit;
}

$hibak = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nev = trim($_POST['nev'] ?? '');
    $kor = trim($_POST['kor'] ?? '');
    $keszsegek = trim($_POST['keszsegek'] ?? '');
    $munkakor = trim($_POST['munkakor'] ?? '');
    $cim = trim($_POST['cim'] ?? '');

    if (strlen($nev) < 2) {
        $hibak[] = "A név legalább 2 karakter legyen!";
    }

    if (!filter_var($kor, FILTER_VALIDATE_INT) ||
        $kor < 1 || $kor > 120) {
        $hibak[] = "Hibás életkor!";
    }

    if ($keszsegek == '' || $munkakor == '' || $cim == '') {
        $hibak[] = "Minden mezőt ki kell tölteni!";
    }

    if (empty($hibak)) {

        try {

            $dbh = new PDO(
                'mysql:host=localhost;dbname=gyakorlat7',
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );

            $sql = "INSERT INTO alkalmazottak
                    (nev, kor, keszsegek, munkakor, cim)
                    VALUES (?, ?, ?, ?, ?)";

            $sth = $dbh->prepare($sql);

            $sth->execute([
                $nev, $kor, $keszsegek, $munkakor, $cim
            ]);

            header("Location: tablazat");
            exit;

        }
        catch (PDOException $e) {
            $hibak[] = "Adatbázis hiba történt!";
        }

    }

}

?>
