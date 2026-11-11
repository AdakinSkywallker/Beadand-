<h1>Beérkezett üzenetek</h1>

<?php if (isset($hiba) && $hiba != "") { ?>
    <div style="color: red; font-weight: bold;"><?= $hiba ?></div>
<?php } else { ?>
    <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px;">Dátum</th>
                <th style="padding: 8px;">Küldő neve</th>
                <th style="padding: 8px;">E-mail címe</th>
                <th style="padding: 8px;">Üzenet</th>
                <th style="padding: 8px;">Küldő státusza</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uzenetekLista as $uzenet) { ?>
                <tr>
                    <td style="padding: 8px;"><?= htmlspecialchars($uzenet['datum']) ?></td>
                    <td style="padding: 8px;"><?= htmlspecialchars($uzenet['nev']) ?></td>
                    <td style="padding: 8px;"><?= htmlspecialchars($uzenet['email']) ?></td>
                    <td style="padding: 8px;"><?= nl2br(htmlspecialchars($uzenet['szoveg'])) ?></td>
                    <td style="padding: 8px;"><em><?= htmlspecialchars($uzenet['kuldo_login']) ?></em></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>