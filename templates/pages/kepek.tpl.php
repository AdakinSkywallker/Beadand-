<h1>Képgaléria</h1>

<?php if(isset($uzenet) && $uzenet != "") { ?>
    <h4 style="color: blue; text-align: center;"><?= $uzenet ?></h4>
<?php } ?>

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

<div class="galeria-tarolo">
    <?php foreach($kepek as $kep) { ?>
        <div>
            <img src="<?= $kep ?>" alt="Galéria kép">
            
            <?php if(isset($_SESSION['login'])) { ?>
                <form action="" method="post">
                    <input type="hidden" name="torlendo_kep" value="<?= basename($kep) ?>">
                    <input type="submit" name="torles" value="Törlés">
                </form>
            <?php } ?>
        </div>
    <?php } ?>
</div>