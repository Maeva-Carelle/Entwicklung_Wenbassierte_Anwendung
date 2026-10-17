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
        <?php if ($message === 'updated'): ?>
            <div class="alert alert-success">
                Status erfolgreich aktualisiert!
            </div>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <p>Derzeit keine offenen Bestellungen.</p>
        <?php else: ?>

            <?php 
            $groupedOrders = [];

            foreach ($orders as $order) {
                $orderId = (int)$order['ordering_id'];

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

                    <p>
                        <strong>Adresse:</strong>
                        <?= htmlspecialchars((string)$order['address'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p>
                        <strong>Bestellzeit:</strong>
                        <?= htmlspecialchars((string)$order['ordering_time'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <h4 class="ordered_articles">Bestellte Artikel:</h4>

                    <ul>
                        <?php foreach ($order['articles'] as $article): ?>
                            <li>
                                <?= htmlspecialchars((string)$article['article_name'], ENT_QUOTES, 'UTF-8') ?>
                                –
                                <?= number_format((float)$article['article_price'], 2) ?> €

                                <form method="POST" action="<?= Router::generateUrl('baker') ?>" class="status-form">
                                    <input type="hidden" name="ordered_article_id" value="<?= (int)$article['ordered_article_id'] ?>">

                                    <div class="status-options">
                                        <label>
                                            <input
                                                type="radio"
                                                name="status"
                                                value="0"
                                                onclick="this.form.submit();"
                                                <?= (int)$article['status'] === 0 ? 'checked' : '' ?>
                                            >
                                            Bestellt
                                        </label>

                                        <label>
                                            <input
                                                type="radio"
                                                name="status"
                                                value="1"
                                                onclick="this.form.submit();"
                                                <?= (int)$article['status'] === 1 ? 'checked' : '' ?>
                                            >
                                            In Vorbereitung
                                        </label>

                                        <label>
                                            <input
                                                type="radio"
                                                name="status"
                                                value="2"
                                                onclick="this.form.submit();"
                                                <?= (int)$article['status'] === 2 ? 'checked' : '' ?>
                                            >
                                            Fertig
                                        </label>
                                    </div>
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