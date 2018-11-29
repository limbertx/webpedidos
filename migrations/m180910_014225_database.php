<?php

use yii\db\Migration;

/**  {{{{{Ç}}}}}}}} []???==?=?==ªªªª\\\\\ªª\\
 * Class m180910_014225_database
 */
class m180910_014225_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('clientes', [
            'pkCliente' => $this->primaryKey(),
            'nombres'   => $this->string(100)->notNull(),
            'apellidos' => $this->string(1),
            'direccion' => $this->string(50),
            'telfMovil' => $this->string(25)->notNull(),
            'tipoCliente' => $this->string(25)->notNull(), // es may. min.inter
            'tipoCuenta' => $this->string(25)->notNull(), // admin, user
            'token'      =>$this->string(256),
            'documento'  => $this->string(50)
        ]);

        $this->createTable('monedas', [
            'pkMoneda' => $this->primaryKey(),
            'descripcion'   => $this->string(25)->notNull(),
            'abreviatura' => $this->string(10)->notNull()
        ]);

        $this->insert('monedas', [
            'descripcion' => 'Bolivianos',
            'abreviatura' => 'Bs.',
        ]);

        $this->createTable('configuraciones', [
            'pkConfiguracion' => $this->primaryKey(),
            'tipoClienteDefecto'   => $this->string(25)->notNull(),
            'emailAdministrador' => $this->string(50)->notNull(),
            'fkClienteAdmin'  => $this->integer()->notNull(),
            'fkMonedaDefecto'  => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-configuraciones-fkClienteAdmin',
            'configuraciones',
            'fkClienteAdmin',
            'clientes',
            'pkCliente',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-configuraciones-moneda',
            'configuraciones',
            'fkMonedaDefecto',
            'monedas',
            'pkMoneda',
            'RESTRICT'
        );

        $this->createTable('medidas', [
            'pkMedida' => $this->primaryKey(),
            'descripcion'   => $this->string(25)->notNull(),
            'abreviatura' => $this->string(10)->notNull()            
        ]);

        $this->insert('medidas', [
            'descripcion' => 'Unidad',
            'abreviatura' => 'ud.',
        ]);

        $this->createTable('productos', [
            'pkProducto'    => $this->primaryKey(),
            'nombre'        => $this->string(50)->notNull(),
            'descripcion'   => $this->string(100),
            'fkMedida'  => $this->integer()->notNull(),
            'precioIntermedio' => $this->decimal(10, 2)->notNull(),
            'precioMayorista' => $this->decimal(10, 2)->notNull(),
            'precioMinorista' => $this->decimal(10, 2)->notNull(),
        ]);

        // creamos index para columna fkMedida
        $this->createIndex(
            'idx-productos-fkmedida',
            'productos',
            'fkMedida'
        );

        // add foreign key for table productos
        $this->addForeignKey(
            'fk-productos-fkmedida',
            'productos',
            'fkMedida',
            'medidas',
            'pkMedida',
            'RESTRICT'
        );

        $this->createTable('imagenes', [
            'pkImagen'    => $this->primaryKey(),
            'ruta'        => $this->string(50)->notNull(),
            'nombre'   => $this->string(50)->notNull(),
            'extension'  => $this->string(10)->notNull(),
            'fkProducto' => $this->integer()->notNull()
        ]);

        // index para la tabla imagenes
        $this->createIndex(
            'idx-imagenes-fkproducto',
            'imagenes',
            'fkProducto'
        );

        // add foreign key for table imagenes
        $this->addForeignKey(
            'fk-imagenes-fkproducto',
            'imagenes',
            'fkProducto',
            'productos',
            'pkProducto',
            'RESTRICT'
        );


        $this->createTable('pedidos', [
            'pkPedido'      => $this->primaryKey(),
            'codigo'        => $this->string(25)->notNull(),
            'fkCliente'     => $this->integer()->notNull(),
            'fechaPedido'   => $this->datetime()->notNull(),
            'fechaAtendida' => $this->datetime(),
            'precioTotal'   => $this->decimal(10, 2)->notNull(),
            'estadoPedido'  => $this->string(50)->notNull(),
            'fechaEntregado'=> $this->datetime()
        ]);

        $this->createIndex(
            'idx-pedidos-fkcliente',
            'pedidos',
            'fkCliente'
        );

        // add foreign key for table pedidos
        $this->addForeignKey(
            'fk-pedidos-fkcliente',
            'pedidos',
            'fkCliente',
            'clientes',
            'pkCliente',
            'RESTRICT'
        );


       $this->createTable('pedidoDetalles', [
            'pkPedidoDetalle'   => $this->primaryKey(),
            'fkPedido'          => $this->integer()->notNull(),
            'fkProducto'        => $this->integer()->notNull(),
            'cantidad'          => $this->integer()->notNull(),
            'precioUnitario'    => $this->decimal(10, 2)->notNull(),
            'precioTotal'       => $this->decimal(10, 2)->notNull(),
        ]);

        $this->createIndex(
            'idx-pedidodetalles-fkpedido',
            'pedidoDetalles',
            'fkPedido'
        );

        // add foreign key for table pedidos
        $this->addForeignKey(
            'fk-pedidodetalles-fkpedido',
            'pedidoDetalles',
            'fkPedido',
            'pedidos',
            'pkPedido',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-pedidodetalles-fkproducto',
            'pedidoDetalles',
            'fkProducto'
        );

        // add foreign key for table pedidos
        $this->addForeignKey(
            'fk-pedidodetalles-fkproducto',
            'pedidoDetalles',
            'fkProducto',
            'productos',
            'pkProducto',
            'RESTRICT'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180910_014225_database cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180910_014225_database cannot be reverted.\n";

        return false;
    }
    */
}
