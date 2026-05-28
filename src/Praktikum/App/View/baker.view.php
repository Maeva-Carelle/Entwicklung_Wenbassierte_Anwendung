<?php
$orders = $data['orders'] ?? [];
$message = $_GET['message'] ?? '';

require_once 'partials/head.php';
?>

<header>
    <h1>Bestellung</h1>

    <?php require_once 'partials/navigation.php'; ?>

    <h2>Bäcker</h2>
</header>

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

                    <h4>Bestellte Artikel:</h4>

                    <ul>
                        <?php foreach ($order['articles'] as $article): ?>
                            <li>
                                <?= htmlspecialchars($article['article_name']) ?>
                                – <?= number_format($article['article_price'], 2) ?> €

                                <span class="status-badge status-<?= $article['status'] ?>">
                                    <?php 
                                    if ($article['status'] == 0) echo 'In Vorbereitung';
                                    elseif ($article['status'] == 1) echo 'Fertig';
                                    else echo 'Ausgeliefert';
                                    ?>
                                </span>

                                <form method="POST" action="?route=baker" class="status-form">
                                    <input type="hidden" name="ordered_article_id" value="<?= $article['ordered_article_id'] ?>">

                                    <select name="status">
                                        <option value="0" <?= $article['status'] == 0 ? 'selected' : '' ?>>In Vorbereitung</option>
                                        <option value="1" <?= $article['status'] == 1 ? 'selected' : '' ?>>Fertig</option>
                                        <option value="2" <?= $article['status'] == 2 ? 'selected' : '' ?>>Ausgeliefert</option>
                                    </select>

                                    <button type="submit">Update</button>
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