<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Enviar notificaciones</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => false]) ?>

    <?= $form->field($model, 'mensaje')->textInput(['maxlength' => false]) ?>

    <div class="form-group">
        <a href="<?= Url::to(['site/send', 
        						'titulo'=>$model->titulo,
        						'mensaje'=>$model->mensaje])?>" data-toggle="tooltip" title="Enviar mensaje">
            <span class="btn btn-danger">Enviar mensaje</span> 
        </a>
    </div>
    <?php ActiveForm::end(); ?>

</div>
