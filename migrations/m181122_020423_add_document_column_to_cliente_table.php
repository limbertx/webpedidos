<?php

use yii\db\Migration;

/**
 * Handles adding document to table `cliente`.
 */
class m181122_020423_add_document_column_to_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('clientes', 'documento', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cliente', 'documento');
    }
}
