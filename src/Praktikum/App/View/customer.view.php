<?php
$orders = $data['orders'] ?? [];
$message = $data['message'] ?? '';

require_once 'partials/head.php';
?>

<script src="assets/js/customer.js?v=1.0" defer></script>

<?php 
$page_title = 'Mazama Burger House';
$page_subtitle = 'Meine Bestellung';
require_once 'partials/header.php';
?>

<main>
    <?php if ($message === 'success'): ?>
        <div class="alert alert-success">
            Ihre Bestellung wurde erfolgreich aufgegeben!
        </div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <p>Derzeit keine Bestellungen.</p>
    <?php else: ?>
        <div class="orders-container">

            <?php
            $groupedOrders = [];

            foreach ($orders as $order) {
                $orderId = (int)$order['ordering_id'];

                if (!isset($groupedOrders[$orderId])) {
                    $groupedOrders[$orderId] = [
                        'ordering_id' => $orderId,
                        'address' => $order['address'],
                        'ordering_time' => $order['ordering_time'],
                        'articles' => []
                    ];
                }

                $groupedOrders[$orderId]['articles'][] = [
                    'ordered_article_id' => $order['ordered_article_id'],
                    'name' => $order['article_name'],
                    'price' => $order['article_price'],
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
                        <strong>Zeit:</strong>
                        <?= htmlspecialchars((string)$order['ordering_time'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <h4>Artikel:</h4>
                    <ul>
                        <?php foreach ($order['articles'] as $article): ?>
                            <li>
                                <?= htmlspecialchars((string)$article['name'], ENT_QUOTES, 'UTF-8') ?>
                                –
                                <?= number_format((float)$article['price'], 2) ?> €

                                <span
                                    class="status-badge"
                                    data-ordered-article-id="<?= (int)$article['ordered_article_id'] ?>"
                                >
                                    <?= htmlspecialchars((string)$article['status'], ENT_QUOTES, 'UTF-8') ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <p>
                        <strong>Gesamtpreis:</strong>
                        <?= number_format((float)array_sum(array_column($order['articles'], 'price')), 2) ?> €
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>
</main>

<?php require_once 'partials/footer.php'; ?>