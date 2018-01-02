<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_persona extends CI_Model {

	function getPersona($id = null) {
		$sql = "SELECT id,
					   nombre_pers,
					   ape_mater,
					   ape_pater,
					   nro_doc,
					   TO_CHAR(fecha_nac,'dd/mm/yyyy') as fecha_nac
		          FROM personas
		         WHERE id = COALESCE(?, id)
		          ORDER BY id DESC";
		$result = $this->db->query($sql,array($id));
		if($result->num_rows() > 0 && $id == null) {
			return $result->result_array();
		}else if($result->num_rows() > 0 && $id != null){
			return $result->row_array();
		}
		return null;
	}

	function insertarPersona($json) {
		$sql = "INSERT 
		          INTO personas 
		               (nombre_pers, ape_pater, ape_mater, nro_doc, fecha_nac) 
		        VALUES (?,?,?,?,?)";
		$result = $this->db->query($sql, array($json['nombre_pers'], $json['ape_pater'], $json['ape_mater'], $json['nro_doc'], $json['fecha_nac']));
		if($result) {
			return $this->db->insert_id(); 
		}
		return null;
	}

	function updatePersona($json) {
		$sql = "UPDATE personas 
		           SET nombre_pers=?, 
		               ape_pater=?,
		               ape_mater=?,
		               nro_doc=?,
		               fecha_nac=?
		         WHERE id=?";
		$result = $this->db->query($sql, array($json['nombre_pers'],$json['ape_pater'],$json['ape_mater'],$json['nro_doc'],$json['fecha_nac'], $json['id']));
		return $result;
	}

	function deletePersona($id) {
		$sql = "DELETE 
		          FROM personas 
		         WHERE id= ?";
		$result = $this->db->query($sql,array($id));
		return $result;
	}

}

/* End of file M_persona.php */
/* Location: ./application/models/M_persona.php */