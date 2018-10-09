<?php

use yii\helpers\Html;

$this->title = 'Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'url' => "",
        'nombre' =>"",
        "size" =>0
    ]) ?>
</div>
