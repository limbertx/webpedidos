<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;


class PedidosSearch extends Model
{
    public $search;
    
    public function rules()
    {
        return [            
            [['search'], 'safe' ]
        ]; 
    }

    public function attributeLabels(){
        return [            
            'search' => 'Buscar'
        ]; 
    }
}
