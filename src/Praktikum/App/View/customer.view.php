<!-- App/View/customer.view.php -->
<?php
$orders = $data['orders'] ?? [];
$message = $_GET['message'] ?? '';

require_once 'partials/head.php';
?>

<header>
    <h1><?= htmlspecialchars($data['page_title'] ?? 'Bestellung') ?></h1>

    <?php require_once 'partials/navigation.php'; ?>

    <h2>Kunde</h2>
</header>
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

<?php foreach ($orders as $order): ?>
    <div class="order-card">

        <h3>Bestellung #<?= (int)$order['ordering_id'] ?></h3>

        <p><strong>Artikel:</strong> <?= htmlspecialchars($order['article_name']) ?></p>
        <p><strong>Preis:</strong> <?= number_format($order['article_price'], 2) ?> €</p>
        <p><strong>Adresse:</strong> <?= htmlspecialchars($order['address']) ?></p>
        <p><strong>Zeit:</strong> <?= htmlspecialchars($order['ordering_time']) ?></p>

        <p>
            <strong>Status:</strong>
            <?php if ($order['status'] == 0): ?>
                <span class="status-badge status-0">In Vorbereitung (Bäcker)</span>
            <?php elseif ($order['status'] == 1): ?>
                <span class="status-badge status-1">Fertig / Unterwegs (Fahrer)</span>
            <?php else: ?>
                <span class="status-badge status-2">Ausgeliefert</span>
            <?php endif; ?>
        </p>

    </div>
<?php endforeach; ?>

</div>
    <?php endif; ?>
</main>

<?php require_once 'partials/footer.php'; ?>