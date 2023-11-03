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

		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('payment');
		$this->load->view('footer');
	}

	public function addPedido(){
		//falta que redirija al inicio si no tiene carrito de compras
		$arrPost['header'] = $this->input->post('arrParams');
		$arrPost['detail'] = $_SESSION['cart'];
		
		$arrResponse = $this->PaymentModel->addPedido($arrPost);
		if ($arrResponse['status']=='success'){
			//unset($_SESSION['cart']);
			echo json_encode($arrResponse);
		} else {
			echo json_encode($arrResponse);
		}
	}

	public function thank(){
		//falta que redirija al inicio si no tiene carrito de compras
		$arrPedido = $_SESSION['cart'];
		unset($_SESSION['cart']);
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('thank', array(
			'arrPedido' => $arrPedido
		));
		$this->load->view('footer');
	}
}
