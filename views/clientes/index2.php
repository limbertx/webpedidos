<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
       <?= Html::a('Nuevo cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form = ActiveForm::begin([
        "method"     => "get",
        "action"    => Url::toRoute("clientes/index"),
        "enableClientValidation"=> true
    ]);?>

    <?= $form->field($searchModel, 'search')->input("search") ?>
         
    <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>
    <?php $form->end(); ?>
    <table class="table table-bordered">
        <tr>
            <th>Nombres Completos/Empresa</th>
            <th>Ci / Nit</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th></th>
        </tr>
        <?php foreach($clientes as $cliente){ ?>
            <tr>
                <td><?= $cliente->nombres; ?></td>
                <td><?= $cliente->documento; ?></td>
                <td><?= $cliente->direccion; ?></td>
                <td><?= $cliente->telfMovil; ?></td>
                <td style="white-space:nowrap; width: 1%;">
                    <a href="<?= Url::to(['clientes/view', 'id'=>$cliente->pkCliente])?>" data-toggle="tooltip" title="Ver">
                        <span class="glyphicon glyphicon-eye-open"></span> 
                    </a>
                    <a href="<?= Url::to(['clientes/update', 'id'=>$cliente->pkCliente])?>" data-toggle="tooltip" title="Editar">
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