<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\components\leftmenu\LeftMenuWidget;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="col-md-3 left-container">
    <?= LeftMenuWidget::widget([]); ?>
</div>
<div class="col-md-9">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>