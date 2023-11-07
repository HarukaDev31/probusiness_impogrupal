<?php
class PaymentModel extends CI_Model{
	public function __construct(){
		parent::__construct();
    }
  
    public function addPedido($arrPost){
		$this->db->trans_begin();
        
        $arrHeader = $arrPost['header'];
        $arrDetail = $arrPost['detail'];

        //crear cliente si no existe
        $sNombreEntidad = trim($arrHeader['No_Entidad']);
        $sNumeroDocumentoIdentidad = trim($arrHeader['Nu_Documento_Identidad']);
        $iTipoDocumentoIdentidad = '1';//1=OTROS
        $sTipoDocumentoIdentidad = 'OTROS';
        if ( strlen($sNumeroDocumentoIdentidad) == 8 ) {
            $iTipoDocumentoIdentidad = '2';//2=DNI
            $sTipoDocumentoIdentidad = 'DNI';
        } else if ( strlen($sNumeroDocumentoIdentidad) == 11 ) {
            $iTipoDocumentoIdentidad = '4';//4=RUC
            $sTipoDocumentoIdentidad = 'RUC';
        } else if ( strlen($sNumeroDocumentoIdentidad) == 12 ) {
            $iTipoDocumentoIdentidad = '3';//3=CARNET EXTRANJERIA
            $sTipoDocumentoIdentidad = 'CARNET EXTRANJERIA';
        }
        
        $query = "SELECT ID_Entidad FROM entidad WHERE ID_Empresa = 1 AND Nu_Tipo_Entidad = 0 AND ID_Tipo_Documento_Identidad = " . $iTipoDocumentoIdentidad . " AND Nu_Documento_Identidad = '" . $sNumeroDocumentoIdentidad . "' AND No_Entidad = '" . limpiarCaracteresEspeciales($sNombreEntidad) . "' LIMIT 1";
        $objVerificarCliente = $this->db->query($query)->row();
        if (is_object($objVerificarCliente)){
            $ID_Entidad = $objVerificarCliente->ID_Entidad;
        } else {
            $arrCliente = array(
                'ID_Empresa' => $arrHeader['id_empresa'],
                'ID_Organizacion' => $arrHeader['id_organizacion'],
                'Nu_Tipo_Entidad' => 0,//0=Cliente
                'ID_Tipo_Documento_Identidad' => $iTipoDocumentoIdentidad,
                'Nu_Documento_Identidad' => $sNumeroDocumentoIdentidad,
                'No_Entidad' => $sNombreEntidad,
                'Nu_Estado' => 1,
                'Nu_Celular_Entidad' => $arrHeader['Nu_Celular_Entidad'],
                'Txt_Email_Entidad'	=> $arrHeader['Txt_Email_Entidad']
            );

            if ($this->db->insert('entidad', $arrCliente) > 0) {
                $ID_Entidad = $this->db->insert_id();
            } else {
                $this->db->trans_rollback();
                return array(
                    'status' => 'error',
                    'message' => 'No registro cliente'
                );
            }
        }
        //caso contrario ubicar id

        $dEmision = dateNow('fecha');
        $dRegistroHora = dateNow('fecha_hora');

		$arrSaleOrder = array(
            'ID_Empresa' => $arrHeader['id_empresa'],
            'ID_Organizacion' => $arrHeader['id_organizacion'],
			'ID_Importacion_Grupal' => $arrHeader['id_importacion_grupal'],
			'Fe_Emision' => dateNow('fecha'),
            'ID_Entidad' => $ID_Entidad,
			'ID_Pais' => $arrHeader['id_pais'],//1=PERU
            'ID_Moneda' => $arrHeader['id_moneda'],
            'Ss_Total' => $arrHeader['importe_total'],
            'Qt_Total' => $arrHeader['cantidad_total'],
			'Txt_Direccion_Envio' => $arrHeader['Txt_Direccion'],
            'Nu_Estado' => 1,//1=Pendiente, 2=Confirmado y 3=Finalizado
            'Fe_Registro' => $dRegistroHora
		);
		
		$this->db->insert('importacion_grupal_pedido_cabecera', $arrSaleOrder);
		$iIdHeader = $this->db->insert_id();
        
		foreach($arrDetail as $row) {
			$arrSaleOrderDetail[] = array(
                'ID_Empresa' => $arrHeader['id_empresa'],
                'ID_Organizacion' => $arrHeader['id_organizacion'],
				'ID_Pedido_Cabecera' => $iIdHeader,
				'ID_Producto' => $row['id_item_bd'],
				'ID_Unidad_Medida' => $row['id_unidad_medida'],
				'ID_Unidad_Medida_Precio' => $row['id_unidad_medida_2'],
				'Qt_Producto' => $row['cantidad_item'],
				'Ss_Precio' => $row['precio_item'],
				'Ss_SubTotal' => $row['total_item'],
				'Ss_Impuesto' => 0,
				'Ss_Total' => $row['total_item'],
			);
		}
		$this->db->insert_batch('importacion_grupal_pedido_detalle', $arrSaleOrderDetail);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return array(
				'status' => 'error',
				'message' => '¡Oops! Algo salió mal. Inténtalo mas tarde detalle'
			);
		} else {
			$this->db->trans_commit();
			return array(
				'status' => 'success',
				'message' => 'Pedido creado',
                'result' => array(
                    'id_pedido' => $iIdHeader,
                    'tipo_documento_identidad' => $sTipoDocumentoIdentidad,
                    'fecha_registro' => $dRegistroHora,
                    'importe_total' => $arrHeader['importe_total'],
                    'cantidad_total' => $arrHeader['cantidad_total']
                )
			);
		}
    }
}