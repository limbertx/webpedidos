<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedidos */

$this->title = "Atender pedido";
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
?>
<div class="pedidos-view">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Pedido # <?=$code ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <label for="nombreCliente">Nombre de cliente</label>
                    <input type="input" class="form-control" id="nombreCliente" placeholder="Nombre completo" value="<?=$nombre?>" readonly>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <label for="fecha">Fecha de pedido</label>
                    <input type="input" class="form-control" id="fecha" placeholder="01/01/2018" value="<?=$fecha?>" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="direccion">Direccion de cliente</label>
                    <input type="input" class="form-control" id="direccion" placeholder="mi direccion" value="<?=$direccion?>" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Detalle de pedido</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Precio unitario</th>
                                    <th class="text-center">Precio total</th>
                                </tr>
                                <?php
                                    $index = 1; 
                                    $detalles = $pedidos
                                                ->getPedidoDetalles()
                                                ->all();?>
                                <?php foreach($detalles as $detalle){ ?>
                                <tr>
                                    <td class="text-center"><?= $index ?></td>
                                    <td><?=$detalle->fkProducto0->nombre?></td>
                                    <td class="text-center"><?=$detalle->cantidad?></td>
                                    <td class="text-center"><?=$detalle->precioUnitario?></td>
                                    <td class="text-center"><?=$detalle->precioTotal?></td>
                                </tr>
                                <?php $index = $index+1; }?>                                    
                            </table>     
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-right">Precio total : <?= $pedidos->precioTotal?> Bs.</h4>
                                </div>                                
                            </div>
                        </div>
                    </div>                                    
                </div>
            </div>            
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-2">
                    <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true">
                            </span>',['pedidos/imprimir', "id"=>$pedidos->pkPedido], [
                                'class' => 'btn btn-primary', 
                                'title' => 'Imprimir formato PDF',
                                'data-toggle'=>'tooltip', 
                                'target'=>'_blank']) ?>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-2">
                    <?= Html::a('Atender pedido', [
                                    'attend', 
                                    'id' => $pedidos->pkPedido], 
                                    [
                                        'class'=>'btn btn-primary',
                                        'title' => 'Atender pedido',
                                        'data-toggle'=>'tooltip',
                                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
