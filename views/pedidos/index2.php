<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedidos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>   
        <?php $form = ActiveForm::begin([
            "method"     => "get",
            "action"    => Url::toRoute("pedidos/index"),
            "enableClientValidation"=> true
        ]);?>

        <?= $form->field($searchModel, 'search')->input("search") ?>
             
        <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>
        <?php $form->end(); ?>
        <table class="table table-bordered">
            <tr>
                <th class="text-center">Codigo</th>
                <th>Nombre de Cliente</th>
                <th>Fecha de pedido</th>                
                <th>Estado de pedido</th>
                <th></th>
            </tr>
            <?php foreach($pedidos as $pedido){ ?>
            <tr>
                <td class="text-center"><?= $pedido->pkPedido; ?></td>                
                <td><?= $pedido->fkCliente0->nombres ." ". $pedido->fkCliente0->apellidos; ?></td>
                <td><?= Yii::$app->formatter->asDate($pedido->fechaPedido, 'dd-MM-yyyy HH:mm'); ?></td>
                <td><?= $pedido->estadoPedido; ?></td>
                <td style="white-space:nowrap; width: 1%;">
                    <a href="<?= Url::to(['pedidos/view', 'id'=>$pedido->pkPedido])?>" data-toggle="tooltip" title="Ver pedido">
                        <span class="glyphicon glyphicon-new-window"></span> 
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