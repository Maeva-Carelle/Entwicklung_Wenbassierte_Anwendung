<?php
$orders = $data['orders'] ?? [];
$message = $_GET['message'] ?? '';

require_once 'partials/head.php';
?>

<?php 
$page_title = 'Mazama Burger House';
$page_subtitle = 'Meine Bestellung';
require_once 'partials/header.php';
?>

<main>
    <!-- PRG-Pattern: Erfolgsmeldung nach Bestellung -->
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
            // Gruppieren nach Bestellung
            $groupedOrders = [];
            foreach ($orders as $order) {
                $orderId = $order['ordering_id'];
                if (!isset($groupedOrders[$orderId])) {
                    $groupedOrders[$orderId] = [
                        'ordering_id' => $orderId,
                        'address' => $order['address'],
                        'ordering_time' => $order['ordering_time'],
                        'articles' => []
                    ];
                }
                $groupedOrders[$orderId]['articles'][] = [
                    'name' => $order['article_name'],
                    'price' => $order['article_price'],
                    'status' => $order['status']
                ];
            }
            ?>

            <?php foreach ($groupedOrders as $order): ?>
                <div class="order-card">
                    <h3>Bestellung #<?= (int)$order['ordering_id'] ?></h3>
                    <p><strong>Adresse:</strong> <?= htmlspecialchars($order['address']) ?></p>
                    <p><strong>Zeit:</strong> <?= htmlspecialchars($order['ordering_time']) ?></p>

                    <h4>Artikel:</h4>
                    <ul>
                        <?php foreach ($order['articles'] as $article): ?>
                            <li>
                                <?= htmlspecialchars($article['name']) ?> – <?= number_format($article['price'], 2) ?> €
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php
$allStatuses = array_map('intval', array_column($order['articles'], 'status'));

/*
 * Nimmt den höchsten Status der Bestellung:
 * 0 = Bestellt
 * 1 = In Vorbereitung
 * 2 = Fertig
 * 3 = Unterwegs
 */
$currentStatus = max($allStatuses);

$statusMap = [
    0 => [
        'text'  => 'Bestellt',
        'class' => 'status-ordered'
    ],
    1 => [
        'text'  => 'In Vorbereitung',
        'class' => 'status-preparing'
    ],
    2 => [
        'text'  => 'Fertig',
        'class' => 'status-ready'
    ],
    3 => [
        'text'  => 'Unterwegs',
        'class' => 'status-delivery'
    ]
];

$statusText = $statusMap[$currentStatus]['text'] ?? 'Unbekannt';
$statusClass = $statusMap[$currentStatus]['class'] ?? '';
?>

<p>
    <strong>Status:</strong>
    <span class="status-badge <?= $statusClass ?>">
        <?= htmlspecialchars($statusText) ?>
    </span>
</p>
                   

                    <br>
                    <p><strong>Gesamtpreis:</strong>
                        <?= number_format(array_sum(array_column($order['articles'], 'price')), 2) ?> €
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>
</main>

<?php require_once 'partials/footer.php'; ?>