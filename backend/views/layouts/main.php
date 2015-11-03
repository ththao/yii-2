<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="sidebar-mini skin-blue-light">
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <?= $this->render('partials/top'); ?>
            <?= $this->render('partials/left_sidebar'); ?>
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo isset($this->title) ? Html::encode($this->title) : ""; ?>
                    </h1>
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                </section>
                <!-- Main content -->
                <section class="content">
                    <?= $content ?>
                </section>

            </div>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <p class="pull-left">&copy; <?= Yii::$app->params['projectName']; ?> <?= date('Y') ?></p>
            </div>
        </footer>
        
        <?= \common\widgets\PNotifyAlert::widget(); ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
