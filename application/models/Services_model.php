<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Services_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getNacionalidades()
    {
        $FormasPago =  $this->db->query("SELECT id_opcion as id_forma_pago,nombre as forma_pago FROM opcs_x_cats WHERE id_catalogo=16")->result_array();
       $ArrayMex = $FormasPago;
       $contadorMex=0;
       $contadorExt=0;
        unset($ArrayMex[4]);
        $ArrayExt =  array_pop($FormasPago);
        $arr = array();
        $arr[0] = $ArrayExt;

        $Nacionalidades =  $this->db->query("SELECT id_opcion as id_nacionalidad,nombre as nacionalidad,
        CASE WHEN id_opcion=0 THEN 0 ELSE 1 END as tipo_contrato
         FROM opcs_x_cats WHERE id_catalogo=11 and id_opcion in(0,1,14,17,20)")->result_array();
        for ($m=0; $m <count($Nacionalidades) ; $m++) { 
                if($m == 0){
                    $Nacionalidades[$m]['tipo_pago'] = $ArrayMex;
                }else{
                    $Nacionalidades[$m]['tipo_pago'] = $arr;
                } 
        }
        return $Nacionalidades;
    }



     function saveUserCH($data) {
        if ($data != '' && $data != null) {
            $this->db->db_debug = false;
            $response = $this->db->insert("usuarios", $data);
            $id = $this->db->insert_id();
            if (!$response) {  
            $error = $this->db->error();
            $datos = explode('.',$error['message']);
            if($error['code'] == "23000/2627"){
                $message = "El nombre de usuario ya se encuentra registrado";
            }else{
                echo $error;

            }
            return $finalAnswer = array("result" => false,
                                        "code" => $error['code'],
                                        "message" => $message);
            } else {
                return $finalAnswer = array("result" => true,
                "id_usuario" => $id);
            } 


        } else {
            return 0;
        }
    }
     function getLider($id_lider,$id_rol)
	{

        if($id_rol == 7){
            //Asesor
            $query = $this->db->query("SELECT u.id_lider as id_gerente,u.subdirector_id as id_subdirector,regional_id as id_regional
            FROM usuarios u
            WHERE u.id_usuario=$id_lider");
            return $query->result_array();
        }else if($id_rol == 9){
            //Coordinador
            $query = $this->db->query("SELECT u.id_lider as id_subdirector, u.regional_id as regional_id
            FROM usuarios u
            WHERE u.id_usuario=$id_lider");
            return $query->result_array();
        }else if($id_rol == 3){
            //Gerente
            $query = $this->db->query("SELECT u.regional_id as id_regional
            FROM usuarios u
            WHERE u.id_usuario=$id_lider");
            return $query->result_array();
        }
	}

    function getRFC($rfc){
        $query = $this->db->query("select * from usuarios where rfc='$rfc'");
        return $query->result_array();
    }

}
