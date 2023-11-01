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
		$arrParams = array();
		$arrImportacionGrupalProducto = $this->InicioModel->getImportacionGrupalProducto($arrParams);
		$this->load->view('inicio',
			array('arrImportacionGrupalProducto' => $arrImportacionGrupalProducto)
		);
	}
}
