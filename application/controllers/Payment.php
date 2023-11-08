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
		
		//get medio de pago
		$arrMedioPago = array();
		if($arrImportacionGrupalProducto['status'] == 'success') {
			$arrImportacionGrupalProducto_ = $arrImportacionGrupalProducto['result'];
			$arrParamsMedioPago = array(
				'ID_Empresa' => $arrImportacionGrupalProducto_[0]->ID_Empresa
			);
			$arrMedioPago = $this->PaymentModel->getMedioPago($arrParamsMedioPago);
		}
		
		//get ubigeo
		$arrDepartamento = array();
		$arrProvincia = array();
		$arrDistrito = array();
		if($arrImportacionGrupalProducto['status'] == 'success') {
			//get Departamento
			$arrDepartamento = $this->PaymentModel->getDepartamento();

			//get provincia
			$_SESSION['provincia'] = $this->PaymentModel->getProvincia();

			//get distrito
			$arrImportacionGrupalProducto_ = $arrImportacionGrupalProducto['result'];
			$arrParamsUbigeo = array(
				'ID_Empresa' => $arrImportacionGrupalProducto_[0]->ID_Empresa
			);
			$_SESSION['distrito'] = $this->PaymentModel->getDistrito($arrParamsUbigeo);
		}

		$this->load->view('header');
		$this->load->view('menu', array('arrImportacionGrupalProducto' => $arrImportacionGrupalProducto));
		$this->load->view('payment', array(
				'arrMedioPago' => $arrMedioPago,
				'arrDepartamento' => $arrDepartamento
			)
		);
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
		unset($_SESSION['provincia']);
		unset($_SESSION['distrito']);
		
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('thank', array(
			'arrCabecera' => $arrCabecera,
			'arrDetalle' => $arrDetalle
		));
		$this->load->view('footer');
	}

	function searchForIdProvincia() {
		$id = $this->input->post('ID_Departamento');
		if(isset($_SESSION['provincia']) && $_SESSION['provincia']['status']=='success') {
			$arrProvincia = array();
			foreach ($_SESSION['provincia']['result'] as $row) {
				if ($row->ID_Departamento == $id) {
					$arrProvincia[] = [
						'ID_Provincia' => $row->ID_Provincia,
						'No_Provincia' => $row->No_Provincia,
					];
				}
			}

            echo json_encode(array(
                'status' => 'success',
                'message' => 'Si hay registros',
                'result' => $arrProvincia
            ));
		} else {
            echo json_encode(array(
                'status' => 'warning',
                'message' => 'No hay registros'
            ));
		}
	}

	function searchForIdDistrito() {
		$id = $this->input->post('ID_Provincia');
		if(isset($_SESSION['distrito']) && $_SESSION['distrito']['status']=='success') {
			$arrResult = array();
			foreach ($_SESSION['distrito']['result'] as $row) {
				if ($row->ID_Provincia == $id) {
					$arrResult[] = [
						'ID_Distrito' => $row->ID_Distrito,
						'No_Distrito' => $row->No_Distrito
					];
				}
			}

            echo json_encode(array(
                'status' => 'success',
                'message' => 'Si hay registros',
                'result' => $arrResult
            ));
		} else {
            echo json_encode(array(
                'status' => 'warning',
                'message' => 'No hay registros'
            ));
		}
	}
}
