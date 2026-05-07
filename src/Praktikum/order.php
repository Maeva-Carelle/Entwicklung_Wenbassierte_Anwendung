<?php require 'partials/head.php'; ?>
<?php require 'partials/header.php'; ?>
<?php require 'partials/nav.php'; ?>

<main>
    <section>
        <h2>Unsere Burger</h2>

        <article>
            <h3>Classic Cheeseburger</h3>
            <p>Rindfleisch, Cheddar, Salat, Tomate, Zwiebel</p>
            <p>Preis: 8,90 €</p>
        </article>

        <article>
            <h3>BBQ Bacon Burger</h3>
            <p>Rindfleisch, Bacon, BBQ-Sauce, Röstzwiebeln</p>
            <p>Preis: 10,50 €</p>
        </article>

        <article>
            <h3>Chicken Crispy</h3>
            <p>Knuspriges Hähnchen, Salat, Honig-Senf-Sauce</p>
            <p>Preis: 9,50 €</p>
        </article>
    </section>

    <section>
        <h2>Unsere Beilagen</h2>

        <article>
            <h3>Pommes Frites</h3>
            <p>Klassisch, knusprig</p>
            <p>Preis: 3,50 €</p>
        </article>

        <article>
            <h3>Süßkartoffel-Pommes</h3>
            <p>Mit Paprika gewürzt</p>
            <p>Preis: 4,50 €</p>
        </article>

        <article>
            <h3>Cola</h3>
            <p>0,5 L</p>
            <p>Preis: 2,50 €</p>
        </article>

        <article>
            <h3>Wasser</h3>
            <p>0,5 L still oder sprudelnd</p>
            <p>Preis: 2,00 €</p>
        </article>
    </section>

    <section>
        <h2>Bestellung aufgeben</h2>

        <form action="https://echo.hofmann-thomas.de" method="post">
            <h3>Warenkorb</h3>
            <p>Halte Shift oder Strg/Cmd gedrückt, um mehrere Artikel auszuwählen.</p>

            <label for="warenkorb">Artikel auswählen:</label>
            <select name="warenkorb[]" id="warenkorb" multiple size="7">
                <optgroup label="Burger">
                    <option value="cheeseburger">Classic Cheeseburger – 8,90 €</option>
                    <option value="bbq">BBQ Bacon Burger – 10,50 €</option>
                    <option value="chicken">Chicken Crispy – 9,50 €</option>
                </optgroup>
                <optgroup label="Beilagen &amp; Getränke">
                    <option value="pommes">Pommes Frites – 3,50 €</option>
                    <option value="suess_pommes">Süßkartoffel-Pommes – 4,50 €</option>
                    <option value="cola">Cola – 2,50 €</option>
                    <option value="wasser">Wasser – 2,00 €</option>
                </optgroup>
            </select>

            <h3>Lieferadresse</h3>

            <p>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required />
            </p>

            <p>
                <label for="strasse">Straße und Hausnummer:</label>
                <input type="text" id="strasse" name="strasse" required />
            </p>

            <p>
                <label for="plz">PLZ:</label>
                <input type="text" id="plz" name="plz" required />
            </p>

            <p>
                <label for="ort">Ort:</label>
                <input type="text" id="ort" name="ort" required />
            </p>

            <p>
                <button type="submit">Bestellung abschicken</button>
            </p>
        </form>
    </section>
</main>

<?php require 'partials/footer.php'; ?>