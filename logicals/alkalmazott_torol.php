
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        $dbh = new PDO(
            'mysql:host=localhost;dbname=gyakorlat7',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );

        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {

            $sth = $dbh->prepare(
                "DELETE FROM alkalmazottak WHERE id = ?"
            );

            $sth->execute([$id]);

        }

    }
    catch (PDOException $e) {

        // Adatbázishiba kezelése

    }

}

header("Location: tablazat");
exit;

?>
