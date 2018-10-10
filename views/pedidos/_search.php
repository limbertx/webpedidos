<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pkPedido') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'fkCliente') ?>

    <?= $form->field($model, 'fechaPedido') ?>

    <?= $form->field($model, 'fechaAtendida') ?>

    <?php // echo $form->field($model, 'precioTotal') ?>

    <?php // echo $form->field($model, 'estadoPedido') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
