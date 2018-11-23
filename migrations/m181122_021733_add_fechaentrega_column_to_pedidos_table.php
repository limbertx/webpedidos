<?php

use yii\db\Migration;

/**
 * Handles adding document to table `pedidos`.
 */
class m181122_021733_add_fechaentrega_column_to_pedidos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pedidos', 'fechaEntregado', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pedidos', 'fechaEntregado');
    }
}
