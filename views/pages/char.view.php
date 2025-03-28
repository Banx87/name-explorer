<ul>
    <?php foreach ($names as $name): ?>
        <li>
            <a href="name.php?<?php echo http_build_query(['name' => $name]); ?>">
                <?php echo e($name); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<div class="pagination">

    <?php for ($x = 1; $x < ($pagination['count'] / $pagination['perPage']); $x++) { ?>

        <a class="pagination_link button <?php if ($x === $pagination['page']): ?>active<?php endif ?>"
            href="char.php?<?php echo http_build_query(['char' => $char, 'page' => $x]); ?>">
            <?php echo e($x) ?> </a>
    <?php } ?>
</div>