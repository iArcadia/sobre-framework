<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-bottom:0">
        <?php foreach ($this->get() as $item): ?>
            <?php if (isset($item['url']) && $item['url']): ?>
                <li class="breadcrumb-item"><a href="<?= $item['url'] ?>"><?= $item['label'] ?></a></li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $item['label'] ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>