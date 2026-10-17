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
        <div class="burger-card">
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



            <strong class="price">
                <?= number_format((float)$article['price'], 2) ?> €
            </strong>
        </div>
    <?php endforeach; ?>

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