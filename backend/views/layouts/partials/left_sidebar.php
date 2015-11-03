<?php

use yii\helpers\Html;
use yii\widgets\Menu

/* @var $this \yii\web\View */
/* @var $content string */
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">    
            <div class="pull-left image">
                <img src="<?= Yii::$app->getRequest()->getBaseUrl();?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
		<?php $controller = \Yii::$app->controller->id; ?>
        <?php
        echo Menu::widget([
            'options'         => [
                'class' => 'sidebar-menu',
            ],
            'items'           => [
                [
                    'label'   => 'MAIN NAVIGATION',
                    'options' => [
                        'class' => 'header'
                    ],
                ],
                [
                    'label'    => 'Dashboard',
                    'template' => '<a href="{url}"><i class="fa fa-dashboard"></i><span>{label}</span></a>',
                    'url'      => ['/site/index'],
                ],
            ],
            'activateItems'   => TRUE,
            'activateParents' => TRUE,
            'submenuTemplate' => "<ul class='treeview-menu'>{items}</ul>",
        ]);
        ?>

    </section>
    <!-- /.sidebar -->
</aside>
