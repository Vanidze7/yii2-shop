<li <?php if(isset($category['children'])) echo 'class="dropdown"'//если существует дочерний массив?>>
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) //через Url метод to указываем путь к ссылке(контролер/экшен, дописываемые пар)?>"
        <?php if(isset($category['children'])) echo 'class="dropdown-toggle" data-toggle="dropdown"'?>>
        <?= $category['title'] ?>
    </a>
    <?php if(isset($category['children'])) : ?>
        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
            <div class="w3ls_vegetables">
                <ul>
                    <?= $this->getMenuHtml($category['children']) //примени на дочернем массиве, как на родительском?>
                </ul>
            </div>
        </div>
    <?php endif;?>
</li>
