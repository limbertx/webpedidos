<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medidas".
 *
 * @property int $pkMedida
 * @property string $descripcion
 * @property string $abreviatura
 *
 * @property Productos[] $productos
 */
class Medidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medidas';
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
            'pkMedida' => 'Pk Medida',
            'descripcion' => 'Unidad de medida',
            'abreviatura' => 'Abreviatura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['fkMedida' => 'pkMedida']);
    }
}
