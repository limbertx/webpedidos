<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monedas".
 *
 * @property int $pkMoneda
 * @property string $descripcion
 * @property string $abreviatura
 *
 * @property Productos[] $productos
 */
class Monedas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monedas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'abreviatura'], 'required'],
            [['descripcion'], 'string', 'max' => 25],
            [['abreviatura'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkMoneda' => 'Pk Moneda',
            'descripcion' => 'Tipo moneda',
            'abreviatura' => 'Abreviatura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['fkMoneda' => 'pkMoneda']);
    }
}
