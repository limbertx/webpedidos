<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Producto";
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
?>
<div class="productos-view">
    
    <h1><?= Html::encode($model->nombre)?></h1>
    <div class="row">
        <div class="col-sm-4">
            <img 
                id="myImg"
                src="<?=$url?>" 
                class="img-thumbnail responsive"

            >
        </div>
        <div class="col-sm-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'descripcion',            
                    'fkMedida0.descripcion',
                    'precioIntermedio',
                    'precioMayorista',
                    'precioMinorista',
                    'fkMoneda0.descripcion',
                ],
            ]) ?>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
