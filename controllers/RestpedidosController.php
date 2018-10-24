<?php 
namespace app\controllers;

use yii\rest\ActiveController;
use yii\db\Expression;
use app\models\Medidas;
use app\models\Productos;
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
	 * metodo que inserta un pedido en el 
	 */
	public function actionSetPedido($value){
		// pkPedido, codigo, fkCliente, fechaPedido, fechaAtendida, precioTotal, estadoPedido
		//_______________________________________________________________
		//DETALLE
		//pkPedidoDetalle, fkPedido, fkProducto, cantidad, precioUnitario, precioTotal
		return "pedido guardado";
	}

}