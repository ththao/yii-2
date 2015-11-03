<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::$app->urlManager->createUrl("plugins/datatables/dataTables.bootstrap.css"), [], 'css-data-table');
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <?php
            Pjax::begin([
                'id'              => 'users_pjax',
                'enablePushState' => false,
                'options'         => ['class' => 'box-body'],
            ])
            ?>
            <?=
            GridView::widget([
                'id'           => 'users_wrapper',
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'layout'       => "<div class='row'><div class='col-sm-12'>{items}</div></div><div class='row'><div class='col-sm-5'><div class='dataTables_info' id='users_info' role='status' aria-live='polite'>{summary}</div></div><div class='col-sm-7'><div class='dataTables_paginate paging_simple_numbers' id='users_paginate'>{pager}</div></div></div>",
                'summary'      => 'Showing {begin} to {end} of {totalCount} entries',
                'options'      => [
                    'class' => 'dataTables_wrapper form-inline dt-bootstrap'
                ],
                'tableOptions' => [
                    'id'               => 'users',
                    'class'            => 'table table-bordered table-striped dataTable',
                    'role'             => 'grid',
                    'aria-describedby' => 'users_info',
                ],
                'rowOptions'   => [
                    'role' => 'row',
                ],
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    'email:email',
                    'role_id',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'pager'        => [
                    'options'        => ['class' => 'pagination'],
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last',
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
