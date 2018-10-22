<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;

/**
 * ProductosSearch represents the model behind the search form of `app\models\Productos`.
 */
class ProductosSearch extends Model
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
