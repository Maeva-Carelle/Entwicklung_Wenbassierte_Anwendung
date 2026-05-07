<?php require_once 'partials/head.php'; ?>

<header>
    <h1>Küche</h1>
</header>

<main>
    <h2>Bestellungen in der Küche</h2>

    <form action="https://echo.hofmann-thomas.de" method="post">

        <p>Classic Burger</p>

        <input type="radio" id="classic_bestellt" name="classic_status" value="bestellt" required>
        <label for="classic_bestellt">bestellt</label>

        <input type="radio" id="classic_in_zubereitung" name="classic_status" value="in_zubereitung">
        <label for="classic_in_zubereitung">in Zubereitung</label>

        <input type="radio" id="classic_fertig" name="classic_status" value="fertig">
        <label for="classic_fertig">fertig</label>

        <p>Double Cheeseburger</p>

        <input type="radio" id="double_bestellt" name="double_status" value="bestellt" required>
        <label for="double_bestellt">bestellt</label>

        <input type="radio" id="double_in_zubereitung" name="double_status" value="in_zubereitung">
        <label for="double_in_zubereitung">in Zubereitung</label>

        <input type="radio" id="double_fertig" name="double_status" value="fertig">
        <label for="double_fertig">fertig</label>

        <p>Veggie Burger</p>

        <input type="radio" id="veggie_bestellt" name="veggie_status" value="bestellt" required>
        <label for="veggie_bestellt">bestellt</label>

        <input type="radio" id="veggie_in_zubereitung" name="veggie_status" value="in_zubereitung">
        <label for="veggie_in_zubereitung">in Zubereitung</label>

        <input type="radio" id="veggie_fertig" name="veggie_status" value="fertig">
        <label for="veggie_fertig">fertig</label>

        <p>
            <button type="submit">Status abschicken</button>
        </p>

    </form>
</main>

<?php require_once 'partials/footer.php'; ?>