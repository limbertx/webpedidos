<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Productos;
use app\models\Imagenes;
use app\models\ProductosSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $search = null;
        $pagination = null;
        $productos = null;
        if($searchModel->load(Yii::$app->request->get())){
            if($searchModel->validate()){
                $search = Html::encode($searchModel->search);
                $query = Productos::find()
                            ->Where(["like", "nombre", $search]);

                $count = $query->count();

                $pagination = new Pagination([
                                        "totalCount"=>$count,
                                        "pageSize"=> 5
                                    ]);

                $productos = $query->offset($pagination->offset)
                                  ->limit($pagination->limit)
                                  ->all();
            }else{
                $searchModel->getErrors();
            }

        }else{ // cuando no llega ninguna busqueda
            $query = Productos::find();
            $count = $query->count();
            
            $pagination = new Pagination([
                                    "totalCount"=>$count,
                                    "pageSize"=> 5
                                ]);
            $productos = $query->offset($pagination->offset)
                              ->limit($pagination->limit)
                              ->all();
        }

        return $this->render('index2', [
            "productos" => $productos,
            "searchModel" => $searchModel,
            "pagination" => $pagination,
        ]);

    }

    /**
     * Displays a single Productos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // obtenemos el link de la imagen
        $imagen = Imagenes::find()->where(["fkProducto"=>$id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            "url" => $imagen->getUrlWeb(),
        ]);
    }

    /**
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productos();

        if ($model->load(Yii::$app->request->post())){
            if($model->save()){
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->uploadImage()){
                    // guardamos el link de la imagen                    
                    //Yii::warning("extension : " . $model->image->extension);
                    $imagen = new Imagenes();
                    $imagen->ruta = "uploads/";
                    $imagen->nombre = "prod-".$model->pkProducto;
                    $imagen->extension = $model->image->extension;
                    $imagen->fkProducto = $model->pkProducto;
                    $imagen->save();
                }else{
                    Yii::warning("no se guardo!!");
                }
                return $this->redirect(['view', 'id' => $model->pkProducto]);
            }
        }        
        return $this->render('create', [
            'model' => $model,
            'url' => "",
            'nombre' =>"",
            'size' => 0,
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mImagen = Imagenes::find()->where(["fkProducto"=>$model->pkProducto])->one();        

        $url = "";
        $nombre = "";
        $size = 0;
        if($mImagen!=null){            
            $url = $mImagen->getUrlApplication();
            if(file_exists($url)){
                $size = filesize($url);
                $url = $mImagen->getUrlWeb();
                $nombre = $mImagen->nombre . "." . $mImagen->extension;
            }            
        }
        if ($model->load(Yii::$app->request->post())){
            if($model->save()){
                $model->image = UploadedFile::getInstance($model, 'image');
                //Yii::warning("nombre base del preview : " . $model->image->baseName);
                if(!($model->image == null)){
                    Yii::warning("soy una imagen valida : ");
                    if($model->uploadImage()){
                        // guardamos el link de la imagen
                        Yii::warning("nombre : " . $model->image->baseName);
                        $imagen = Imagenes::find()->where(["fkProducto"=>$model->pkProducto])->one();
                        if($imagen == null){
                            $imagen = new Imagenes();
                        }
                        
                        $imagen->ruta = "uploads/";
                        $imagen->nombre = "prod-". $model->pkProducto;
                        $imagen->extension = $model->image->extension;
                        $imagen->fkProducto = $model->pkProducto;
                        $imagen->save();
                    }
                }else{                
                    Yii::warning("imagen nula : nombre de imagen : ");
                    //unlink()
                }

            }
            return $this->redirect(['view', 'id' => $model->pkProducto]);
        }        
        return $this->render('update', [
            'model' => $model,
            'url' => $url,
            'nombre' => $nombre,
            'size' => $size,
        ]);
    }
    protected function deleteImagen($idProducto){
        // eliminamos la imagen
        $img = Imagenes::find()->where(["fkProducto" => $idProducto])->one();
        if($img!=null){
            // eliminamos el archivo fisico
            if(file_exists($img->getUrlApplication()))
                if(unlink($img->getUrlApplication())){
                    $img->delete();
                }
        }
    }
    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // primero buscamos el producto
        $modelo = $this->findModel($id);
        $this->deleteImagen($modelo->pkProducto);
        $modelo->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
