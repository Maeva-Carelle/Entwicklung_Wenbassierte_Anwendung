<?php
require_once 'partials/head.php';
require_once 'partials/navigation.php';
?>

<section>
    <h2>Bäcker</h2>
    <p>Der Bäcker bereitet die Burger zu.</p>

    <form action="https://echo.hofmann-thomas.de" method="POST">
        <h3>Status ändern</h3>
        <p>
            <label>
                <input type="radio" name="baker_status" value="bereit" required>
                Bereit
            </label>
        </p>
        <p>
            <label>
                <input type="radio" name="baker_status" value="inVorbereitung">
                In Vorbereitung
            </label>
        </p>
        <p>
            <label>
                <input type="radio" name="baker_status" value="ausgefallen">
                Ausgefallen
            </label>
        </p>

        <button type="submit">Status aktualisieren</button>
    </form>
</section>

<?php require_once 'partials/footer.php'; ?>