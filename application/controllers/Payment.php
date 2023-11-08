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
		if(!isset($_SESSION['cart'])){
			redirect('Inicio');
		}

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
		$this->load->view('menu', array(
				'bCartShop' => false,
				'arrImportacionGrupalProducto' => $arrImportacionGrupalProducto
			)
		);
		$this->load->view('payment', array(
				'arrMedioPago' => $arrMedioPago,
				'arrDepartamento' => $arrDepartamento
			)
		);
		$this->load->view('footer');
	}

	public function addPedido(){
		if(!isset($_SESSION['cart'])){
			redirect('Inicio');
		}

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

	public function thank($iIdPedido=0){
		if($iIdPedido==0 && !isset($_SESSION['header']) && !isset($_SESSION['cart'])){
			redirect('Inicio');
		}

		//falta que redirija al inicio si no tiene carrito de compras
		if( isset($_SESSION['header']) && isset($_SESSION['cart']) ){
			$arrCabecera = $_SESSION['header'];
			$arrDetalle = $_SESSION['cart'];

			$ID_Empresa = $arrCabecera['cliente']['id_empresa'];
		} else {
			//get pedido si vence la sesión
			$arrParams = array( 'id_pedido' => $iIdPedido );
			$arrResponsePedido = $this->PaymentModel->getPedido($arrParams);
			if($arrResponsePedido['status']=='success'){
				$arrPedidoCabecera = $arrResponsePedido['result'][0];
				
				$ID_Empresa = $arrPedidoCabecera->ID_Empresa;

				$arrCabecera['cliente']['Nu_Celular_Entidad'] = $arrPedidoCabecera->Nu_Celular_Entidad;
				$arrCabecera['cliente']['No_Entidad'] = $arrPedidoCabecera->No_Entidad;
				$arrCabecera['documento']['tipo_documento_identidad'] = $arrPedidoCabecera->tipo_documento_identidad;
				$arrCabecera['cliente']['Nu_Documento_Identidad'] = $arrPedidoCabecera->Nu_Documento_Identidad;
				$arrCabecera['cliente']['Txt_Direccion'] = $arrPedidoCabecera->Txt_Direccion;

				$arrCabecera['documento']['id_pedido'] = $arrPedidoCabecera->id_pedido;
				$arrCabecera['documento']['fecha_registro'] = $arrPedidoCabecera->fecha_registro;
				$arrCabecera['documento']['importe_total'] = $arrPedidoCabecera->importe_total;
				$arrCabecera['documento']['cantidad_total'] = $arrPedidoCabecera->cantidad_total;
				$arrCabecera['documento']['signo_moneda'] = $arrPedidoCabecera->signo_moneda;

				$arrDetalle = (array)$arrResponsePedido['result'];
			} else {
				redirect('Inicio');
			}
		}

		unset($_SESSION['header']);//quitado temporalmente para crear pedido por whatssapp
		unset($_SESSION['cart']);//quitado temporalmente para crear pedido por whatssapp
		unset($_SESSION['provincia']);
		unset($_SESSION['distrito']);
		
		//get medio de pago
		$arrParamsMedioPago = array(
			'ID_Empresa' => $ID_Empresa
		);
		$arrMedioPago = $this->PaymentModel->getMedioPago($arrParamsMedioPago);

		$this->load->view('header');
		$this->load->view('menu', array(
				'bCartShop' => false,
			)
		);
		$this->load->view('thank', array(
			'arrCabecera' => $arrCabecera,
			'arrDetalle' => $arrDetalle,
			'arrMedioPago' => $arrMedioPago
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

	public function enviarArchivo(){
		//array_debug($_FILES);
		//array_debug($this->input->post());
	
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'heif', 'webp');
		if(!empty($this->input->post('id_pedido')) && isset($_FILES['voucher'])){
			$img = $_FILES['voucher']['name'];
			$tmp = $_FILES['voucher']['tmp_name'];
			$type = $_FILES['voucher']['type'];
			// get uploaded file's extension
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			// check's valid format
			if(in_array($ext, $valid_extensions)){
				$path = "assets/images/voucher_deposito/";

				$config['upload_path'] = $path;
				$config['allowed_types'] = 'png|jpg|jpeg|webp|PNG|JPG|JPEG|WEBP';
				$config['max_size'] = 1024;//1024 KB = 1 MB
				$config['encrypt_name'] = TRUE;
				$config['max_filename'] = '255';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('voucher')){
					echo json_encode(array(
						'status' => 'warning',
						'message' => 'No se guardo ' . strip_tags($this->upload->display_errors()) 
					));
				} else {
					$arrUploadFile = $this->upload->data();
					//array_debug($arrUploadFile);

					//ruta de archivo cloud
					$Txt_Url_Imagen_Deposito = base_url($path . $arrUploadFile['file_name']);

					//echo $Txt_Url_Imagen_Deposito;
					$data = array(
						'Txt_Url_Imagen_Deposito' => $Txt_Url_Imagen_Deposito
					);
					$where = array(
						'ID_Pedido_Cabecera' => $this->input->post('id_pedido')
					);
					echo json_encode($this->PaymentModel->addVoucherPedido($data, $where));
				}
			} else {
				echo json_encode(array(
					'status' => 'warning',
					'message' => 'Extensión inválida ' . $type
				));
			}
		}
	}	
}
