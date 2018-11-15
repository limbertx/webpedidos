<?php

namespace app\controllers;

use Yii;
use app\models\MessageNotification;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use paragraph1\phpFCM\Notification;

//require_once '../vendor/autoload.php';

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
        //$titulo = Yii::$app->request->get("titulo");
        //$mensaje = Yii::$app->request->get("mensaje");
        //Yii::warning("mensaje : " . $mensaje);

        /*if(isset($titulo) || isset($mensaje)){
            Yii::warning("mensaje : " . $mensaje);            
            $model = new MessageNotification();    
            return $this->redirect(['about']);
        }else{*/
            //$apiKey = 'AAAAy9IgdN4:APA91bGA8dsWzCfoRwy0npwqboLxvDhrI_6HAEplY0pjXMSeEzVbqvIUYVuNrSM0l5H_ZecVpwJsF5EqsCI1pMrd3DcdSs_5Rkz890EkrjXgMPxeq-Cru-ATN0J4j8SY3-P7x-feNYCj';
            $apiKey="AIzaSyAx9N126CImme4p9o2qDfjmiphUPR-sASQ";
            $client = new Client();
            $client->setApiKey($apiKey);
            $client->injectHttpClient(new \GuzzleHttp\Client());

            $note = new Notification('test title', 'testing body');
            $note->setIcon('notification_icon_resource_name')
                ->setColor('#ffffff')
                ->setBadge(1);
            $message = new Message();
            $message->addRecipient(new Device('fQNQHUCVeCc:APA91bE40i20_1cTSfNIqqr0Z9EtiSE7OYE3RD4PECEv1B4fjlTWd1bhTM19Ju8kTp_FMGrCRlyFarDpbCnv9a9VhsPdw-5rw5gNsFsLDT9doyCWZoFwZdJBGaXR6-N6Wd6LmwIqRFx9'));
            $message->setNotification($note)
                ->setData(array('someId' => 111));

            $response = $client->send($message);
            var_dump($response->getStatusCode());
        //}
            
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $model = new MessageNotification();
        $model->titulo = "";
        $model->mensaje= "";

        return $this->render('about', [
            'model'=> $model,
        ]);
    }
}
