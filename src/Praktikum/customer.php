<?php
require_once 'partials/head.php';
require_once 'partials/navigation.php';

// Bestellte Artikel (simuliert)
$bestellungen = [
    ['name' => 'Classic', 'price' => '10 €'],
    ['name' => 'Cola', 'price' => '2,50 €']
];
?>

<section>
    <h2>Bestellübersicht</h2>
    <ul>
        <?php foreach ($bestellungen as $bestellung): ?>
            <li><?= htmlspecialchars($bestellung['name']) ?> – <?= htmlspecialchars($bestellung['price']) ?></li>
        <?php endforeach; ?>
    </ul>
</section>

<section>
    <h2>Status Ihrer Bestellung</h2>
    <p>
        <label>
            <input type="radio" name="status" value="inVorbereitung" checked>
            Noch in Vorbereitung (Bäcker)
        </label>
    </p>
    <p>
        <label>
            <input type="radio" name="status" value="unterwegs">
            Unterwegs (Fahrer)
        </label>
    </p>
    <p>
        <label>
            <input type="radio" name="status" value="geliefert">
            Geliefert
        </label>
    </p>
</section>

<?php require_once 'partials/footer.php'; ?>