<nav>
    <ul>
        <li>
            <a href="<?= Router::generateUrl('order') ?>">
                <i class="fa-solid fa-burger"></i> Bestellung
            </a>
        </li>

        <li>
            <a href="<?= Router::generateUrl('customer') ?>">
                <i class="fa-solid fa-receipt"></i> Kunde
            </a>
        </li>

        <li>
            <a href="<?= Router::generateUrl('baker') ?>">
                <i class="fa-solid fa-kitchen-set"></i> Bäcker
            </a>
        </li>

        <li>
            <a href="<?= Router::generateUrl('driver') ?>">
                <i class="fa-solid fa-truck"></i> Fahrer
            </a>
        </li>
    </ul>
</nav>