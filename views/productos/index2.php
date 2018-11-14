<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>   
        <p>
            <?=Html::a('Nuevo producto', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php $form = ActiveForm::begin([
            "method"     => "get",
            "action"    => Url::toRoute("productos/index"),
            "enableClientValidation"=> true
        ]);?>

        <?= $form->field($searchModel, 'search')->input("search") ?>
             
        <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>
        <?php $form->end(); ?>
        <table class="table table-bordered">
            <tr>
                <th>Nombre</th>
                <th>Precio Mayorista</th>
                <th>Precio Intermediario</th>
                <th>Precio Minorista</th>
                <th>Moneda</th>
                <th></th>
            </tr>
            <?php foreach($productos as $producto){ ?>
            <tr>
                <td><?= $producto->nombre; ?></td>
                <td><?= $producto->precioMayorista; ?></td>
                <td><?= $producto->precioIntermedio; ?></td>
                <td><?= $producto->precioMinorista; ?></td>
                <td><?= "Bolivianos" ?></td>
                <td style="white-space:nowrap; width: 1%;">
                    <a href="<?= Url::to(['productos/view', 'id'=>$producto->pkProducto])?>" data-toggle="tooltip" title="Ver">
                        <span class="glyphicon glyphicon-eye-open"></span> 
                    </a>
                    <a href="<?= Url::to(['productos/update', 'id'=>$producto->pkProducto])?>" data-toggle="tooltip" title="Editar">
                        <span class="glyphicon glyphicon-pencil"></span> 
                    </a>           
                    <a href="#" data-toggle="tooltip" title="Eliminar">
                        <span class="glyphicon glyphicon-trash"></span> 
                    </a>                    
                </td>
            </tr>
            <?php }?>    
        </table>
    <?= Linkpager::widget([
                "pagination"=>$pagination
            ]);?>        
    <?php Pjax::end(); ?>
</div>