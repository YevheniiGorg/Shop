<option
    value="<?= $category['id'] ?>"
    <?php if ($category['id']==$this->model->category_id) echo 'selected'?>
>
    <?= $tab . $category['name'] ?>
    <?php if (isset($category['childs'])): ?>
    <ul>
        <?= $this->getMenuHtml($category['childs'], $tab .'—') ?>
    </ul>
<?php endif; ?>