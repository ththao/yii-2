<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams     = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::$app->urlManager->createUrl("plugins/datatables/dataTables.bootstrap.css"), [], 'css-data-table');
?>
<div class="<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s-index">

    <?php if (!empty($generator->searchModelClass)): ?>
        <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php endif; ?>

    <?php if ($generator->indexWidgetType === 'grid'): ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box-header with-border">
                    <?= "<?= " ?>Html::a(<?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success']) ?>
                </div>
                <div class="box box-primary">
                    <?= "<?php " ?>Pjax::begin([
                    'id'              => '<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s_pjax',
                    'enablePushState' => false,
                    'options'         => ['class' => 'box-body'],
                    ]); <?= "?>" ?>
                    <?= "<?= " ?>GridView::widget([
                    'id'           => '<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s_wrapper',
                    'layout'       => "<div class='row'><div class='col-sm-12'>{items}</div></div><div class='row'><div class='col-sm-5'><div class='dataTables_info' id='<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s_info' role='status' aria-live='polite'>{summary}</div></div><div class='col-sm-7'><div class='dataTables_paginate paging_simple_numbers' id='<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s_paginate'>{pager}</div></div></div>",
                    'summary'      => 'Showing {begin} to {end} of {totalCount} entries',
                    'options'      => [
                    'class' => 'dataTables_wrapper form-inline dt-bootstrap'
                    ],
                    'tableOptions' => [
                    'id'               => '<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s',
                    'class'            => 'table table-bordered table-striped dataTable',
                    'role'             => 'grid',
                    'aria-describedby' => '<?= lcfirst(StringHelper::basename($generator->modelClass)) ?>s_info',
                    ],
                    'rowOptions'   => [
                    'role' => 'row',
                    ],
                    'dataProvider' => $dataProvider,
                    <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                    ['class' => 'yii\grid\SerialColumn'],

                    <?php
                    $count       = 0;
                    if (($tableSchema = $generator->getTableSchema()) === false) {
                        foreach ($generator->getColumnNames() as $name) {
                            if (++$count < 6) {
                                echo "            '" . $name . "',\n";
                            } else {
                                echo "            // '" . $name . "',\n";
                            }
                        }
                    } else {
                        foreach ($tableSchema->columns as $column) {
                            $format = $generator->generateColumnFormat($column);
                            if (++$count < 6) {
                                echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                            } else {
                                echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                            }
                        }
                    }
                    ?>

                    ['class' => 'yii\grid\ActionColumn'],
                    ],
                    'pager'        => [
                    'options'        => ['class' => 'pagination'],
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last',
                    ],
                    ]); ?>
                    <?= "<?php " ?>Pjax::end();<?= "?>" ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
        ]) ?>
    <?php endif; ?>

</div>
