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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Clientes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pkCliente' => $this->pkCliente,
        ]);

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telfMovil', $this->telfMovil])
            ->andFilterWhere(['like', 'tipoCliente', $this->tipoCliente])
            ->andFilterWhere(['like', 'tipoCuenta', $this->tipoCuenta]);

        return $dataProvider;
    }
}
