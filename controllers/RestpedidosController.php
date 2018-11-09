<?php 
namespace app\controllers;

use Yii;
use yii\db\Expression;
use yii\rest\ActiveController;
use app\models\Medidas;
use app\models\Clientes;
use app\models\Productos;
use app\models\Pedidos;
use app\models\PedidoDetalles;
use yii\helpers\BaseJson;

class RestpedidosController extends ActiveController {

	public $modelClass = "app\models\Medidas";

	// es la url http://localhost/pedido/web/uploads/prod-1.jpg

	/**
	 * servicio que envia una lista de productos
	 */
	public function actionGetproductos(){
		
		$response = array();

		$productos = Productos::find()->all();
		$lista = array();
		foreach ($productos as $producto) {
			$item = array();
			$item["pkProducto"] = $producto->pkProducto;
			$item["nombre"] = $producto->nombre;
			$item["descripcion"] = $producto->descripcion;
			$item["precioMayorista"] = $producto->precioMayorista;
			$item["precioMinorista"] = $producto->precioMinorista;
			$item["precioIntermedio"] = $producto->precioIntermedio;
			$item["medida"] = $producto->fkMedida0->abreviatura;
			$item["moneda"] = $producto->fkMoneda0->abreviatura;
			//$item["url"] = "";
			$imagenes = $producto->imagenes;
			foreach ($imagenes as $imagen) {
				$item["url"] = $imagen->ruta . $imagen->nombre .".". $imagen->extension;
			}
			$lista[] = $item;	
		}
		if(count($lista) > 0){
			$response["status"] = "200";
			$response["response"] = $lista; 
		}else{
			$response["status"] = "404";
		}	
		return $response;
		
	}
	/**
	 * metodo que inserta un pedido en la base de datos
	 */
	public function actionSetpedido(){
		
		$response = array();
		// pkPedido, codigo, fkCliente, fechaPedido, fechaAtendida, precioTotal, estadoPedido
		if(!Yii::$app->request->post()){
			$response["status"] = "500";
			$response["response"] = "no se encontraron datos!";
			return $response;
		}

		$data = Yii::$app->request->post();
		$head = $data["head"];
		$detail = $data["detail"];

		$encabezado = json_decode($head);
		$model = new Pedidos();
		$model->fkCliente = 1; // $head->fkCliente
		$model->codigo = "0000";
		$model->fechaPedido = new Expression('NOW()');
		$model->fechaAtendida = null;
		$model->precioTotal = $encabezado->precioTotal;
		$model->estadoPedido = "PENDIENTE";
		// enviar fkCliente, precioTotal
		if($model->save()){ // $model->save()
			//DETALLE
			//pkPedidoDetalle, fkPedido, fkProducto, cantidad, precioUnitario, precioTotal
			$detalles = json_decode($detail);
			foreach ($detalles as $detalle){
				$modelDetalle = new PedidoDetalles();
				$modelDetalle->fkPedido = $model->pkPedido;				
				$modelDetalle->cantidad = $detalle->cantidad;
				$modelDetalle->precioUnitario = $detalle->precioUnitario;
				$modelDetalle->precioTotal = $detalle->precioTotal;
				$producto = $detalle->producto;
				$modelDetalle->fkProducto = $producto->pkProducto;
				//$modelDetalle->fkProducto = $detalle->fkProducto;
				// enviar fkProducto, cantidad, precioUnitario, precioTotal
				if($modelDetalle->save()){ // $modelDetalle->save()
					$response["status"] = "200";
					$response["response"] = "ok";
				}else{
					$response["status"] = "500";
					$response["response"] = $modelDetalle->getErrors();	
				}
			}
		}else{
			$response["status"] = "500";
			$response["response"] = $model->getErrors();
		}
		
		return $response;
	}
	/**
	 * metodo que envia un cliente a la peticion en base al telefono del cliente 
	 *  http://localhost/pedido/web/restpedidos/getcliente/3364987
	 */
	public function actionGetcliente($telefono){

		$response = array();

		if(is_null($telefono)){
			$response["status"] = "500";
			$response["response"] = $model->getErrors();
			return $response;			
		}

		$client = Clientes::find()->where(['like', 'telfMovil', $telefono])->one();

		if($client != null){
			$item = array();
			$item["pkCliente"]	 = $client->pkCliente;
			$item["nombres"] 	 = $client->nombres;
			$item["apellidos"]   = $client->apellidos;
			$item["direccion"]   = $client->direccion;
			$item["telfMovil"]   = $client->telfMovil;
			$item["tipoCliente"] = $client->tipoCliente;
			$item["tipoCuenta"]  = $client->tipoCuenta;

			$response["status"]  = "200";
			$response["response"]= $item;
		}else{
			$response["status"]  = "505";
			$response["response"]= "No se encontro ningun cliente";
		}

		return $response;
	}
	/** metodo que actualiza o ingresa un cliente.
	 * http://localhost/pedido/web/restpedidos/updatecliente
	 * @return [type]
	 */
	public function actionUpdatecliente(){
		$response = array();

		$item = Yii::$app->request->post();
		$telefono = $item["telfMovil"];

		$client = Clientes::find()
						->where(['telfMovil' => $telefono])
						->one();

		if($client != null){ // entonces actualizamos
			$client->nombres   = $item["nombres"];
			$client->apellidos = $item["apellidos"];
			$client->direccion = $item["direccion"];
			$client->telfMovil = $item["telfMovil"];
			//$client->tipoCliente = $item["tipoCliente"];
			//$client->tipoCliente = "MINORISTA";
			//$client->tipoCuenta = $item["tipoCuenta"];
			//$client->tipoCuenta = "USUARIO";
			$client->save();
		}else{
			$client = new Clientes();
			$client->nombres   = $item["nombres"];
			$client->apellidos = $item["apellidos"];
			$client->direccion = $item["direccion"];
			$client->telfMovil = $item["telfMovil"];
			//$client->tipoCliente = $item["tipoCliente"];
			$client->tipoCliente = "MINORISTA";
			//$client->tipoCuenta = $item["tipoCuenta"];
			$client->tipoCuenta = "USUARIO";
			$client->save();			
		}

		$response["status"] = "200";
		$response["response"] = "ok";		
		
		return $response; 
	}
}