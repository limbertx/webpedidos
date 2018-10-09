<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConfiguracionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuraciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pkConfiguracion') ?>

    <?= $form->field($model, 'tipoClienteDefecto') ?>

    <?= $form->field($model, 'emailAdministrador') ?>

    <?= $form->field($model, 'cuentaAdminMovil') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
