<?php require_once 'partials/head.php'; ?>

<header>
    <h1>Fahrer</h1>
</header>

<main>
    <h2>Lieferstatus</h2>

    <form action="https://echo.hofmann-thomas.de" method="post">

        <p>Bestellung 1: Classic Burger, Paris</p>

        <input type="radio" id="unterwegs" name="lieferstatus" value="unterwegs" required>
        <label for="unterwegs">unterwegs</label>

        <input type="radio" id="geliefert" name="lieferstatus" value="geliefert">
        <label for="geliefert">geliefert</label>

        <p>
            <button type="submit">Status abschicken</button>
        </p>

    </form>
</main>

<?php require_once 'partials/footer.php'; ?>