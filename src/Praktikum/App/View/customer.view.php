<?php

$order = $data['order'] ?? [];
require_once 'partials/head.php';
?>

<?php
$page_title = 'Mazama Burger House';
$page_subtitle = 'Meine Bestellung';
require_once 'partials/header.php';
?>

    <main>

        <?php if (!$order): ?>

            <p>Derzeit keine Bestellungen.</p>

        <?php else: ?>

            <?php
            $statusMap = [
                    0 => ['text' => 'Bestellt', 'class' => 'status-ordered'],
                    1 => ['text' => 'In Vorbereitung', 'class' => 'status-preparing'],
                    2 => ['text' => 'Fertig', 'class' => 'status-ready'],
                    3 => ['text' => 'Unterwegs', 'class' => 'status-delivery']
            ];

            $status = $statusMap[$order['status'] ?? 0] ?? ['text' => 'Unbekannt', 'class' => ''];
            ?>

            <div class="order-card">

                <h3>Bestellung #<?= (int)($order[0]['ordering_id'] ?? 0) ?></h3>

                <p>
                    <strong>Adresse:</strong>
                    <?= htmlspecialchars($order[0]['address'] ?? '') ?>
                </p>

                <h4>Artikel:</h4>
                <ul>
                    <?php foreach ($order as $article): ?>
                        <li>
                            <?= htmlspecialchars($article['article_name']) ?>
                            (<?= (float)$article['article_price'] ?> €)
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>

        <?php endif; ?>

    </main>

<?php require_once 'partials/footer.php'; ?>