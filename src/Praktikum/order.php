<?php require_once 'partials/head.php'; ?>

<header>
    <h1>Bestellung</h1>
</header>

<main>

    <section>
        <h2>Speisekarte</h2>

        <article>

            <img src="Bilder/classic_burger.jpg" alt="Classic Burger" width="300">
            <h3>Classic Burger</h3>
            <p>- 7.99€ -</p>
        </article>

        <article>
            <img src="Bilder/double_cheese_burger.png" alt="Double Cheeseburger" width="300">
            <h3>Double Cheeseburger</h3>
            <p>- 10.99€ -</p>
        </article>

        <article>
            <img src="Bilder/veggie_burger.jpg" alt="Veggie Burger" width="300">
            <h3>Veggie Burger</h3>
            <p>- 8.99€ -</p>
        </article>

    </section>

    <form action="https://echo.hofmann-thomas.de" method="post">

        <section>
            <h2>Warenkorb</h2>

            <label for="warenkorb">Ihre Auswahl:</label>
            <br>

            <select id="warenkorb" name="warenkorb[]" multiple required>
                <option value="classicburger">Classic Burger</option>
                <option value="doublecheeseburger">Double Cheeseburger</option>
                <option value="veggieburger">Veggie Burger</option>
            </select>
        </section>

        <section>
            <h2>Lieferadresse</h2>

            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" placeholder="Adresse eingeben" required>
        </section>

        <br>

        <p>Gesamtpreis: 27.97€</p>

        <h2>Zahlungsart</h2>

        <p>
            <input type="radio" id="bar" name="zahlung" value="bar" required>
            <label for="bar">Barzahlung</label>

            <input type="radio" id="karte" name="zahlung" value="karte">
            <label for="karte">Kartenzahlung</label>
        </p>

        <button type="button">Auswahl löschen</button>
        <button type="button">Alles löschen</button>

        <button type="submit">Bestellung abschicken</button>

    </form>

</main>

<?php require_once 'partials/footer.php'; ?>