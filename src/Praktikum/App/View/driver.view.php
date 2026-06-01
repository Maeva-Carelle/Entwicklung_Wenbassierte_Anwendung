<?php
$orders = $data['orders'] ?? [];
$message = $_GET['message'] ?? '';

require_once 'partials/head.php';

?>

<header>
    <h1>Mazama Burger House</h1>

    <?php require_once 'partials/navigation.php'; ?>

    <h2>Fahrer</h2>
</header>

<main>

<section>
    
    <p>Der Fahrer liefert die Bestellungen.</p>

    <?php if ($message === 'updated'): ?>
        <p style="color: green;">Status erfolgreich aktualisiert!</p>
    <?php endif; ?>

    <?php if ($message === 'deleted'): ?>
        <p style="color: green;">Bestellung als ausgeliefert markiert!</p>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <p>Derzeit keine offenen Bestellungen.</p>
    <?php else: ?>

        <div class="orders-container">

        <?php foreach ($orders as $order): ?>
            <div class="order-card">

                <h3>Bestellung #<?= (int)$order['ordering_id'] ?></h3>

                <p><strong>Artikel:</strong> <?= htmlspecialchars($order['article_name']) ?></p>
                <p><strong>Preis:</strong> <?= number_format($order['article_price'], 2) ?> €</p>
                <p><strong>Adresse:</strong> <?= htmlspecialchars($order['address']) ?></p>

                <p><strong>Status:</strong>
                    <?php if ($order['status'] == 0): ?>
                        In Vorbereitung (Bäcker)
                    <?php elseif ($order['status'] == 1): ?>
                        Unterwegs
                    <?php else: ?>
                        Ausgeliefert
                    <?php endif; ?>
                </p>

                <!-- Status Update -->
                <form method="POST" action="?route=driver">
                    <input type="hidden" name="ordered_article_id" value="<?= $order['ordered_article_id'] ?>">

                    <label>
                        <input type="radio" name="status" value="1" <?= $order['status'] == 1 ? 'checked' : '' ?>>
                        Unterwegs
                    </label>

                    <label>
                        <input type="radio" name="status" value="2" <?= $order['status'] == 2 ? 'checked' : '' ?>>
                        Geliefert
                    </label>

                    <button type="submit">Update</button>
                </form>

                <?php if ($order['status'] >= 1): ?>
                    <form method="POST" action="?route=driver">
                        <input type="hidden" name="delete_ordering_id" value="<?= $order['ordering_id'] ?>">
                        <button type="submit" onclick="return confirm('Wirklich als geliefert löschen?')">
                            Entfernen
                        </button>
                    </form>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

        </div>

    <?php endif; ?>
</section>

</main>

<?php require_once 'partials/footer.php'; ?>