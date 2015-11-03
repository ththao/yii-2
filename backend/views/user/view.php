<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data'  => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method'  => 'post',
                        ],
                    ])
                    ?>
                </div>
                <div class="box-body">
                    <?=
                    DetailView::widget([
                        'model'      => $model,
                        'attributes' => [
                            'id',
                            'username',
                            'email:email',
                            'auth_key',
                            'api_key',
                            'login_ip',
                            'login_time',
                            'create_ip',
                            'password_hash',
                            'password_reset_token',
                            [
                                'label' => 'Role',
                                'value' => $model->role->name,
                            ],
                            [
                                'label' => 'Status',
                                'value' => $model->statusString,
                            ],
                            'created_time:datetime',
                            'updated_time:datetime',
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
