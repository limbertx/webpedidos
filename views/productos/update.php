<?php

use yii\helpers\Html;

$this->title = 'Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Producto';
?>
<div class="productos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'url' => $url,
        'nombre' => $nombre,
        'size' => $size
    ]) ?>

</div>
