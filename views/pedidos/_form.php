<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fkCliente')->textInput() ?>

    <?= $form->field($model, 'fechaPedido')->textInput() ?>

    <?= $form->field($model, 'fechaAtendida')->textInput() ?>

    <?= $form->field($model, 'precioTotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estadoPedido')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
