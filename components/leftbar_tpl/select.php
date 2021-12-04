<option value="<?= $category['id'] //как сюда попала $category ?>"
    <?php if($this->model->parent_id == $category['id']) echo 'selected' //если у редактируемой категории parent_id = Id какой либо категории - выбери эту категорию в списке ?>
    <?php if($this->model->id == $category['id']) echo 'disabled' //если у редактируемой категории id = Id какой либо категории - не выводи эту категорию в списке?>
>
    <?= " {$tab} {$category['title']} " ?>
</option>
<?php if(isset($category['children'])) : ?>
    <?= $this->getMenuHtml($category['children'], $tab . '-')?>
<?php endif;?>