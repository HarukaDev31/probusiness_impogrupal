<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database('default');
		$this->load->library('session');
		$this->load->library('encryption');
		$this->load->model('InicioModel');
	}

	public function index(){
		//unset($_SESSION['cart']);//por mientras hasta que realice el quitar

		$arrParams = array();
		$arrImportacionGrupalProducto = $this->InicioModel->getImportacionGrupalProducto($arrParams);
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('inicio',
			array('arrImportacionGrupalProducto' => $arrImportacionGrupalProducto)
		);
		$this->load->view('footer_data');
		$this->load->view('footer');
	}

	public function agregarItem(){
		$arrParams = $this->input->post('arrParams');

		$result = array();
		$count = 0;
		if( !empty($arrParams['id_item']) && !empty($arrParams['cantidad_item']) ) {
			$id = $arrParams['id_item'];
			$nombre_item = $arrParams['nombre_item'];
			$url_imagen_item = $arrParams['url_imagen_item'];
			$cantidad_item = $arrParams['cantidad_item'];
			$precio_item = $arrParams['precio_item'];
			$total_item = $arrParams['total_item'];
			if(isset($_SESSION['cart'])) {
				$existProduct = false;
				foreach ($_SESSION['cart'] as $key => $product) {
					if($product['id_item'] == $id) {
						$_SESSION['cart'][$key]['cantidad_item'] += $cantidad_item;
						$_SESSION['cart'][$key]['precio_item'] = $precio_item;
						$_SESSION['cart'][$key]['total_item'] = $total_item;
						$_SESSION['cart'][$key]['nombre_item'] = $nombre_item;
						$_SESSION['cart'][$key]['url_imagen_item'] = $url_imagen_item;
						$existProduct = true;
						break;
					}
				}
				if(!$existProduct) {
					array_push($_SESSION['cart'], [
						'id_item' => $id,
						'cantidad_item' => $cantidad_item,
						'precio_item' => $precio_item,
						'total_item' => $total_item,
						'nombre_item' => $nombre_item,
						'url_imagen_item' => $url_imagen_item
					]);
				}
			} else {
				$_SESSION['cart'][] = [
					'id_item' => $id,
					'cantidad_item' => $cantidad_item,
					'precio_item' => $precio_item,
					'total_item' => $total_item,
					'nombre_item' => $nombre_item,
					'url_imagen_item' => $url_imagen_item
				];
			}
			$result['status'] = 'success';
			$result['count'] = countBooks($_SESSION['cart']);
			$result['total_item'] = amountBooks($_SESSION['cart']);
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Problemas al agregar';
		}
		echo json_encode($result);
	}

	function quitarItem() {
		$arrParams = $this->input->post('arrParams');
		
		$result = array();
		$count = 0;
		if( !empty($arrParams['id_item']) ) {
			$id = $arrParams['id_item'];
			foreach ($_SESSION["cart"] as $key => $product) {
				if($product["id_item"] == $id) {
					unset($_SESSION['cart'][$key]);
					break;
				}
			}
			
			$result['status'] = 'success';
			$result['count'] = countBooks($_SESSION['cart']);
			$result['total_item'] = amountBooks($_SESSION['cart']);
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Problemas al agregar';
		}
		echo json_encode($result);
	}

	public function modalCartShop(){
		if(isset($_SESSION['cart'])) {
			$result['status'] = 'success';
			$result['result'] = $_SESSION['cart'];
		} else {
			$result['status'] = 'error';
			$result['message'] = 'No hay datos';
		}
		echo json_encode($result);
	}
}
