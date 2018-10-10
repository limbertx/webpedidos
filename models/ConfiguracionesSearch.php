<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Configuraciones;

/**
 * ConfiguracionesSearch represents the model behind the search form of `app\models\Configuraciones`.
 */
class ConfiguracionesSearch extends Configuraciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkConfiguracion'], 'integer'],
            [['tipoClienteDefecto', 'emailAdministrador', 'cuentaAdminMovil'], 'safe'],
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
        $query = Configuraciones::find();

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
            'pkConfiguracion' => $this->pkConfiguracion,
        ]);

        $query->andFilterWhere(['like', 'tipoClienteDefecto', $this->tipoClienteDefecto])
            ->andFilterWhere(['like', 'emailAdministrador', $this->emailAdministrador])
            ->andFilterWhere(['like', 'cuentaAdminMovil', $this->cuentaAdminMovil]);

        return $dataProvider;
    }
}
