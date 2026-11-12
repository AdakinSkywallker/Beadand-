
<h2>Új alkalmazott felvétele</h2>

<?php foreach ($hibak as $hiba) { ?>
    <p style="color:red;">
        <?= htmlspecialchars($hiba) ?>
    </p>
<?php } ?>

<form method="post" action="alkalmazott_uj">

    Név:<br>
    <input type="text" name="nev"><br><br>

    Életkor:<br>
    <input type="number" name="eletkor"><br><br>

    Készségek:<br>
    <input type="text" name="keszsegek"><br><br>

    Munkakör:<br>
    <input type="text" name="munkakor"><br><br>

    Lakcím:<br>
    <input type="text" name="lakcim"><br><br>

    <button type="submit">Mentés</button>

</form>

<br>

<a href="tablazat">Vissza a táblázathoz</a>
