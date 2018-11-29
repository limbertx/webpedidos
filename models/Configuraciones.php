<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuraciones".
 *
 * @property int $pkConfiguracion
 * @property string $tipoClienteDefecto
 * @property string $emailAdministrador
 * @property int $fkClienteAdmin
 * @property int $fkMonedaDefecto
 *
 * @property Clientes $fkClienteAdmin0
 * @property Monedas $fkMonedaDefecto0
 */
class Configuraciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configuraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipoClienteDefecto', 'emailAdministrador', 'fkClienteAdmin', 'fkMonedaDefecto'], 'required'],
            [['fkClienteAdmin', 'fkMonedaDefecto'], 'default', 'value' => null],
            [['fkClienteAdmin', 'fkMonedaDefecto'], 'integer'],
            [['tipoClienteDefecto'], 'string', 'max' => 25],
            [['emailAdministrador'], 'string', 'max' => 50],
            [['fkClienteAdmin'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['fkClienteAdmin' => 'pkCliente']],
            [['fkMonedaDefecto'], 'exist', 'skipOnError' => true, 'targetClass' => Monedas::className(), 'targetAttribute' => ['fkMonedaDefecto' => 'pkMoneda']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkConfiguracion' => 'Pk Configuracion',
            'tipoClienteDefecto' => 'Tipo Cliente Defecto',
            'emailAdministrador' => 'Email Administrador',
            'fkClienteAdmin' => 'Administrador',
            'fkMonedaDefecto' => 'Tipo de moneda por defecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkClienteAdmin0()
    {
        return $this->hasOne(Clientes::className(), ['pkCliente' => 'fkClienteAdmin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMonedaDefecto0()
    {
        return $this->hasOne(Monedas::className(), ['pkMoneda' => 'fkMonedaDefecto']);
    }
}
