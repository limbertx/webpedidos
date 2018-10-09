<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuraciones".
 *
 * @property int $pkConfiguracion
 * @property string $tipoClienteDefecto
 * @property string $emailAdministrador
 * @property string $cuentaAdminMovil
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
            [['tipoClienteDefecto', 'emailAdministrador', 'cuentaAdminMovil'], 'required'],
            [['tipoClienteDefecto'], 'string', 'max' => 25],
            [['emailAdministrador', 'cuentaAdminMovil'], 'string', 'max' => 50],
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
            'cuentaAdminMovil' => 'Cuenta Admin Movil',
        ];
    }
}
