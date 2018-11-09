<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;


class Message extends Model
{
    public $titulo;
    public $mensaje;
    
    public function rules()
    {
        return [            
            [['mensaje'], 'safe' ],
            [['titulo'], 'safe' ],
            [['titulo', 'mensaje'], 'required'],
            [['mensaje', 'titulo'], 'string', 'max' => 25],
        ]; 
    }

    public function attributeLabels(){
        return [            
            'titulo' => 'Titulo',
            'mensaje' => 'Mensaje',
        ]; 
    }
}
