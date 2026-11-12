
<?php

if (!isset($_SESSION['login'])) {
    header("Location: belepes");
    exit;
}

$hibak = [];
$sor = null;
$id = (int)($_POST['id'] ?? 0);

try {

    $dbh = new PDO(
        'mysql:host=localhost;dbname=gyakorlat7',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    if ($id <= 0) {
        throw new Exception("Érvénytelen azonosító!");
    }

    if (isset($_POST['mentes'])) {

        $nev = trim($_POST['nev'] ?? '');
        $kor = trim($_POST['kor'] ?? '');
        $keszsegek = trim($_POST['keszsegek'] ?? '');
        $munkakor = trim($_POST['munkakor'] ?? '');
        $cim = trim($_POST['cim'] ?? '');

        if (strlen($nev) < 2) {
            $hibak[] = "A név túl rövid!";
        }

        if (!filter_var($kor, FILTER_VALIDATE_INT) ||
            $kor < 1 || $kor > 120) {
            $hibak[] = "Hibás életkor!";
        }

        if ($keszsegek == '' || $munkakor == '' || $cim == '') {
            $hibak[] = "Minden mezőt ki kell tölteni!";
        }

        if (empty($hibak)) {

            $sql = "UPDATE alkalmazottak SET
                    nev = ?,
                    kor = ?,
                    keszsegek = ?,
                    munkakor = ?,
                    cim = ?
                    WHERE id = ?";

            $sth = $dbh->prepare($sql);

            $sth->execute([
                $nev,
                $kor,
                $keszsegek,
                $munkakor,
                $cim,
                $id
            ]);

            header("Location: tablazat");
            exit;

        }

    }

    $sth = $dbh->prepare(
        "SELECT * FROM alkalmazottak WHERE id = ?"
    );

    $sth->execute([$id]);

    $sor = $sth->fetch(PDO::FETCH_ASSOC);

    if (!$sor) {
        header("Location: tablazat");
        exit;
    }

}
catch (Exception $e) {

    $hibak[] = "Hiba történt az adatok feldolgozásakor!";

}

?>
