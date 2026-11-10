<h1>Képgaléria</h1>

<!-- Üzenetek megjelenítése (pl. Sikeres feltöltés) -->
<?php if(isset($uzenet) && $uzenet != "") { ?>
    <h4 style="color: blue;"><?= $uzenet ?></h4>
<?php } ?>

<!-- Feltöltő űrlap CSAK bejelentkezett felhasználóknak -->
<?php if(isset($_SESSION['login'])) { ?>
    <form action="?oldal=kepek" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Új kép feltöltése</legend>
            <!-- Az enctype="multipart/form-data" kötelező a fájlfeltöltéshez! -->
            <input type="file" name="kep" accept="image/png, image/jpeg, image/gif" required>
            <input type="submit" name="kuld" value="Feltöltés">
        </fieldset>
    </form>
    <br>
<?php } else { ?>
    <!-- Üzenet a vendégeknek -->
    <p><em>Kép feltöltéséhez kérjük, jelentkezz be a rendszerbe!</em></p>
<?php } ?>

<!-- A képek megjelenítése rácsosan -->
<div class="galeria" style="display: flex; flex-wrap: wrap; gap: 15px;">
    <?php foreach($kepek as $kep) { ?>
        <img src="<?= $kep ?>" alt="Galéria kép" style="height: 150px; border: 1px solid #ccc; padding: 5px;">
    <?php } ?>
</div>