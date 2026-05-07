<?php require 'partials/head.php'; ?>
<?php require 'partials/header.php'; ?>
<?php require 'partials/nav.php'; ?>

<main>
    <section>
        <h2>Auslieferungsbereit</h2>

        <article>
            <h3>Bestellung #1</h3>
            <p>Burger: Classic Cheeseburger, BBQ Bacon Burger</p>
            <p>Lieferadresse: Max Mustermann, Musterstraße 1, 64283 Darmstadt</p>
            <p>Status: Zubereitet</p>
            <form action="https://echo.hofmann-thomas.de" method="post">
                <input type="hidden" name="bestellung_id" value="1" />
                <input type="hidden" name="aktion" value="ausgeliefert" />
                <button type="submit">Als ausgeliefert markieren</button>
            </form>
        </article>

        <article>
            <h3>Bestellung #3</h3>
            <p>Burger: Chicken Crispy, Classic Cheeseburger</p>
            <p>Lieferadresse: Anna Schmidt, Hauptweg 5, 64289 Darmstadt</p>
            <p>Status: Zubereitet</p>
            <form action="https://echo.hofmann-thomas.de" method="post">
                <input type="hidden" name="bestellung_id" value="3" />
                <input type="hidden" name="aktion" value="ausgeliefert" />
                <button type="submit">Als ausgeliefert markieren</button>
            </form>
        </article>
    </section>
</main>

<?php require 'partials/footer.php'; ?>