<?php
use kartik\select2\Select2;
use kartik\widgets\FileInput;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Monedas;
use app\models\Medidas;
?>

<div class="productos-form">
    <?php $form = ActiveForm::begin([
                    'options'=> ['enctype' => 'multipart/form-data']
                                    ]);?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'image')->widget(FileInput::classname(), 
                    [
                        'options'       =>  [
                                                'accept'=>'image/*', 
                                                'multiple'=>false
                                            ],
                        'pluginOptions' =>
                                        [
                            'initialPreview'=>[$url],
                            'initialPreviewAsData'=>true,
                            'initialCaption'=>"producto inicial",
                            'initialPreviewConfig' => [
                                ['caption' => $nombre, 'size' => $size],
                                
                            ],                            
                            'overwriteInitial'=>true,

                            'allowedFileExtensions'=>['jpg','png'],
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  'Seleccione imagen de producto',
                                        ]
                    ]);
            ?>


        </div>        
<!-- esto es la segunda columna -->        
        <div class="col-sm-6">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>            
            <?= $form->field($model, 'fkMedida')->widget(Select2::classname(), [
                    'hideSearch' => true,
                    'data' => ArrayHelper::map(Medidas::find()->all(), 'pkMedida', 'descripcion'),
                    'language'=>'es',
                    'options' => ['placeholder' => 'Seleccione medida...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'precioMinorista')->textInput(['maxlength' => true]) ?>
                </div>                
                <div class="col-sm-4">
                    <?= $form->field($model, 'precioIntermedio')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'precioMayorista')->textInput(['maxlength' => true]) ?>                    
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
