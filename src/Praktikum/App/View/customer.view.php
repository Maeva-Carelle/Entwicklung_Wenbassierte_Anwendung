<?php
$orders = $data['orders'] ?? [];
require_once 'partials/head.php';
?>

<?php
$page_title = 'Mazama Burger House';
$page_subtitle = 'Meine Bestellung';
require_once 'partials/header.php';
?>

    <main>

        <?php if (empty($orders)): ?>
            <p>Derzeit keine Bestellungen.</p>
        <?php else: ?>

            <div class="orders-container">

                <?php foreach ($orders as $order): ?>

                    <?php
                    $statusMap = [
                            0 => ['text' => 'Bestellt', 'class' => 'status-ordered'],
                            1 => ['text' => 'In Vorbereitung', 'class' => 'status-preparing'],
                            2 => ['text' => 'Fertig', 'class' => 'status-ready'],
                            3 => ['text' => 'Unterwegs', 'class' => 'status-delivery']
                    ];

                    $status = $statusMap[$order['status']] ?? ['text' => 'Unbekannt', 'class' => ''];
                    ?>

                    <div class="order-card">

                        <h3>Bestellung #<?= (int)$order['ordering_id'] ?></h3>

                        <p><strong>Adresse:</strong> <?= htmlspecialchars($order['address']) ?></p>
                        <p><strong>Zeit:</strong> <?= htmlspecialchars($order['ordering_time']) ?></p>

                        <p>
                            <strong>Status:</strong>
                            <span class="<?= $status['class'] ?>">
                    <?= htmlspecialchars($status['text']) ?>
                </span>
                        </p>

                        <h4>Artikel:</h4>
                        <ul>
                            <?php foreach ($order['articles'] as $article): ?>
                                <li>
                                    <?= htmlspecialchars($article['name']) ?> –
                                    <?= number_format($article['price'], 2) ?> €
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <p>
                            <strong>Gesamtpreis:</strong>
                            <?= number_format($order['total_price'], 2) ?> €
                        </p>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </main>

<?php require_once 'partials/footer.php'; ?>