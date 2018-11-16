<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;

use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use paragraph1\phpFCM\Notification;

class MessageNotification extends Model
{
    public $titulo;
    public $mensaje;
    
    public function rules()
    {
        return [            
            [['mensaje'], 'safe' ],
            [['titulo'], 'safe' ],
            [['titulo', 'mensaje'], 'required'],
            [['mensaje', 'titulo'], 'string', 'max' => 25],
        ]; 
    }

    public function attributeLabels(){
        return [            
            'titulo' => 'Titulo',
            'mensaje' => 'Mensaje',
        ]; 
    }
    /**
     * metodo que envia una notificacion al cliente del token
     * @param  [type] $nombres   [description]
     * @param  [type] $token     [description]
     * @param  [type] $id_pedido [description]
     * @return [type]            [description]
     */
    public static function sendNotification($token, $title, $message){
        $apiKey=Yii::$app->params['apiKeyFCM'];       
        $client = new Client();
        $client->setApiKey($apiKey);
        $client->injectHttpClient(new \GuzzleHttp\Client());

        $note = new Notification($title, $message);
        $note->setIcon('baseline_shopping_cart_white_48dp')
            ->setColor('#ffffff')
            ->setBadge(1);
        $message = new Message();
        $message->addRecipient(new Device($token));
        $message->setNotification($note)
            ->setData(array('someId' => 111));

        $response = $client->send($message);
    }    
}
