<?php

namespace app\models;


use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $pkProducto
 * @property string $nombre
 * @property string $descripcion
 * @property int $fkMedida
 * @property string $precioIntermedio
 * @property string $precioMayorista
 * @property string $precioMinorista
 *
 * @property Imagenes[] $imagenes
 * @property PedidoDetalles[] $pedidoDetalles
 * @property Medidas $fkMedida0
 */
class Productos extends \yii\db\ActiveRecord
{

    /**
     * imagen del producto
     */
    public $image;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fkMedida', 'precioIntermedio', 'precioMayorista', 'precioMinorista'], 'required'],
            [['fkMedida'], 'integer'],
            [['precioIntermedio', 'precioMayorista', 'precioMinorista'], 'number'],
            [['nombre'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 100],
            [['fkMedida'], 'exist', 'skipOnError' => true, 'targetClass' => Medidas::className(), 'targetAttribute' => ['fkMedida' => 'pkMedida']],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 1],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pkProducto' => 'Identificador primario',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'fkMedida' => 'Medida',
            'precioIntermedio' => 'P. Intermediario',
            'precioMayorista' => 'P. Mayorista',
            'precioMinorista' => 'P. Minorista',
            'image' =>""
        ];
    }

    /**
     * metodo que carga una imagen al servidor
     */
    public function uploadImage(){
        if ($this->validate()) {
            $this->image->saveAs('uploads/prod-' . $this->pkProducto . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagenes()
    {
        return $this->hasMany(Imagenes::className(), ['fkProducto' => 'pkProducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalles::className(), ['fkProducto' => 'pkProducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMedida0()
    {
        return $this->hasOne(Medidas::className(), ['pkMedida' => 'fkMedida']);
    }
}
