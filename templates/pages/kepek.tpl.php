<h1>Képgaléria</h1>

<!-- Üzenetek megjelenítése (pl. Sikeres feltöltés vagy törlés) -->
<?php if(isset($uzenet) && $uzenet != "") { ?>
    <h4 style="color: blue;"><?= $uzenet ?></h4>
<?php } ?>

<!-- Feltöltő űrlap CSAK bejelentkezett felhasználóknak -->
<?php if(isset($_SESSION['login'])) { ?>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Új kép feltöltése</legend>
            <input type="file" name="kep" accept="image/png, image/jpeg, image/gif" required>
            <input type="submit" name="kuld" value="Feltöltés">
        </fieldset>
    </form>
    <br>
<?php } else { ?>
    <p><em>Kép feltöltéséhez és törléséhez kérjük, jelentkezz be a rendszerbe!</em></p>
<?php } ?>

<!-- A képek megjelenítése rácsosan -->
<div class="galeria" style="display: flex; flex-wrap: wrap; gap: 15px;">
    <?php foreach($kepek as $kep) { ?>
        <div style="border: 1px solid #ccc; padding: 5px; text-align: center;">
            <img src="<?= $kep ?>" alt="Galéria kép" style="height: 150px; display: block; margin-bottom: 5px;">
            
            <!-- Törlés gomb CSAK bejelentkezett felhasználóknak -->
            <?php if(isset($_SESSION['login'])) { ?>
                <form action="" method="post" style="margin: 0;">
                    <input type="hidden" name="torlendo_kep" value="<?= basename($kep) ?>">
                    <input type="submit" name="torles" value="Törlés" style="background-color: #ff4444; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                </form>
            <?php } ?>
        </div>
    <?php } ?>
</div>