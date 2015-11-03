<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Newsletter */

$this->title = 'Newsletter # ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsletters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-letter-view">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    
                </div>
                <div class="box-body">
                    <?= DetailView::widget([
                    'model'      => $model,
                    'attributes' => [
                        'subject',
                        [
                            'label' => 'Content',
                            'format' => 'raw',
                            'value' => Html::activeTextarea($model, 'content', [
                                'rows'=>10,
                                'cols'=>130,
                                'readonly' => true
                            ]),
                        ],
                        
                        [
                            'label' => 'Send to',
                            'value' => $model->getRoleName()->name,
                        ],
                        [
                            'label' => 'Status',
                            'value' =>  $model->getStatusString(),
                        ],
                        
                    ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
