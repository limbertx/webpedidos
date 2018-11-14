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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkConfiguracion' => 'Identificador primario',
            'tipoClienteDefecto' => 'Tipo Cliente Defecto',
            'emailAdministrador' => 'Email Administrador',
            'fkClienteAdmin' => 'Cliente administrador',
            'fkMonedaDefecto' => 'Tipo de Moneda',
        ];
    }
}
