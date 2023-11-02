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
		unset($_SESSION['cart']);//por mientras hasta que realice el quitar

		$arrParams = array();
		$arrImportacionGrupalProducto = $this->InicioModel->getImportacionGrupalProducto($arrParams);
		$this->load->view('inicio',
			array('arrImportacionGrupalProducto' => $arrImportacionGrupalProducto)
		);
	}

	public function agregarItem(){
		$arrParams = $this->input->post('arrParams');

		$result = array();
		$count = 0;
		if( !empty($arrParams['id_item']) && !empty($arrParams['cantidad_item']) ) {
			$id = $arrParams['id_item'];
			$cantidad_item = $arrParams['cantidad_item'];
			if(isset($_SESSION['cart'])) {
				$existProduct = false;
				foreach ($_SESSION['cart'] as $key => $product) {
					if($product['id_item'] == $id) {
						$_SESSION['cart'][$key]['cantidad_item'] = $cantidad_item;
						$existProduct = true;
						break;
					}
				}
				if(!$existProduct) {
					array_push($_SESSION['cart'], [
						'id_item' => $id,
						'cantidad_item' => $cantidad_item
					]);
				}
			} else {
				$_SESSION['cart'][] = [
					'id_item' => $id,
					'cantidad_item' => $cantidad_item
				];
			}
			$result['status'] = 'success';
			$result['count'] = countBooks($_SESSION['cart']);
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Problemas al agregar';
		}
		echo json_encode($result);
	}
}
