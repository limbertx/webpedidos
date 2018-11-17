<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\Pedidos;
use app\models\MessageNotification;
use app\models\PedidosSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\helpers\Html;
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
                            ->Where(["like", "estadoPedido", $search])->orderBy(["fechaPedido"=>SORT_DESC]);


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
            $query = Pedidos::find()->orderBy(["fechaPedido"=>SORT_DESC]);
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

    public function actionImprimir($id){

        $pedidos = $this->findModel($id);        
        $code = str_pad((string)$pedidos->pkPedido, 6, "0", STR_PAD_LEFT);
        $nombre = $pedidos->fkCliente0->nombres . " " . $pedidos->fkCliente0->apellidos;
        $fecha = Yii::$app->formatter->asDate($pedidos->fechaPedido, 'dd-MM-yyyy');
        $direccion = $pedidos->fkCliente0->direccion;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode'      => Pdf::MODE_CORE,
            'format'    => Pdf::FORMAT_LETTER,
            'content'   => $this->getHTML($code, $nombre, $fecha, $direccion, $pedidos),
            "filename"  => "P-".$code.".pdf",
            'options'   => [
                        'title' => 'Krajee Report Title',
                           ],
            'methods'   => [
                'SetTitle' => 'Pedido # '. $code,
                'SetSubject' => 'Generado por webpedidos(Codeyal soluciones)',
                'SetHeader' => ['Documento generado el: ' . date("d-M-Y H:i:s")],
                'SetFooter' => ['|Pagina {PAGENO}|'],
                'SetAuthor' => 'codeyal soluciones',
                'SetCreator' => 'codeyal soluciones',
                'SetKeywords' => 'codeyal, Export, PDF, yii2-mpdf',
                            ]
        ]);
        return $pdf->render();
    }
    /**
     * metodo que atiende el pedido
     */
    public function actionAttend($id){
        $pedidos = $this->findModel($id);
        $pedidos->estadoPedido="ATENDIDO";
        if($pedidos->save()){
            $token = $pedidos->fkCliente0->token;
            $code = str_pad((string)$pedidos->pkPedido, 6, "0", STR_PAD_LEFT);
            $title = "Pedido Nº. : " . $code . " Ha sido atendido.";
            $message = "Su pedido fue atendido pronto tendra noticias.";
            MessageNotification::sendNotification($token, $title, $message);
        }
        return $this->redirect(['index']);
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
        
        $code = str_pad((string)$pedidos->pkPedido, 6, "0", STR_PAD_LEFT);
    
        return $this->render('view',
         [
            'code' => $code,
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

    public function getHTML($code, $nombre, $fecha, $direccion, $pedidos){

    $html = '
    <h3 align="center">Pedido #' . $code .'</h3>
    <hr style=" margin:0; padding:0;">
    <table>
        <tr>
            <td style="width:500px; height: 40px;">
                <p>
                    <strong>
                        Nombre de cliente:
                    </strong>
                    ' . $nombre . '
                </p>            
            </td>
            <td style="width:200px; height: 40px;">
                <p>
                    <strong>
                        Fecha de pedido:
                    </strong>
                    ' . $fecha . '
                </p>            
            </td>
        </tr>
        <tr>
            <td colspan="2" style="height: 40px;">
                <p align="left">
                    <strong>
                        Direccion de cliente:
                    </strong>
                    ' . $direccion . '
                </p>
            </td>
        </tr>        
    </table>

    <hr style=" margin:0; padding:0;">
    <h4 align="center">Detalle de pedido</h4>
    <hr style=" margin:0; padding:0;">
    <br>
    <br>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <th style="width:40px; background-color: #C9C9C9;" align="center">#</th>
            <th style="width:310px; background-color: #C9C9C9;" align="center">PRODUCTO</th>
            <th style="width:100px; background-color: #C9C9C9;" align="center">CANTIDAD</th>
            <th style="width:150px; background-color: #C9C9C9;" align="center">PRECIO UNITARIO</th>
            <th style="width:100px; background-color: #C9C9C9;" align="center">PRECIO TOTAL</th>
        </tr>
        ';

                                
        $index = 1; 
        $detalles = $pedidos->getPedidoDetalles()->all();
        foreach($detalles as $detalle){
            $html .= "<tr>";
            $html .= '<td align="center">'. $index .'</td>';
            $html .= '<td><p>'. $detalle->fkProducto0->nombre .'</p></td>';
            $html .= '<td align="center"><p>'. $detalle->cantidad .'</p></td>';
            $html .= '<td align="center"><p>'.$detalle->precioUnitario.'</p></td>';
            $html .= '<td align="center"><p>'.$detalle->precioTotal.'</p></td>';
            $html .= '</tr>';
            $index = $index + 1;
        }

        $html = $html . '<tr>
            <td colspan="4" align="right">
                <p>Precio total (Bolivianos):</p>    
            </td>
            <td align="center">
            <p>'.$pedidos->precioTotal.'</p>
            </td>
        </tr>
    </table>

    <p>&nbsp;</p>';

    return $html;
    }
}
