<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Configuraciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuraciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoClienteDefecto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailAdministrador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuentaAdminMovil')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
