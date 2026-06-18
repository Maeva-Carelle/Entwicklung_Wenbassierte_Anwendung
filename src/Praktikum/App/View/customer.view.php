<?php
$orders = $data['orders'] ?? [];
$message = $data['message'] ?? '';

require_once 'partials/head.php';
?>

<?php
$page_title = 'Mazama Burger House';
$page_subtitle = 'Meine Bestellung';
require_once 'partials/header.php';

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

            <?php foreach ($orders as $order): ?>

                <?php
                $statusText =
                    $statusMap[$order['current_status']]['text']
                    ?? 'Unbekannt';

                $statusClass =
                    $statusMap[$order['current_status']]['class']
                    ?? '';
                ?>

                <div class="order-card">

                    <h3>
                        Bestellung #<?= (int)$order['ordering_id'] ?>
                    </h3>

                    <p>
                        <strong>Adresse:</strong>
                        <?= htmlspecialchars($order['address']) ?>
                    </p>

                    <p>
                        <strong>Zeit:</strong>
                        <?= htmlspecialchars($order['ordering_time']) ?>
                    </p>

                    <h4>Artikel:</h4>

                    <ul>
                        <?php foreach ($order['articles'] as $article): ?>
                            <li>
                                <?= htmlspecialchars($article['name']) ?>
                                –
                                <?= number_format($article['price'], 2) ?> €
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <p>
                        <strong>Status:</strong>

                        <span class="status-badge <?= $statusClass ?>">
                            <?= htmlspecialchars($statusText) ?>
                        </span>
                    </p>

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