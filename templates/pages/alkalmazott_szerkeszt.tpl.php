
<h2>Alkalmazott módosítása</h2>

<?php foreach($hibak as $hiba) { ?>
    <p style="color:red;">
        <?= htmlspecialchars($hiba) ?>
    </p>
<?php } ?>

<?php if($sor) { ?>

<form method="post" action="alkalmazott_szerkeszt">

    <input type="hidden" name="id"
           value="<?= $id ?>">

    Név:<br>
    <input type="text" name="nev"
        value="<?= htmlspecialchars($_POST['nev'] ?? $sor['nev']) ?>">
    <br><br>

    Életkor:<br>
    <input type="text" name="kor"
        value="<?= htmlspecialchars($_POST['kor'] ?? $sor['kor']) ?>">
    <br><br>

    Készségek:<br>
    <input type="text" name="keszsegek"
        value="<?= htmlspecialchars($_POST['keszsegek'] ?? $sor['keszsegek']) ?>">
    <br><br>

    Munkakör:<br>
    <input type="text" name="munkakor"
        value="<?= htmlspecialchars($_POST['munkakor'] ?? $sor['munkakor']) ?>">
    <br><br>

    Cím:<br>
    <input type="text" name="cim"
        value="<?= htmlspecialchars($_POST['cim'] ?? $sor['cim']) ?>">
    <br><br>

    <button type="submit" name="mentes">
        Módosítás mentése
    </button>

</form>

<?php } ?>

<br>

<a href="tablazat">Vissza a táblázathoz</a>
