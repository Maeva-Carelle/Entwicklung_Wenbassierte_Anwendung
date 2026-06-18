<?php
$orders = $data['orders'] ?? [];
$message = $_GET['message'] ?? '';

require_once 'partials/head.php';
?>

<?php 
$page_title = 'Mazama Burger House';
$page_subtitle = 'Bäcker';
require_once 'partials/header.php';
?>

<main>
    <section>
        

        <!-- PRG-Pattern: Erfolgsmeldung anzeigen -->
        <?php if ($message === 'updated'): ?>
            <div class="alert alert-success">
                Status erfolgreich aktualisiert!
            </div>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <p>Derzeit keine offenen Bestellungen.</p>
        <?php else: ?>

            <!-- Gruppieren nach Bestellung -->
            <?php 
            $groupedOrders = [];

            foreach ($orders as $order) {
                $orderId = $order['ordering_id'];

                if (!isset($groupedOrders[$orderId])) {
                    $groupedOrders[$orderId] = [
                        'ordering_id' => $order['ordering_id'],
                        'address' => $order['address'],
                        'ordering_time' => $order['ordering_time'],
                        'articles' => []
                    ];
                }

                $groupedOrders[$orderId]['articles'][] = [
                    'ordered_article_id' => $order['ordered_article_id'],
                    'article_name' => $order['article_name'],
                    'article_price' => $order['article_price'],
                    'status' => $order['status']
                ];
            }
            ?>

            <?php foreach ($groupedOrders as $order): ?>
                <div class="order-card">

                    <h3>Bestellung #<?= (int)$order['ordering_id'] ?></h3>

                    <p><strong>Adresse:</strong> <?= htmlspecialchars($order['address']) ?></p>
                    <p><strong>Bestellzeit:</strong> <?= htmlspecialchars($order['ordering_time']) ?></p>

                    <h4 class="ordered_articles">Bestellte Artikel:</h4>

                    <ul>
                        <?php foreach ($order['articles'] as $article): ?>
                            <li>
                                <?= htmlspecialchars($article['article_name']) ?>
                                – <?= number_format($article['article_price'], 2) ?> €

                                
                                <form method="POST" action="<?= Router::generateUrl('baker') ?>" class="status-form">

    <input type="hidden" name="ordered_article_id" value="<?= $article['ordered_article_id'] ?>">

    <div class="status-options">

        <label>
            <input type="radio" name="status" value="0" <?= $article['status'] == 0 ? 'checked' : '' ?>>
            Bestellt
        </label>

        <label>
            <input type="radio" name="status" value="1" <?= $article['status'] == 1 ? 'checked' : '' ?>>
            In Vorbereitung
        </label>

        <label>
            <input type="radio" name="status" value="2" <?= $article['status'] == 2 ? 'checked' : '' ?>>
            Fertig
        </label>

    </div>

    <button type="submit">Speichern</button>

</form>

                                
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </section>
</main>

<?php require_once 'partials/footer.php'; ?>