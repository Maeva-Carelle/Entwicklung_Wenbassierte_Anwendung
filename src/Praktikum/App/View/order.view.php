
<!-- order.php -->
<?php
// Daten vom Controller empfangen
$articles = $data['articles'] ?? [];
require_once 'partials/head.php';


?>

    <?php 
$page_title = 'Mazama Burger House';
$page_subtitle = 'Unsere Speisekarte';
require_once 'partials/header.php';
?>
<section class="burger-container">
    <!-- Burger 1 -->
    <div class="burger-classic">
        <img src="assets/images/simple_burger.jpg" width="300" height="200" alt="Burger-classic">
        <h3>Classy</h3>
        <br>
        <i>Ein handgemachter Burger mit einem Patty, Käse, Salat, Tomate, Zwiebeln und heller Sauce und einem Sesam Brötchen.</i>
        <br>
        <strong class="price">10 €</strong>
    </div>

    <!-- Burger 2 -->
    <div class="burger-two-pattys">
        <img src="assets/images/burger-zwei-pattys.jpg" width="300" height="200" alt="Burger-two-pattys">
         <h3>Double Cheese</h3>
        <br>
        <i>Ein hausgemachter Cheese-Burger mit zwei Pattys, jeweils mit Käse überbacken und Salat, Tomaten und roten Zwiebeln und einem Brioche Brötchen mit Sesam.</i>
        <br>
        <strong class="price">12 €</strong>
    </div>

    <!-- Burger 3 -->
    <div class="burger-special">
        <img src="assets/images/burger-zweipattys-bacon.jpg" width="300" height="200" alt="Burger-special">
        <h3>Special</h3>
        <br>
        <i>Ein hausgemachter Cheese-Burger mit zwei Pattys, jeweils mit Käse überbacken und Bacon und einem saftigen Brioche Brötchen.</i>
        <br>
        <strong class="price">15 €</strong>
    </div>
</section>


<section class="extras-section">

    <article class="extra-card" style="background-image: url('assets/images/pommes.png');">
        <div class="extra-content">
           <h3>
    <img src="assets/images/icon/fritten.png" class="title-icon" alt="">
    Beilagen
        </h3>

            <p>Pommes Frites <span>3,50 €</span></p>
            <p>Süßkartoffel Pommes <span>4,50 €</span></p>
            <p>Onion Rings <span>4,50 €</span></p>
            <p>Mozzarella Sticks <span>4,50 €</span></p>
        </div>
    </article>

   <article class="extra-card" style="background-image: url('assets/images/cola.png');">
        <div class="extra-content">
            <h3>
    <img src="assets/images/icon/soda-drink.png" class="title-icon icon-orange" alt="">
    Getränke
</h3>

            <p>Coca Cola <span>2,50 €</span></p>
            <p>Coca Cola Zero <span>2,50 €</span></p>
            <p>Fanta <span>2,50 €</span></p>
            <p>Sprite <span>2,50 €</span></p>
        </div>
    </article>

    <article class="extra-card" style="background-image: url('assets/images/sauce.png');">
        <div class="extra-content">
            <h3>
    <img src="assets/images/icon/saucen.png" class="title-icon icon-orange" alt="">
    Saucen
</h3>

            <p>Ketchup <span>0,50 €</span></p>
            <p>Mayo <span>0,50 €</span></p>
            <p>BBQ Sauce <span>0,60 €</span></p>
            <p>Chili Sauce <span>0,60 €</span></p>
        </div>
    </article>

</section>


<form method="POST" action="<?= Router::generateUrl('order') ?>">
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
            <label for="address">Adresse:</label><br>
            <input id="address" type="text" name="address" placeholder="Adresse eingeben" required>
        </p>
    </section>

    <section>
    <h2>Bestellung ansehen</h2>
    <p>
        <strong>Gesamtpreis:</strong> wird nach Bestellung berechnet
    </p>
</section>

    <button type="submit">Bestellen</button>
    <button type="reset">Alles löschen</button>
</form>

<?php
require_once 'partials/footer.php';
?>