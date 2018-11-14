<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Monedas;
use app\models\Clientes;
/* @var $this yii\web\View */
/* @var $model app\models\Configuraciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuraciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoClienteDefecto')->widget(Select2::classname(), [
            'data' => ['MINORISTA' => 'MINORISTA', 'MAYORISTA' => 'MAYORISTA', 'INTERMEDIARIO'=>'INTERMEDIARIO'],
            'options' => ['placeholder' => 'Seleccione tipo de cliente ...'],
            'hideSearch' => true,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'emailAdministrador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fkClienteAdmin')->widget(Select2::classname(), [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Clientes::find()->all(), 'pkCliente', 'nombres'),
            'language'=>'es',
            'options' => ['placeholder' => 'Seleccione Cliente Administrador'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'fkMonedaDefecto')->widget(Select2::classname(), [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Monedas::find()->all(), 'pkMoneda', 'descripcion'),
            'language'=>'es',
            'options' => ['placeholder' => 'Seleccione tipo de moneda...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
