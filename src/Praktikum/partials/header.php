<header class="page-header">
    <h1><?= htmlspecialchars($page_title ?? 'Mazama Burger House', ENT_QUOTES, 'UTF-8') ?></h1>

    <?php require_once 'partials/navigation.php'; ?>

    <?php if (!empty($page_subtitle)): ?>
        <h2><?= htmlspecialchars($page_subtitle, ENT_QUOTES, 'UTF-8') ?></h2>
    <?php endif; ?>
</header>