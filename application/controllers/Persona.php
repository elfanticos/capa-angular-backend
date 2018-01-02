<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
class Persona extends REST_Controller {

	function __construct() {
        parent::__construct();
        $this->load->helper('util');
        $this->load->model('m_persona');
 	}
	public function index_get() {
		$personas = $this->m_persona->getPersona();
		if(!empty($personas)) {
	      $this->response(array('response' => $personas,'code'=> 200),200);
	    }else {
	      $this->response(array('error' => 'Producto no disponible','code'=> 404),404);
	    }
	}
	public function index_post() {
		echo 'Cargo Api Rest';
	}

	public function find_get($id) {
		if(!$id) {
	      $this->response(null,400);
	    }
	    $listPersona = $this->m_persona->getPersona($id);
	    if(!is_null($listPersona)) {
	      $this->response(array('response' => $listPersona, 'code'=> 200),200);
	    }else {
	      $this->response(array('error' => 'No se encontro el producto', 'code'=> 404),404);
	    }
	}
	public function index_put() {}
  	public function index_delete($id) {}

  	function insertarPersona_post() {
  		$json   = json_decode(utf8_encode($this->input->post('json')),true);
       if(!$json) {
        $this->response(null,400);
       }
       if(!isset($json['nombre_pers'])) {
        $json['nombre_pers'] = null;
       }
       if(!isset($json['ape_pater'])) {
        $json['ape_pater'] = null;
       }
       if(!isset($json['ape_mater'])) {
        $json['ape_mater'] = null;
       }
       if(!isset($json['nro_doc'])) {
        $json['nro_doc'] = null;
       }
       if(!isset($json['fecha_nac'])) {
        $json['fecha_nac'] = null;
       }
       $id = $this->m_persona->insertarPersona($json);
       if(!empty($id)) {
          $this->response(array('response' => 'La persona'.$json['nombre_pers'].' :::('.$id.') Se inserto correctamente.', 'code'=> 200),200);
       }else {
          $this->response(array('error' => 'Algo ha fallado en el servidor', 'code'=> 400),400);
       }
  	}

  	function actualizarPersona_post($id) {
    $json = empty($this->input->post('json')) ? null : json_decode($this->input->post('json'),true);
    if(!$json) {
      $this->response(null,400);
    }
    $result = $this->m_persona->updatePersona($json);
    if($result) {
      $this->response(array('response' => 'Persona actualizada', 'code'=> 200),200);
    }else {
      $this->response(array('error' => 'Algo a fallado en el servidor', 'code'=> 400),400);
    }
  }

  function eliminarPersona_get($id) {
    if(!$id) {
      $this->response(null,400);
    }
    $result = $this->m_persona->deletePersona($id);
    if($result) {
      $this->response(array('response' => 'La persona se elimino correctamente.', 'code'=> 200),200);
    }else {
      $this->response(array('error' => 'Algo ha fallado en el servidor', 'code'=> 400),400);
    }
   
  }
}

/* End of file persona.php */
/* Location: ./application/controllers/persona.php */