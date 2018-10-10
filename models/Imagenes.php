<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagenes".
 *
 * @property int $pkImagen
 * @property string $ruta
 * @property string $nombre
 * @property string $extension
 * @property int $fkProducto
 *
 * @property Productos $fkProducto0
 */
class Imagenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ruta', 'nombre', 'extension', 'fkProducto'], 'required'],
            [['fkProducto'], 'integer'],
            [['ruta', 'nombre'], 'string', 'max' => 50],
            [['extension'], 'string', 'max' => 10],
            [['fkProducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['fkProducto' => 'pkProducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkImagen' => 'Pk Imagen',
            'ruta' => 'Ruta',
            'nombre' => 'Nombre',
            'extension' => 'Extension',
            'fkProducto' => 'Fk Producto',
        ];
    }
    public function getNameComplete(){
        return $this->nombre . "." . $this->extension;
    }
    public function getUrlWeb(){
        return  Yii::getAlias('@web') 
                .'/'
                .$this->ruta 
                .$this->nombre 
                ."." 
                .$this->extension;
    }

    public function getUrlApplication(){
        return Yii::getAlias('@app') 
                    .'/web/'
                    .$this->ruta 
                    .$this->nombre 
                    ."." 
                    .$this->extension;

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProducto0()
    {
        return $this->hasOne(Productos::className(), ['pkProducto' => 'fkProducto']);
    }
}
