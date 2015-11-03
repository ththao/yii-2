<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Newsletter;
use common\models\Role;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsletterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Newsletters');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::$app->urlManager->createUrl("plugins/datatables/dataTables.bootstrap.css"), [], 'css-data-table');
?>
<div class="Newsletters-index">

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
            <div class="row">
            <div class="col-xs-12">
                <div class="box-header with-border">
                    <?= Html::a(Yii::t('app', 'Create Newsletter'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
                <div class="box box-primary">
                    <?php Pjax::begin([
                    'id'              => 'Newsletters_pjax',
                    'enablePushState' => false,
                    'options'         => ['class' => 'box-body'],
                    ]); ?>                    
                    <?= 
                        GridView::widget([
                            'id'           => 'Newsletters_wrapper',
                            'layout'       => "<div class='row'><div class='col-sm-12'>{items}</div></div><div class='row'><div class='col-sm-5'><div class='dataTables_info' id='Newsletters_info' role='status' aria-live='polite'>{summary}</div></div><div class='col-sm-7'><div class='dataTables_paginate paging_simple_numbers' id='Newsletters_paginate'>{pager}</div></div></div>",
                            'summary'      => 'Showing {begin} to {end} of {totalCount} entries',
                            'options'      => [
                            'class' => 'dataTables_wrapper form-inline dt-bootstrap'
                        ],
                        'tableOptions' => [
                            'id'               => 'Newsletters',
                            'class'            => 'table table-bordered table-striped dataTable',
                            'role'             => 'grid',
                            'aria-describedby' => 'Newsletters_info',
                        ],
                        'rowOptions'   => [
                            'role' => 'row',
                        ],
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'subject',
                            'content:ntext',
                            [   
                                'attribute' => 'role_id',
                                'value'     => function($model) {
                                    return $model->getRoleName()->name . 's';
                                },
                                'filter' => Html::activeDropDownList($searchModel, 'role_id', [
                                        Role::ROLE_CLIENT => 'Clients',
                                        Role::ROLE_WORKER => 'Workers'
                                    ], 
                                    ['class'=>'form-control','prompt' => 'Select']),
                                
                            ],
                            [
                            'attribute' => 'status',
                            'contentOptions' => ['style' => 'text-align: center; width: 10%'],
                            'content'=>function($model){
                                if ($model->status == Newsletter::STATUS_SENT){
                                    return '<span class="label label-success">' . $model->getStatusString() . '</span>';
                                } elseif ($model->status == Newsletter::STATUS_PENDING) {
                                    return '<span class="label label-warning">' . $model->getStatusString() . '</span>';
                                } else {
                                    return '<span class="label label-danger">' . $model->getStatusString() . '</span>';
                                }
                                
                            },
                            
                            'filter' => Html::activeDropDownList($searchModel, 'status', 
                                [
                                    Newsletter::STATUS_SENT    => 'Sent', 
                                    Newsletter::STATUS_PENDING => 'Pending', 
                                    Newsletter::STATUS_DELETED => 'Deleted'
                                ], 
                                ['class'=>'form-control','prompt' => 'Select']
                            ),
                        ],
                            'created_time:datetime',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view}&nbsp;{send}',
                                'buttons'  => [
                                    'send' => function ($url, $model) {
                                        if ($model->status == Newsletter::STATUS_PENDING) {
                                            return Html::a('<span class="fa fa-send-o "></span>', ['send-news', 'id' => $model->id], [
                                                    'title' => Yii::t('app', 'Send'),
                                                    'data-pjax' => 0,
                                                ]);
                                        }
                                    },
                                ]
                            ],
                        ],
                        'pager'        => [
                        'options'        => ['class' => 'pagination'],
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last',
                        ],
                    ]); ?>
                    <?php Pjax::end();?>                </div>
            </div>
        </div>
    
</div>
