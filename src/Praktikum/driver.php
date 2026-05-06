<?php
require_once 'partials/head.php';
require_once 'partials/navigation.php';
?>

<section>
    <h2>Fahrer</h2>
    <p>Der Fahrer liefert die Bestellungen.</p>

    <form action="https://echo.hofmann-thomas.de" method="POST">
        <h3>Lieferstatus ändern</h3>
        <p>
            <label>
                <input type="radio" name="driver_status" value="abholen" required>
                Abholen
            </label>
        </p>
        <p>
            <label>
                <input type="radio" name="driver_status" value="unterwegs">
                Unterwegs
            </label>
        </p>
        <p>
            <label>
                <input type="radio" name="driver_status" value="geliefert">
                Geliefert
            </label>
        </p>

        <button type="submit">Status aktualisieren</button>
    </form>
</section>

<?php require_once 'partials/footer.php'; ?>