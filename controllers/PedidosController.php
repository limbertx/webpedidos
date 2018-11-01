<?php

namespace app\controllers;

use Yii;
use app\models\Pedidos;
use app\models\PedidosSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PedidosController implements the CRUD actions for Pedidos model.
 */
class PedidosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pedidos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidosSearch();
        $search = null;
        $pagination = null;
        $pedidos = null;
        if($searchModel->load(Yii::$app->request->get())){
            if($searchModel->validate()){
                $search = Html::encode($searchModel->search);
                $query = Pedidos::find()
                            ->Where(["like", "nombre", $search])
                            ->orWhere(["like", "estadoPedido", $search]);

                $count = $query->count();

                $pagination = new Pagination([
                                        "totalCount"=>$count,
                                        "pageSize"=> 5
                                    ]);

                $pedidos = $query->offset($pagination->offset)
                                  ->limit($pagination->limit)
                                  ->all();
            }else{
                $searchModel->getErrors();
            }

        }else{ // cuando no llega ninguna busqueda
            $query = Pedidos::find();
            $count = $query->count();
            
            $pagination = new Pagination([
                                    "totalCount"=>$count,
                                    "pageSize"=> 5
                                ]);
            $pedidos = $query->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
        }

        return $this->render('index2', [
            "pedidos" => $pedidos,
            "searchModel" => $searchModel,
            "pagination" => $pagination,
        ]);
    }

    /**
     * Displays a single Pedidos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $pedidos = $this->findModel($id);

        return $this->render('view', [
            'nombre' => $pedidos->fkCliente0->nombres . " " . $pedidos->fkCliente0->apellidos,
            'fecha'=>Yii::$app->formatter->asDate($pedidos->fechaPedido, 'dd-MM-yyyy HH:mm'),
            'direccion'=> $pedidos->fkCliente0->direccion,
            'pedidos'=>$pedidos
        ]);
    }

    /**
     * Updates an existing Pedidos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pkPedido]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Pedidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedidos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
