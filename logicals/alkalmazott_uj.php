
<?php

if (!isset($_SESSION['login'])) {
    header("Location: belepes");
    exit;
}

$hibak = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nev = trim($_POST['nev'] ?? '');
    $eletkor = trim($_POST['eletkor'] ?? '');
    $keszsegek = trim($_POST['keszsegek'] ?? '');
    $munkakor = trim($_POST['munkakor'] ?? '');
    $lakcim = trim($_POST['lakcim'] ?? '');

    if (strlen($nev) < 2) {
        $hibak[] = "A név legalább 2 karakter legyen!";
    }

    if (!filter_var($eletkor, FILTER_VALIDATE_INT) ||
        $eletkor < 1 || $eletkor > 120) {
        $hibak[] = "Hibás életkor!";
    }

    if ($keszsegek == '' || $munkakor == '' || $lakcim == '') {
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
                    (nev, eletkor, keszsegek, munkakor, lakcim)
                    VALUES (?, ?, ?, ?, ?)";

            $sth = $dbh->prepare($sql);

            $sth->execute([
                $nev, $eletkor, $keszsegek, $munkakor, $lakcim
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
