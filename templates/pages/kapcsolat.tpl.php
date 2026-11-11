<h1>Kapcsolat</h1>

<?php if ($sikeres) { ?>
    <!-- EZ A KÉRT "ÚJ OLDAL/TARTALOM" SIKERES KÜLDÉS UTÁN -->
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; border: 1px solid #c3e6cb;">
        <h3>Köszönjük az üzenetet!</h3>
        <p>Az alábbi adatokat sikeresen rögzítettük és elküldtük az oldal tulajdonosának:</p>
        <ul>
            <li><strong>Név:</strong> <?= htmlspecialchars($elkuldott_adatok['nev']) ?></li>
            <li><strong>E-mail:</strong> <?= htmlspecialchars($elkuldott_adatok['email']) ?></li>
            <li><strong>Üzenet:</strong> <?= nl2br(htmlspecialchars($elkuldott_adatok['szoveg'])) ?></li>
            <li><strong>Küldő státusza:</strong> <?= htmlspecialchars($elkuldott_adatok['login']) ?></li>
        </ul>
        <br>
        <a href="?oldal=kapcsolat">Új üzenet írása</a>
    </div>
<?php } else { ?>
    <!-- HIBAÜZENET MEGJELENÍTÉSE -->
    <?php if ($hiba != "") { ?>
        <div style="color: red; font-weight: bold; margin-bottom: 15px;"><?= $hiba ?></div>
    <?php } ?>

    <!-- AZ ŰRLAP (HTML5 validáció nélkül, type="text"-ként minden) -->
    <form name="kapcsolatForm" action="" method="POST" onsubmit="return ellenoriz();">
        <fieldset>
            <legend>Írjon nekünk üzenetet!</legend>
            
            <label for="nev">Név:</label><br>
            <input type="text" id="nev" name="nev" style="width: 300px;"><br><br>
            
            <label for="email">E-mail cím:</label><br>
            <!-- Szándékosan type="text" a type="email" helyett! -->
            <input type="text" id="email" name="email" style="width: 300px;"><br><br>
            
            <label for="szoveg">Üzenet:</label><br>
            <textarea id="szoveg" name="szoveg" rows="5" style="width: 300px;"></textarea><br><br>
            
            <input type="submit" name="kuld" value="Üzenet elküldése">
        </fieldset>
    </form>

    <!-- KLIENSOLDALI ELLENŐRZÉS (JavaScript) -->
    <script>
    function ellenoriz() {
        var nev = document.getElementById("nev").value;
        var email = document.getElementById("email").value;
        var szoveg = document.getElementById("szoveg").value;
        var hiba = "";

        if (nev.trim() === "") {
            hiba += "Kliens hiba: A név megadása kötelező!\n";
        }
        if (email.trim() === "") {
            hiba += "Kliens hiba: Az e-mail cím megadása kötelező!\n";
        } else {
            // Egyszerű Regex az e-mail formátum ellenőrzésére
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!re.test(email)) {
                hiba += "Kliens hiba: Az e-mail cím formátuma hibás!\n";
            }
        }
        if (szoveg.trim() === "") {
            hiba += "Kliens hiba: Az üzenet mező nem lehet üres!\n";
        }

        if (hiba !== "") {
            alert(hiba); // Hibaüzenet felugró ablakban
            return false; // Megakadályozza az űrlap elküldését
        }
        
        return true; // Ha minden jó, mehet a PHP-nak
    }
    </script>
<?php } ?>