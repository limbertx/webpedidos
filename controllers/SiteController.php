<?php

namespace app\controllers;

use Yii;
use app\models\Message;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    public function actionSend(){
        $titulo = Yii::$app->request->get("titulo");
        $mensaje = Yii::$app->request->get("mensaje");
        if(isset($titulo) || isset($mensaje)){
            $model = new Message();    
            return $this->redirect(['about']);
        }else{
            $service = new FirebaseNotifications(['authKey' => 'AAAAy9IgdN4:APA91bGA8dsWzCfoRwy0npwqboLxvDhrI_6HAEplY0pjXMSeEzVbqvIUYVuNrSM0l5H_ZecVpwJsF5EqsCI1pMrd3DcdSs_5Rkz890EkrjXgMPxeq-Cru-ATN0J4j8SY3-P7x-feNYCj']);
            $service->sendNotification($tokens, $message);
        }
            
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $model = new Message();
        $model->titulo = "";
        $model->mensaje= "";

        return $this->render('about', [
            'model'=> $model,
        ]);
    }
}
