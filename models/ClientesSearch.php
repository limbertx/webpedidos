<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form of `app\models\Clientes`.
 */
class ClientesSearch extends Model
{
    public $search;
    /**
     * {@inheritdoc}
     */
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