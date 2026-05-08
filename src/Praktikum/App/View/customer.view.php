<!-- App/View/customer.view.php -->
<h2>Bestellübersicht</h2>
<ul>
    <?php foreach ($articles as $article): ?>
        <li><?= htmlspecialchars($article['name']) ?> – <?= htmlspecialchars($article['price']) ?></li>
    <?php endforeach; ?>
</ul>

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