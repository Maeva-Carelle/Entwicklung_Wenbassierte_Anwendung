<?php
$orders = $data['orders'] ?? [];
$message = $_GET['message'] ?? '';

require_once 'partials/head.php';

$page_title = 'Mazama Burger House';
$page_subtitle = 'Fahrer';
require_once 'partials/header.php';
?>

<main>

<section>

    <p>Der Fahrer liefert die Bestellungen aus.</p>

    <?php if ($message === 'updated'): ?>
        <p style="color: green;">Status erfolgreich aktualisiert!</p>
    <?php endif; ?>

    <?php if ($message === 'deleted'): ?>
        <p style="color: green;">Bestellung wurde ausgeliefert!</p>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <p>Derzeit keine zur Auslieferung bereiten Bestellungen.</p>
    <?php else: ?>

        <div class="orders-container">

            <?php foreach ($orders as $order): ?>
                <div class="order-card">

                    <h3>Bestellung #<?= (int)$order['ordering_id'] ?></h3>

                    <p>
                        <strong>Gesamtpreis:</strong>
                        <?= number_format($order['total_price'], 2) ?> €
                    </p>

                    <p>
                        <strong>Adresse:</strong>
                        <?= htmlspecialchars($order['address']) ?>
                    </p>

                    <form method="POST" action="?route=driver" class="status-form">

    <input type="hidden" name="ordering_id" value="<?= $order['ordering_id'] ?>">

    <div class="status-options">

        <label>
            <input type="radio" name="status" value="2">
            Fertig abgeholt
        </label>

        <label>
            <input type="radio" name="status" value="3">
            Unterwegs
        </label>

    </div>

    <button type="submit">Status aktualisieren</button>

</form>

                    <!-- ausgeliefert -->
                    <form method="POST" action="<?= Router::generateUrl('driver') ?>">
                        <label>
            
            
        
                        <input type="radio" name="delete_ordering_id" value="<?= $order['ordering_id'] ?>">
                        Ausgeliefert </label>
                        <button type="submit">Als ausgeliefert löschen</button>
                    </form>

                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>

</main>

<?php require_once 'partials/footer.php'; ?>