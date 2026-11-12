<h2>Alkalmazottak kezelése</h2>

<?php if (isset($_SESSION['login'])) { ?>
    <a href="alkalmazott_uj">
        <button type="button">Add New</button>
    </a>
<?php } ?>

<br><br>

<?php if (isset($hiba)) { ?>
    <p><?= htmlspecialchars($hiba) ?></p>
<?php } ?>

<table class="crud-table">

    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Skills</th>
        <th>Designation</th>
        <th>Address</th>

        <?php if (isset($_SESSION['login'])) { ?>
            <th>Actions</th>
        <?php } ?>
    </tr>

    <?php foreach ($alkalmazottak as $sor) { ?>

    <tr>

        <td><?= htmlspecialchars($sor['nev']) ?></td>
        <td><?= htmlspecialchars($sor['kor']) ?></td>
        <td><?= htmlspecialchars($sor['keszsegek']) ?></td>
        <td><?= htmlspecialchars($sor['munkakor']) ?></td>
        <td><?= htmlspecialchars($sor['cim']) ?></td>

        <?php if (isset($_SESSION['login'])) { ?>
            <td>

                <form action="alkalmazott_szerkeszt" method="post">
                    <input type="hidden" name="id"
                           value="<?= $sor['id'] ?>">
                    <button class="edit" type="submit">Edit</button>
                </form>

                <form action="alkalmazott_torol" method="post"
                      onsubmit="return confirm('Biztosan törlöd?');">
                    <input type="hidden" name="id"
                           value="<?= $sor['id'] ?>">
                    <button class="delete" type="submit">Delete</button>
                </form>

            </td>
        <?php } ?>

    </tr>

    <?php } ?>

</table>