<?php

use yii\helpers\Html;

$this->title = 'Configuracion de sistema';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuraciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
