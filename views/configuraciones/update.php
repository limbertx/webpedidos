<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Configuraciones */

$this->title = 'Update Configuraciones: ' . $model->pkConfiguracion;
$this->params['breadcrumbs'][] = ['label' => 'Configuraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkConfiguracion, 'url' => ['view', 'id' => $model->pkConfiguracion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="configuraciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
