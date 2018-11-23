<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $pkPedido
 * @property string $codigo
 * @property int $fkCliente
 * @property string $fechaPedido
 * @property string $fechaAtendida
 * @property string $fechaEntregado
 * @property string $precioTotal
 * @property string $estadoPedido
 *
 * @property PedidoDetalles[] $pedidoDetalles
 * @property Clientes $fkCliente0
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'fkCliente', 'fechaPedido', 'precioTotal', 'estadoPedido'], 'required'],
            [['fkCliente'], 'integer'],
            [['fechaPedido', 'fechaAtendida', 'fechaEntregado'], 'safe'],
            [['precioTotal'], 'number'],
            [['codigo'], 'string', 'max' => 25],
            [['estadoPedido'], 'string', 'max' => 50],
            [['fkCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['fkCliente' => 'pkCliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkPedido' => 'Nro. pedido',
            'codigo' => 'Codigo',
            'fkCliente' => 'Fk Cliente',
            'fechaPedido' => 'Fecha Pedido',
            'fechaAtendida' => 'Fecha Atendida',
            'fechaEntregado' => 'Fecha Entregado',
            'precioTotal' => 'Precio Total',
            'estadoPedido' => 'Estado Pedido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalles::className(), ['fkPedido' => 'pkPedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCliente0()
    {
        return $this->hasOne(Clientes::className(), ['pkCliente' => 'fkCliente']);
    }
}
