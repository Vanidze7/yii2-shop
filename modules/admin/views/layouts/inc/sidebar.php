<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username //вывод имени ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="<?= \yii\helpers\Url::to(['main/index']) ?>"><i class="fa fa-bar-chart"></i> <span>Статистика бабы Зины</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Сосиски</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['order_admin/index']) ?>">Список сосисок</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['order_admin/create']) ?>">Добавить сосисочку</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cubes"></i> <span>Карапузы</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['category_admin/index']) ?>">Список карапузов</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['category_admin/create']) ?>">Добавить карапуза</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>