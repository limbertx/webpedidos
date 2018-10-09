<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $pkCliente
 * @property string $nombres
 * @property string $apellidos
 * @property string $direccion
 * @property string $telfMovil
 * @property string $tipoCliente
 * @property string $tipoCuenta
 *
 * @property Pedidos[] $pedidos
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'telfMovil', 'tipoCliente'], 'required'],
            [['nombres', 'apellidos', 'direccion'], 'string', 'max' => 50],
            [['telfMovil', 'tipoCliente', 'tipoCuenta'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkCliente' => 'Identificador de cliente',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'direccion' => 'Direccion',
            'telfMovil' => 'Telefono',
            'tipoCliente' => 'Tipo Cliente',
            'tipoCuenta' => 'Tipo Cuenta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['fkCliente' => 'pkCliente']);
    }
}
