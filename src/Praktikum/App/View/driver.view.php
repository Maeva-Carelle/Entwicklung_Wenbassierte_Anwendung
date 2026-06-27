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
                            <?= number_format((float)$order['total_price'], 2) ?> €
                        </p>

                        <p>
                            <strong>Adresse:</strong>
                            <?= htmlspecialchars((string)$order['address'], ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <form method="POST" action="<?= Router::generateUrl('driver') ?>" class="status-form">
                            <input type="hidden" name="ordering_id" value="<?= (int)$order['ordering_id'] ?>">

                            <div class="status-options">
                                <label>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="2"
                                        onclick="this.form.submit();"
                                    >
                                    Fertig abgeholt
                                </label>

                                <label>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="3"
                                        onclick="this.form.submit();"
                                    >
                                    Unterwegs
                                </label>
                            </div>
                        </form>

                        <form method="POST" action="<?= Router::generateUrl('driver') ?>">
                            <label>
                                <input
                                    type="radio"
                                    name="delete_ordering_id"
                                    value="<?= (int)$order['ordering_id'] ?>"
                                    onclick="this.form.submit();"
                                >
                                Ausgeliefert
                            </label>
                        </form>

                    </div>
                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </section>
</main>

<?php require_once 'partials/footer.php'; ?>