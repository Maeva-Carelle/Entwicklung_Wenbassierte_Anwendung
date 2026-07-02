<?php
$articles = $data['articles'] ?? [];
require_once 'partials/head.php';
?>

<script src="/Praktikum/assets/js/script.js?v=5.0" defer></script>

<?php 
$page_title = 'Mazama Burger House';
$page_subtitle = 'Unsere Speisekarte';
require_once 'partials/header.php';
?>

<section class="burger-container">

    <?php foreach ($articles as $article): ?>
        <div class="burger-classic">
            <img 
                class="article-image"
                src="/Praktikum/assets/images/<?= htmlspecialchars((string)$article['picture'], ENT_QUOTES, 'UTF-8') ?>"
                width="300"
                height="200"
                alt="<?= htmlspecialchars((string)$article['name'], ENT_QUOTES, 'UTF-8') ?>"
                data-id="<?= (int)$article['article_id'] ?>"
                data-name="<?= htmlspecialchars((string)$article['name'], ENT_QUOTES, 'UTF-8') ?>"
                data-price="<?= htmlspecialchars((string)$article['price'], ENT_QUOTES, 'UTF-8') ?>"
            >

            <h3><?= htmlspecialchars((string)$article['name'], ENT_QUOTES, 'UTF-8') ?></h3>

            <br>

            <strong class="price">
                <?= number_format((float)$article['price'], 2) ?> €
            </strong>
        </div>
    <?php endforeach; ?>

</section>

<section class="extras-section">

    <article class="extra-card" style="background-image: url('/Praktikum/assets/images/pommes.avif');">
        <div class="extra-content">
            <h3><i class="fa-solid fa-bowl-food"></i> Beilagen</h3>
            <p>Pommes Frites <span>3,50 €</span></p>
            <p>Süßkartoffel Pommes <span>4,50 €</span></p>
            <p>Onion Rings <span>4,50 €</span></p>
            <p>Mozzarella Sticks <span>4,50 €</span></p>
        </div>
    </article>

    <article class="extra-card" style="background-image: url('/Praktikum/assets/images/cola.avif');">
        <div class="extra-content">
            <h3><i class="fa-solid fa-glass-water"></i> Getränke</h3>
            <p>Coca Cola <span>2,50 €</span></p>
            <p>Coca Cola Zero <span>2,50 €</span></p>
            <p>Fanta <span>2,50 €</span></p>
            <p>Sprite <span>2,50 €</span></p>
        </div>
    </article>

    <article class="extra-card" style="background-image: url('/Praktikum/assets/images/sauce.avif');">
        <div class="extra-content">
            <h3><i class="fa-solid fa-bottle-droplet"></i> Saucen</h3>
            <p>Ketchup <span>0,50 €</span></p>
            <p>Mayo <span>0,50 €</span></p>
            <p>BBQ Sauce <span>0,60 €</span></p>
            <p>Chili Sauce <span>0,60 €</span></p>
        </div>
    </article>

</section>

<form id="order-form" action="<?= Router::generateUrl('order') ?>" method="POST">
    <section>
        <h2>Warenkorb</h2>

        <label for="warenkorb">Ihre ausgewählten Burger:</label>
        <br>

        <select name="articles[]" id="warenkorb" multiple size="5"></select>

        <br><br>

        <button type="button" id="remove-selected">
            <i class="fa-solid fa-trash"></i> Ausgewählte löschen
        </button>

        <button type="button" id="clear-cart">
            <i class="fa-solid fa-broom"></i> Warenkorb leeren
        </button>
    </section>

    <section>
        <h2>Adresse</h2>
        <p>
            <label for="address">Adresse:</label><br>
            <input id="address" type="text" name="address" placeholder="Adresse eingeben">
        </p>
    </section>

    <section>
        <h2>Bestellung ansehen</h2>
        <p>
            <strong>Gesamtpreis:</strong>
            <span id="total-price">0.00 €</span>
        </p>
    </section>

    <button type="submit" id="order-button" class="disabled" disabled>
        <i class="fa-solid fa-cart-shopping"></i> Bestellen
    </button>

    <button type="reset" id="reset-button">
        <i class="fa-solid fa-rotate-left"></i> Alles löschen
    </button>
</form>

<?php require_once 'partials/footer.php'; ?>