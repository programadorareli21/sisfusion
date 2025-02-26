<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Cobranza_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getInformation($typeTransaction, $beginDate, $endDate, $where) {
        if ($typeTransaction == 1 || $typeTransaction == 3) {  // FIRST LOAD || SEARCH BY DATE RANGE
            $filter = " AND cl.fechaApartado BETWEEN '$beginDate 00:00:00' AND '$endDate 23:59:59'";
            $filterTwo = "";
        } else if($typeTransaction == 2) { // SEARCH BY LOTE
            $filter = "";
            $filterTwo = " AND l.idLote = $where";
        }

        if ($this->session->userdata('id_rol') == 19 || $this->session->userdata('id_rol') == 63) { // SUBDIRECTOR MKTD
            $id_sede = explode(", ", $this->session->userdata('id_sede'));
            $result = "'" . implode("', '", $id_sede) . "'";
        } else { // COBRANZA
            if ($this->session->userdata('id_usuario') == 2042)
                $result = "'2', '3', '4', '6'";
            else if ($this->session->userdata('id_usuario') == 5363)
                $result = "'1', '5', '8', '9'";
        }

        return $this->db->query("SELECT r.nombreResidencial, UPPER(cn.nombre) nombreCondominio, UPPER(l.nombreLote) nombreLote, l.idLote,
        FORMAT(ISNULL(l.totalNeto2, '0.00'), 'C') precioTotalLote, FORMAT(l.total, 'C') total_sindesc, cl.fechaApartado, UPPER(s.nombre) plaza,
        ISNULL(ec.estatus, 0) estatusEvidencia, 
        (CASE l.idStatusContratacion WHEN '1' THEN '01' WHEN '2' THEN '02' WHEN '3' THEN '03' WHEN '4' THEN '04' WHEN '5' THEN '05' WHEN '6' THEN '06' 
		 WHEN '7' THEN '07' WHEN '8' THEN '08' WHEN '9' THEN '09' WHEN '10' THEN '10' WHEN '11' THEN '11' WHEN '12' THEN '12' 
		 WHEN '13' THEN '13' WHEN '14' THEN '14' WHEN '15' THEN '15' END) 
        idStatusContratacion, idStatusLote, pc.bandera estatusComision,
        FORMAT(ISNULL(cm.comision_total, '0.00'), 'C') comisionTotal, 
        FORMAT(ISNULL(pci3.abonoDispersado, '0.00'), 'C') abonoDispersado, 
        FORMAT(ISNULL(pci2.abonoPagado, '0.00'), 'C') abonoPagado, l.registro_comision registroComision, cm.estatus as rec, cl.descuento_mdb,
        REPLACE(oxc.nombre, ' (especificar)', '') lugar_prospeccion
        FROM lotes l
        INNER JOIN condominios cn ON cn.idCondominio = l.idCondominio
        INNER JOIN residenciales r ON r.idResidencial = cn.idResidencial
        LEFT JOIN evidencia_cliente ec ON ec.idLote = l.idLote AND ec.idCliente = l.idCliente
        INNER JOIN clientes cl ON cl.id_cliente = l.idCliente AND cl.status = 1 AND (cl.lugar_prospeccion IN(6,29) OR cl.descuento_mdb = 1 OR (ec.estatus = 3 and cl.lugar_prospeccion not IN(6,29)) ) $filter
        INNER JOIN prospectos pr ON pr.id_prospecto = cl.id_prospecto AND pr.fecha_creacion <= '2022-01-20 00:00:00.000'
        INNER JOIN usuarios u ON u.id_usuario = cl.id_asesor AND u.id_sede IN ($result) 
        --INNER JOIN sedes s ON CAST(s.id_sede AS VARCHAR(15)) = CAST(u.id_sede AS VARCHAR(15))
        INNER JOIN sedes s ON s.id_sede = (CASE WHEN l.ubicacion_dos != 0 THEN l.ubicacion_dos WHEN l.ubicacion != 0 and l.ubicacion_dos = 0 THEN l.ubicacion WHEN u.id_sede != 0 and l.ubicacion_dos = 0 and l.ubicacion  = 0 THEN u.id_sede END)
        LEFT JOIN comisiones cm ON cm.id_lote = l.idLote AND cm.rol_generado = 38
        LEFT JOIN pago_comision pc ON pc.id_lote = l.idLote    
        LEFT JOIN (SELECT SUM(abono_neodata) abonoPagado, id_comision FROM pago_comision_ind WHERE estatus IN (11) GROUP BY id_comision) pci2 ON cm.id_comision = pci2.id_comision
        LEFT JOIN (SELECT SUM(abono_neodata) abonoDispersado, id_comision FROM pago_comision_ind GROUP BY id_comision) pci3 ON cm.id_comision = pci3.id_comision
        LEFT JOIN opcs_x_cats oxc ON oxc.id_opcion = cl.lugar_prospeccion AND oxc.id_catalogo = 9
        WHERE l.status = 1 $filterTwo
        UNION ALL
        SELECT r.nombreResidencial, UPPER(cn.nombre) nombreCondominio, UPPER(l.nombreLote) nombreLote, l.idLote,
        FORMAT(ISNULL(l.totalNeto2, '0.00'), 'C') precioTotalLote, FORMAT(l.total, 'C') total_sindesc, cl.fechaApartado, UPPER(s.nombre) plaza,
        ISNULL(ec.estatus, 0) estatusEvidencia, 
        (CASE l.idStatusContratacion WHEN '1' THEN '01' WHEN '2' THEN '02' WHEN '3' THEN '03' WHEN '4' THEN '04' WHEN '5' THEN '05' WHEN '6' THEN '06' 
		 WHEN '7' THEN '07' WHEN '8' THEN '08' WHEN '9' THEN '09' WHEN '10' THEN '10' WHEN '11' THEN '11' WHEN '12' THEN '12' 
		 WHEN '13' THEN '13' WHEN '14' THEN '14' WHEN '15' THEN '15' END) 
        idStatusContratacion, idStatusLote, pc.bandera estatusComision,
        FORMAT(ISNULL(cm.comision_total, '0.00'), 'C') comisionTotal, 
        FORMAT(ISNULL(pci3.abonoDispersado, '0.00'), 'C') abonoDispersado, 
        FORMAT(ISNULL(pci2.abonoPagado, '0.00'), 'C') abonoPagado, l.registro_comision registroComision, cm.estatus as rec, cl.descuento_mdb,
        REPLACE(oxc.nombre, ' (especificar)', '') lugar_prospeccion
        FROM lotes l
        INNER JOIN condominios cn ON cn.idCondominio = l.idCondominio
        INNER JOIN residenciales r ON r.idResidencial = cn.idResidencial
        INNER JOIN evidencia_cliente ec ON ec.idLote = l.idLote AND ec.idCliente = l.idCliente AND ec.estatus = 3
        INNER JOIN controversias co ON co.id_lote = ec.idLote AND co.id_cliente = ec.idCliente AND co.estatus = 1
        INNER JOIN clientes cl ON cl.id_cliente = l.idCliente AND cl.status = 1 AND (cl.descuento_mdb = 0 OR cl.descuento_mdb IS NULL) $filter
        INNER JOIN prospectos pr ON pr.id_prospecto = cl.id_prospecto AND pr.fecha_creacion > '2022-01-20 00:00:00.000'
        INNER JOIN usuarios u ON u.id_usuario = cl.id_asesor AND u.id_sede IN ($result) 
        --INNER JOIN sedes s ON CAST(s.id_sede AS VARCHAR(15)) = CAST(u.id_sede AS VARCHAR(15))
        INNER JOIN sedes s ON s.id_sede = (CASE WHEN l.ubicacion_dos != 0 THEN l.ubicacion_dos WHEN l.ubicacion != 0 and l.ubicacion_dos = 0 THEN l.ubicacion WHEN u.id_sede != 0 and l.ubicacion_dos = 0 and l.ubicacion  = 0 THEN u.id_sede END)
        LEFT JOIN comisiones cm ON cm.id_lote = l.idLote AND cm.rol_generado = 38
        LEFT JOIN pago_comision pc ON pc.id_lote = l.idLote    
        LEFT JOIN (SELECT SUM(abono_neodata) abonoPagado, id_comision FROM pago_comision_ind WHERE estatus IN (11) GROUP BY id_comision) pci2 ON cm.id_comision = pci2.id_comision
        LEFT JOIN (SELECT SUM(abono_neodata) abonoDispersado, id_comision FROM pago_comision_ind GROUP BY id_comision) pci3 ON cm.id_comision = pci3.id_comision
        LEFT JOIN opcs_x_cats oxc ON oxc.id_opcion = cl.lugar_prospeccion AND oxc.id_catalogo = 9
        WHERE l.status = 1 $filterTwo");
    }

    public function updateRecord($table, $data, $key, $value) // MJ: ACTUALIZA LA INFORMACIÓN DE UN REGISTRO EN PARTICULAR, RECIBE 4 PARÁMETROS. TABLA, DATA A ACTUALIZAR, LLAVE (WHERE) Y EL VALOR DE LA LLAVE
    {
        $response = $this->db->update($table, $data, "$key = '$value'");
        if (!$response) {
            return 0; // MJ: SOMETHING HAPPENDS
        } else {
            return 1; // MJ: EVERYTHING RUNS FINE
        }
    }

        /*********************/
    function getClientsByAsesor($asesor){
        return $this->db->query("SELECT c.id_cliente, CONCAT(c.nombre, ' ', c.apellido_paterno, ' ', c.apellido_materno) nombre, c.telefono1, c.correo, l.nombreLote, c.fechaApartado, 
        c.idLote, CONCAT(u.nombre,  ' ', u.apellido_paterno, ' ', u.apellido_materno) gerente, c.lugar_prospeccion, 
        ISNULL (oxc.nombre, 'Sin especificar') nombre_lp, oxc2.id_opcion tipo_controversia
        FROM clientes c
                INNER JOIN lotes l ON l.idLote=c.idLote
                INNER JOIN usuarios u ON u.id_usuario = c.id_gerente
                LEFT JOIN opcs_x_cats oxc ON c.lugar_prospeccion = oxc.id_opcion AND oxc.id_catalogo = 9
                LEFT JOIN controversias con ON con.id_lote = l.idLote AND con.id_cliente = l.idCliente
                LEFT JOIN opcs_x_cats oxc2 ON oxc2.id_opcion = con.tipo AND oxc2.id_catalogo = 58
                LEFT JOIN evidencia_cliente ec ON ec.idLote = l.idLote
                WHERE c.id_asesor = $asesor AND ec.id_evidencia IS NULL AND c.status = 1");
    }
    function getDetails($id, $checks, $beginDate, $endDate, $sede){
        $query["data"] = $this->db->query("SELECT * FROM clientes WHERE id_cliente = $id")->row();

        $name = str_replace(array(' ', '.'),'',$query["data"]->nombre);
        $correo = $query["data"]->correo;
        $telefono = $query["data"]->telefono1;
        $string = "";

        foreach($checks as $check){
            if( $check["value"] == "on" && $check["key"] == 'nombre'){
                $string .= " AND REPLACE(REPLACE(p.nombre, ' ', ''),'.', '') LIKE '%$name%'";
            } else if( $check["value"] == "on" && $check["key"] == 'telefono'){
                $string .= " AND p.telefono LIKE '%$telefono%'";
            } else if( $check["value"] == "on" && $check["key"] == 'correo'){
                $string .= " AND p.correo LIKE '%$correo%'";
            } else if( $check["value"] == "on" && $check["key"] == 'sedes'){
                $string .= " AND p.id_sede =  $sede";
            } else if ( $check["value"] == "on" && $check["key"] == 'date'){
                $string .= " AND p.fecha_creacion BETWEEN '$beginDate 00:00:00' AND '$endDate 23:59:59'";
            }
        }

        $WHERE = substr($string, 4);

        $query2["data"] = $this->db->query("SELECT CONCAT(p.nombre, ' ', p.apellido_paterno, ' ', p.apellido_materno) nombre, oxc.nombre namePros, p.correo, p.telefono, p.fecha_creacion, CONCAT(u.nombre, ' ', u.apellido_paterno, ' ', u.apellido_materno) nombreAsesor, 
        CONCAT(us.nombre, ' ', us.apellido_paterno, ' ', us.apellido_materno) nombreGerente
        FROM prospectos p 
        INNER JOIN usuarios u ON u.id_usuario = p.id_asesor
        INNER JOIN usuarios us ON us.id_usuario = p.id_gerente
        INNER JOIN opcs_x_cats oxc ON oxc.id_opcion = p.lugar_prospeccion WHERE $WHERE AND oxc.id_catalogo = 9");

        return $query2["data"];
    }

    function getAsesores(){
        return $this->db->query("SELECT id_usuario, CONCAT(nombre, ' ', apellido_paterno, ' ', ISNULL(apellido_materno, '')) nombre, id_sede FROM usuarios WHERE 
                                id_rol = 7 AND estatus = 1 ORDER BY nombre");
    }

    function getSedes(){
        return $this->db->query("SELECT * FROM sedes WHERE estatus != 0");
    }
    //Se verifica si el lote ya tiene una controversia
    public function verificarControversia($idLote){
        $query = $this->db->query("SELECT * FROM controversias WHERE id_lote = $idLote");
        return $query->result_array();
    }

    public function insertControversia($data){
        $a = 0;
        $this->db->insert('controversias',$data);
        return $this->db->affected_rows();
    }

    public function insertEvidencia($data)
    {
        $this->db->insert('evidencia_cliente',$data);
        return $this->db->affected_rows();
    }

    public function insertHistorialEvidencia($data)
    {
        $this->db->insert('historial_evidencias',$data);
        return $this->db->affected_rows();
    }

    public function getReporteLiberaciones() {
        return $this->db->query("SELECT lo.idLote, lo.nombreLote, cl.id_cliente, hl.modificado fecha_liberacion, oxc.nombre motivo_liberacion,
        CONCAT(cl.nombre, ' ', cl.apellido_paterno, ' ', cl.apellido_materno) nombre_cliente_old, cl.fechaApartado fechaApartadoOld,
        CASE WHEN oxc2.nombre LIKE '%(especificar)%' THEN ISNULL(CONCAT(REPLACE(oxc2.nombre, ' (especificar)', ''), ' - ', cl.otro_lugar), 'Sin especificar') ELSE ISNULL(REPLACE(oxc2.nombre, ' (especificar)', ''), 'Sin especificar') END lugar_prospeccion_old,
        CONCAT(us.nombre, ' ', us.apellido_paterno, ' ', us.apellido_materno) nombre_asesor_old, ISNULL(se.nombre, se2.nombre) sede_old,
        sc.nombreStatus ultimoEstatusContratacion, sc2.nombreStatus estatusActualContratacion, sl.nombre estatusActualLote,
        CONCAT(cl2.nombre, ' ', cl2.apellido_paterno, ' ', cl2.apellido_materno) nombre_cliente_new, cl2.fechaApartado fechaApartadoNew,
        CASE WHEN oxc3.nombre LIKE '%(especificar)%' THEN ISNULL(CONCAT(REPLACE(oxc3.nombre, ' (especificar)', ''), ' - ', cl2.otro_lugar), 'Sin especificar') ELSE ISNULL(REPLACE(oxc3.nombre, ' (especificar)', ''), 'Sin especificar') END lugar_prospeccion_new,
        CONCAT(us2.nombre, ' ', us2.apellido_paterno, ' ', us2.apellido_materno) nombre_asesor_new, ISNULL(se3.nombre, se4.nombre) sede_new
        FROM lotes lo
        INNER JOIN (SELECT idLote, MAX(modificado) modificado FROM historial_liberacion GROUP BY idLote) hl ON hl.idLote = lo.idLote
        INNER JOIN historial_liberacion hll ON hll.idLote =  hl.idLote AND hll.modificado = hl.modificado
        INNER JOIN opcs_x_cats oxc ON oxc.id_opcion = hll.tipo AND oxc.id_catalogo = 48
        INNER JOIN clientes cl ON cl.idLote = hl.idLote AND cl.status = 0 AND cl.lugar_prospeccion = 6
        INNER JOIN usuarios us ON us.id_usuario = cl.id_asesor
        LEFT JOIN opcs_x_cats oxc2 ON oxc2.id_opcion = cl.lugar_prospeccion AND oxc2.id_catalogo = 9
        LEFT JOIN sedes se ON se.id_sede = cl.id_sede
        LEFT JOIN sedes se2 ON se2.id_sede = us.id_sede
        INNER JOIN (SELECT idLote, idCliente, status, MAX(modificado) modificado FROM historial_lotes GROUP BY idLote, idCliente, status) hlo ON hlo.idLote = hl.idLote AND hlo.idCliente = cl.id_cliente AND hlo.status = 0
        INNER JOIN historial_lotes hlo2 ON hlo2.idLote = hlo.idLote AND hlo2.idCliente = hlo.idCliente AND hlo2.modificado = hlo.modificado
        INNER JOIN statuscontratacion sc ON sc.idStatusContratacion = hlo2.idStatusContratacion
        LEFT JOIN statuscontratacion sc2 ON sc2.idStatusContratacion = lo.idStatusContratacion
        INNER JOIN statuslote sl ON sl.idStatusLote = lo.idStatusLote
        LEFT JOIN clientes cl2 ON cl2.id_cliente = lo.idCliente
        LEFT JOIN opcs_x_cats oxc3 ON oxc3.id_opcion = cl2.lugar_prospeccion AND oxc3.id_catalogo = 9
        LEFT JOIN usuarios us2 ON us2.id_usuario = cl2.id_asesor
        LEFT JOIN sedes se3 ON se3.id_sede = cl2.id_sede
        LEFT JOIN sedes se4 ON se4.id_sede = us2.id_sede
        WHERE lo.status = 1 AND cl2.lugar_prospeccion NOT IN (6, 29) --AND lo.idLote IN (65874)");
    }

}
