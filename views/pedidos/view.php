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
            <h3 class="panel-title text-center">Pedido #1121</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <label for="nombreCliente">Nombre de cliente</label>
                    <input type="input" class="form-control" id="nombreCliente" placeholder="Nombre completo" value="<?=$nombre?>">
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <label for="fecha">Fecha de pedido</label>
                    <input type="input" class="form-control" id="fecha" placeholder="01/01/2018" value="<?=$fecha?>">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="direccion">Direccion de cliente</label>
                    <input type="input" class="form-control" id="direccion" placeholder="mi direccion" value="<?=$direccion?>">
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
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                    <th>Precio total</th>
                                </tr>
                                <?php $detalles = $pedidos->getPedidoDetalles()->all();?>
                                <?php foreach($detalles as $detalle){ ?>
                                <tr>
                                    <td>1</td>
                                    <td><?=$detalle->fkProducto0->nombre?></td>
                                    <td><?=$detalle->cantidad?></td>
                                    <td><?=$detalle->precioUnitario?></td>
                                    <td><?=$detalle->precioTotal?></td>
                                </tr>
                                <?php }?>                                    
                            </table>     
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-11">
                                    <h4 class="text-right">Precio total : 15.00 Bs.</h4>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>                                    
                </div>
            </div>            
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" aria-label="Left Align">
                            <span class="glyphicon glyphicon-print" aria-hidden="true">
                            </span>
                    </button>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary">
                        Atender pedido
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
