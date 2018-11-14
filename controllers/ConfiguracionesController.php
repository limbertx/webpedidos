<?php

namespace app\controllers;

use Yii;
use app\models\Configuraciones;
use app\models\ConfiguracionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfiguracionesController implements the CRUD actions for Configuraciones model.
 */
class ConfiguracionesController extends Controller
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
     * Creates a new Configuraciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Configuraciones();

        if ($model->load(Yii::$app->request->post())){
            $config = Configuraciones::findOne(1);
            $config->tipoClienteDefecto = $model->tipoClienteDefecto;
            $config->emailAdministrador = $model->emailAdministrador;
            $config->fkClienteAdmin = $model->fkClienteAdmin;
            $config->fkMonedaDefecto = $model->fkMonedaDefecto;
            $config->save();

            return $this->render('create', [
                'model' => $config,
            ]);
        }else{
            Yii::warning("BUSCANDO EL UNO!!");
            $model = Configuraciones::findOne(1);
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

}
