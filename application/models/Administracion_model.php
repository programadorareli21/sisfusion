<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administracion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }



	public function get_datos_lote_11 () {
		$query = $this->db-> query("SELECT l.idLote, cl.id_cliente, UPPER(CONCAT(cl.nombre, ' ', cl.apellido_paterno, ' ', cl.apellido_materno)) nombreCliente,
        l.nombreLote, l.idStatusContratacion, l.idMovimiento, l.modificado, cl.rfc, l.totalNeto, l.fechaSolicitudValidacion,
        CAST(l.comentario AS varchar(MAX)) as comentario, l.fechaVenc, l.perfil, cond.nombre as nombreCondominio, res.nombreResidencial, l.ubicacion,
        l.tipo_venta, l.observacionContratoUrgente as vl,
		concat(asesor.nombre,' ', asesor.apellido_paterno, ' ', asesor.apellido_materno) as asesor,
        concat(coordinador.nombre,' ', coordinador.apellido_paterno, ' ', coordinador.apellido_materno) as coordinador,
        concat(gerente.nombre,' ', gerente.apellido_paterno, ' ', gerente.apellido_materno) as gerente,
		cond.idCondominio, cl.expediente, mo.descripcion
	    FROM lotes l
        INNER JOIN clientes cl ON l.idLote=cl.idLote
        INNER JOIN condominios cond ON l.idCondominio=cond.idCondominio
        INNER JOIN residenciales res ON cond.idResidencial = res.idResidencial
        INNER JOIN movimientos mo ON mo.idMovimiento = l.idMovimiento
		LEFT JOIN usuarios asesor ON cl.id_asesor = asesor.id_usuario
		LEFT JOIN usuarios coordinador ON cl.id_coordinador = coordinador.id_usuario
		LEFT JOIN usuarios gerente ON cl.id_gerente = gerente.id_usuario
        WHERE ((l.idStatusContratacion IN (8, 10) AND l.idMovimiento IN (40, 10, 67) AND (l.validacionEnganche = 'NULL' OR l.validacionEnganche IS NULL)) OR
        (l.idStatusContratacion = 12 AND l.idMovimiento = 42 AND (l.validacionEnganche = 'NULL' OR l.validacionEnganche IS NULL)) OR
        (l.idStatusContratacion IN (7) AND l.idMovimiento IN (37, 7, 64, 77) AND (l.validacionEnganche = 'NULL' OR l.validacionEnganche IS NULL)) OR
        (l.idStatusContratacion IN (8) AND l.idMovimiento IN (38, 65) AND (l.validacionEnganche = 'NULL' OR l.validacionEnganche IS NULL)))
        AND cl.status = 1
	    GROUP BY l.idLote, cl.id_cliente, cl.nombre, cl.apellido_paterno, cl.apellido_materno,
        l.nombreLote, l.idStatusContratacion, l.idMovimiento, l.modificado, cl.rfc, l.totalNeto, l.fechaSolicitudValidacion,
        CAST(l.comentario AS varchar(MAX)), l.fechaVenc, l.perfil, cond.nombre, res.nombreResidencial, l.ubicacion,
        l.tipo_venta, l.observacionContratoUrgente,
        concat(asesor.nombre,' ', asesor.apellido_paterno, ' ', asesor.apellido_materno),
        concat(coordinador.nombre,' ', coordinador.apellido_paterno, ' ', coordinador.apellido_materno),
        concat(gerente.nombre,' ', gerente.apellido_paterno, ' ', gerente.apellido_materno),
        cond.idCondominio, cl.expediente, mo.descripcion
        ORDER BY l.nombreLote");
		return $query->result();
	}

    public function get_datos_admon($condominio){
    	return $this->db->query("SELECT lot.idCliente, lot.nombreLote, con.nombre as nombreCondominio, res.nombreResidencial, lot.idStatusLote, lot.comentarioLiberacion, lot.fechaLiberacion, 
        con.idCondominio, lot.sup as superficie, lot.saldo, lot.precio, lot.enganche, lot.porcentaje, lot.total, lot.referencia, lot.comentario, lot.comentarioLiberacion, lot.observacionLiberacion, 
        sl.nombre as descripcion_estatus, sl.color FROM [lotes] lot 
        INNER JOIN [condominios] con ON con.idCondominio = lot.idCondominio 
        INNER JOIN [residenciales] res ON res.idResidencial = con.idResidencial 
        INNER JOIN [statuslote] sl ON sl.idStatusLote = lot.idStatusLote WHERE lot.idCondominio = ".$condominio."");
    }

	public function validateSt11($idLote){
      $this->db->where("idLote",$idLote);
      $this->db->where_in('idStatusLote', 3);
      $this->db->where("((idStatusContratacion IN (8, 10) AND idMovimiento IN (40, 10, 67) AND (validacionEnganche = 'NULL' OR validacionEnganche IS NULL)) OR
      (idStatusContratacion = 12 and idMovimiento = 42 AND (validacionEnganche = 'NULL' OR validacionEnganche IS NULL)) OR
      (idStatusContratacion IN (7) AND idMovimiento IN (37, 7, 64, 77) AND (validacionEnganche = 'NULL' OR validacionEnganche IS NULL)) OR
      (idStatusContratacion IN (8) AND idMovimiento IN (38, 65, 67) AND (validacionEnganche = 'NULL' OR validacionEnganche IS NULL)))");
      $query = $this->db->get('lotes');
      $valida = (empty($query->result())) ? 0 : 1;
      return $valida;
    }


    public function updateSt($idLote,$arreglo,$arreglo2){

        $this->db->trans_begin();

        $this->db->where("idLote",$idLote);
        $this->db->update('lotes',$arreglo);

        $this->db->insert('historial_lotes',$arreglo2);

        if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
        }

	}

	   public function get_data_asignacion($idLote){
		return $this->db->query("SELECT id_estado, id_desarrollo_n FROM lotes WHERE idLote = $idLote")->row();
	  }

	  public function get_edo_lote(){
		return $this->db->query("SELECT * FROM opcs_x_cats WHERE id_catalogo = 44")->result_array();
	  }

	  public function get_des_lote(){
		return $this->db->query("SELECT * FROM opcs_x_cats WHERE id_catalogo = 45")->result_array();
	  }

	  public function update_asignacion($idLote,$data){
		$this->db->where("idLote",$idLote);
		$this->db->update('lotes',$data);
		return true;
	 }

	 public function getAssisGte($id_cliente){
        $query = $this->db->query("SELECT id_gerente FROM clientes WHERE id_cliente=".$id_cliente);
        $query = $query->row();

        if($query->id_gerente != NULL || $query->id_gerente != ''){
            $query2 = $this->db->query("SELECT * FROM usuarios WHERE id_rol=6 AND estatus=1 AND id_lider=".$query->id_gerente);
            return $query2 = $query2->result_array();
//            print_r($query2 = $query2->result_array());
        }else{
            return $query;
//            print_r($query);

        }
        exit;
     }

     public function getInfoToMail($id_cliente, $id_lote){
        $query = $this->db->query("SELECT res.nombreResidencial, c.nombre as nombreCondominio, l.nombreLote,
        CONCAT(cl.nombre,' ', cl.apellido_paterno, ' ', cl.apellido_materno) as nombreCliente,
        cl.fechaApartado
        FROM clientes cl
        INNER JOIN lotes l ON l.idLote = cl.idLote
        INNER JOIN condominios c ON c.idCondominio=l.idCondominio
        INNER JOIN residenciales res ON res.idResidencial = c.idResidencial
        WHERE cl.id_cliente=".$id_cliente." AND cl.idLote=".$id_lote);
        return $query->row();
     }

    public function getDateStatus11(){
        $query = $this->db->query("SELECT r.descripcion, c.nombre, l.idLote, nombreLote, idStatusContratacion, idMovimiento, idStatusLote, perfil, 
        validacionEnganche, status8Flag, comentario, firmaRL, totalNeto2, l.idCliente, totalNeto, 
        totalValidado, hl.modificado as fecha_status_11,
        CONCAT(cl.nombre,' ', cl.apellido_paterno, ' ', cl.apellido_materno) as nombreCliente
        FROM lotes l
        INNER JOIN clientes cl ON cl.idLote = l.idLote AND l.idCliente = cl.id_cliente AND cl.status = 1
        INNER JOIN condominios c ON c.idCondominio = l.idCondominio
        INNER JOIN residenciales r ON r.idResidencial = c.idResidencial
        INNER JOIN (SELECT idLote, idCliente, MAX(modificado) as modificado FROM historial_lotes WHERE idStatusContratacion = 11 AND idMovimiento = 41 AND status = 1
        GROUP BY idLote, idCliente) hl ON hl.idLote = l.idLote AND hl.idCliente = cl.id_cliente
        WHERE status8Flag = 0 AND validacionEnganche = 'VALIDADO' AND l.status = 1
        ORDER BY l.nombreLote");
        return $query->result_array();
    }

}
