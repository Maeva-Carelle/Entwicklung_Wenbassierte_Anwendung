
<!-- order.php -->
<?php
// Daten vom Controller empfangen
$articles = $data['articles'] ?? [];
require_once 'partials/head.php';


?>

    <header>
        <h1>Bestellung</h1>
        <?php require_once 'partials/navigation.php'; ?>
        <h2>Speisekarte</h2>
    </header>
<section class="burger-container">
    <!-- Burger 1 -->
    <div class="burger-classic">
        <h3>Classy</h3>
        <img src="assets/images/simple_burger.jpg" width="300" height="200" alt="Burger-classic">
        <br>
        <i>Ein handgemachter Burger mit einem Patty, Käse, Salat, Tomate, Zwiebeln und heller Sauce und einem Sesam Brötchen.</i>
        <br>
        <strong class="price">10 €</strong>
    </div>

    <!-- Burger 2 -->
    <div class="burger-two-pattys">
        <h3>Double Cheese</h3>
        <img src="assets/images/burger-zwei-pattys.jpg" width="300" height="200" alt="Burger-two-pattys">
        <br>
        <i>Ein hausgemachter Cheese-Burger mit zwei Pattys, jeweils mit Käse überbacken und Salat, Tomaten und roten Zwiebeln und einem Brioche Brötchen mit Sesam.</i>
        <br>
        <strong class="price">12 €</strong>
    </div>

    <!-- Burger 3 -->
    <div class="burger-special">
        <h3>Special</h3>
        <img src="assets/images/burger-zweipattys-bacon.jpg" width="300" height="200" alt="Burger-special">
        <br>
        <i>Ein hausgemachter Cheese-Burger mit zwei Pattys, jeweils mit Käse überbacken und Bacon und einem saftigen Brioche Brötchen.</i>
        <br>
        <strong class="price">15 €</strong>
    </div>
</section>

<form action="?route=order" method="POST">
    <section>
        <h2>Warenkorb</h2>
        <label for="warenkorb">Wählen Sie mindestens einen Burger:</label>
        <br>
       <select name="articles[]" id="warenkorb" multiple size="5" required>
            <?php foreach ($articles as $article): ?>
            <option value="<?= $article['article_id'] ?>">
                <?= htmlspecialchars($article['name']) ?> – <?= number_format($article['price'], 2) ?> €
            </option>
            <?php endforeach; ?>
        </select>
    </section>

    <section>
        <h2>Beilage (optional)</h2>
        <label for="beilage">Wählen Sie Ihre Beilage (optional):</label>
        <br>
        <select name="beilage[]" id="beilage" multiple size="3">
            <option value="Cola">Cola – 2,50 €</option>
            <option value="Pommes">Pommes – 3,90 €</option>
            <option value="Salat">Salat – 3,50 €</option>
            <option value="Smoothie">Smoothie – 4,90 €</option>
        </select>
    </section>

    <section>
        <h2>Adresse</h2>
        <p>
            <label for="adress">Adresse:</label><br>
            <input id="adress" type="text" name="adress" placeholder="Adresse eingeben" required>
        </p>
    </section>

    <section>
        <h2>Bestellung ansehen</h2>
        <p>Gesamtpreis: <strong id="gesamtpreis">17,50 €</strong></p>
    </section>

    <button type="submit">Bestellen</button>
    <button type="reset">Alles löschen</button>
</form>

<?php
require_once 'partials/footer.php';
?>