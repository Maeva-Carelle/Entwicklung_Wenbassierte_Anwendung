<?php
/** @var array $articles */

$articles = $data['articles'] ?? [];

require_once 'partials/head.php';

$page_title = 'Mazama Burger House';
$page_subtitle = 'Unsere Speisekarte';

require_once 'partials/header.php';
?>

    <section class="burger-container">

        <?php foreach ($articles as $article): ?>

            <div class="burger-classic">

                <img
                        src="assets/images/<?= htmlspecialchars($article['picture']) ?>"
                        width="300"
                        height="200"
                        alt="<?= htmlspecialchars($article['name']) ?>"
                >

                <h3>
                    <?= htmlspecialchars($article['name']) ?>
                </h3>

                <strong class="price">
                    <?= number_format($article['price'], 2) ?> €
                </strong>

            </div>

        <?php endforeach; ?>

    </section>


    <section class="extras-section">

        <article class="extra-card"
                 style="background-image: url('assets/images/pommes.png');">

            <div class="extra-content">

                <h3>
                    <img src="assets/images/icon/fritten.png"
                         class="title-icon"
                         alt="">
                    Beilagen
                </h3>

                <p>Pommes Frites <span>3,50 €</span></p>
                <p>Süßkartoffel Pommes <span>4,50 €</span></p>
                <p>Onion Rings <span>4,50 €</span></p>

            </div>

        </article>


        <article class="extra-card"
                 style="background-image: url('assets/images/cola.png');">

            <div class="extra-content">

                <h3>
                    Getränke
                </h3>

                <p>Coca Cola <span>2,50 €</span></p>
                <p>Coca Cola Zero <span>2,50 €</span></p>
                <p>Fanta <span>2,50 €</span></p>

            </div>

        </article>


    </section>



    <form
            action="<?= Router::generateUrl('order') ?>"
            method="POST">


        <section>

            <h2>Warenkorb</h2>

            <label for="warenkorb">
                Wählen Sie mindestens einen Burger:
            </label>

            <br>


            <select
                    name="articles[]"
                    id="warenkorb"
                    multiple
                    size="5"
                    required>


                <?php foreach ($articles as $article): ?>

                    <option
                            value="<?= $article['article_id'] ?>">

                        <?= htmlspecialchars($article['name']) ?>

                        –
                        <?= number_format($article['price'],2) ?> €

                    </option>


                <?php endforeach; ?>


            </select>


        </section>



        <section>

            <h2>Adresse</h2>

            <label for="address">
                Adresse:
            </label>

            <br>

            <input
                    id="address"
                    type="text"
                    name="address"
                    placeholder="Adresse eingeben"
                    required>

        </section>



        <section>

            <h2>Bestellung ansehen</h2>

            <p>
                <strong>Gesamtpreis:</strong>
                wird nach Bestellung berechnet
            </p>

        </section>



        <button type="submit">
            Bestellen
        </button>


        <button type="reset">
            Alles löschen
        </button>


    </form>


<?php require_once 'partials/footer.php'; ?>