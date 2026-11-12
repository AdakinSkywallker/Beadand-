
<h2>Alkalmazottak kezelése</h2>

<?php if (isset($_SESSION['login'])) { ?>
    <a href="alkalmazott_uj">
        <button type="button">Új alkalmazott hozzáadása</button>
    </a>
<?php } ?>

<br><br>

<?php if (isset($hiba)) { ?>
    <p><?= htmlspecialchars($hiba) ?></p>
<?php } ?>

<table class="crud-table">

    <tr>
        <th>Név</th>
        <th>Életkor</th>
        <th>Készségek</th>
        <th>Munkakör</th>
        <th>Lakcím</th>

        <?php if (isset($_SESSION['login'])) { ?>
            <th>Műveletek</th>
        <?php } ?>
    </tr>

    <?php foreach ($alkalmazottak as $sor) { ?>

    <tr>

        <td><?= htmlspecialchars($sor['nev']) ?></td>
        <td><?= htmlspecialchars($sor['eletkor']) ?></td>
        <td><?= htmlspecialchars($sor['keszsegek']) ?></td>
        <td><?= htmlspecialchars($sor['munkakor']) ?></td>
        <td><?= htmlspecialchars($sor['lakcim']) ?></td>

        <?php if (isset($_SESSION['login'])) { ?>
            <td>

                <form action="alkalmazott_szerkeszt" method="post">
                    <input type="hidden" name="id"
                           value="<?= $sor['id'] ?>">
                    <button class="edit" type="submit">Szerkesztés</button>
                </form>

                <form action="alkalmazott_torol" method="post"
                      onsubmit="return confirm('Biztosan törölni szeretnéd ezt az alkalmazottat?');">
                    <input type="hidden" name="id"
                           value="<?= $sor['id'] ?>">
                    <button class="delete" type="submit">Törlés</button>
                </form>

            </td>
        <?php } ?>

    </tr>

    <?php } ?>

</table>