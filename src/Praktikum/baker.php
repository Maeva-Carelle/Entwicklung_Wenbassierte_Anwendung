<?php require 'partials/head.php'; ?>
<?php require 'partials/header.php'; ?>
<?php require 'partials/nav.php'; ?>

<main>
    <section>
        <h2>Offene Bestellungen</h2>

        <article>
            <h3>Bestellung #1</h3>
            <p>Burger: Classic Cheeseburger, BBQ Bacon Burger</p>
            <p>Status: Neu</p>
            <form action="https://echo.hofmann-thomas.de" method="post">
                <input type="hidden" name="bestellung_id" value="1" />
                <input type="hidden" name="aktion" value="zubereitet" />
                <button type="submit">Als zubereitet markieren</button>
            </form>
        </article>

        <article>
            <h3>Bestellung #2</h3>
            <p>Burger: Chicken Crispy</p>
            <p>Status: Neu</p>
            <form action="https://echo.hofmann-thomas.de" method="post">
                <input type="hidden" name="bestellung_id" value="2" />
                <input type="hidden" name="aktion" value="zubereitet" />
                <button type="submit">Als zubereitet markieren</button>
            </form>
        </article>
    </section>
</main>

<?php require 'partials/footer.php'; ?>