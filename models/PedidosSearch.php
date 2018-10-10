<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedidos;

/**
 * PedidosSearch represents the model behind the search form of `app\models\Pedidos`.
 */
class PedidosSearch extends Pedidos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkPedido', 'fkCliente'], 'integer'],
            [['codigo', 'fechaPedido', 'fechaAtendida', 'estadoPedido'], 'safe'],
            [['precioTotal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Pedidos::find();

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
            'pkPedido' => $this->pkPedido,
            'fkCliente' => $this->fkCliente,
            'fechaPedido' => $this->fechaPedido,
            'fechaAtendida' => $this->fechaAtendida,
            'precioTotal' => $this->precioTotal,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'estadoPedido', $this->estadoPedido]);

        return $dataProvider;
    }
}
