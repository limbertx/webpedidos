<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
?>

<div class="clientes-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telfMovil')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?=
        $form->field($model, 'tipoCliente')->widget(Select2::classname(), [
            'data' => ['MINORISTA' => 'MINORISTA', 'MAYORISTA' => 'MAYORISTA', 'INTERMEDIARIO'=>'INTERMEDIARIO'],
            'options' => ['placeholder' => 'Seleccione tipo de cliente ...'],
            'hideSearch' => true,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?=
        $form->field($model, 'tipoCuenta')->widget(Select2::classname(), [
            'data' => ['ADMINISTRADOR'=>'ADMINISTRADOR', 'USUARIO'=>'USUARIO'],
            'options' => ['placeholder' => 'Seleccione tipo de cuenta ...'],
            'hideSearch' => true,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>