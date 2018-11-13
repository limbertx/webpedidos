<?php

use yii\db\Migration;

/**
 * Class m181113_043505_add_token_cliente_table
 */
class m181113_043505_add_token_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('clientes', 'token', $this->string(256));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181113_043505_add_token_cliente_table cannot be reverted.\n";
        $this->dropColumn('clientes', 'token');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181113_043505_add_token_cliente_table cannot be reverted.\n";

        return false;
    }
    */
}
