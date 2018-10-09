<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidoDetalles".
 *
 * @property int $pkPedidoDetalle
 * @property int $fkPedido
 * @property int $fkProducto
 * @property int $cantidad
 * @property string $precioUnitario
 * @property string $precioTotal
 *
 * @property Pedidos $fkPedido0
 * @property Productos $fkProducto0
 */
class PedidoDetalles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidoDetalles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkPedido', 'fkProducto', 'cantidad', 'precioUnitario', 'precioTotal'], 'required'],
            [['fkPedido', 'fkProducto', 'cantidad'], 'integer'],
            [['precioUnitario', 'precioTotal'], 'number'],
            [['fkPedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['fkPedido' => 'pkPedido']],
            [['fkProducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['fkProducto' => 'pkProducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkPedidoDetalle' => 'Pk Pedido Detalle',
            'fkPedido' => 'Fk Pedido',
            'fkProducto' => 'Fk Producto',
            'cantidad' => 'Cantidad',
            'precioUnitario' => 'Precio Unitario',
            'precioTotal' => 'Precio Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkPedido0()
    {
        return $this->hasOne(Pedidos::className(), ['pkPedido' => 'fkPedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProducto0()
    {
        return $this->hasOne(Productos::className(), ['pkProducto' => 'fkProducto']);
    }
}
