<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Monedas */

$this->title = 'Update Monedas: ' . $model->pkMoneda;
$this->params['breadcrumbs'][] = ['label' => 'Monedas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkMoneda, 'url' => ['view', 'id' => $model->pkMoneda]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="monedas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
