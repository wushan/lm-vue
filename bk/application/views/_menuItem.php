<li class="<?= $row['active'] ?>">
    <a href="<?= !$row['is_parent'] ? $row['url'] : "javascript:;" ?>" title="<?= $row['title'] ?>">
        <i class="fa fa-lg fa-fw <?= $row['icon'] ?>"></i>
        <span class="menu-item-parent"><?= $row['title'] ?></span>
    </a>
    <?php if (isset($row['sub'])) { ?>
        <ul>
            <?php foreach ($row['sub'] as $sub) {
                echo get_menu_item($menuList[$sub]);
            } ?>
        </ul>
    <?php } ?>
</li>