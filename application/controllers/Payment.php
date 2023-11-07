<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database('default');
		$this->load->library('session');
		$this->load->library('encryption');
		$this->load->model('PaymentModel');
		$this->load->model('InicioModel');
	}

	public function index(){
		//falta que redirija al inicio si no tiene carrito de compras

		$arrParams = array();
		$arrImportacionGrupalProducto = $this->InicioModel->getImportacionGrupalProducto($arrParams);
		$this->load->view('header');
		$this->load->view('menu', array('arrImportacionGrupalProducto' => $arrImportacionGrupalProducto));
		$this->load->view('payment');
		$this->load->view('footer');
	}

	public function addPedido(){
		//falta que redirija al inicio si no tiene carrito de compras
		$arrPost['header'] = $this->input->post('arrParams');
		$arrPost['detail'] = $_SESSION['cart'];
		
		$_SESSION['header']['cliente'] = $arrPost['header'];
		
		$arrResponse = $this->PaymentModel->addPedido($arrPost);
		if ($arrResponse['status']=='success'){
			//unset($_SESSION['cart']);
			$_SESSION['header']['documento'] = $arrResponse['result'];
			echo json_encode($arrResponse);
		} else {
			echo json_encode($arrResponse);
		}
	}

	public function thank(){
		//falta que redirija al inicio si no tiene carrito de compras
		$arrCabecera = $_SESSION['header'];
		$arrDetalle = $_SESSION['cart'];

		//unset($_SESSION['header']);//quitado temporalmente para crear pedido por whatssapp
		//unset($_SESSION['cart']);//quitado temporalmente para crear pedido por whatssapp
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('thank', array(
			'arrCabecera' => $arrCabecera,
			'arrDetalle' => $arrDetalle
		));
		$this->load->view('footer');
	}
}
