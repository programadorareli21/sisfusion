<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Comisiones extends CI_Controller
{
  private $gph;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Comisiones_model');
    $this->load->model('asesor/Asesor_model');
    $this->load->model('Usuarios_modelo');
    $this->load->model('PagoInvoice_model');
    $this->load->model('General_model');
    $this->load->library(array('session', 'form_validation', 'get_menu', 'Jwt_actions'));
    $this->load->helper(array('url', 'form'));
    $this->load->database('default');
    $this->jwt_actions->authorize('7396', $_SERVER['HTTP_HOST']);
    $this->validateSession();
   }

  public function index()
  {
    redirect(base_url());
  }

  public function validateSession() {
        if ($this->session->userdata('id_usuario') == "" || $this->session->userdata('id_rol') == "")
            redirect(base_url() . "index.php/login");
  }
   public function lista_usuarios($rol,$forma_pago)
    {
      echo json_encode($this->Comisiones_model->get_lista_usuarios($rol,$forma_pago)->result_array());
    }
    public function descuentosCapitalHumano()
    {
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/add_descuento", $datos);
    }

public function getPuestosDescuentos(){
  echo json_encode($this->Comisiones_model->getPuestosDescuentos()->result_array());
}

  // ------------------------------------------------------PASO 1 CONTRALORIA----------------------------------------
  public function dispersar_pago_neodata()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/dispersar_pago_neodata", $datos);
  }

  public function usuariosIncidencias()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/usuariosIncidencias", $datos);
  }


  public function incidencias()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/IncidenciasByLote", $datos);
  }



  public function getDataDispersionPago($val = '')
  {
    //echo $val;
    $datos = array();
    if(empty($val)){
      $datos = $this->Comisiones_model->getDataDispersionPago();
    }else{
      $datos = $this->Comisiones_model->getDataDispersionPago($val);
    }
    
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }
  public function getDataDispersionPago2()
  {
    $datos = array();
    $datos = $this->Comisiones_model->getDataDispersionPago2();
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }

  

  public function enganche_comision()
  {
    $respuesta = array(FALSE);
    if ($this->input->post("ideLotenganche")) {
      $ideLotep = $this->input->post("ideLotenganche");
      $selectOption = $this->input->post("planSelect");
      $respuesta = $this->Comisiones_model->update_enganche_comision($ideLotep, $selectOption);
    }
    echo json_encode($respuesta);
  }

  public function getPlanesEnganche($idLote)
  {
    echo json_encode($this->Comisiones_model->getPlanesEnganche($idLote)->result_array());
  }


  public function getValNeodata($param)
  {
    echo json_encode($this->Comisiones_model->getValNeodata($param)->result_array());
  }
  // ------------------------------------------------------****************----------------------------------------


  // ------------------------------------------------------PASO 1 CONTRALORIA----------------------------------------
 
  // ------------------------------------------------------****************----------------------------------------


  // ------------------------------------------------------CONFIRMAR PAGO CONTRALORIA----------------------------------------
  public function confirmar_pago()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/confirmar_pago", $datos);
  }

  public function getDatosConfirmarPago()
  {
    $datos = array();
    $datos = $this->Comisiones_model->getDatosConfirmarPago();
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }


  public function setConfirmarPago()
  {
    $respuesta = array(FALSE);
    if ($this->input->post("idPagoInd")) {
      $idPagoInd = $this->input->post("idPagoInd");
      $respuesta = $this->Comisiones_model->setConfirmarPago($idPagoInd);
    }
    echo json_encode($respuesta);
  }


  // ------------------------------------------------------****************----------------------------------------


    // ------------------------------------------------------CONFIRMAR PAGO CONTRALORIA----------------------------------------
    public function revision_cobranza()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/revision_cobranza_mktd", $datos);
    }
  
 
    public function getDatosNuevasMktd_pre(){
      $dat =  $this->Comisiones_model->getDatosNuevasMktd_pre()->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
  
    
    function aprobar_comision(){
      $id_pago= $_POST['id_pago'];
      $id_comision = $_POST['id_comision'];
      $precio_lote = $_POST['precio_lote'];
      $id_lote = $_POST['id_lote'];
 

      $validar = $this->Comisiones_model->validar_precio_agregado($id_lote);

      if($validar == 1){
        echo json_encode($this->Comisiones_model->aprobar_comision($id_pago, $id_comision, $id_lote, $precio_lote, 1));
      }
      else if($validar == 2){
        echo json_encode($this->Comisiones_model->aprobar_comision($id_pago, $id_comision, $id_lote, $precio_lote, 2));
      }

    }
  
  
    // ------------------------------------------------------****************----------------------------------------


  
    // ------------------------------------------------------LUCERO MARIELA CONTRALORIA----------------------------------------
    public function revision_asimilados()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      // $this->load->view('template/header');
      // $this->load->view("ventas/revision_asimilados", $datos);

      switch($this->session->userdata('id_rol')){
        case '31':
        $this->load->view('template/header');
        $this->load->view("ventas/revision_INTMEXasimilados", $datos);
        break;

        default:
        $this->load->view('template/header');
        $this->load->view("ventas/revision_asimilados", $datos);
        break;
      }

    }
 
    public function getDatosRevisionAsimilados($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatosRevisionAsimilados($proyecto,$condominio)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
    
    public function getReporteEmpresa(){
      echo json_encode($this->Comisiones_model->report_empresa()->result_array());
  }
  
  
    public function revision_factura()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      // $this->load->view('template/header');
      // $this->load->view("ventas/revision_factura", $datos);

      switch($this->session->userdata('id_rol')){
        case '31':
        $this->load->view('template/header');
        $this->load->view("ventas/revision_INTMEXfactura", $datos);
        break;

        default:
        $this->load->view('template/header');
        $this->load->view("ventas/revision_factura", $datos);
        break;
      }

    }
 
    public function getDatosRevisionFactura($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatosRevisionFactura($proyecto,$condominio)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
  
    public function enviadas_internomex()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/enviadas_internomex", $datos);
    }


        public function enviadas_cobranza()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/enviadas_cobranza", $datos);
    }
 

    
    
    public function getDatosEnviadasInternomex($proyecto, $condominio, $formaPago){
      $dat =  $this->Comisiones_model->getDatosEnviadasInternomex($proyecto, $condominio, $formaPago)->result_array();
      for( $i = 0; $i < count($dat); $i++ ){
        $dat[$i]['pa'] = 0;
      }
      echo json_encode( array( "data" => $dat));
    }
    
    
    // ------------------------------------------------------****************----------------------------------------
  

  // ------------------------------------------------------HISTORIAL GENERAL CONTRALORIA----------------------------------------
  public function historial_comisiones()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    // $this->load->view("ventas/historial_contraloria", $datos);

     switch($this->session->userdata('id_rol')){
      case '28':
      case '18':
      $this->load->view('template/header');
      $this->load->view("ventas/historial_Marketing", $datos);
      break;
      default:
      $this->load->view('template/header');
      $this->load->view("ventas/historial_contraloria", $datos);
      break;
    }


  }
  
  public function acepto_internomex_factura(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'CONTRALORÍA ENVÍO PAGO A INTERNOMEX' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_contraloria($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }
 
  public function acepto_contraloria_MKTD(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where estatus = 13");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'CONTRALORÍA ENVÍO PAGO A INTERNOMEX' 
            );
             array_push($data,$row_arr);
          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_contraloria($id_pago_i);
            $up_c = $this->Comisiones_model->update_mktd_contraloria($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $up_c == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }


  public function pago_internomex_MKTD(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where estatus = 8 AND id_usuario = 4394");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'INTERNOMEX APLICO PAGO' 
            );
             array_push($data,$row_arr);
          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_INTMEX($id_pago_i);
            $up_b = $this->Comisiones_model->update_mktd_INTMEX($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }

function enviar_solicitud(){
  $respuesta = array( FALSE );
  if($this->input->post("id_usuario")){
     $respuesta = array( $this->Comisiones_model->update_estatus_facturas( $this->input->post("id_usuario"), $this->input->post("id_residencial")));
  }
  echo json_encode( $respuesta );
}

function despausar_solicitud(){
  $respuesta = array( FALSE );
  // <input type="hidden" name="value_pago" value="2">
  if($this->input->post("value_pago")){
    $validate = $this->input->post("value_pago");

    switch($validate){
      case 1:
        $respuesta = array($this->Comisiones_model->update_estatus_pausa($this->input->post("id_pago_i"), $this->input->post("observaciones"), $this->input->post("estatus") ));
        break;

        case 2:
        $respuesta = array($this->Comisiones_model->update_estatus_despausa($this->input->post("id_pago_i"), $this->input->post("observaciones"), $this->input->post("estatus")));
        break;

        case 3:

        $validate =  $this->db->query("SELECT registro_comision from lotes l where l.idLote in (select c.id_lote from comisiones c WHERE c.id_comision IN (SELECT p.id_comision FROM pago_comision_ind p WHERE p.id_pago_i = ".$this->input->post("id_pago_i")."))");

        // echo $validate->row()->registro_comision.' *COMISION'.$validate->row()->registro_comision;
        if($validate->row()->registro_comision == 7){
          $respuesta = FALSE;
           // echo 'no entra';
        }else{
          // echo 'si entra';
         $respuesta = array($this->Comisiones_model->update_estatus_edit($this->input->post("id_pago_i"), $this->input->post("observaciones")));
       }
        break;
    }  
  }
  echo json_encode( $respuesta );
}


function borrar_factura(){
  $respuesta = array( FALSE );
  if($this->input->post("delete_fact")){
     $respuesta = array( $this->Comisiones_model->borrar_factura( $this->input->post("delete_fact")));
  }
  echo json_encode( $respuesta );
}

function refresh_solicitud(){
  $respuesta = array( FALSE );
  if($this->input->post("id_pago_i")){
     $respuesta = array( $this->Comisiones_model->update_estatus_refresh( $this->input->post("id_pago_i")));
  }
  echo json_encode( $respuesta );
}

function update_estatus(){
  $respuesta = array( FALSE );
  if($this->input->post("motivo_change")){
    $desc_01 = $this->input->post("motivo_change");
    $select_01 = $this->input->post("RegresoSelect");
    $pago_01 = $this->input->post("PagoRechazo");
     $respuesta = array( $this->Comisiones_model->update_estatus_coorporativa($desc_01 , $select_01 , $pago_01 ));
  }
  echo json_encode( $respuesta );
}

  // ------------------------------------------------------****************----------------------------------------


  // ------------------------------------------------------ABONO TEMPORAL CONTRALORIA----------------------------------------
  public function dispersion_com_contraloria()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/dispersion_contraloria", $datos);
  }
  // ------------------------------------------------------****************----------------------------------------


  // ------------------------------------------------------SOLICITUDES ASESOR ----------------------------------------
  public function comisiones_colaborador()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();

    $datos["opn_cumplimiento"] = $this->Usuarios_modelo->Opn_cumplimiento($this->session->userdata('id_usuario'))->result_array();


    switch($this->session->userdata('id_rol')){
      case '1':
      $this->load->view('template/header');
      $this->load->view("ventas/comisiones_colaboradorRigel", $datos);
      break;
      case '2':
      $this->load->view('template/header');
      $this->load->view("ventas/comisiones_colaboradorRigel", $datos);
      break;
      default:
      $this->load->view('template/header');
      $this->load->view("ventas/comisiones_colaborador", $datos);
      break;
    }
  }


  public function getDatosComisionesRigel($proyecto,$condominio,$estado)
  {
    $dat =  $this->Comisiones_model->getDatosComisionesRigel($proyecto,$condominio,$estado)->result_array();
    echo json_encode(array("data" => $dat));
  }

  public function asesores_baja()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/comisiones_colaborador_externo", $datos);
  }

  public function getDatosFactura($uuid, $id_res){
    if($uuid){
         $consulta_sol = $this->Comisiones_model->factura_comision($uuid, $id_res)->row();
         if (!empty($consulta_sol)) {
            $datos['datos_solicitud'] = $this->Comisiones_model->factura_comision($uuid, $id_res)->row(); 
        }
        else {
            $datos['datos_solicitud'] = array('0', FALSE);
        } 
    }
    else{
        $datos['datos_solicitud'] = array('0', FALSE);
    }
    echo json_encode( $datos );
  }

  public function getDatosComisionesAsesor($a)
  {
    $dat =  $this->Comisiones_model->getDatosComisionesAsesor($a)->result_array();
    for ($i = 0; $i < count($dat); $i++) {
      $dat[$i]['pa'] = 0;
    }
    echo json_encode(array("data" => $dat));
  }

  public function getDatosComisionesAsesorBaja($a)
  {
    $dat =  $this->Comisiones_model->getDatosComisionesAsesorBaja($a)->result_array();
    for ($i = 0; $i < count($dat); $i++) {
      $dat[$i]['pa'] = 0;
    }
    echo json_encode(array("data" => $dat));
  }

  public function getDatosComisionesHistorial()
  {
    $dat =  $this->Comisiones_model->getDatosComisionesHistorial()->result_array();
    echo json_encode(array("data" => $dat));
  }

  public function acepto_comisiones_user(){
    $this->load->model("Comisiones_model");
    $id_user_Vl = $this->session->userdata('id_usuario');
    $formaPagoUsuario = $this->session->userdata('forma_pago');
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
    $opinionCumplimiento = $this->Comisiones_model->findOpinionActiveByIdUsuario($id_user_Vl);
   
      if( $consulta_comisiones->num_rows() > 0 ){

        $validar_sede = $this->session->userdata('id_sede');
        date_default_timezone_set('America/Mexico_City');       
        $fecha_actual = strtotime(date("d-m-Y H:i:00"));
          //fecha inicio
          $fecha_entrada10 = strtotime("10-10-2022 00:00:00");
          $fecha_entrada11 = strtotime("07-11-2022 00:00:00");
          $fecha_entrada12 = strtotime("12-12-2022 00:00:00");
          //fecha fin
          
          if($validar_sede == 8){
            $fecha_entrada100 = strtotime("11-10-2022 15:59:00");
            $fecha_entrada111 = strtotime("08-11-2022 15:59:00");
            $fecha_entrada122 = strtotime("13-12-2022 15:59:00");
          }else{

            $fecha_entrada99 = strtotime("13-09-2022 13:59:00");
            $fecha_entrada100 = strtotime("11-10-2022 13:59:00");
            $fecha_entrada111 = strtotime("08-11-2022 13:59:00");
            $fecha_entrada122 = strtotime("13-12-2022 13:59:00");
    
          }
          //$resultado = array("resultado" => 3);
          if( 
            ($fecha_actual >= $fecha_entrada10 && $fecha_actual <=$fecha_entrada100) ||
            ($fecha_actual >= $fecha_entrada11 && $fecha_actual <=$fecha_entrada111) ||
            ($fecha_actual >= $fecha_entrada12 && $fecha_actual <=$fecha_entrada122))
            {
                        $consulta_comisiones = $consulta_comisiones->result_array();
                  
                        $sep = ',';
                        $id_pago_i = '';
              
                        $data=array();
                        $pagoInvoice = array();
              
                        foreach ($consulta_comisiones as $row) {
                          $id_pago_i .= implode($sep, $row);
                          $id_pago_i .= $sep;
              
                          $row_arr=array(
                            'id_pago_i' => $row['id_pago_i'],
                            'id_usuario' =>  $id_user_Vl,
                            'fecha_movimiento' => date('Y-m-d H:i:s'),
                            'estatus' => 1,
                            'comentario' =>  'COLABORADOR ENVÍO A CONTRALORÍA' 
                          );
                          array_push($data,$row_arr);
              
                          if ($formaPagoUsuario == 5) { // Pago extranjero
                              $pagoInvoice[] = array(
                                  'id_pago_i' => $row['id_pago_i'],
                                  'nombre_archivo' => $opinionCumplimiento->archivo_name,
                                  'estatus' => 1,
                                  'modificado_por' => $id_user_Vl,
                                  'fecha_registro' => date('Y-m-d H:i:s')
                              );
                          }
                        }
                        $id_pago_i = rtrim($id_pago_i, $sep);
                    
                          $up_b = $this->Comisiones_model->update_acepta_solicitante($id_pago_i);
                          $ins_b = $this->Comisiones_model->insert_phc($data);
                          $this->Comisiones_model->changeEstatusOpinion($id_user_Vl);
                          if ($formaPagoUsuario == 5) {
                              $this->PagoInvoice_model->insertMany($pagoInvoice);
                          }
                    
                    if($up_b == true && $ins_b == true){
                      $data_response = 1;
                      echo json_encode($data_response);
                    } else {
                      $data_response = 0;
                      echo json_encode($data_response);
                    } 

            }else{
              $data_response = 2;
              echo json_encode($data_response);
            }
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  } 
 
  public function acepto_comisiones_resguardo(){
 
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'ENVÍO A SU RESGUARDO PERSONAL' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_resguardo($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }
  public function acepto_internomex_asimilados(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'CONTRALORÍA ENVÍO PAGO A INTERNOMEX' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_contraloria($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }

  public function acepto_internomex_remanente(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'CONTRALORÍA ENVÍO PAGO A INTERNOMEX' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_contraloria($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }

    public function pago_internomex(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'INTERNOMEX APLICÓ PAGO' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_INTMEX($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }


    public function despausar_historial(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
    $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'CONTRALORÍA REGRESÓ A NUEVAS' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_PAUSADA($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      }
            
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  }

  public function acepto_comisiones_contra(){
    $this->load->model("Comisiones_model");
    $sol=$this->input->post('idcomision');  
     $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
        $id_user_Vl = $this->session->userdata('id_usuario');
        
          $sep = ',';
          $id_pago_i = '';

          $data=array();

          foreach ($consulta_comisiones as $row) {
            $id_pago_i .= implode($sep, $row);
            $id_pago_i .= $sep;

            $row_arr=array(
              'id_pago_i' => $row['id_pago_i'],
              'id_usuario' =>  $id_user_Vl,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'CONTRALORÍA SOLICITO PAGO DE USUARIO BAJA' 
            );
             array_push($data,$row_arr);


          }
          $id_pago_i = rtrim($id_pago_i, $sep);
      
            $up_b = $this->Comisiones_model->update_acepta_solicitante($id_pago_i);
            $ins_b = $this->Comisiones_model->insert_phc($data);
      
      if($up_b == true && $ins_b == true){
        $data_response = 1;
        echo json_encode($data_response);
      } else {
        $data_response = 0;
        echo json_encode($data_response);
      } 
        
      }
      else{
        $data_response = 0;
      echo json_encode($data_response);
      }
  } 

 

  public function acepto_comisiones_usermktd_dos($sol){
    $this->load->model("Comisiones_model");   
     $consulta_comisiones = $this->db->query("SELECT id_pago_mk FROM pago_comision_mktd where id_pago_mk IN (".$sol.")");
   
      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();
  
        $id_user_Vl = $this->session->userdata('id_usuario');
  
    for( $i = 0; $i < count($consulta_comisiones ); $i++){
           $this->Comisiones_model->update_acepta_solicitante_mk($consulta_comisiones[$i]['id_pago_mk']);
  
           $this->db->query("INSERT INTO historial_com_mktd VALUES (".$consulta_comisiones[$i]['id_pago_mk'].", ".$id_user_Vl.", GETDATE(), 1, 'COLABORADOR ENVÍO A CONTRALORÍA')");
           $this->db->query("UPDATE pago_comision_mktd SET fecha_pago_intmex = GETDATE() WHERE id_pago_mk = ".$consulta_comisiones[$i]['id_pago_mk']."");
        }
      }
      else{
        $consulta_comisiones = array();
      }
  } 
  
  public function getDesarrolloSelect($a = ''){

    $validar_user = $this->session->userdata('id_usuario');
    $validar_sede = $this->session->userdata('id_sede');
    date_default_timezone_set('America/Mexico_City');       
    $fecha_actual = strtotime(date("d-m-Y H:i:00"));
      //fecha inicio
      $fecha_entrada2 = strtotime("01-02-2022 00:00:00");
      $fecha_entrada3 = strtotime("07-03-2022 00:00:00");
      $fecha_entrada4 = strtotime("11-04-2022 00:00:00");
      $fecha_entrada5 = strtotime("09-05-2022 00:00:00");
      $fecha_entrada6 = strtotime("13-06-2022 00:00:00");
      $fecha_entrada7 = strtotime("11-07-2022 00:00:00");
      $fecha_entrada8 = strtotime("08-08-2022 00:00:00");
      $fecha_entrada9 = strtotime("12-09-2022 00:00:00");
      $fecha_entrada10 = strtotime("10-10-2022 00:00:00");
      $fecha_entrada11 = strtotime("07-11-2022 00:00:00");
      $fecha_entrada12 = strtotime("12-12-2022 00:00:00");
      //fecha fin
      
      if($validar_sede == 8){
        $fecha_entrada22 = strtotime("08-02-2022 15:59:00");
        $fecha_entrada33 = strtotime("08-03-2022 15:59:00");
        $fecha_entrada44 = strtotime("12-04-2022 15:59:00");
        $fecha_entrada55 = strtotime("10-05-2022 15:59:00");
        $fecha_entrada66 = strtotime("14-06-2022 15:59:00");
        $fecha_entrada77 = strtotime("12-07-2022 15:59:00");
        $fecha_entrada88 = strtotime("09-08-2022 15:59:00");
        $fecha_entrada99 = strtotime("13-09-2022 15:59:00");
        $fecha_entrada100 = strtotime("11-10-2022 15:59:00");
        $fecha_entrada111 = strtotime("08-11-2022 15:59:00");
        $fecha_entrada122 = strtotime("13-12-2022 15:59:00");
      }else{
        $fecha_entrada22 = strtotime("08-02-2022 13:59:00");
        $fecha_entrada33 = strtotime("08-03-2022 13:59:00");
        $fecha_entrada44 = strtotime("12-04-2022 13:59:00");
        $fecha_entrada55 = strtotime("10-05-2022 13:59:00");
        $fecha_entrada66 = strtotime("14-06-2022 13:59:00");
        $fecha_entrada77 = strtotime("12-07-2022 13:59:00");
        $fecha_entrada88 = strtotime("09-08-2022 13:59:00");
        $fecha_entrada99 = strtotime("13-09-2022 13:59:00");
        $fecha_entrada100 = strtotime("11-10-2022 13:59:00");
        $fecha_entrada111 = strtotime("08-11-2022 13:59:00");
        $fecha_entrada122 = strtotime("13-12-2022 13:59:00");

      }
      //$resultado = array("resultado" => 3);
      if(($fecha_actual >= $fecha_entrada2 && $fecha_actual <= $fecha_entrada22) ||
        ($fecha_actual >= $fecha_entrada3 && $fecha_actual <= $fecha_entrada33) ||
        ($fecha_actual >= $fecha_entrada4 && $fecha_actual <= $fecha_entrada44) || 
        ($fecha_actual >= $fecha_entrada5 && $fecha_actual <= $fecha_entrada55) ||
        ($fecha_actual >= $fecha_entrada6 && $fecha_actual <= $fecha_entrada66) ||
        ($fecha_actual >= $fecha_entrada7 && $fecha_actual <= $fecha_entrada77) ||
        ($fecha_actual >= $fecha_entrada8 && $fecha_actual <= $fecha_entrada88) ||
        ($fecha_actual >= $fecha_entrada9 && $fecha_actual <= $fecha_entrada99) || 
        ($fecha_actual >= $fecha_entrada10 && $fecha_actual <=$fecha_entrada100) ||
        ($fecha_actual >= $fecha_entrada11 && $fecha_actual <=$fecha_entrada111) ||
        ($fecha_actual >= $fecha_entrada12 && $fecha_actual <=$fecha_entrada122)){
      


    if($a == ''){
      echo json_encode($this->Comisiones_model->getDesarrolloSelect()->result_array());

    }else{
      echo json_encode($this->Comisiones_model->getDesarrolloSelect($a)->result_array());

    }
  }else{
    echo json_encode(3);
  }
  }

  function getDatosProyecto($idlote,$id_usuario = ''){
    if($id_usuario == ''){
      echo json_encode($this->Comisiones_model->getDatosProyecto($idlote)->result_array());

    }else{
      echo json_encode($this->Comisiones_model->getDatosProyecto($idlote,$id_usuario)->result_array());

    }
  }


  public function historial_colaborador()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
      $this->load->view("ventas/historial_contraloria", $datos);    
  }


    public function historial_baja()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/historial_comisiones_Baja", $datos);
  }


  public function getDatosComisionesHistorialRigel($proyecto,$condominio)
  {
    $dat =  $this->Comisiones_model->getDatosComisionesHistorialRigel($proyecto,$condominio)->result_array();
    echo json_encode(array("data" => $dat));
  }

  public function getDatosComisionesHistorialBaja($proyecto,$condominio)
  {
    $dat =  $this->Comisiones_model->getDatosComisionesHistorialBaja($proyecto,$condominio)->result_array();
    echo json_encode(array("data" => $dat));
  }
  public function GetDescripcionXML($xml){
    error_reporting(0);

    $xml=simplexml_load_file("".base_url()."UPLOADS/XMLS/".$xml."") or die("Error: Cannot create object");

    $cuantos = count($xml-> xpath('//cfdi:Concepto'));
    $UUID = $xml->xpath('//@UUID')[0];
    $fecha = $xml -> xpath('//cfdi:Comprobante')[0]['Fecha'];
    $folio = $xml -> xpath('//cfdi:Comprobante')[0]['Folio'];
    if($folio[0] == null){
      $folio = '*';
    }
    $total = $xml -> xpath('//cfdi:Comprobante')[0]['Total'];
    $cadena = '';
    for($i=0;$i< $cuantos; $i++ ){
      $cadena = $cadena .' '. $xml -> xpath('//cfdi:Concepto')[$i]['Descripcion']; 
    }
    $arr[0]= $UUID[0];
    $arr[1]=  $fecha[0];
    $arr[2]=  $folio[0];
    $arr[3]=  $total;
    $arr[4]=  $cadena;
    echo json_encode($arr);
  }

  
// public function cargaxml2($id_user = ''){

//   $user =   $usuarioid =$this->session->userdata('id_usuario');
//   $this->load->model('Usuarios_modelo');

//   if(empty($id_user)){
//     $RFC = $this->Usuarios_modelo->getPersonalInformation()->result_array();

//   }else{
//     $RFC = $this->Usuarios_modelo->getPersonalInformation2($id_user)->result_array();

//   }

 
// $respuesta = array( "respuesta" => array( FALSE, "HA OCURRIDO UN ERROR") );
// if( isset( $_FILES ) && !empty($_FILES) ){
//     $config['upload_path'] = './UPLOADS/XMLS/';
//     $config['allowed_types'] = 'xml';
//     //CARGAMOS LA LIBRERIA CON LAS CONFIGURACIONES PREVIAS -----$this->upload->display_errors()
//     $this->load->library('upload', $config);
//     if( $this->upload->do_upload("xmlfile") ){
//         $xml_subido = $this->upload->data()['full_path'];
//         $datos_xml = $this->Comisiones_model->leerxml( $xml_subido, TRUE );
//         if( $datos_xml['version'] >= 3.3){
//           $responsable_factura = $this->Comisiones_model->verificar_uuid( $datos_xml['uuidV'] );
//           if($responsable_factura->num_rows()>=1){
//             $respuesta['respuesta'] = array( FALSE, "ESTA FACTURA YA SE SUBIÓ ANTERIORMENTE AL SISTEMA");
//           }
//           else{          
//             if($datos_xml['claveProdServ'][0]=='80131600' || ($user == 6578 && $datos_xml['claveProdServ'][0]=='83121703')){//VALIDAR UNIDAD
//               $diasxmes = date('t');
//                $fecha1 = date('Y-m-').'0'.(($diasxmes - $diasxmes) +1);
//                $fecha2 = date('Y-m-').$diasxmes;
//               if($datos_xml['fecha'][0] >= $fecha1 && $datos_xml['fecha'][0] <= $fecha2){

//             if($datos_xml['rfcemisor'][0] == $RFC[0]['rfc']){
//             if($datos_xml['regimenFiscal'][0]=='612' || ($user == 6578 && $datos_xml['regimenFiscal'][0]=='601')){//VALIDAR REGIMEN FISCAL
//             if($datos_xml['formaPago'][0]=='03' || $datos_xml['formaPago'][0]=='003'){//VALIDAR FORMA DE PAGO Transferencia electrónica de fondos
//             if($datos_xml['usocfdi'][0]=='G03'){//VALIDAR USO DEL CFDI
//             if($datos_xml['metodoPago'][0]=='PUE'){//VALIDAR METODO DE PAGO
//             if($datos_xml['claveUnidad'][0]=='E48'){//VALIDAR UNIDAD
//               $respuesta['respuesta'] = array( TRUE );
//               $respuesta['datos_xml'] = $datos_xml;
//             }else{
//               $respuesta['respuesta'] = array( FALSE, "LA UNIDAD NO ES 'E48 (UNIDAD DE SERVICIO)', VERIFIQUE SU FACTURA.");
//             }//FINAL DE UNIDAD
//             }else{
//               $respuesta['respuesta'] = array( FALSE, "EL METODO DE PAGO NO ES 'PAGO EN UNA SOLA EXHIBICIÓN (PUE)', VERIFIQUE SU FACTURA.");
//             }//FINAL DE METODO DE PAGO
//             }else{
//               $respuesta['respuesta'] = array( FALSE, "EL USO DEL CFDI NO ES 'GASTOS EN GENERAL (G03)', VERIFIQUE SU FACTURA.");
//             }//FINAL DE USO DEL CFDI
//             }else{
//               $respuesta['respuesta'] = array( FALSE, "LA FORMA DE PAGO NO ES 'TRANSFERENCIA ELECTRÓNICA DE FONDOS (03)', VERIFIQUE SU FACTURA.");
//             }//FINAL DE FORMA DE PAGO
//             }else{
//               $respuesta['respuesta'] = array( FALSE, "EL REGIMEN NO ES, 'PERSONAS FÍSICAS CON ACTIVIDADES EMPRESARIALES (612)");
//             }//FINAL DE REGIMEN FISCAL
//             }else{
//             $respuesta['respuesta'] = array( FALSE, "ESTA FACTURA NO CORRESPONDE A TU RFC.");
//             }//FINAL DE RFC VALIDO
//           }else{
//             $respuesta['respuesta'] = array( FALSE, "FECHA INVALIDA, SOLO SE ACEPTAN FACTURAS CON FECHA DE ESTE MES, VERIFICA TU XML");
//           }          
//             }else{
//             $respuesta['respuesta'] = array( FALSE, "LA CLAVE DE TU FACTURA NO CORRESPONDE A 'VENTA DE PROPIEDADES Y EDIFICIOS' (80131600).");
//           }
//         }
//         }else{
//           $respuesta['respuesta'] = array( FALSE, "LA VERSION DE LA FACTURA ES INFERIOR A LA 3.3, SOLICITE UNA REFACTURACIÓN");
//         }
//         unlink( $xml_subido );
//       }
//       else{
//         $respuesta['respuesta'] = array( FALSE, $this->upload->display_errors());
//       }
//     }
//     echo json_encode( $respuesta );
//   }


public function cargaxml2($id_user = ''){

  $user =   $usuarioid =$this->session->userdata('id_usuario');
  $this->load->model('Usuarios_modelo');

  if(empty($id_user)){
    $RFC = $this->Usuarios_modelo->getPersonalInformation()->result_array();

  }else{
    $RFC = $this->Usuarios_modelo->getPersonalInformation2($id_user)->result_array();

  }
 
$respuesta = array( "respuesta" => array( FALSE, "HA OCURRIDO UN ERROR") );
if( isset( $_FILES ) && !empty($_FILES) ){
    $config['upload_path'] = './UPLOADS/XMLS/';
    $config['allowed_types'] = 'xml';
    //CARGAMOS LA LIBRERIA CON LAS CONFIGURACIONES PREVIAS -----$this->upload->display_errors()
    $this->load->library('upload', $config);
    if( $this->upload->do_upload("xmlfile") ){
        $xml_subido = $this->upload->data()['full_path'];
        $datos_xml = $this->Comisiones_model->leerxml( $xml_subido, TRUE );
        if( $datos_xml['version'] >= 3.3){
          $responsable_factura = $this->Comisiones_model->verificar_uuid( $datos_xml['uuidV'] );
          if($responsable_factura->num_rows()>=1){
            $respuesta['respuesta'] = array( FALSE, "ESTA FACTURA YA SE SUBIÓ ANTERIORMENTE AL SISTEMA");
          }
          else{

            if($datos_xml['rfcreceptor'][0]=='ICE211215685'){//VALIDAR UNIDAD
       
            if($datos_xml['claveProdServ'][0]=='80131600' || ($user == 6578 && $datos_xml['claveProdServ'][0]=='83121703')){//VALIDAR UNIDAD
              $diasxmes = date('t');
               $fecha1 = date('Y-m-').'0'.(($diasxmes - $diasxmes) +1);
               $fecha2 = date('Y-m-').$diasxmes;
              if($datos_xml['fecha'][0] >= $fecha1 && $datos_xml['fecha'][0] <= $fecha2){

            if($datos_xml['rfcemisor'][0] == $RFC[0]['rfc']){
            if($datos_xml['regimenFiscal'][0]=='612' || ($user == 6578 && $datos_xml['regimenFiscal'][0]=='601')){//VALIDAR REGIMEN FISCAL
            if($datos_xml['formaPago'][0]=='03' || $datos_xml['formaPago'][0]=='003'){//VALIDAR FORMA DE PAGO Transferencia electrónica de fondos
            if($datos_xml['usocfdi'][0]=='G03'){//VALIDAR USO DEL CFDI
            if($datos_xml['metodoPago'][0]=='PUE'){//VALIDAR METODO DE PAGO
            if($datos_xml['claveUnidad'][0]=='E48'){//VALIDAR UNIDAD
              $respuesta['respuesta'] = array( TRUE );
              $respuesta['datos_xml'] = $datos_xml;
            }else{
              $respuesta['respuesta'] = array( FALSE, "LA UNIDAD NO ES 'E48 (UNIDAD DE SERVICIO)', VERIFIQUE SU FACTURA.");
            }//FINAL DE UNIDAD
            }else{
              $respuesta['respuesta'] = array( FALSE, "EL METODO DE PAGO NO ES 'PAGO EN UNA SOLA EXHIBICIÓN (PUE)', VERIFIQUE SU FACTURA.");
            }//FINAL DE METODO DE PAGO
            }else{
              $respuesta['respuesta'] = array( FALSE, "EL USO DEL CFDI NO ES 'GASTOS EN GENERAL (G03)', VERIFIQUE SU FACTURA.");
            }//FINAL DE USO DEL CFDI
            }else{
              $respuesta['respuesta'] = array( FALSE, "LA FORMA DE PAGO NO ES 'TRANSFERENCIA ELECTRÓNICA DE FONDOS (03)', VERIFIQUE SU FACTURA.");
            }//FINAL DE FORMA DE PAGO
            }else{
              $respuesta['respuesta'] = array( FALSE, "EL REGIMEN NO ES, 'PERSONAS FÍSICAS CON ACTIVIDADES EMPRESARIALES (612)");
            }//FINAL DE REGIMEN FISCAL
            }else{
            $respuesta['respuesta'] = array( FALSE, "ESTA FACTURA NO CORRESPONDE A TU RFC.");
            }//FINAL DE RFC VALIDO
          }else{
            $respuesta['respuesta'] = array( FALSE, "FECHA INVALIDA, SOLO SE ACEPTAN FACTURAS CON FECHA DE ESTE MES, VERIFICA TU XML");
          }          
            }else{
            $respuesta['respuesta'] = array( FALSE, "LA CLAVE DE TU FACTURA NO CORRESPONDE A 'VENTA DE PROPIEDADES Y EDIFICIOS' (80131600).");
          }

          }else{
            $respuesta['respuesta'] = array( FALSE, "EL RFC NO CORRESPONDE A INTERNOMEX, DEBE SER ICE211215685");
          }

        }
        }else{
          $respuesta['respuesta'] = array( FALSE, "LA VERSION DE LA FACTURA ES INFERIOR A LA 3.3, SOLICITE UNA REFACTURACIÓN");
        }
        unlink( $xml_subido );
      }
      else{
        $respuesta['respuesta'] = array( FALSE, $this->upload->display_errors());
      }
    }
    echo json_encode( $respuesta );
  }

      public function guardar_solicitud($id_comision){
        $resultado = array("resultado" => TRUE);
        if( (isset($_POST) && !empty($_POST)) || ( isset( $_FILES ) && !empty($_FILES) ) ){
          $this->db->trans_begin();
          $responsable = $this->session->userdata('id_usuario');
          $resultado = TRUE;
          if( isset( $_FILES ) && !empty($_FILES) ){
            $config['upload_path'] = './UPLOADS/XMLS/';
            $config['allowed_types'] = 'xml';
            $this->load->library('upload', $config);
            $resultado = $this->upload->do_upload("xmlfile");
            if( $resultado ){
              $xml_subido = $this->upload->data();
              $datos_xml = $this->Comisiones_model->leerxml( $xml_subido['full_path'], TRUE );
              $nuevo_nombre = date("my")."_";
              $nuevo_nombre .= str_replace( array(",", ".", '"'), "", str_replace( array(" ", "/"), "_", limpiar_dato($datos_xml["nameEmisor"]) ))."_";
              $nuevo_nombre .= date("Hms")."_";
              $nuevo_nombre .= rand(4, 100)."_";
              $nuevo_nombre .= substr($datos_xml["uuidV"], -5).".xml";
              rename( $xml_subido['full_path'], "./UPLOADS/XMLS/".$nuevo_nombre );
              $datos_xml['nombre_xml'] = $nuevo_nombre;
              $id_com = $id_comision;
              $this->Comisiones_model->insertar_factura($id_com, $datos_xml);
            }else{
              $resultado["mensaje"] = $this->upload->display_errors();
            }
          }
          if ( $resultado === FALSE || $this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $resultado = array("resultado" => FALSE);
            }else{
                $this->db->trans_commit();
                $resultado = array("resultado" => TRUE);
            }
        }
        echo json_encode( $resultado );
    }


    public function guardar_solicitud2($usuario = ''){
      $validar_user = $this->session->userdata('id_usuario');
      $validar_sede =   $usuarioid =$this->session->userdata('id_sede');

      date_default_timezone_set('America/Mexico_City');       
      $fecha_actual = strtotime(date("d-m-Y H:i:00"));

      //fecha inicio
     $fecha_entrada2 = strtotime("07-02-2022 00:00:00");
      $fecha_entrada3 = strtotime("07-03-2022 00:00:00");
      $fecha_entrada4 = strtotime("11-04-2022 00:00:00");
      $fecha_entrada5 = strtotime("09-05-2022 00:00:00");
      $fecha_entrada6 = strtotime("13-06-2022 00:00:00");
      $fecha_entrada7 = strtotime("11-07-2022 00:00:00");
      $fecha_entrada8 = strtotime("08-08-2022 00:00:00");
      $fecha_entrada9 = strtotime("12-09-2022 00:00:00");
      $fecha_entrada10 = strtotime("10-10-2022 00:00:00");
      $fecha_entrada11 = strtotime("07-11-2022 00:00:00");
      $fecha_entrada12 = strtotime("12-12-2022 00:00:00");
      //fecha fin
      
      if($validar_sede == 8){
        $fecha_entrada22 = strtotime("08-02-2022 15:59:00");
        $fecha_entrada33 = strtotime("08-03-2022 15:59:00");
        $fecha_entrada44 = strtotime("12-04-2022 15:59:00");
        $fecha_entrada55 = strtotime("10-05-2022 15:59:00");
        $fecha_entrada66 = strtotime("14-06-2022 15:59:00");
        $fecha_entrada77 = strtotime("12-07-2022 15:59:00");
        $fecha_entrada88 = strtotime("09-08-2022 15:59:00");
        $fecha_entrada99 = strtotime("13-09-2022 15:59:00");
        $fecha_entrada100 = strtotime("11-10-2022 15:59:00");
        $fecha_entrada111 = strtotime("08-11-2022 15:59:00");
        $fecha_entrada122 = strtotime("13-12-2022 15:59:00");
      }else{
        $fecha_entrada22 = strtotime("08-02-2022 13:59:00");
        $fecha_entrada33 = strtotime("08-03-2022 13:59:00");
        $fecha_entrada44 = strtotime("12-04-2022 13:59:00");
        $fecha_entrada55 = strtotime("10-05-2022 13:59:00");
        $fecha_entrada66 = strtotime("14-06-2022 13:59:00");
        $fecha_entrada77 = strtotime("12-07-2022 13:59:00");
        $fecha_entrada88 = strtotime("09-08-2022 13:59:00");
        $fecha_entrada99 = strtotime("13-09-2022 13:59:00");
        $fecha_entrada100 = strtotime("11-10-2022 13:59:00");
        $fecha_entrada111 = strtotime("08-11-2022 13:59:00");
        $fecha_entrada122 = strtotime("13-12-2022 13:59:00");

      }


      $resultado = array("resultado" => 3);

      if(($fecha_actual >= $fecha_entrada2 && $fecha_actual <= $fecha_entrada22) ||
        ($fecha_actual >= $fecha_entrada3 && $fecha_actual <= $fecha_entrada33) ||
        ($fecha_actual >= $fecha_entrada4 && $fecha_actual <= $fecha_entrada44) || 
        ($fecha_actual >= $fecha_entrada5 && $fecha_actual <= $fecha_entrada55) ||
        ($fecha_actual >= $fecha_entrada6 && $fecha_actual <= $fecha_entrada66) ||
        ($fecha_actual >= $fecha_entrada7 && $fecha_actual <= $fecha_entrada77) ||
        ($fecha_actual >= $fecha_entrada8 && $fecha_actual <= $fecha_entrada88) ||
        ($fecha_actual >= $fecha_entrada9 && $fecha_actual <= $fecha_entrada99) || 
        ($fecha_actual >= $fecha_entrada10 && $fecha_actual <=$fecha_entrada100) ||
        ($fecha_actual >= $fecha_entrada11 && $fecha_actual <=$fecha_entrada111) ||
        ($fecha_actual >= $fecha_entrada12 && $fecha_actual <=$fecha_entrada122) ){
      
      if($usuario != ''){
        $usuarioid = $usuario;
      }else{
        $usuarioid =$this->session->userdata('id_usuario');
      }
     // $datos = explode(",",$pagos);
     $datos = explode(",",$this->input->post('pagos'));
      $resultado = array("resultado" => TRUE);
      if( (isset($_POST) && !empty($_POST)) || ( isset( $_FILES ) && !empty($_FILES) ) ){
        $this->db->trans_begin();
        $responsable = $this->session->userdata('id_usuario');
        $resultado = TRUE;
        if( isset( $_FILES ) && !empty($_FILES) ){
          $config['upload_path'] = './UPLOADS/XMLS/';
          $config['allowed_types'] = 'xml';
          $this->load->library('upload', $config);
          $resultado = $this->upload->do_upload("xmlfile");
          if( $resultado ){
            $xml_subido = $this->upload->data();
            $datos_xml = $this->Comisiones_model->leerxml( $xml_subido['full_path'], TRUE );

            $total = (float)$this->input->post('total');
            $totalXml = (float)$datos_xml['total'];

            if (($total + .50) >= $totalXml && ($total - .50) <= $totalXml) {
              $nuevo_nombre = date("my")."_";
              $nuevo_nombre .= str_replace( array(",", ".", '"'), "", str_replace( array(" ", "/"), "_", limpiar_dato($datos_xml["nameEmisor"]) ))."_";
              $nuevo_nombre .= date("Hms")."_";
              $nuevo_nombre .= rand(4, 100)."_";
              $nuevo_nombre .= substr($datos_xml["uuidV"], -5).".xml";
              rename( $xml_subido['full_path'], "./UPLOADS/XMLS/".$nuevo_nombre );
              $datos_xml['nombre_xml'] = $nuevo_nombre;
              ini_set('max_execution_time', 0);
              for ($i=0; $i <count($datos) ; $i++) { 
                if(!empty($datos[$i])){
                  $id_com =  $datos[$i];
                  $this->Comisiones_model->insertar_factura($id_com, $datos_xml,$usuarioid);
                  $this->Comisiones_model->update_acepta_solicitante($id_com);
                  $this->db->query("INSERT INTO historial_comisiones VALUES (".$id_com.", ".$this->session->userdata('id_usuario').", GETDATE(), 1, 'COLABORADOR ENVÍO FACTURA A CONTRALORÍA')");
                }
              }
            } else {
              $this->db->trans_rollback();
              echo json_encode(4);
              return;
            }
          }else{
            $resultado["mensaje"] = $this->upload->display_errors();
          }
        }
        if ( $resultado === FALSE || $this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  $resultado = array("resultado" => FALSE);
              }else{
                  $this->db->trans_commit();
                  $resultado = array("resultado" => TRUE);
              }
          }

          $this->Usuarios_modelo->Update_OPN($this->session->userdata('id_usuario'));
          echo json_encode( $resultado );


        }else{
          echo json_encode(3);
        }

      }

      public function getComments($pago){
        echo json_encode($this->Comisiones_model->getComments($pago)->result_array());
    }


    public function getCommentsDU($user){
        echo json_encode($this->Comisiones_model->getCommentsDU($user)->result_array());
    }
    
    public function getDataMarketing($lote, $cliente){
        echo json_encode($this->Comisiones_model->getDataMarketing($lote, $cliente)->result_array());
    }


  // ------------------------------------------------------****************----------------------------------------
  
  
  // ------------------------------------------DISPERSION MARKETING DIGITAL ----------------------------------------
  public function dispersion_mktd()
  {
    $datos=array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace(''.base_url().'', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/comisiones_dispersion_mktd",$datos);
  }

  
  public function getDatosNuevasMktd(){
    $dat =  $this->Comisiones_model->getDatosNuevasMktd()->result_array();
   for( $i = 0; $i < count($dat); $i++ ){
       $dat[$i]['pa'] = 0;
   }
   echo json_encode( array( "data" => $dat));
  }
  
  public function getDatosNuevasMktd2(){
    $dat =  $this->Comisiones_model->getDatosNuevasMktd2()->result_array();
   for( $i = 0; $i < count($dat); $i++ ){
       $dat[$i]['pa'] = 0;
   }
   echo json_encode( array( "data" => $dat));
  }

  public function getDatosPlanesMktd(){
    $dat =  $this->Comisiones_model->getDatosPlanesMktd()->result_array();
    echo json_encode( array( "data" => $dat));
  }

  function getDatosColabMktd($sede, $plan){
    echo json_encode($this->Comisiones_model->getDatosColabMktd($sede, $plan)->result_array());
  }

  function getDatosSumaMktd($sede, $plen, $empresa, $res){
    echo json_encode($this->Comisiones_model->getDatosSumaMktd($sede, $plen, $empresa, $res)->result_array());
  }

    function getDatosSumaMktdComp($sede, $plen, $empresa, $s1, $s2){
    echo json_encode($this->Comisiones_model->getDatosSumaMktdComp($sede, $plen, $empresa, $s1, $s2)->result_array());
  }

  
  function getDatosColabMktd2($sede, $lote){
    echo json_encode($this->Comisiones_model->getDatosColabMktd2($sede, $lote)->result_array());
  }

  function getDatosUsersMktd($val){
    echo json_encode($this->Comisiones_model->getDatosUsersMktd($val)->result_array());
  }

  public function nueva_mktd_comision(){

    $respuesta = "";

    $valores_pagos =  $this->input->post("valores_pago_i");
    $values_send = $valores_pagos;
    $num_plan =  $this->input->post("num_plan");
    $array_up = explode(",", $valores_pagos);

      $abono_mktd = $this->input->post("abono_mktd[]");
      $pago_mktd = $this->input->post("pago_mktd");
      $empresa = $this->input->post("empresa");
      $id_usuario = $this->input->post("user_mktd[]");
   
    for($i=0;$i<sizeof($abono_mktd);$i++){
      if($abono_mktd[$i] > 0){
      $respuesta =  $this->Comisiones_model->nueva_mktd_comision($values_send,$id_usuario[$i],$abono_mktd[$i],$pago_mktd,$this->session->userdata('id_usuario'), $num_plan,$empresa);
      }
    }

     for($i=0;$i<sizeof($array_up);$i++){
      $respuesta =  $this->Comisiones_model->updatePagoInd($array_up[$i]);
      // echo $array_up[$i];
     }
    

     
  echo json_encode($respuesta);
  }
  
  // ------------------------------------------------------****************----------------------------------------

// ------------------------------------------DISPERSION MARKETING DIGITAL ----------------------------------------
public function dispersion_club()
{
  $datos=array();
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $salida = str_replace(''.base_url().'', '', $val);
  $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
  $this->load->view('template/header');
  $this->load->view("ventas/comisiones_dispersion_club",$datos);
}


public function getDatosNuevasSNL(){
  $dat =  $this->Comisiones_model->getDatosNuevasSNL()->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}
public function getDatosNuevasQro(){
  $dat =  $this->Comisiones_model->getDatosNuevasQro()->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

public function getDatosNuevasPen(){
  $dat =  $this->Comisiones_model->getDatosNuevasPen()->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

public function getDatosNuevasCDMX(){
  $dat =  $this->Comisiones_model->getDatosNuevasCDMX()->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}
public function getDatosNuevasLeon(){
  $dat =  $this->Comisiones_model->getDatosNuevasLeon()->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}
public function getDatosNuevasCan(){
  $dat =  $this->Comisiones_model->getDatosNuevasCan()->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

public function getDatosPlanesClub(){
  $dat =  $this->Comisiones_model->getDatosPlanesClub()->result_array();
  echo json_encode( array( "data" => $dat));
}

function getDatosUsersClub($val){
  echo json_encode($this->Comisiones_model->getDatosUsersClub($val)->result_array());
}

function getDatosColabClub($sede, $lote){
  
  echo json_encode($this->Comisiones_model->getDatosColabClub($sede, $lote)->result_array());
}


public function nueva_club_comision(){
  $respuesta = "";
  /*------USUARIO PARA BONOS---------------------*/
  $userclub = $this->input->post("userclub");
  $abono_clubEje = $this->input->post("abono_clubEje");

   $userClubCoA = $this->input->post("userCoA");
 $abonoClubCoA = $this->input->post("abono_clubCoA");

  $pago_id = $this->input->post("pago_id");
  $com_value = $this->input->post("com_value");
  $abono_mktd = $this->input->post("abono_mktd[]");
  $pago_club = $this->input->post("pago_club");
  $id_usuario = $this->input->post("user_mktd[]");
  $respuesta =  $this->Comisiones_model->nueva_club_comision($com_value,$userClubCoA,$abonoClubCoA,$pago_club,$this->session->userdata('id_usuario'));

  $respuesta =  $this->Comisiones_model->nueva_club_comision($com_value,$userclub,$abono_clubEje,$pago_club,$this->session->userdata('id_usuario'));

  for($i=0;$i<sizeof($abono_mktd);$i++){
    $respuesta =  $this->Comisiones_model->nueva_club_comision($com_value,$id_usuario[$i],$abono_mktd[$i],$pago_club,$this->session->userdata('id_usuario'));
  }
  $respuesta =  $this->Comisiones_model->updatePagoInd($pago_id);
echo json_encode($respuesta);
}



public function bonos_club()
{
  $datos=array();
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $salida = str_replace(''.base_url().'', '', $val);
  $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
  $this->load->view('template/header');
  $this->load->view("ventas/bonos_club",$datos);
}

public function getDatosComisionesNuevas_dos_bonos($proyecto, $condominio){
  $dat =  $this->Comisiones_model->getDatosComisionesNuevas_dos_bonos($proyecto, $condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

 
public function getDatosComisionesNuevasNivel2()
{
  $dat =  $this->Comisiones_model->getDatosComisionesNuevasNivel2()->result_array();
  for ($i = 0; $i < count($dat); $i++) {
    $dat[$i]['pa'] = 0;
  }
  echo json_encode(array("data" => $dat));
}

public function getDatosComisionesRecibidasNivel2()
{
  $dat =  $this->Comisiones_model->getDatosComisionesRecibidasNivel2()->result_array();
  for ($i = 0; $i < count($dat); $i++) {
    $dat[$i]['pa'] = 0;
  }
  echo json_encode(array("data" => $dat));
}


public function insertar_gph_maderas_new(){
  $dat =  $this->Comisiones_model->insertar_gph_maderas_new();
 echo json_encode($dat);
}
  // ------------------------------------------------------****************----------------------------------------



// ------------------------------------------ABONO TEMPORAL CONTRALORIA ----------------------------------------
public function getDatosComisionesDispersarContraloria(){
  $dat =  $this->Comisiones_model->getDatosComisionesDispersarContraloria()->result_array();
  echo json_encode( array( "data" => $dat));
}

public function getDirector(){
    echo json_encode($this->Comisiones_model->getDirector()->result_array());
}
public function getsubDirector(){
    echo json_encode($this->Comisiones_model->getsubDirector()->result_array());
}
public function getGerente(){
    echo json_encode($this->Comisiones_model->getGerenteT()->result_array());
}
public function getCoordinador(){
    echo json_encode($this->Comisiones_model->getCoordinador()->result_array());
}
public function getAsesor(){
    echo json_encode($this->Comisiones_model->getAsesor()->result_array());
}
public function getMktd(){
  echo json_encode($this->Comisiones_model->getMktd()->result_array());
}
public function getEjectClub(){
echo json_encode($this->Comisiones_model->getEjectClub()->result_array());
}
public function getSubClub(){
echo json_encode($this->Comisiones_model->getSubClub()->result_array());
}
public function getGreen(){
echo json_encode($this->Comisiones_model->getGreen()->result_array());
}
public function getsubDirector2(){
  echo json_encode($this->Comisiones_model->getsubDirector2()->result_array());
}
public function getGerente2(){
  echo json_encode($this->Comisiones_model->getGerente2T()->result_array());
}
public function getCoordinador2(){
  echo json_encode($this->Comisiones_model->getCoordinador2()->result_array());
}
public function getAsesor2(){
  echo json_encode($this->Comisiones_model->getAsesor2()->result_array());
}
public function getsubDirector3(){
echo json_encode($this->Comisiones_model->getsubDirector3()->result_array());
}
public function getGerente3(){
echo json_encode($this->Comisiones_model->getGerente3T()->result_array());
}
public function getCoordinador3(){
echo json_encode($this->Comisiones_model->getCoordinador3()->result_array());
}
public function getAsesor3(){
echo json_encode($this->Comisiones_model->getAsesor3()->result_array());
}
public function getUserMk(){
echo json_encode($this->Comisiones_model->getUserMk()->result_array());
}
public function getPlazasMk(){
echo json_encode($this->Comisiones_model->getPlazasMk()->result_array());
}
public function getSedeMk(){
echo json_encode($this->Comisiones_model->getSedeMk()->result_array());
}

public function agregar_precioNeto(){

 $respuesta = array( FALSE );
 if($this->input->post("lote")){
  $new_total =  $this->input->post("precio_Neto");
  $new_lote =  $this->input->post("lote");
  $respuesta = array($this->Comisiones_model->update_precio($new_total, $new_lote));
}
echo json_encode( $respuesta );
}

public function agregar_pago(){
  
 $respuesta = array( FALSE );

 if($this->input->post("idComision")){
   
   $comision = $this->input->post("idComision");
   $user = $this->input->post("idUsuario");
   $monto = $this->input->post("montodisponible");

   $respuesta = $this->Comisiones_model->insert_nuevo_pago($comision,$user,$monto);
}
echo json_encode( $respuesta );
}


public function liquidar_comision(){
  
 $respuesta = array( FALSE );
 if($this->input->post("ideLotep")){
   $ideLotep = $this->input->post("ideLotep");
   $estatus = $this->input->post("estatusL");
   if($estatus == 7){
    $estado=7;
    $comentario='SE MARCÓ COMO PAGADO '.$ideLotep;
   }else{
    $comentarioPago = $this->input->post("Motivo");
    $estado=8;
    $comentario='SE PAUSÓ '.$ideLotep;
   }
   $respuesta = $this->Comisiones_model->update_pagada_comision($ideLotep,$estado,$comentario,$comentarioPago);
}
echo json_encode( $respuesta );
}


function getDatosDispersar($idlote){
  echo json_encode($this->Comisiones_model->getDatosDispersar($idlote)->result_array());
}


public function agregar_comision(){

  $replace = ["$", ","];

     $respuesta = array( FALSE );
     if($this->input->post("precioLote")){

      $precioLote = $this->input->post("precioLote");
      $ideLote = $this->input->post("ideLote");
      $directorSelect = $this->input->post("directorSelect");
      $porcentajeDir = $this->input->post("porcentajeDir");
      $abonadoDir = str_replace($replace,"",$this->input->post("abonadoDir"));
      $pendienteDir = str_replace($replace,"",$this->input->post("pendienteDir"));
      $totalDir = str_replace($replace,"",$this->input->post("totalDir"));

      $subdirectorSelect = $this->input->post("subdirectorSelect");
      $porcentajesubDir = $this->input->post("porcentajesubDir");
      $abonadosubDir = str_replace($replace,"",$this->input->post("abonadosubDir"));
      $pendientesubDir = str_replace($replace,"",$this->input->post("pendientesubDir"));
      $totalsubDir = str_replace($replace,"",$this->input->post("totalsubDir"));

      $gerenteSelect = $this->input->post("gerenteSelect");
      $porcentajeGerente = $this->input->post("porcentajeGerente");
      $abonadoGerente = str_replace($replace,"",$this->input->post("abonadoGerente"));
      $pendienteGerente = str_replace($replace,"",$this->input->post("pendienteGerente"));
      $totalGerente = str_replace($replace,"",$this->input->post("totalGerente"));

      $coordinadorSelect = $this->input->post("coordinadorSelect");
      $porcentajeCoordinador = $this->input->post("porcentajeCoordinador");
      
      $asesorSelect = $this->input->post("asesorSelect");
      $porcentajeAsesor = $this->input->post("porcentajeAsesor");
      $abonadoAsesor = str_replace($replace,"",$this->input->post("abonadoAsesor"));
      $pendienteAsesor = str_replace($replace,"",$this->input->post("pendienteAsesor"));
      $totalAsesor = str_replace($replace,"",$this->input->post("totalAsesor"));
      ////////////////////////////////////
      $MKTDSelect = $this->input->post("MKTDSelect");
      $porcentajeMKTD = $this->input->post("porcentajeMKTD");
      $abonadoMKTD = str_replace($replace,"",$this->input->post("abonadoMKTD"));
      $pendienteMKTD = str_replace($replace,"",$this->input->post("pendienteMKTD"));
      $totalMKTD = str_replace($replace,"",$this->input->post("totalMKTD"));

      $SubClubSelect = $this->input->post("SubClubSelect");
      $porcentajeSubClub = $this->input->post("porcentajeSubClub");
      $abonadoSubClub = str_replace($replace,"",$this->input->post("abonadoSubClub"));
      $pendienteSubClub = str_replace($replace,"",$this->input->post("pendienteSubClub"));
      $totalSubClub = str_replace($replace,"",$this->input->post("totalSubClub"));

      $EjectClubSelect = $this->input->post("EjectClubSelect");
      $porcentajeEjectClub = $this->input->post("porcentajeEjectClub");
      $abonadoEjectClub = str_replace($replace,"",$this->input->post("abonadoEjectClub"));
      $pendienteEjectClub = str_replace($replace,"",$this->input->post("pendienteEjectClub"));
      $totalEjectClub = str_replace($replace,"",$this->input->post("totalEjectClub"));

      $GreenSelect = $this->input->post("GreenSelect");
      $porcentajeGreenham = $this->input->post("porcentajeGreenham");
      $abonadoGreenham = str_replace($replace,"",$this->input->post("abonadoGreenham"));
      $pendienteGreenham = str_replace($replace,"",$this->input->post("pendienteGreenham"));
      $totalGreenham = str_replace($replace,"",$this->input->post("totalGreenham"));

      ////////////////////////////////////

      $referencia = $this->input->post("referencia");
      $idDesarrollo = $this->input->post("idDesarrollo");

      if($directorSelect==''||$directorSelect=='undefinded' || $directorSelect ==0 || $directorSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionesDir($ideLote, $directorSelect, $abonadoDir, $totalDir, $porcentajeDir));
      }

      if($subdirectorSelect==''||$subdirectorSelect=='undefinded' || $subdirectorSelect ==0 || $subdirectorSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionessubDir($ideLote, $subdirectorSelect, $abonadosubDir, $totalsubDir, $porcentajesubDir));      
      }

      if($gerenteSelect==''||$gerenteSelect=='undefinded' || $gerenteSelect ==0 || $gerenteSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionesGer($ideLote, $gerenteSelect, $abonadoGerente, $totalGerente, $porcentajeGerente));
      }

      if($coordinadorSelect==''||$coordinadorSelect=='undefinded' || $coordinadorSelect ==0 || $coordinadorSelect==null){
        $abonadoCoordinador = ($this->input->post("abonadoCoordinador")) == '' ? 0:$this->input->post("abonadoCoordinador");
        $pendienteCoordinador = ($this->input->post("pendienteCoordinador")) == '' ? 0:$this->input->post("pendienteCoordinador");
        $totalCoordinador = ($this->input->post("totalCoordinador"))== '' ? 0:$this->input->post("totalCoordinador");
        $respuesta = array( TRUE );
      }
      else{
        $abonadoCoordinador = str_replace($replace,"",$this->input->post("abonadoCoordinador"));
        $pendienteCoordinador = str_replace($replace,"",$this->input->post("pendienteCoordinador"));
        $totalCoordinador = str_replace($replace,"",$this->input->post("totalCoordinador"));
        $respuesta = array($this->Comisiones_model->update_comisionesCoord($ideLote, $coordinadorSelect, $abonadoCoordinador, $totalCoordinador, $porcentajeCoordinador));
      }

      if($asesorSelect==''||$asesorSelect=='undefinded' || $asesorSelect ==0 || $asesorSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionesAse($ideLote, $asesorSelect, $abonadoAsesor, $totalAsesor, $porcentajeAsesor));
      }

///////////////////////////////////////////////////////////////////////////////////////////////////////////777

      if($MKTDSelect==''||$MKTDSelect=='undefinded' || $MKTDSelect ==0 || $MKTDSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisioneMKTD($ideLote, $MKTDSelect, $abonadoMKTD, $totalMKTD, $porcentajeMKTD));
      }
      if($SubClubSelect==''||$SubClubSelect=='undefinded' || $SubClubSelect ==0 || $SubClubSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionesSUBCLUB($ideLote, $SubClubSelect, $abonadoSubClub, $totalSubClub, $porcentajeSubClub));
      }
      if($EjectClubSelect==''||$EjectClubSelect=='undefinded' || $EjectClubSelect ==0 || $EjectClubSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionesEJECTCLUB($ideLote, $EjectClubSelect, $abonadoEjectClub, $totalEjectClub, $porcentajeEjectClub));
      }


      if($GreenSelect==''||$GreenSelect=='undefinded' || $GreenSelect ==0 || $GreenSelect==null){
        $respuesta = array( TRUE );
      }
      else{
        $respuesta = array($this->Comisiones_model->update_comisionesGreenham($ideLote, $GreenSelect, $abonadoGreenham, $totalGreenham, $porcentajeGreenham));
      }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7

      $TOTALCOMISION = ($totalDir+$totalsubDir+$totalGerente+$totalCoordinador+$totalAsesor+$totalMKTD+$totalSubClub+$totalGreenham);
      $ABONOCONTRALORIA = ($abonadoDir+$abonadosubDir+$abonadoGerente+$abonadoCoordinador+$abonadoAsesor+$abonadoMKTD+$abonadoSubClub+$abonadoGreenham);
      $PENDICONTRALORIA = ($TOTALCOMISION-$ABONOCONTRALORIA);
      $PORCETOTAL = ($porcentajeDir+$porcentajesubDir+$porcentajeGerente+$porcentajeCoordinador+$porcentajeAsesor+$porcentajeMKTD+$porcentajeSubClub+$porcentajeEjectClub+$porcentajeGreenham);

      $respuesta = array($this->Comisiones_model->update_pago_comision($ideLote, $TOTALCOMISION, $PORCETOTAL, $ABONOCONTRALORIA, $PENDICONTRALORIA));
      $respuesta = array($this->Comisiones_model->update_lote_registro_comision($ideLote));
  }
  echo json_encode( $respuesta );
}


function getDatosAbonado($idlote){
  echo json_encode($this->Comisiones_model->getDatosAbonado($idlote)->result_array());
}
function getDatosAbonadoDispersion($idlote){
  echo json_encode($this->Comisiones_model->getDatosAbonadoDispersion($idlote)->result_array());
}


function getDatosAbonadoSuma1($idlote){
  echo json_encode($this->Comisiones_model->getDatosAbonadoSuma1($idlote)->result_array());
}
function getDatosAbonadoSuma11($idlote){
  echo json_encode($this->Comisiones_model->getDatosAbonadoSuma11($idlote)->result_array());
}
 





 
public function nuevo_abono_comision(){
  $respuesta = array( FALSE );
  if($this->input->post("ideLote")){
    $ideLote = $this->input->post("ideLote");
    $referencia = $this->input->post("referencia");
    $idDesarrollo = $this->input->post("idDesarrollo");
    $abono_nuevo = $this->input->post("abono_nuevo[]");
    $rol = $this->input->post("rol[]");
    $id_comision = $this->input->post("id_comision[]");
    $suma = 0;
    $replace = [",","$"];
     for($i=0;$i<sizeof($id_comision);$i++){   
       $var_n = str_replace($replace,"",$abono_nuevo[$i]);

       $respuesta = $this->Comisiones_model->insert_pago_individual($id_comision[$i], $rol[$i], $var_n);
      }

    for($i=0;$i<sizeof($abono_nuevo);$i++){
      $var_n = str_replace($replace,"",$abono_nuevo[$i]);

      $suma = $suma + $var_n ;
    }
        // $respuesta = $this->Comisiones_model->update_neodata($referencia, $idDesarrollo, $suma);
    $respuesta = $this->Comisiones_model->update_pago_general($suma, $ideLote);
 }
echo json_encode( $respuesta );
}



public function agregar_comisionvc(){
  $replace = ["$", ","];
  $respuesta = array( FALSE );
  if($this->input->post("precioLote")){
   // echo "si entro";
   $precioLote = $this->input->post("precioLote");
   $ideLote = $this->input->post("ideLote");
  
   $directorSelect = $this->input->post("directorSelect");
   $porcentajeDir = $this->input->post("porcentajeDir");
  
   $subdirectorSelect = $this->input->post("subdirectorSelect");
   $porcentajesubDir = $this->input->post("porcentajesubDir");
  
   $gerenteSelect = $this->input->post("gerenteSelect");
   $porcentajeGerente = $this->input->post("porcentajeGerente");
   
   $coordinadorSelect = $this->input->post("coordinadorSelect");
   $porcentajeCoordinador = $this->input->post("porcentajeCoordinador");
  
   $asesorSelect = $this->input->post("asesorSelect");
   $porcentajeAsesor = $this->input->post("porcentajeAsesor");
    
   ///////////////////////////////////77
  
  
   $subdirectorSelect21 = $this->input->post("subdirectorSelect21");
   $porcentajesubDir21 = $this->input->post("porcentajesubDir21");
   
  
   $gerenteSelect21 = $this->input->post("gerenteSelect21");
   $porcentajeGerente21 = $this->input->post("porcentajeGerente21");
  
  
   $coordinadorSelect21 = $this->input->post("coordinadorSelect21");
   $porcentajeCoordinador21 = $this->input->post("porcentajeCoordinador21");
  
  
   $asesorSelect21 = $this->input->post("asesorSelect21");
   $porcentajeAsesor21 = $this->input->post("porcentajeAsesor21");
  
   ////////////////////////////7
  
  
    $subdirectorSelect31 = $this->input->post("subdirectorSelect31");
   $porcentajesubDir31 = $this->input->post("porcentajesubDir31");
   
  
   $gerenteSelect31 = $this->input->post("gerenteSelect31");
   $porcentajeGerente31 = $this->input->post("porcentajeGerente31");
  
  
   $coordinadorSelect31 = $this->input->post("coordinadorSelect31");
   $porcentajeCoordinador31 = $this->input->post("porcentajeCoordinador31");
  
  
   $asesorSelect31 = $this->input->post("asesorSelect31");
   $porcentajeAsesor31 = $this->input->post("porcentajeAsesor31");
   
  
         ////////////////////////////////////
         $MKTDSelect = $this->input->post("MKTDSelect");
         $porcentajeMKTD = $this->input->post("porcentajeMKTD");
         
   
         $SubClubSelect = $this->input->post("SubClubSelect");
         $porcentajeSubClub = $this->input->post("porcentajeSubClub");
        
   
         $EjectClubSelect = $this->input->post("EjectClubSelect");
         $porcentajeEjectClub = $this->input->post("porcentajeEjectClub");
        

         $GreenSelect = $this->input->post("GreenSelect");
         $porcentajeGreenham = $this->input->post("porcentajeGreenham");
        
  
   $referencia = $this->input->post("referencia");
   $idDesarrollo = $this->input->post("idDesarrollo");
  
  
   if($directorSelect==''||$directorSelect=='undefinded' || $directorSelect ==0 || $directorSelect==null){
    $abonadoDir = $this->input->post("abonadoDir");
    $pendienteDir = $this->input->post("pendienteDir");
    $totalDir = $this->input->post("totalDir");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoDir = str_replace($replace,"",$this->input->post("abonadoDir"));
    $pendienteDir = str_replace($replace,"",$this->input->post("pendienteDir"));
    $totalDir = str_replace($replace,"",$this->input->post("totalDir"));
     $respuesta = array($this->Comisiones_model->update_comisionesDir($ideLote, $directorSelect, $abonadoDir, $totalDir, $porcentajeDir));
   }
  
   if($subdirectorSelect==''||$subdirectorSelect=='undefinded' || $subdirectorSelect ==0 || $subdirectorSelect==null){
    $abonadosubDir = $this->input->post("abonadosubDir");
    $pendientesubDir = $this->input->post("pendientesubDir");
    $totalsubDir = $this->input->post("totalsubDir");
     $respuesta = array( TRUE );
   }
   else{
    $abonadosubDir = str_replace($replace,"",$this->input->post("abonadosubDir"));
    $pendientesubDir = str_replace($replace,"",$this->input->post("pendientesubDir"));
    $totalsubDir = str_replace($replace,"",$this->input->post("totalsubDir"));
     $respuesta = array($this->Comisiones_model->update_comisionessubDir($ideLote, $subdirectorSelect, $abonadosubDir, $totalsubDir, $porcentajesubDir));      
   }
  
   if($gerenteSelect==''||$gerenteSelect=='undefinded' || $gerenteSelect ==0 || $gerenteSelect==null){
    $abonadoGerente = $this->input->post("abonadoGerente");
    $pendienteGerente = $this->input->post("pendienteGerente");
    $totalGerente = $this->input->post("totalGerente");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoGerente = str_replace($replace,"",$this->input->post("abonadoGerente"));
    $pendienteGerente = str_replace($replace,"",$this->input->post("pendienteGerente"));
    $totalGerente = str_replace($replace,"",$this->input->post("totalGerente"));
     $respuesta = array($this->Comisiones_model->update_comisionesGer($ideLote, $gerenteSelect, $abonadoGerente, $totalGerente, $porcentajeGerente));
   }
  
   if($coordinadorSelect==''||$coordinadorSelect=='undefinded' || $coordinadorSelect ==0 || $coordinadorSelect==null){
    $abonadoCoordinador = ($this->input->post("abonadoCoordinador")) == '' ? 0:$this->input->post("abonadoCoordinador");
    $pendienteCoordinador = ($this->input->post("pendienteCoordinador")) == '' ? 0:$this->input->post("pendienteCoordinador");
    $totalCoordinador = ($this->input->post("totalCoordinador"))== '' ? 0:$this->input->post("totalCoordinador");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoCoordinador = str_replace($replace,"",$this->input->post("abonadoCoordinador"));
    $pendienteCoordinador = str_replace($replace,"",$this->input->post("pendienteCoordinador"));
    $totalCoordinador = str_replace($replace,"",$this->input->post("totalCoordinador"));
     $respuesta = array($this->Comisiones_model->update_comisionesCoord($ideLote, $coordinadorSelect, $abonadoCoordinador, $totalCoordinador, $porcentajeCoordinador));
   }
  
   if($asesorSelect==''||$asesorSelect=='undefinded' || $asesorSelect ==0 || $asesorSelect==null){
    $abonadoAsesor = $this->input->post("abonadoAsesor");
    $pendienteAsesor =$this->input->post("pendienteAsesor");
    $totalAsesor = $this->input->post("totalAsesor");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoAsesor = str_replace($replace,"",$this->input->post("abonadoAsesor"));
    $pendienteAsesor = str_replace($replace,"",$this->input->post("pendienteAsesor"));
    $totalAsesor = str_replace($replace,"",$this->input->post("totalAsesor"));
   
     $respuesta = array($this->Comisiones_model->update_comisionesAse($ideLote, $asesorSelect, $abonadoAsesor, $totalAsesor, $porcentajeAsesor));
   }
  
  
  ///////////////////////////////////7
  
  
  
    if($subdirectorSelect21==''||$subdirectorSelect21=='undefinded' || $subdirectorSelect21 ==0 || $subdirectorSelect21==null){
      $abonadosubDir21 = $this->input->post("abonadosubDir21");
    $pendientesubDir21 = $this->input->post("pendientesubDir21");
    $totalsubDir21 = $this->input->post("totalsubDir21");
     $respuesta = array( TRUE );
   }
   else{
    $abonadosubDir21 = str_replace($replace,"",$this->input->post("abonadosubDir21"));
    $pendientesubDir21 = str_replace($replace,"",$this->input->post("pendientesubDir21"));
    $totalsubDir21 = str_replace($replace,"",$this->input->post("totalsubDir21"));
     $respuesta = array($this->Comisiones_model->update_comisionessubDir($ideLote, $subdirectorSelect21, $abonadosubDir21, $totalsubDir21, $porcentajesubDir21));      
   }
  
   if($gerenteSelect21==''||$gerenteSelect21=='undefinded' || $gerenteSelect21 ==0 || $gerenteSelect21==null){
    $abonadoGerente21 = $this->input->post("abonadoGerente21");
    $pendienteGerente21 = $this->input->post("pendienteGerente21");
    $totalGerente21 = $this->input->post("totalGerente21");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoGerente21 = str_replace($replace,"",$this->input->post("abonadoGerente21"));
    $pendienteGerente21 = str_replace($replace,"",$this->input->post("pendienteGerente21"));
    $totalGerente21 = str_replace($replace,"",$this->input->post("totalGerente21"));
     $respuesta = array($this->Comisiones_model->update_comisionesGer($ideLote, $gerenteSelect21, $abonadoGerente21, $totalGerente21, $porcentajeGerente21));
   }
  
   if($coordinadorSelect21==''||$coordinadorSelect21=='undefinded' || $coordinadorSelect21 ==0 || $coordinadorSelect21==null){
    $abonadoCoordinador21 = ($this->input->post("abonadoCoordinador21")) == '' ? 0:$this->input->post("abonadoCoordinador21");
    $pendienteCoordinador21 = ($this->input->post("pendienteCoordinador21")) == '' ? 0:$this->input->post("pendienteCoordinador21");
    $totalCoordinador21 = ($this->input->post("totalCoordinador21"))== '' ? 0:$this->input->post("totalCoordinador21");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoCoordinador21 = str_replace($replace,"",$this->input->post("abonadoCoordinador21"));
    $pendienteCoordinador21 = str_replace($replace,"",$this->input->post("pendienteCoordinador21"));
    $totalCoordinador21 = str_replace($replace,"",$this->input->post("totalCoordinador21"));
     $respuesta = array($this->Comisiones_model->update_comisionesCoord($ideLote, $coordinadorSelect21, $abonadoCoordinador21, $totalCoordinador21, $porcentajeCoordinador21));
   }
  
   if($asesorSelect21==''||$asesorSelect21=='undefinded' || $asesorSelect21 ==0 || $asesorSelect21==null){
    $abonadoAsesor21 = $this->input->post("abonadoAsesor21");
    $pendienteAsesor21 = $this->input->post("pendienteAsesor21");
    $totalAsesor21 = $this->input->post("totalAsesor21");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoAsesor21 = str_replace($replace,"",$this->input->post("abonadoAsesor21"));
    $pendienteAsesor21 = str_replace($replace,"",$this->input->post("pendienteAsesor21"));
    $totalAsesor21 = str_replace($replace,"",$this->input->post("totalAsesor21"));
     $respuesta = array($this->Comisiones_model->update_comisionesAse($ideLote, $asesorSelect21, $abonadoAsesor21, $totalAsesor21, $porcentajeAsesor21));
   }
  
  
   ////////////////////////////////////////////77
  
  
  
   ///////////////////////////////////7
  
  
  if($subdirectorSelect31==''||$subdirectorSelect31=='undefinded' || $subdirectorSelect31 ==0 || $subdirectorSelect31==null){
    $abonadosubDir31 = $this->input->post("abonadosubDir31");
    $pendientesubDir31 = $this->input->post("pendientesubDir31");
    $totalsubDir31 = $this->input->post("totalsubDir31");
     $respuesta = array( TRUE );
   }
   else{
    $abonadosubDir31 = str_replace($replace,"",$this->input->post("abonadosubDir31"));
    $pendientesubDir31 = str_replace($replace,"",$this->input->post("pendientesubDir31"));
    $totalsubDir31 = str_replace($replace,"",$this->input->post("totalsubDir31"));
     $respuesta = array($this->Comisiones_model->update_comisionessubDir($ideLote, $subdirectorSelect31, $abonadosubDir31, $totalsubDir31, $porcentajesubDir31));      
   }
  
   if($gerenteSelect31==''||$gerenteSelect31=='undefinded' || $gerenteSelect31 ==0 || $gerenteSelect31==null){
    $abonadoGerente31 = $this->input->post("abonadoGerente31");
    $pendienteGerente31 = $this->input->post("pendienteGerente31");
    $totalGerente31 = $this->input->post("totalGerente31");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoGerente31 = str_replace($replace,"",$this->input->post("abonadoGerente31"));
    $pendienteGerente31 = str_replace($replace,"",$this->input->post("pendienteGerente31"));
    $totalGerente31 = str_replace($replace,"",$this->input->post("totalGerente31"));
     $respuesta = array($this->Comisiones_model->update_comisionesGer($ideLote, $gerenteSelect31, $abonadoGerente31, $totalGerente31, $porcentajeGerente31));
   }
  
   if($coordinadorSelect31==''||$coordinadorSelect31=='undefinded' || $coordinadorSelect31 ==0 || $coordinadorSelect31==null){
    $abonadoCoordinador31 = ($this->input->post("abonadoCoordinador31")) == '' ? 0:$this->input->post("abonadoCoordinador31");
    $pendienteCoordinador31 = ($this->input->post("pendienteCoordinador31")) == '' ? 0:$this->input->post("pendienteCoordinador31");
    $totalCoordinador31 = ($this->input->post("totalCoordinador31"))== '' ? 0:$this->input->post("totalCoordinador31");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoCoordinador31 = str_replace($replace,"",$this->input->post("abonadoCoordinador31"));
    $pendienteCoordinador31 = str_replace($replace,"",$this->input->post("pendienteCoordinador31"));
    $totalCoordinador31 = str_replace($replace,"",$this->input->post("totalCoordinador31"));
     $respuesta = array($this->Comisiones_model->update_comisionesCoord($ideLote, $coordinadorSelect31, $abonadoCoordinador31, $totalCoordinador31, $porcentajeCoordinador31));
   }
  
   if($asesorSelect31==''||$asesorSelect31=='undefinded' || $asesorSelect31 ==0 || $asesorSelect31==null){
    $abonadoAsesor31 = $this->input->post("abonadoAsesor31");
    $pendienteAsesor31 = $this->input->post("pendienteAsesor31");
    $totalAsesor31 = $this->input->post("totalAsesor31");
     $respuesta = array( TRUE );
   }
   else{
    $abonadoAsesor31 = str_replace($replace,"",$this->input->post("abonadoAsesor31"));
    $pendienteAsesor31 = str_replace($replace,"",$this->input->post("pendienteAsesor31"));
    $totalAsesor31 = str_replace($replace,"",$this->input->post("totalAsesor31"));
     $respuesta = array($this->Comisiones_model->update_comisionesAse($ideLote, $asesorSelect31, $abonadoAsesor31, $totalAsesor31, $porcentajeAsesor31));
   }
  
  
   ////////////////////////////////////////////77



   if($MKTDSelect==''||$MKTDSelect=='undefinded' || $MKTDSelect ==0 || $MKTDSelect==null){
    $abonadoMKTD = $this->input->post("abonadoMKTD");
    $pendienteMKTD =$this->input->post("pendienteMKTD");
    $totalMKTD = $this->input->post("totalMKTD");
    $respuesta = array( TRUE );
  }
  else{
    $abonadoMKTD = str_replace($replace,"",$this->input->post("abonadoMKTD"));
    $pendienteMKTD = str_replace($replace,"",$this->input->post("pendienteMKTD"));
    $totalMKTD = str_replace($replace,"",$this->input->post("totalMKTD"));
    $respuesta = array($this->Comisiones_model->update_comisioneMKTD($ideLote, $MKTDSelect, $abonadoMKTD, $totalMKTD, $porcentajeMKTD));
  }
  if($SubClubSelect==''||$SubClubSelect=='undefinded' || $SubClubSelect ==0 || $SubClubSelect==null){
    $abonadoSubClub = $this->input->post("abonadoSubClub");
    $pendienteSubClub = $this->input->post("pendienteSubClub");
    $totalSubClub = $this->input->post("totalSubClub");
    $respuesta = array( TRUE );
  }
  else{
    $abonadoSubClub = str_replace($replace,"",$this->input->post("abonadoSubClub"));
    $pendienteSubClub = str_replace($replace,"",$this->input->post("pendienteSubClub"));
    $totalSubClub = str_replace($replace,"",$this->input->post("totalSubClub"));
    $respuesta = array($this->Comisiones_model->update_comisionesSUBCLUB($ideLote, $SubClubSelect, $abonadoSubClub, $totalSubClub, $porcentajeSubClub));
  }
  if($EjectClubSelect==''||$EjectClubSelect=='undefinded' || $EjectClubSelect ==0 || $EjectClubSelect==null){
    $abonadoEjectClub = $this->input->post("abonadoEjectClub");
    $pendienteEjectClub = $this->input->post("pendienteEjectClub");
    $totalEjectClub = $this->input->post("totalEjectClub");
    $respuesta = array( TRUE );
  }
  else{
    $abonadoEjectClub = str_replace($replace,"",$this->input->post("abonadoEjectClub"));
    $pendienteEjectClub = str_replace($replace,"",$this->input->post("pendienteEjectClub"));
    $totalEjectClub = str_replace($replace,"",$this->input->post("totalEjectClub"));
    $respuesta = array($this->Comisiones_model->update_comisionesEJECTCLUB($ideLote, $EjectClubSelect, $abonadoEjectClub, $totalEjectClub, $porcentajeEjectClub));
  }


  if($GreenSelect==''||$GreenSelect=='undefinded' || $GreenSelect ==0 || $GreenSelect==null){
    $abonadoGreenham = $this->input->post("abonadoGreenham");
    $pendienteGreenham = $this->input->post("pendienteGreenham");
    $totalGreenham = $this->input->post("totalGreenham");
    $respuesta = array( TRUE );
  }
  else{
    $abonadoGreenham = str_replace($replace,"",$this->input->post("abonadoGreenham"));
    $pendienteGreenham = str_replace($replace,"",$this->input->post("pendienteGreenham"));
    $totalGreenham = str_replace($replace,"",$this->input->post("totalGreenham"));
    $respuesta = array($this->Comisiones_model->update_comisionesGreenham($ideLote, $GreenSelect, $abonadoGreenham, $totalGreenham, $porcentajeGreenham));
  }

   ////////////////////////////////////////////////////////////////////////
  
  
  $TO1 = ($totalDir+$totalsubDir+$totalGerente+$totalCoordinador+$totalAsesor);
  $TO2 = ($totalsubDir21+$totalGerente21+$totalCoordinador21+$totalAsesor21);
  $TO3 = ($totalsubDir31+$totalGerente31+$totalCoordinador31+$totalAsesor31);
  $TO4 = ($totalMKTD+$totalSubClub+$totalEjectClub+$totalGreenham);
  
  $AB1 = ($abonadoDir+$abonadosubDir+$abonadoGerente+$abonadoCoordinador+$abonadoAsesor);
  $AB2 = ($abonadosubDir21+$abonadoGerente21+$abonadoCoordinador21+$abonadoAsesor21);
  $AB3 = ($abonadosubDir31+$abonadoGerente31+$abonadoCoordinador31+$abonadoAsesor31);
  $AB4 = ($abonadoMKTD+$abonadoSubClub+$abonadoEjectClub+$abonadoGreenham);
  
  $PO1 = ($porcentajeDir+$porcentajesubDir+$porcentajeGerente+$porcentajeCoordinador+$porcentajeAsesor);
  $PO2 = ($porcentajesubDir21+$porcentajeGerente21+$porcentajeCoordinador21+$porcentajeAsesor21);
  $PO3 = ($porcentajesubDir31+$porcentajeGerente31+$porcentajeCoordinador31+$porcentajeAsesor31);
  $PO4 = ($porcentajeMKTD+$porcentajeSubClub+$porcentajeEjectClub+$porcentajeGreenham);
  
   $TOTALCOMISION = ($TO1+$TO2+$TO3+$TO4);
   $ABONOCONTRALORIA = ($AB1+$AB2+$AB3+$AB4);
   $PENDICONTRALORIA = ($TOTALCOMISION-$ABONOCONTRALORIA);
   $PORCETOTAL = ($PO1+$PO2+$PO3+$PO4);
  
   $respuesta = array($this->Comisiones_model->update_pago_comision($ideLote, $TOTALCOMISION, $PORCETOTAL, $ABONOCONTRALORIA, $PENDICONTRALORIA));
   $respuesta = array($this->Comisiones_model->update_lote_registro_comision($ideLote));
  
  }
  echo json_encode( $respuesta );
  }
    
  function getDatosDispersarCompartidas($idlote){
    echo json_encode($this->Comisiones_model->getDatosDispersarCompartidas($idlote)->result_array());
  }
  

  public function historyDispersePaymentInNeodata()
  {
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/historial_liquidadas", $datos);
  }

public function getSettledCommissions(){
      $datos = array();
      $datos = $this->Comisiones_model->getSettledCommissions();
      if ($datos != null) {
          echo json_encode($datos);
      } else {
          echo json_encode(array());
      }
  }

  function validateSettledCommissions($idlote){
    $response = $this->Comisiones_model->validateSettledCommissions($idlote)->result_array();
    if(count($response) == 0) {
        $response[0]['finalAnswer'] = 0; // NO REGRESÓ RESULTADOS
        echo json_encode($response);
    } else {
        $response[0]['finalAnswer'] = 1; // REGRESÓ ALGO
        echo json_encode($response);
    }
}

public function porcentajes2($idLote){
  echo json_encode($this->Comisiones_model->porcentajes2($idLote)->result_array(), JSON_NUMERIC_CHECK);
}
 
  public function InsertNeoCompartida(){
    $lote_1 =  $this->input->post("idLote");
    $responses = $this->Comisiones_model->validateDispersionCommissions($lote_1)->result_array();
         if(sizeof($responses) > 0 && $responses[0]['bandera'] != 0) {
           $respuesta = 2;
       } else {

    $disparador =  $this->input->post("id_disparador");
    
    if($disparador == '1' || $disparador == 1){
      
        //$lote_1 =  $this->input->post("idLote");
        $pending_1 =  $this->input->post("pending");
        $abono_nuevo = $this->input->post("abono_nuevo[]");
        $rol = $this->input->post("rol[]");
        $id_comision = $this->input->post("id_comision[]");
        $pago = $this->input->post("pago_neo");
  
        $suma = 0;
        $replace = [",","$"];
         for($i=0;$i<sizeof($id_comision);$i++){
           $var_n = str_replace($replace,"",$abono_nuevo[$i]);
           $respuesta = $this->Comisiones_model->insert_dispersion_individual($id_comision[$i], $rol[$i], $var_n, $pago);
          }
        for($i=0;$i<sizeof($abono_nuevo);$i++){
          $var_n = str_replace($replace,"",$abono_nuevo[$i]);
          $suma = $suma + $var_n ;
        }
        $resta = $pending_1 - $pago;
          $this->Comisiones_model->UpdateLoteDisponible($lote_1);
        $respuesta = $this->Comisiones_model->update_pago_dispersion($suma, $lote_1, $pago);
      }

      //COMISIÓN NUEVA COMPARTIDA
      
      else if($disparador == '0' || $disparador == 0){

        
        $replace = [",","$"];
  
        $bonificacion =  $this->input->post("bonificacion");
  
    $lote = $lote_1; //  $this->input->post("idLote");
    $pago = $this->input->post("pago_neo");
  
    $idAse = array();
    $idAse[0] =  $this->input->post("idAs");
    $idAse[1] =  $this->input->post("idAs2");
  
    $roleAsesor =7;
  
    $comisionesAs = array();
    $comisionesAs[0] =  str_replace($replace,"",$this->input->post("restoAs"));
    $comisionesAs[1] =  str_replace($replace,"",$this->input->post("restoAs2"));
  
  
    $porAse = array();
    $porAse[0] = $this->input->post("porAs");
    $porAse[1] = $this->input->post("porAs2");
  
  
    $disponibleAse = array();
    $disponibleAse[0] = str_replace($replace,"",$this->input->post("totalAs"));
    $disponibleAse[1] = str_replace($replace,"",$this->input->post("totalAs2"));
  //$ = $this->input->post("idAs3");
  
  $sumaPorAs = 0;
  $sumaComiAs = 0;
  $sumaDispoAs = 0;
  if( !empty($this->input->post("idAs3") ) ){
    $idAse[2] =  $this->input->post("idAs3");
    $porAse[2] =  str_replace($replace,"",$this->input->post("porAs3"));
    $disponibleAse[2] = str_replace($replace,"",$this->input->post("totalAs3"));
    $comisionesAs[2] =  str_replace($replace,"",$this->input->post("restoAs3"));
            for ($i=0; $i < 3; $i++) {
              
              $sumaPorAs += $porAse[$i];
              $sumaComiAs += $comisionesAs[$i];
            $sumaDispoAs += $disponibleAse[$i];   
              $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idAse[$i],$disponibleAse[$i],$this->session->userdata('id_usuario'),$porAse[$i],$comisionesAs[$i],$pago,$roleAsesor);
  
            }
  
  }else{
    
          for ($i=0; $i < 2; $i++) { 
            $sumaPorAs += $porAse[$i];
            $sumaComiAs += $comisionesAs[$i];
          $sumaDispoAs += $disponibleAse[$i];
            $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idAse[$i],$disponibleAse[$i],$this->session->userdata('id_usuario'),$porAse[$i],$comisionesAs[$i],$pago,$roleAsesor);
    
          }
  }
   
  
  /**-------------------------------COORDINADORES--------------------- */
  
  $idCoor = array();
  $idCoor[0] =  $this->input->post("idCoor");
  
  $rolCoor = 9;
  
  $comisionesCoor = array();
  $comisionesCoor[0] =  str_replace($replace,"",$this->input->post("restoCoor"));;
  
  
  $porCoor = array();
  $porCoor[0] = $this->input->post("porCoor");
  
  
  $disponibleCoor = array();
  $disponibleCoor[0] = str_replace($replace,"",$this->input->post("totalCoor"));
  
  
  $sumaPorCoor = 0;
  $sumaComiCoor = 0;
  $sumaDispoCoor = 0;
  if( !empty($this->input->post("idCoor2") ) &&  !empty($this->input->post("idCoor3") )){
  
  
    $idCoor[1] =  $this->input->post("idCoor2");
    $porCoor[1] =  $this->input->post("porCoor2");
    $disponibleCoor[1] = str_replace($replace,"",$this->input->post("totalCoor2"));
    $comisionesCoor[1] =  str_replace($replace,"",$this->input->post("restoCoor2"));
  
    $idCoor[2] =  $this->input->post("idCoor3");
  $porCoor[2] =  $this->input->post("porCoor3");
  $disponibleCoor[2] =  str_replace($replace,"",$this->input->post("totalCoor3"));
  $comisionesCoor[2] =  str_replace($replace,"",$this->input->post("restoCoor3"));
  
          for ($i=0; $i < 3; $i++) {
            
            $sumaPorCoor += $porCoor[$i];
            $sumaComiCoor += $comisionesCoor[$i];
          $sumaDispoCoor += $disponibleCoor[$i]; 
            $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idCoor[$i],$disponibleCoor[$i],$this->session->userdata('id_usuario'),$porCoor[$i],$comisionesCoor[$i],$pago,$rolCoor);
  
          }
  
  }else if( !empty($this->input->post("idCoor2") ) &&  empty($this->input->post("idCoor3") )){
    
    $idCoor[1] =  $this->input->post("idCoor2");
    $porCoor[1] =  $this->input->post("porCoor2");
    $disponibleCoor[1] =  str_replace($replace,"",$this->input->post("totalCoor2"));
    $comisionesCoor[1] =  str_replace($replace,"",$this->input->post("restoCoor2"));
  
        for ($i=0; $i < 2; $i++) {
          $sumaPorCoor += $porCoor[$i];
            $sumaComiCoor += $comisionesCoor[$i];
          $sumaDispoCoor += $disponibleCoor[$i]; 
          $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idCoor[$i],$disponibleCoor[$i],$this->session->userdata('id_usuario'),$porCoor[$i],$comisionesCoor[$i],$pago,$rolCoor);
  
        }
  }else if( empty($this->input->post("idCoor2") ) &&  empty($this->input->post("idCoor3") )){
    $sumaPorCoor = $porCoor[0];
            $sumaComiCoor = $comisionesCoor[0];
          $sumaDispoCoor = $disponibleCoor[0];
    $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idCoor[0],$disponibleCoor[0],$this->session->userdata('id_usuario'),$porCoor[0],$comisionesCoor[0],$pago,$rolCoor);
  
  }
  
  
  /**------------------GERENTE -------------------------------------- */
  $idGe = array();
  $idGe[0] =  $this->input->post("idGe");
  
  $rolGe = 3;
  
  $comisionesGe = array();
  $comisionesGe[0] =  str_replace($replace,"",$this->input->post("restoGe"));
  
  
  $porGe = array();
  $porGe[0] = $this->input->post("porGe");
  
  
  $disponibleGe = array();
  $disponibleGe[0] = str_replace($replace,"",$this->input->post("totalGe"));
  
  $sumaPorGe = 0;
  $sumaComiGe = 0;
  $sumaDispoGe = 0;
  if( !empty($this->input->post("idGe2") ) &&  !empty($this->input->post("idGe3") )){
  
  
    $idGe[1] =  $this->input->post("idGe2");
    $porGe[1] =  $this->input->post("porGe2");
    $disponibleGe[1] =  str_replace($replace,"",$this->input->post("totalGe2"));
    $comisionesGe[1] =  str_replace($replace,"",$this->input->post("restoGe2"));
  
    $idGe[2] =  $this->input->post("idGe3");
  $porGe[2] =  $this->input->post("porGe3");
  $disponibleGe[2] =  str_replace($replace,"",$this->input->post("totalGe3"));
  $comisionesGe[2] =  str_replace($replace,"",$this->input->post("restoGe3"));
  
          for ($i=0; $i < 3; $i++) {
            $sumaPorGe += $porGe[$i];
            $sumaComiGe += $comisionesGe[$i];
          $sumaDispoGe += $disponibleGe[$i]; 
            
            $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idGe[$i],$disponibleGe[$i],$this->session->userdata('id_usuario'),$porGe[$i],$comisionesGe[$i],$pago,$rolGe);
  
          }
  
  }else if( !empty($this->input->post("idGe2") ) &&  empty($this->input->post("idGe3") )){
    
    $idGe[1] =  $this->input->post("idGe2");
    $porGe[1] =  $this->input->post("porGe2");
    $disponibleGe[1] =  str_replace($replace,"",$this->input->post("totalGe2"));
    $comisionesGe[1] =  str_replace($replace,"",$this->input->post("restoGe2"));
  
        for ($i=0; $i < 2; $i++) { 
          $sumaPorGe += $porGe[$i];
          $sumaComiGe += $comisionesGe[$i];
        $sumaDispoGe += $disponibleGe[$i]; 
          $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idGe[$i],$disponibleGe[$i],$this->session->userdata('id_usuario'),$porGe[$i],$comisionesGe[$i],$pago,$rolGe);
  
        }
  }else if( empty($this->input->post("idGe2") ) &&  empty($this->input->post("idGe3") )){
    $sumaPorGe = $porGe[0];
    $sumaComiGe = $comisionesGe[0];
  $sumaDispoGe = $disponibleGe[0]; 
    $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idGe[0],$disponibleGe[0],$this->session->userdata('id_usuario'),$porGe[0],$comisionesGe[0],$pago,$rolGe);
  
  }
  
  /**----------------SUB DIRECTOR------------------------------- */
  
  $idSub = array();
  $idSub[0] =  $this->input->post("idSub");
  
  $rolSub = 2;
  
  $comisionesSub = array();
  $comisionesSub[0] =  str_replace($replace,"",$this->input->post("restoSub"));
  
  
  $porSub = array();
  $porSub[0] = $this->input->post("porSub");
  
  
  $disponibleSub = array();
  $disponibleSub[0] = str_replace($replace,"",$this->input->post("totalSub"));
  
  $sumaPorSub = 0;
  $sumaComiSub = 0;
  $sumaDispoSub = 0;
  if( !empty($this->input->post("idSub2") ) &&  !empty($this->input->post("idSub3") )){
  
  
    $idSub[1] =  $this->input->post("idSub2");
    $porSub[1] =  $this->input->post("porSub2");
    $disponibleSub[1] =  str_replace($replace,"",$this->input->post("totalSub2"));
    $comisionesSub[1] =  str_replace($replace,"",$this->input->post("restoSub2"));
  
    $idSub[2] =  $this->input->post("idSub3");
  $porSub[2] =  $this->input->post("porSub3");
  $disponibleSub[2] =  str_replace($replace,"",$this->input->post("totalSub3"));
  $comisionesSub[2] =  str_replace($replace,"",$this->input->post("restoSub3"));
  
          for ($i=0; $i < 3; $i++) {
            $sumaPorSub += $porSub[$i];
            $sumaComiSub += $comisionesSub[$i];
          $sumaDispoSub += $disponibleSub[$i]; 
            
            $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idSub[$i],$disponibleSub[$i],$this->session->userdata('id_usuario'),$porSub[$i],$comisionesSub[$i],$pago,$rolSub);
  
          }
  
  }else if( !empty($this->input->post("idSub2") ) &&  empty($this->input->post("idSub3") )){
    
    $idSub[1] =  $this->input->post("idSub2");
    $porSub[1] =  $this->input->post("porSub2");
    $disponibleSub[1] =  str_replace($replace,"",$this->input->post("totalSub2"));
    $comisionesSub[1] =  str_replace($replace,"",$this->input->post("restoSub2"));
  
        for ($i=0; $i < 2; $i++) { 
  
          $sumaPorSub += $porSub[$i];
            $sumaComiSub += $comisionesSub[$i];
          $sumaDispoSub += $disponibleSub[$i]; 
          $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idSub[$i],$disponibleSub[$i],$this->session->userdata('id_usuario'),$porSub[$i],$comisionesSub[$i],$pago,$rolSub);
  
        }
  }else if( empty($this->input->post("idSub2") ) &&  empty($this->input->post("idSub3") )){
    $sumaPorSub = $porSub[0];
    $sumaComiSub = $comisionesSub[0];
  $sumaDispoSub = $disponibleSub[0]; 
    $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idSub[0],$disponibleSub[0],$this->session->userdata('id_usuario'),$porSub[0],$comisionesSub[0],$pago,$rolSub);
  
  } 
  
  /**------------------DIRECTOR---------------------- */
  
  $idDir =$this->input->post("idDir");
  $comisionesDir=str_replace($replace,"",$this->input->post("restoDir"));
  $porDir=$this->input->post("porDir");
  $disponibleDir=str_replace($replace,"",$this->input->post("totalDir"));
  $rolDir=1;
  
  $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idDir,$disponibleDir,$this->session->userdata('id_usuario'),$porDir,$comisionesDir,$pago,$rolDir);
  
  $sumaPorDir = $this->input->post("porDir");
  $sumaComiDir =  str_replace($replace,"",$this->input->post("restoDir"));
  $sumaDispoDir = str_replace($replace,"",$this->input->post("totalDir"));
  
  /**------------------CLUB MADERAS---------------------- */
  
  $idCb =$this->input->post("idCb");
  $comisionesCb =str_replace($replace,"",$this->input->post("restoCb"));
  $porCb =$this->input->post("porCb");
  $disponibleCb =str_replace($replace,"",$this->input->post("totalCb"));
  $rolCb = $this->input->post("rolCb");
  
  $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idCb,$disponibleCb,$this->session->userdata('id_usuario'),$porCb,$comisionesCb,$pago,$rolCb);
  
  $sumaPorCb = $this->input->post("porCb");
  $sumaComiCb = str_replace($replace,"",$this->input->post("restoCb"));
  $sumaDispoCb = str_replace($replace,"",$this->input->post("totalCb"));
  
  /**------------------MARKETING---------------------- */
  
  $idMk =$this->input->post("idMk");
  $comisionesMk=str_replace($replace,"",$this->input->post("restoMk"));
  $porMk=$this->input->post("porMk");
  $disponibleMk=str_replace($replace,"",$this->input->post("totalMk"));
  $rolMk = $this->input->post("rolMk");
  
  $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idMk,$disponibleMk,$this->session->userdata('id_usuario'),$porMk,$comisionesMk,$pago,$rolMk);
  
  $sumaPorMk = $this->input->post("porMk");
  $sumaComiMk =  str_replace($replace,"",$this->input->post("restoMk"));
  $sumaDispoMk = str_replace($replace,"",$this->input->post("totalMk"));
  
  
  /**------------------EMPRESA---------------------- */
  
  $idEm =$this->input->post("idEm");
  $comisionesEm=str_replace($replace,"",$this->input->post("restoEm"));
  $porEm=$this->input->post("porEm");
  $disponibleEm=str_replace($replace,"",$this->input->post("totalEm1"));
  $rolEm = $this->input->post("rolEm");
  $respuesta =  $this->Comisiones_model->InsertNeo($lote,$idEm,$disponibleEm,$this->session->userdata('id_usuario'),$porEm,$comisionesEm,$pago,$rolEm);

  $sumaPorEm = $this->input->post("porEm");
  $sumaComiEm = str_replace($replace,"",$this->input->post("restoEm"));
  $sumaDispoEm = str_replace($replace,"",$this->input->post("totalEm1"));
  
/**-----------------COREANO VLOGS---------------- */
$idCorea =$this->input->post("idCorea");
$comisionesCorea=str_replace($replace,"",$this->input->post("restoCorea"));
$porCorea=$this->input->post("porCorea");
$disponibleCorea=str_replace($replace,"",$this->input->post("totalCorea"));
$rolCorea = $this->input->post("rolCorea");
$respuesta =  $this->Comisiones_model->InsertNeo($lote,$idCorea,$disponibleCorea,$this->session->userdata('id_usuario'),$porCorea,$comisionesCorea,$pago,$rolCorea);

$sumaPorCorea = $this->input->post("porCorea");
$sumaComiCorea = str_replace($replace,"",$this->input->post("restoCorea"));
$sumaDispoCorea = str_replace($replace,"",$this->input->post("totalCorea"));
  /**------------------END---------------------- */
   
  $sumaDispo = $sumaDispoAs + $sumaDispoCoor + $sumaDispoGe + $sumaDispoSub + $sumaDispoDir + $sumaDispoCb + $sumaDispoMk + $sumaDispoEm + $sumaDispoCorea; 
  $sumaPor = $sumaPorAs + $sumaPorCoor + $sumaPorGe + $sumaPorSub + $sumaPorDir + $sumaPorCb + $sumaPorMk + $sumaPorEm + $sumaPorCorea;
  $sumaComi= $sumaComiAs + $sumaComiCoor + $sumaComiGe + $sumaComiSub + $sumaComiDir  + $sumaComiCb  + $sumaComiMk  + $sumaComiEm + $sumaComiCorea ;
  
  
  $resta = $sumaDispo - $sumaComi ;
  $resta2 = $sumaDispo - $sumaComi;

      $this->Comisiones_model->UpdateLoteDisponible($lote);
     
       $respuesta =  $this->Comisiones_model->InsertPagoComision($lote,$sumaDispo,$sumaComi,$sumaPor,$resta,$this->session->userdata('id_usuario'),$pago,$bonificacion);
  
  
  }


}
  echo json_encode($respuesta);
  
  }

   public function revision_xml()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      switch($this->session->userdata('id_rol')){
        case '31':
        $this->load->view('template/header');
        $this->load->view("ventas/revision_INTMEXxml", $datos);
        break;

        default:
        $this->load->view('template/header');
        $this->load->view("ventas/revision_xml", $datos);
        break;
      }


    }

    public function getDatosNuevasXContraloria($proyecto,$condominio){
  $dat =  $this->Comisiones_model->getDatosNuevasXContraloria($proyecto,$condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}




public function getDatosNuevasAContraloria($proyecto,$condominio){
  $dat =  $this->Comisiones_model->getDatosNuevasAContraloria($proyecto,$condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

public function getDatosNuevasFContraloria($proyecto,$condominio){
  $dat =  $this->Comisiones_model->getDatosNuevasFContraloria($proyecto,$condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

public function getDatosHistorialPagoRP($id_usuario){
    ini_set('max_execution_time', 900);
    set_time_limit(900);
    ini_set('memory_limit','2048M');


    $dat =  $this->Comisiones_model->getDatosHistorialPagoRP($id_usuario)->result_array();
    for( $i = 0; $i < count($dat); $i++ ){
        $dat[$i]['pa'] = 0;
    }
    echo json_encode( array( "data" => $dat));
}

public function getDatosHistorialPago($proyecto,$condominio){

    // ini_set('max_execution_time', 99999);
    // set_time_limit(999999);
    // ini_set('memory_limit','8192M');

      
  $dat =  $this->Comisiones_model->getDatosHistorialPago($proyecto,$condominio)->result_array();
 
 echo json_encode( array( "data" => $dat));
}


public function getDatosHistorialPagoM($proyecto,$condominio){
  ini_set('max_execution_time', 900);
      set_time_limit(900);
      ini_set('memory_limit','2048M');
  $dat =  $this->Comisiones_model->getDatosHistorialPagoM($proyecto,$condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}
 
 

public function getDatosHistorialPagado($proyecto,$condominio){
  $dat =  $this->Comisiones_model->getDatosHistorialPagado($proyecto,$condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}


public function getDatosHistorialDU($proyecto,$condominio){
  $dat =  $this->Comisiones_model->getDatosHistorialDU($proyecto,$condominio)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}

  

public function getDatosInternomexContraloria($proyecto){
  $dat =  $this->Comisiones_model->getDatosInternomexContraloria($proyecto)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}




public function addFileControversia(){

  $idCliente=$this->input->post('idCliente');
  $doc_controversia= preg_replace('[^A-Za-z0-9]', '',$_FILES["doc_controversia"]["name"]);

  $fileExt = strtolower(substr($doc_controversia, strrpos($doc_controversia, '.') + 1));
  $date= date('dmYHis');
  $name_doc=  $idCliente.'_'.$date.'.'.$fileExt;
  
  $result = $this->Comisiones_model->verify_controversia($idCliente);
  $veryfy =  (empty($result)) ? TRUE : FALSE;
  
  if ($veryfy == TRUE){

      if ($fileExt == 'pdf'){

          $move = move_uploaded_file($_FILES["doc_controversia"]["tmp_name"],"static/documentos/cliente/controversia/".$name_doc);
          $validaMove = $move == FALSE ? 0 : 1;

          if ($validaMove == 1) {

            $arreglo=array();
            $arreglo["documento"] = $name_doc;
            $arreglo["idCliente"] = $idCliente;
            $arreglo["idUser"]= $this->session->userdata('id_usuario');

            $arreglo2=array();
            $arreglo2["id_usuario"]= $this->session->userdata('id_usuario');
            $arreglo2["comentario"]= 'SE ADJUNTO CONTROVERSIA';
            $arreglo2["id_pago_i"]= 0;
            $arreglo2["estatus"]= 0;

            $this->Comisiones_model->insert_HCD_A($arreglo);
            $this->Comisiones_model->insert_HCD($arreglo2);

            $response['message'] = 'OK';
            echo json_encode($response);

          } else if ($validaMove == 0){
            $response['message'] = 'ERROR';
            echo json_encode($response);
          } else {
            $response['message'] = 'ERROR';
            echo json_encode($response);
          }

      } else {
          $response['message'] = 'ERROR';
          echo json_encode($response);
      }

  } else {
    
      $file = "./static/documentos/cliente/controversia/".$result[0]["documento"];

      if(file_exists($file)){
        unlink($file);

              if ($fileExt == 'pdf'){

                $move = move_uploaded_file($_FILES["doc_controversia"]["tmp_name"],"static/documentos/cliente/controversia/".$name_doc);
                $validaMove = $move == FALSE ? 0 : 1;

                if ($validaMove == 1) {

                  $arreglo=array();
                  $arreglo["documento"] = $name_doc;
                  $arreglo["idUser"]= $this->session->userdata('id_usuario');
                  $arreglo["fecha_creacion"]=date("Y-m-d H:i:s");

                  $arreglo2=array();
                  $arreglo2["id_usuario"]= $this->session->userdata('id_usuario');
                  $arreglo2["comentario"]= 'SE ADJUNTO CONTROVERSIA';
                  $arreglo2["id_pago_i"]= 0;
                  $arreglo2["estatus"]= 0;

                  $this->Comisiones_model->update_HCD_A($idCliente,$arreglo);
                  $this->Comisiones_model->insert_HCD($arreglo2);

                  $response['message'] = 'OK';
                  echo json_encode($response);

                } else if ($validaMove == 0){
                  $response['message'] = 'ERROR';
                  echo json_encode($response);
                } else {
                  $response['message'] = 'ERROR';
                  echo json_encode($response);
                }

            } else {
                $response['message'] = 'ERROR';
                echo json_encode($response);
            }

      }
  }
}


public function solicitar_controversia()
{
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $datos = array();
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $salida = str_replace('' . base_url() . '', '', $val);
  $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
  $this->load->view('template/header');
  $this->load->view("ventas/solicitar_controversia", $datos);
}

///////////////////////////////////////////////////////////////////////

function update_stC(){

    $idCliente=$this->input->post('idCliente');

    $arreglo=array();
    $arreglo["estatus"] = 2;

    $validate = $this->Comisiones_model->update_HCD_A($idCliente,$arreglo);

  if ($validate == TRUE){
    $response['message'] = 'OK';
    echo json_encode($response);

  } else {
    $response['message'] = 'ERROR';
    echo json_encode($response);
  }

}

public function getDataIncidencias()
{
  $datos = array();
  $datos = $this->Comisiones_model->getDataIncidencias();
  if ($datos != null) {
    echo json_encode($datos);
  } else {
    echo json_encode(array());
  }
}

function getDatosDocumentos($id_comision, $id_pj){
  echo json_encode($this->Comisiones_model->getDatosDocumentos($id_comision, $id_pj)->result_array());
}

public function LiquidarLote(){
  $lote = $this->input->post("lote");
 
   $respuesta = $this->Comisiones_model->LiquidarLote($this->session->userdata('id_usuario'),$lote);
     
     echo json_encode($respuesta);
 
 }

 function activeCommissions()
    {
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $datos = array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace('' . base_url() . '', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
        $this->load->view('template/header');
        $this->load->view("ventas/active_commissions", $datos);
    }

    public function getActiveCommissions()
    {
        $datos = array();
        $datos = $this->Comisiones_model->getActiveCommissions();
        if ($datos != null) {
            echo json_encode($datos);
        } else {
            echo json_encode(array());
        }
    }

    public function getAllCommissions()
    {
        $datos = array();
        $datos = $this->Comisiones_model->getAllCommissions();
        if ($datos != null) {
            echo json_encode($datos);
        } else {
            echo json_encode(array());
        }
    }

    public function getInCommissions($lote)
    {
        $datos = array();
        $datos = $this->Comisiones_model->getInCommissions($lote);
        if ($datos != null) {
            echo json_encode($datos);
        } else {
            echo json_encode(array());
        }
    }

    public function getCommissionsWithoutPaymentInNeodata(){
        $datos=array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        /*CONSULTAS PARA OBTENER EL PADRE DE LA OPCIÓN ACTUAL PARA ACTIVARLA*/
        $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace(''.base_url().'', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
        /*-----------------*/
        $this->load->view('template/header');
        $this->load->view("ventas/commissions_without_payment", $datos);
    }

    public function validateRegion(){
        $datos=array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        /*CONSULTAS PARA OBTENER EL PADRE DE LA OPCIÓN ACTUAL PARA ACTIVARLA*/
        $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace(''.base_url().'', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
        /*-----------------*/
        $this->load->view('template/header');
        $this->load->view("ventas/validate_region", $datos);
    }

    public function getCommissionsToValidate(){
        $id_usuario = $this->session->userdata('id_usuario');
        $data['data'] = $this->Comisiones_model->getCommissionsToValidate($id_usuario)->result_array();
        echo json_encode($data);
    }

    public function updatePlaza($sol, $plaza){
        $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");
        $lotes = $this->db->query("SELECT idLote FROM lotes WHERE idLote IN (SELECT id_lote FROM comisiones WHERE id_comision IN (SELECT id_comision FROM pago_comision_ind WHERE id_pago_i IN (".$sol.")))");
        if( $consulta_comisiones->num_rows() > 0 ){
            $consulta_comisiones = $consulta_comisiones->result_array();
            $lotes = $lotes->result_array();
            $id_user_Vl = $this->session->userdata('id_usuario');
            for( $i = 0; $i < count($consulta_comisiones ); $i++){
                if($plaza == 0) { // SÓLO SE MARCA COMO RECHAZADA Y NO SE ACTUALIZA LOTE
                    if($id_user_Vl == 1981)$estatus = 61; // ES MARICELA
                    else if($id_user_Vl == 1988)$estatus = 62; // ES FERNANDA
                    $this->Comisiones_model->updateIndividualCommission($consulta_comisiones[$i]['id_pago_i'], $estatus);
                    $this->db->query("INSERT INTO historial_comisiones VALUES (".$consulta_comisiones[$i]['id_pago_i'].", ".$id_user_Vl.", GETDATE(), 1, 'RECHAZO SUBDIRECTOR MKTD')");
                    echo json_encode(1); // RECHAZADO
                } else {
                    if($id_user_Vl == 1981)$estatus = 51; // ES MARICELA
                    else if($id_user_Vl == 1988)$estatus = 52; // ES FERNANDA
                    $this->Comisiones_model->updateIndividualCommission($consulta_comisiones[$i]['id_pago_i'], $estatus);
                    $this->db->query("INSERT INTO historial_comisiones VALUES (".$consulta_comisiones[$i]['id_pago_i'].", ".$id_user_Vl.", GETDATE(), 1, 'VALIDÓ SUBDIRECTOR MKTD')");
                    $this->Comisiones_model->updateLotes($lotes[$i]['idLote'], $plaza);
                    echo json_encode(2); // LOTE ASIGNADO
                }
            }
        }
        else{ // SIN LOTES
            $consulta_comisiones = array();
            echo json_encode(3); // NO ENCONTRÓ NADA, ERROR.
        }
    }

    public function updateBandera(){
         // echo($_POST['param']);
        $response = $this->Comisiones_model->updateBandera( $_POST['id_pagoc'], $_POST['param']);
        echo json_encode($response);
    }

    public function asigno_region_uno($sol){
      $this->load->model("Comisiones_model");
      $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");

      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();

        $id_user_Vl = $this->session->userdata('id_usuario');

        for( $i = 0; $i < count($consulta_comisiones ); $i++){
          $this->Comisiones_model->update_acepta_solicitante_uno($consulta_comisiones[$i]['id_pago_i']);

          $this->db->query("INSERT INTO historial_comisiones VALUES (".$consulta_comisiones[$i]['id_pago_i'].", ".$id_user_Vl.", GETDATE(), 1, 'COBRANZA ENVIO A REGIÓN 1')");
// $this->db->query("UPDATE pago_comision_ind SET fecha_pago_intmex = GETDATE() WHERE id_pago_i = ".$consulta_comisiones[$i]['id_pago_i']."");
        }
      }
      else{
        $consulta_comisiones = array();
      }
    }

    public function asigno_region_dos($sol){
      $this->load->model("Comisiones_model");
      $consulta_comisiones = $this->db->query("SELECT id_pago_i FROM pago_comision_ind where id_pago_i IN (".$sol.")");

      if( $consulta_comisiones->num_rows() > 0 ){
        $consulta_comisiones = $consulta_comisiones->result_array();

        $id_user_Vl = $this->session->userdata('id_usuario');

        for( $i = 0; $i < count($consulta_comisiones ); $i++){
          $this->Comisiones_model->update_acepta_solicitante_dos($consulta_comisiones[$i]['id_pago_i']);

          $this->db->query("INSERT INTO historial_comisiones VALUES (".$consulta_comisiones[$i]['id_pago_i'].", ".$id_user_Vl.", GETDATE(), 1, 'COBRANZA ENVIO A REGIÓN 2')");
// $this->db->query("UPDATE pago_comision_ind SET fecha_pago_intmex = GETDATE() WHERE id_pago_i = ".$consulta_comisiones[$i]['id_pago_i']."");
        }
      }
      else{
        $consulta_comisiones = array();
      }
    }


    public function EnviarDesarrollos()
    {
      if($this->input->post("desarrolloSelect2") == 1000){
        $formaPago = $this->Comisiones_model->GetFormaPago($this->session->userdata('id_usuario'))->result_array();
        if($formaPago[0]['forma_pago'] == 3 || $formaPago[0]['forma_pago'] == 4){
          $respuesta = $this->Comisiones_model->ComisionesEnviar($this->session->userdata('id_usuario'),0,1);
        }else{
          $respuesta = $this->Comisiones_model->ComisionesEnviar($this->session->userdata('id_usuario'),0,2);
        }
      }else{
        $formaPago = $this->Comisiones_model->GetFormaPago($this->session->userdata('id_usuario'))->result_array();
        if($formaPago[0]['forma_pago'] == 3 || $formaPago[0]['forma_pago'] == 4){
          $respuesta = $this->Comisiones_model->ComisionesEnviar($this->session->userdata('id_usuario'),$this->input->post("desarrolloSelect2"),3);
        }else{
          $respuesta = $this->Comisiones_model->ComisionesEnviar($this->session->userdata('id_usuario'),$this->input->post("desarrolloSelect2"),4);
        }
      }
      echo json_encode($respuesta);
    }

    public function revision_mktd()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      switch($this->session->userdata('id_rol')){
        case '31':
        $this->load->view('template/header');
        $this->load->view("ventas/revision_INTMEXmktd", $datos);
        break;

        default:
        $this->load->view('template/header');
        $this->load->view("ventas/revision_mktd", $datos);
        break;
      }

    }
 
    public function getDatosRevisionMktd(){
      $dat =  $this->Comisiones_model->getDatosRevisionMktd()->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }


    public function getDatosNuevasmkContraloria(){
      $dat =  $this->Comisiones_model->getDatosNuevasmkContraloria()->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }


    
    public function getDatosEnviadasmkContraloria(){
      $dat =  $this->Comisiones_model->getDatosEnviadasmkContraloria()->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
    
    
    public function getDatosEnviadasADirectorMK($as){
      ini_set('max_execution_time', 900);
      set_time_limit(900);
      ini_set('memory_limit','2048M');

      $dat =  $this->Comisiones_model->getDatosEnviadasADirectorMK($as)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
    
  
    public function revision_remanente()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      switch($this->session->userdata('id_rol')){
        case '31':
        $this->load->view('template/header');
        $this->load->view("ventas/revision_INTMEXremanente", $datos);
        break;

        default:
        $this->load->view('template/header');
        $this->load->view("ventas/revision_remanente", $datos);
        break;
      }

    }
 
    public function getDatosNuevasRContraloria($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatosNuevasRContraloria($proyecto,$condominio)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
    public function resguardos()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/revision_resguardo", $datos);
    }
 
    public function getDatosResguardoContraloria($user,$condominio){
      $dat =  $this->Comisiones_model->getDatosResguardoContraloria($user,$condominio)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }



     public function retiros()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/retiros", $datos);
    }
 
    public function getDatosRetirosContraloria($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatosRetirosContraloria($proyecto,$condominio)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }

     public function retiros_resguardo()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/retiros_dir", $datos);
    }

     public function historial_retiros()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/retiros_historial", $datos);
    }
 
    public function getDatoshistorialResguardoContraloria($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatoshistorialResguardoContraloria($proyecto,$condominio)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }



 

      /**--------------------------------------BONOS---------------------------------------- */
     
     


    /**--------------------------------------BONOS Y PRESTAMOS------------------------------------ */
  
    public function savePrestamo()
    {
      $this->input->post("pago");
      $pesos=str_replace(",", "", $this->input->post("monto"));
      $dato = $this->Comisiones_model->getPrestamoxUser($this->input->post("usuarioid"),$this->input->post("tipo"))->result_array();
      $tipo = $this->input->post("tipo");

      if(empty($dato)){
        $pesos=str_replace("$", "", $this->input->post("monto"));
        $comas =str_replace(",", "", $pesos);
        $pago = $comas;
        $pagoCorresp = $pago / $this->input->post("numeroP");
        $pagoCorresReal = $pagoCorresp;
        $dat =  $this->Comisiones_model->insertar_prestamos($this->input->post("usuarioid"),$pago,$this->input->post("numeroP"),$this->input->post("comentario"),$pagoCorresReal,$tipo);
        echo json_encode($dat);
      }else{
        $data = 3;
        echo json_encode($data);
      }

    }


  public function TienePago($id){
      $respuesta = $this->Comisiones_model->TienePago($id)->result_array();
    if(count($respuesta) > 0)
    {
      echo json_encode(1);
    }else{
      echo json_encode(0);
    }
      
 
  
  }

  public function BorrarPrestamo(){
    $respuesta =  $this->Comisiones_model->BorrarPrestamo($this->input->post("idPrestamo"));
  echo json_encode($respuesta);
  
  }

  public function InsertPago()
  { 
    $id_prestamo = $this->input->post('id_prestamo');

    $pago = $this->input->post('pago');
     $usuario = $this->input->post('id_usuario');

     $dato = $this->Comisiones_model->PagoCerrado($this->input->post('id_prestamo'))->result_array();
      if(!empty($dato)){
        $monto = $dato[0]['monto'];
        $abonado = $dato[0]['suma'];
       
      
      if($abonado >= $monto -.10 && $abonado <= $monto + .10){
        
        $row = $this->Comisiones_model->UpdatePrestamo($id_prestamo);
        $row=2;
        echo json_encode($row);
  
      }else{

        $row = $this->Comisiones_model->InsertPago($id_prestamo,$usuario,$pago,$this->session->userdata('id_usuario'));

        $dato = $this->Comisiones_model->PagoCerrado($this->input->post('id_prestamo'))->result_array();
        $monto = $dato[0]['monto'];
        $abonado = $dato[0]['suma'];
        if($abonado >= $monto -.10 && $abonado <= $monto + .10){
        
          $row = $this->Comisiones_model->UpdatePrestamo($id_prestamo);
          $row=2;
          //echo json_encode($row);
    
        }else{
          $row =1;
        }


        echo json_encode($row); 
      }
      }else{
        $row = $this->Comisiones_model->InsertPago($id_prestamo,$usuario,$pago,$this->session->userdata('id_usuario'));
        echo json_encode($row); 
      }

     

    
  }

  public function getHistorialPrestamo($id)
  {
    echo json_encode($this->Comisiones_model->getHistorialPrestamo($id)->result_array());
  }

  public function prestamo_colaborador()
  {
    
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/PanelPrestamo", $datos);
  }
  public function prestamos_historial()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/prestamos_historial", $datos);
  }

  public function getPrestamoPorUser($estado)
  {

   $res["data"] = $this->Comisiones_model->getPrestamoPorUser($this->session->userdata('id_usuario'),$estado)->result_array();

    echo json_encode($res);
  }
  public function UpdateRevisionPagos()
  { 
    $id_prestamo = $this->input->post('id_prestamo');    
        $row = $this->Comisiones_model->UpdateRevisionPagos($id_prestamo);
    echo json_encode($row);
  }
  public function getHistorialPrestamo2($id)
  {
    echo json_encode($this->Comisiones_model->getHistorialPrestamo2($id)->result_array());
  }

  public function getPrestamosAllUser($estado)
  {

   $res["data"] = $this->Comisiones_model->getPrestamosAllUser($estado)->result_array();

    echo json_encode($res);
  }

  public function getHistorialPrestamoContra($id)
  {
    echo json_encode($this->Comisiones_model->getHistorialPrestamoContra($id)->result_array());
  }
  public function solicitudes_prestamo()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/prestamos_solicitados", $datos);
  }
  public function bonos_historial_colaborador()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/bonos_historial_colaborador", $datos);
  }

  public function getBonosX_User()
  {

   $res["data"] = $this->Comisiones_model->getBonosX_User( $this->session->userdata('id_usuario'))->result_array();

    echo json_encode($res);
  }

  public function bonos_contraloria()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/bonos", $datos);
  }
  public function revision_bonos()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    if($this->session->userdata('id_rol') == 31){
      $this->load->view('template/header');
    $this->load->view("ventas/bonos_intmex", $datos);

    }else{
      $this->load->view('template/header');
      $this->load->view("ventas/bonos_solicitados", $datos);
    }
    
  }
  public function bonos_historial()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/bonos_historial", $datos);
  }
  public function bonos_colaborador()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/PanelBonos", $datos);
  }
  public function prestamos()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/prestamos", $datos);
  }

  public function saveBono()
  {
    $user =  $this->input->post("usuarioid");
    $dato = $this->db->query("SELECT id_usuario FROM bonos WHERE id_usuario = $user AND estatus = 1")->result_array();
    if(count($dato) <= 0){

      $pago=str_replace("$", "", $this->input->post("pago"));
      $comas =str_replace(",", "", $pago);

      $monto=str_replace("$", "", $this->input->post("monto"));
      $coma2 =str_replace(",", "", $monto);

      $pago = $comas;
      $monto = $coma2;

      $pagoCorresp = $coma2 / $this->input->post("numeroP");
      $pagoCorresReal = number_format($pagoCorresp, 2, '.', '');

      $dat =  $this->Comisiones_model->insertar_bono($this->input->post("usuarioid"),$this->input->post("roles"),$monto,$this->input->post("numeroP"),$pagoCorresReal,$this->input->post("comentario"),$this->session->userdata('id_usuario') );

      echo json_encode($dat);
    }else{
      $data = 3;
      echo json_encode($data);
    }
  }



  public function getHistorialAbono($id)
  {
    echo json_encode($this->Comisiones_model->getHistorialAbono($id)->result_array());
  }
  public function getHistorialAbono2($id)
  {
    echo json_encode($this->Comisiones_model->getHistorialAbono2($id)->result_array());
  }

 
  public function InsertAbono()
  { 
    $id_bono = $this->input->post('id_bono');
    
    $pago = $this->input->post('pago');
     $usuario = $this->input->post('id_usuario');

     $dato = $this->Comisiones_model->BonoCerrado($this->input->post('id_bono'))->result_array();
    // echo var_dump($dato);
      if(!empty($dato)){
       
        $abonado = 0;
        for ($i=0; $i <count($dato) ; $i++) { 
         
        $abonado = $abonado + $dato[$i]['suma'];
        }
   //     echo $abonado;
        $monto = $dato[0]['monto'];
         $cuantos = count($dato);
        $n_p=($dato[$cuantos -1]['n_p'] +1);
       
      
      if($abonado >= $monto -.30 && $abonado <= $monto + .30){
        
        $row = $this->Comisiones_model->UpdateAbono($id_bono);
        $row=2;
        echo json_encode($row);
  
      }else{

        $row = $this->Comisiones_model->InsertAbono($id_bono,$usuario,$pago,$this->session->userdata('id_usuario'),$n_p);

        $dato = $this->Comisiones_model->BonoCerrado($this->input->post('id_bono'))->result_array();
        $monto = $dato[0]['monto'];
        $abonado = 0;
        for ($i=0; $i <count($dato) ; $i++) { 
         
        $abonado = $abonado + $dato[$i]['suma'];
        }
        if($abonado >= $monto -.30 && $abonado <= $monto + .30){
        
          $row = $this->Comisiones_model->UpdateAbono($id_bono);
          $row=2;
          //echo json_encode($row);
    
        }else{
          $row =1;
        }


        echo json_encode($row); 
      }
      }else{
        $row = $this->Comisiones_model->InsertAbono($id_bono,$usuario,$pago,$this->session->userdata('id_usuario'),1);
        echo json_encode($row); 
      }

     

    
  }

  public function UpdateRevision()
  { 
    $id_bono = $this->input->post('id_abono');    
        $row = $this->Comisiones_model->UpdateRevision($id_bono);
    echo json_encode($row);
  }
  public function getBonos()
  {
   $res["data"] = $this->Comisiones_model->getBonos()->result_array();

    echo json_encode($res);
  }
  public function getBonosPorUser($estado)
  {

   $res["data"] = $this->Comisiones_model->getBonosPorUser($this->session->userdata('id_usuario'),$estado)->result_array();

    echo json_encode($res);
  }
 

  public function getBonosAllUser($a,$b){
    $dat =  $this->Comisiones_model->getBonosAllUser($a,$b)->result_array();
   for( $i = 0; $i < count($dat); $i++ ){
       $dat[$i]['pa'] = 0;
   }
   echo json_encode( array( "data" => $dat));
  }




  public function getBonosPorUserContra($estado)
  {

   $dat = $this->Comisiones_model->getBonosPorUserContra($estado)->result_array();
   for( $i = 0; $i < count($dat); $i++ ){
    $dat[$i]['pa'] = 0;
  }
  echo json_encode( array( "data" => $dat));
}
  public function enviarBonosMex($idbono){
   $estatus=6;
   if($this->session->userdata('id_rol') == 31){
    $estatus=3;
  }else if($this->session->userdata('id_rol') == 18){
    $estatus=2;
  }
  $ids = explode(',',$idbono);
  for ($i=0; $i <count($ids) ; $i++) { 

   $result = $this->Comisiones_model->UpdateINMEX($ids[$i],$estatus);
  }
  echo json_encode($result);
  }
  
  public function prestamos_contraloria()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/prestamos", $datos);
  }
  public function getPrestamos()
  {
   $res["data"] = $this->Comisiones_model->getPrestamos()->result_array();

    echo json_encode($res);
  }
  public function getUsuariosRol($rol,$opc = '')
  {
    if($opc == ''){
      echo json_encode($this->Comisiones_model->getUsuariosRol($rol)->result_array());
    }else{
      echo json_encode($this->Comisiones_model->getUsuariosRol($rol,$opc)->result_array());

    }
  }
  public function getUsuariosRol2($rol)
  {
    echo json_encode($this->Comisiones_model->getUsuariosRol2($rol)->result_array());
  }

public function getUsuariosRolBonos($rol)
  {
    echo json_encode($this->Comisiones_model->getUsuariosRolBonos($rol)->result_array());
  }

public function getUsuariosRolDU($rol)
  {
    echo json_encode($this->Comisiones_model->getUsuariosRolDU($rol)->result_array());
  }


  public function TieneAbonos($id){

 
   $respuesta = $this->Comisiones_model->TieneAbonos($id)->result_array();


  if(count($respuesta) > 0)
  {
    echo json_encode(1);
  }else{
    echo json_encode(0);
  }
     

 
 }

 public function BorrarBono(){
  // echo $this->input->post("id_bono");

  $respuesta =  $this->Comisiones_model->BorrarBono($this->input->post("id_bono"));
echo json_encode($respuesta);

}




    /**-------------------------------FIN DE BONOS Y PRESTAMOS--------------------------------------------- */
   



    /**.----------------------INICIO DESCUENTOS-------------------------------- */

public function descuentos_contraloria()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/descuentos", $datos);
  }
  public function descuentos_contra()
  {

    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/descuentos_contra", $datos);
  }
public function descuentos_historial()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/historial_descuentos", $datos);
  }


  public function getLotesOrigen($user,$valor)
  {
    echo json_encode($this->Comisiones_model->getLotesOrigen($user,$valor)->result_array());
  }
  public function getLotesOrigen2($user,$valor)
  {
    
    echo json_encode($this->Comisiones_model->getLotesOrigen2($user,$valor));
  } 

   public function getLotesOrigenResguardo($user)
  {
    echo json_encode($this->Comisiones_model->getLotesOrigenResguardo($user)->result_array());
  }

  public function getInformacionData($lote,$valor)
  {
    echo json_encode($this->Comisiones_model->getInformacionData($lote,$valor)->result_array());
  }

   public function getInformacionDataResguardo($lote)
  {
    echo json_encode($this->Comisiones_model->getInformacionDataResguardo($lote)->result_array());
  }


  
   
   
  public function saveDescuento($valor) {
      $saldo_comisiones = $this->input->post('saldo_comisiones');

    
      $LotesInvolucrados = "";

  if(floatval($valor) == 1){
    $datos =  $this->input->post("idloteorigen[]");
    $descuento = $this->input->post("monto");
    $usuario = $this->input->post("usuarioid");
    $comentario = $this->input->post("comentario");
    $pagos_apli = 0;
    $descuent0 = str_replace(",",'',$descuento);
    $descuento = str_replace("$",'',$descuent0);
    
  }else if(floatval($valor) == 2){

    $datos =  $this->input->post("idloteorigen2[]");
    $descuento = $this->input->post("monto2");
    $usuario = $this->input->post("usuarioid2");
    $comentario = $this->input->post("comentario2");
    $pagos_apli = 0;
    $descuent0 = str_replace(",",'',$descuento);
  $descuento = str_replace("$",'',$descuent0);
  
  }
  else if(floatval($valor) == 3){
    /**DESCUENTOS UNIVERSIDAD*/
    $datos =  $this->input->post("idloteorigen[]");
    $desc =  $this->input->post("monto");
    $usuario = $this->input->post("usuarioid");
    $comentario = $this->input->post("comentario");
    if($comentario == 'DESCUENTO UNIVERSIDAD MADERAS'){
      $cuantosLotes = count($datos);
      $comentario=0;
      for($i=0; $i <$cuantosLotes ; $i++) 
      { 
          $formatear = explode(",",$datos[$i]);
          $idComent = $formatear[0]; 
          $montoComent = $formatear[1];
          $pago_neodataComent = $formatear[2];
          $nameLoteComent = $formatear[3];
          $LotesInvolucrados =  $LotesInvolucrados." ".$nameLoteComent.",\n"; // Disponible: $".number_format($montoComent, 2, '.', ',')."\n"; 
      }
    }
    $pagos_apli = intval($this->input->post("pagos_aplicados"));
        $descuent0 = str_replace(",",'',$desc);
      $descuento = str_replace("$",'',$descuent0);
  }

      $cuantos = count($datos); 
      if($cuantos > 1){
        $sumaMontos = 0;
        for($i=0; $i <$cuantos ; $i++) { 
          if($i == $cuantos-1){
            $formatear = explode(",",$datos[$i]);
            $id = $formatear[0]; 
            $monto = $formatear[1];
            $pago_neodata = $formatear[2];
          $montoAinsertar = $descuento - $sumaMontos;
          $Restante = $monto - $montoAinsertar;
          $comision = $this->Comisiones_model->obtenerID($id)->result_array();
          if($valor == 2){
            $dat =  $this->Comisiones_model->update_descuentoEsp($id,$Restante,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario);
          $dat =  $this->Comisiones_model->insertar_descuentoEsp($usuario,$montoAinsertar,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
          
          }else{
            $num = $i +1;
            if($comentario == 0 && floatval($valor) == 3){
              $nameLote = $formatear[3];

              $comentario = "DESCUENTO UNIVERSIDAD MADERAS LOTES INVOLUCRADOS:  $LotesInvolucrados (TOTAL DESCUENTO: $desc ), ".$num."° LOTE A DESCONTAR $nameLote, MONTO DISPONIBLE: $".number_format(floatval($monto), 2, '.', ',').", DESCUENTO DE: $".number_format(floatval($montoAinsertar), 2, '.', ',').", RESTANTE: $".number_format(floatval($Restante), 2, '.', ',')."    ";
            }else{
              $comentario = $this->input->post("comentario");
            }
            $dat =  $this->Comisiones_model->update_descuento($id,$montoAinsertar,$comentario, $saldo_comisiones, $this->session->userdata('id_usuario'),$valor,$usuario,$pagos_apli);
          $dat =  $this->Comisiones_model->insertar_descuento($usuario,$Restante,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
          }
          }else{
            $formatear = explode(",",$datos[$i]);
            $id=$formatear[0];
            $monto = $formatear[1]; 
            $pago_neodata = $formatear[2];
            if($comentario == 0 && floatval($valor) == 3){
            $nameLote = $formatear[3];
            
              $num = $i +1;
              $comentario = "DESCUENTO UNIVERSIDAD MADERAS LOTES INVOLUCRADOS:  $LotesInvolucrados ( TOTAL DESCUENTO $desc ), ".$num."° LOTE A DESCONTAR $nameLote, MONTO DISPONIBLE: $".number_format(floatval($monto), 2, '.', ',').", DESCUENTO DE: $".number_format(floatval($monto), 2, '.', ',').", RESTANTE: $".number_format(floatval(0), 2, '.', ',')." ";
            }else{
              $comentario = $this->input->post("comentario");
            }
          $dat = $this->Comisiones_model->update_descuento($id,0,$comentario, $saldo_comisiones, $this->session->userdata('id_usuario'),$valor,$usuario, $pagos_apli);
          $sumaMontos = $sumaMontos + $monto;
          }

    
        }
  

      }else{
          $formatear = explode(",",$datos[0]);
          $id = $formatear[0];
          $monto = $formatear[1];
          $pago_neodata = $formatear[2];
          $montoAinsertar = $monto - $descuento;
          $Restante = $monto - $montoAinsertar;

          $comision = $this->Comisiones_model->obtenerID($id)->result_array();

          if($valor == 2){

          $dat =  $this->Comisiones_model->update_descuentoEsp($id,$montoAinsertar,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario);
            $dat =  $this->Comisiones_model->insertar_descuentoEsp($usuario,$Restante,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
          }else{
            $dat =  $this->Comisiones_model->update_descuento($id,$descuento,$comentario, $saldo_comisiones, $this->session->userdata('id_usuario'),$valor,$usuario,$pagos_apli);
            $dat =  $this->Comisiones_model->insertar_descuento($usuario,$montoAinsertar,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
  
          }
      }
      echo json_encode($dat);    
    }


//   public function saveDescuento($valor)
//   {

// if($valor == 1){
// //   $datos =  $this->input->post("idloteorigen[]");
// //   $descuento = $this->input->post("monto");
// //   $usuario = $this->input->post("usuarioid");
// //   $comentario = $this->input->post("comentario");
// //   $pagos_aplica = 0;
  
// }else if($valor == 2){
//   echo("LLEGA A 2");
//   echo $valor;
//     $datos = $this->input->post("idloteorigen2[]");
//   // var_dump($datos)

//   $formatear = explode(",",$datos[$i]);
//           $id = $formatear[0]; 
//           $monto = $formatear[1];
//           $pago_neodata = $formatear[2];

//           echo ' este es id '.$formatear[0];

// //   $descuento = $this->input->post("monto2");
// //   $usuario = $this->input->post("usuarioid2");
// //   $comentario = $this->input->post("comentario2");
// //   $pagos_aplica = 0;
 
// }
// else if($valor == 3){
// //   $datos =  $this->input->post("idloteorigen[]");
// //   $desc =  $this->input->post("monto");
// //   $usuario = $this->input->post("usuarioid");
// //   $comentario = $this->input->post("comentario");
// //   $pagos_apli = intval($this->input->post("pagos_aplicados"));
// //        $descuent0 = str_replace(",",'',$desc);
// //      $descuento = str_replace("$",'',$descuent0);
// }

//     // $cuantos = count($datos); 
//     // if($cuantos > 1){
//     //   $sumaMontos = 0;
//     //   for($i=0; $i <$cuantos ; $i++) { 
//     //     if($i == $cuantos-1){
//     //       $formatear = explode(",",$datos[$i]);
//     //       $id = $formatear[0]; 
//     //       $monto = $formatear[1];
//     //       $pago_neodata = $formatear[2];
//     //      $montoAinsertar = $descuento - $sumaMontos;
//     //      $Restante = $monto - $montoAinsertar;
//     //      $comision = $this->Comisiones_model->obtenerID($id)->result_array();
//     //     if($valor == 2){
//     //       $dat =  $this->Comisiones_model->update_descuentoEsp($id,$Restante,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario);
//     //       $dat =  $this->Comisiones_model->insertar_descuentoEsp($usuario,$montoAinsertar,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
         
//     //      }else{
//     //       $dat =  $this->Comisiones_model->update_descuento($id,$montoAinsertar,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario,$pagos_apli);
//     //       $dat =  $this->Comisiones_model->insertar_descuento($usuario,$Restante,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
//     //      }
//     //     }else{
//     //       $formatear = explode(",",$datos[$i]);
//     //        $id=$formatear[0];
//     //       $monto = $formatear[1]; 
//     //      $dat = $this->Comisiones_model->update_descuento($id,0,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario, $pagos_apli);
//     //      $sumaMontos = $sumaMontos + $monto;
//     //     }

  
//     //   }
 

//     // }else{
//          // $formatear = explode(",",$datos[0]);
//          // $id = $formatear[0];
//          // $monto = $formatear[1];
//          // $pago_neodata = $formatear[2];
//          // $montoAinsertar = $monto - $descuento;
//          // $Restante = $monto - $montoAinsertar;

//          // $comision = $this->Comisiones_model->obtenerID($id)->result_array();

//          // if($valor == 2){

//           // echo 'ID '.$id;
//           // echo 'montoAinsertar '.$montoAinsertar;
//           // echo 'comentario '.$comentario;
//           // echo 'session '.$this->session->userdata('id_usuario');
//           // echo 'valor '.$valor;
//           // echo 'usuario '.$usuario;

//     //       // $dat =  $this->Comisiones_model->update_descuentoEsp($id,$montoAinsertar,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario);
//     //       // $dat =  $this->Comisiones_model->insertar_descuentoEsp($usuario,$Restante,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
//     //      }else{
//     //       $dat =  $this->Comisiones_model->update_descuento($id,$descuento,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario,$pagos_apli);
//     //       $dat =  $this->Comisiones_model->insertar_descuento($usuario,$montoAinsertar,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor);
 
//     //      }
//     // }
//     // // echo json_encode($dat); 
//     // echo "NO APARECE NADA";   
//     }

public function getDescuentos2()
{
  $res["data"] = $this->Comisiones_model->getDescuentos2()->result_array();
  echo json_encode($res);
}

public function saveDescuentoch()
{
    $usuario = $this->input->post("usuarioid2");
    $descuento = $this->input->post("descuento");
    $comentario = $this->input->post("comentario2"); 
    $monto0 = str_replace(",",'',$this->input->post('pago_ind01'));
    $monto = str_replace("$",'',$monto0);
    $dat =  $this->Comisiones_model->insertar_descuentoch($usuario, $descuento, $comentario,  $monto, $this->session->userdata('id_usuario')); 
    echo json_encode($dat);
}
    public function getDescuentos()
    {
      $res["data"] = $this->Comisiones_model->getDescuentos()->result_array();
      echo json_encode($res);
    }
    public function getDescuentosCapital()
    {
      $res["data"] = $this->Comisiones_model->getDescuentosCapital()->result_array();
      echo json_encode($res);
    }

    public function getDescuentosCapitalpagos(){
        echo json_encode( $this->Comisiones_model->getDescuentosCapital( $this->input->post("id_usuario") ) );
    }

    public function getRetiros($user,$opc)
    {
      $res["data"] = $this->Comisiones_model->getRetiros($user,$opc)->result_array();
      echo json_encode($res);
    }

    public function getHistorialDescuentos($proyecto,$condominio)
    {
      $res["data"] = $this->Comisiones_model->getHistorialDescuentos($proyecto,$condominio)->result_array();
      echo json_encode($res);
    }

    public function getHistorialRetiros($proyecto,$condominio)
    {
      $res["data"] = $this->Comisiones_model->getHistorialRetiros($proyecto,$condominio)->result_array();
      echo json_encode($res);
    }

    


     public function BorrarDescuento(){

  $respuesta =  $this->Comisiones_model->BorrarDescuento($this->input->post("id_descuento"));
echo json_encode($respuesta);

}

     public function UpdateDescuento(){

  $respuesta =  $this->Comisiones_model->UpdateDescuento($this->input->post("id_descuento"));
echo json_encode($respuesta);

}



// public function UpdateRetiro(){
//   // echo $this->input->post("id_bono");

//   $respuesta =  $this->Comisiones_model->UpdateRetiro($this->input->post("id_descuento"));
// echo json_encode($respuesta);

// }


  // public function getDatosHistorialPostventa()
  // {
  //   echo json_encode($this->Comisiones_model->getDatosHistorialPostventa()->result_array());
  // }


   public function getDatosHistorialPostventa()
  {
   $res["data"] = $this->Comisiones_model->getDatosHistorialPostventa()->result_array();

    echo json_encode($res);
  }


  
  public function historialTotalLote()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/historial_postventa", $datos);
  }

  public function getCommissionsByMktdUserReport(){
      if (isset($_POST) && !empty($_POST)) {
          $typeTransaction = $this->input->post("typeTransaction");
          $beginDate = date("Y-m-d", strtotime($this->input->post("beginDate")));
          $endDate = date("Y-m-d", strtotime($this->input->post("endDate")));
          $where = $this->input->post("where");
          $estatus = $this->input->post("estatus");
          $data['data'] = $this->Comisiones_model->getCommissionsByMktdUserReport($estatus,$typeTransaction, $beginDate, $endDate, $where)->result_array();
          echo json_encode($data);
      } else {
          json_encode(array());
      }


    /*$data =  $this->Comisiones_model->getCommissionsByMktdUserReport($fecha1,$fecha2,$estatus)->result_array();
    echo json_encode( array( "data" => $data));*/
  }
  public function getCommissionsByMktdUser(){
      if (isset($_POST) && !empty($_POST)) {
          $typeTransaction = $this->input->post("typeTransaction");
          $beginDate = date("Y-m-d", strtotime($this->input->post("beginDate")));
          $endDate = date("Y-m-d", strtotime($this->input->post("endDate")));
          $where = $this->input->post("where");
          $estatus = $this->input->post("estatus");
          $data['data'] = $this->Comisiones_model->getCommissionsByMktdUser($estatus,$typeTransaction, $beginDate, $endDate, $where)->result_array();
          echo json_encode($data);
      } else {
          json_encode(array());
      }

    /*$data =  $this->Comisiones_model->getCommissionsByMktdUser($fecha1,$fecha2,$estatus)->result_array();
    echo json_encode( array( "data" => $data));*/
  }
  // public function getCommissionsByMktdUser(){
  //   $data =  $this->Comisiones_model->getCommissionsByMktdUser()->result_array();
  //   echo json_encode( array( "data" => $data));
  // }


  /**REPORTE JOSH */
  public function reportPz()
  {
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/reportAllpzr28", $datos);
  }


  
  public function getDataDispersionPagoReport()
  {
    $datos = array();
    $datos = $this->Comisiones_model->getDataDispersionPagoReport();
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }
  /**-------------- */

  public function getEstatusPagosMktd()
  {
    $datos = $this->Comisiones_model->getEstatusPagosMktd();
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }


    public function cobranza_reporte()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/cobranza_reporte", $datos);
  }

      public function cobranza_ranking()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/cobranza_ranking", $datos);
  }


    public function getDatosCobranzaRanking($a,$b)
  {
    $datos = array();
    $datos = $this->Comisiones_model->getDatosCobranzaRanking($a,$b);
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }




   // public function getDatosCobranzaReporte($a,$b){
   //    $dat =  $this->Comisiones_model->getDatosCobranzaReporte($a,$b)->result_array();
   //   for( $i = 0; $i < count($dat); $i++ ){
   //       $dat[$i]['pa'] = 0;
   //   }
   //   echo json_encode( array( "data" => $dat));
   //  }
    


   public function getDatosCobranzaReporte($a,$b)
  {
    $datos = array();
    $datos = $this->Comisiones_model->getDatosCobranzaReporte($a,$b);
    if ($datos != null) {
      echo json_encode($datos);
    } else {
      echo json_encode(array());
    }
  }




    public function cobranza_dinamic()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/cobranza_dinamic", $datos);
  }

 


   public function getDatosCobranzaDimamic($a,$b,$c,$d){
      $dat =  $this->Comisiones_model->getDatosCobranzaDimamic($a,$b,$c,$d)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }



        public function cobranza_indicador()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/cobranza_indicador", $datos);
  }

 


   public function getDatosCobranzaIndicador($a,$b){
      $dat =  $this->Comisiones_model->getDatosCobranzaIndicador($a,$b)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
    

  public function listSedes()
    {
        echo json_encode($this->Comisiones_model->listSedes()->result_array());
    }

  public function listGerentes($sede)
    {
        echo json_encode($this->Comisiones_model->listGerentes($sede)->result_array());
    }

    
 function agregar_comentarios(){
  $respuesta = array( FALSE );
  if($this->input->post("comentario")){
     $respuesta = array($this->Comisiones_model->agregar_comentarios($this->input->post("lote"), $this->input->post("cliente"), 0, $this->input->post("fecha"), $this->input->post("comentario")));
  }
  echo json_encode( $respuesta );
}


    public function getDirectivos() {

        $data = $this->Comisiones_model->getDirectivos();
        if($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode(array());
        }
        exit;
//      for ($i=0; $i < count($data['condominios']); $i++) {
//          echo "<option idCondominio='".$data['condominios'][$i]['idCondominio']."' value='".$data['condominios'][$i]['idCondominio']."'>".$data['condominios'][$i]['nombre']." "."(".$data['condominios'][$i]['nombreResidencial'].")"."</option>";
//      }
    }
  


      public function getDirectivos2() {

        $data = $this->Comisiones_model->getDirectivos2();
        if($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode(array());
        }
        exit;
//      for ($i=0; $i < count($data['condominios']); $i++) {
//          echo "<option idCondominio='".$data['condominios'][$i]['idCondominio']."' value='".$data['condominios'][$i]['idCondominio']."'>".$data['condominios'][$i]['nombre']." "."(".$data['condominios'][$i]['nombreResidencial'].")"."</option>";
//      }
    }
  

    public function changeCommissionAgent()
    {
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $datos = array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace('' . base_url() . '', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
        $this->load->view('template/header');
        $this->load->view("ventas/changeCommissionAgent", $datos);
    }

    public function getMktdCommissionsList()
    {
        $datos = array();
        $datos = $this->Comisiones_model->getMktdCommissionsList();
        if ($datos != null) {
            echo json_encode($datos);
        } else {
            echo json_encode(array());
        }
    }

    public function addRemoveMktd()
    {
        $type_transaction = $this->input->post("type_transaction");
        $comments = $this->input->post("comments");
        $id_lote = $this->input->post("id_lote");
        $id_cliente = $this->input->post("id_cliente");
        $clientes_data = array(
            "fecha_modificacion" => date("Y-m-d H:i:s"),
            "modificado_por" => $this->session->userdata('id_usuario')
        );

        $lote_data = $this->Comisiones_model->getLoteInformation($id_lote);
        $insert_comisiones_data = array(
            "id_lote" => $lote_data[0]['idLote'],
            "id_usuario" => $type_transaction == 1 ? 4394 : 4824,
            "comision_total" => $lote_data[0]['totalNeto2'] * 0.01,
            "estatus" => 1,
            "observaciones" => $comments,
            "evidencia" => NULL,
            "factura" => NULL,
            "creado_por" => $this->session->userdata('id_usuario'),
            "fecha_creacion" => date("Y-m-d H:i:s"),
            "porcentaje_decimal" => 1,
            "fecha_autorizacion" => date("Y-m-d H:i:s"),
            "rol_generado" => $type_transaction == 1 ? 38 : 45,
            "descuento" => 0,
            "modificado_por" =>$this->session->userdata('id_usuario')
        );
        if ($type_transaction == 1) { // ADD MKTD

          $commission_data = $this->Comisiones_model->getCommisionInformation($id_lote); // MJ: SE OBTIENEN TODOS LOS REGISTROS DE COMISIÓN
          if (COUNT($commission_data) > 0) { // MJ: SE ENCONTRÓ REGISTRO EN COMISIONES
              //$cce_data = $this->Comisiones_model->getCompanyCommissionEntry($id_lote, 4394); // MJ: SE BUSCA EL REGISTRO DE COMISIÓN DE EMPRESA SI HAY UNO YA NO SE INSERTA
              $cce_data = $this->Comisiones_model->getCompanyCommissionEntryEmpMktd($id_lote);
              if (COUNT($cce_data) <= 0) { // MJ: SI HAY REGISTRO DE COMISIONES, ENTONCES NO INSERTAMOS LA EMPRESA SINO SÍ 
                $this->Comisiones_model->addRecord("comisiones", $insert_comisiones_data); // MJ: LLEVA 2 PARÁMETROS $table, $data                
              } else {
                $countRegister = count($cce_data);
                if(count($cce_data) == 1){
                    if($cce_data[0]['id_usuario'] == 4824){
                      //EMPRESA
                      //VERIFICAR SI HAY PAGOS DE EMPREA, SI HAY PAGOS QUE NO SEAN NUEVOS, SE TOPA LA EMPRESA SI NO SE CAMBIOA DE USUARIO
                      $pci_data = $this->Comisiones_model->getIndividualPaymentInformation($id_lote, 4824);
                      if (COUNT($pci_data) > 0) { // MJ: SE ENCONTRARON REGISTROS EN pago_comision_ind CON ESTATUS PAGADO
                       $respuesta = $this->Comisiones_model->ToparComision($pci_data[0]['id_comision'],$comments);
                         $this->Comisiones_model->addRecord("comisiones", $insert_comisiones_data); // MJ: LLEVA 2 PARÁMETROS $table, $data                
                      } else{
                       // MJ: SE OBTIENEN TODOS LOS PAGOS DISTINTOS A 11 Y 8
                       $pci_others_data = $this->Comisiones_model->getIndividualPaymentWPInformation($id_lote, 4824);

                        if(count($pci_others_data) > 0){
                          //HAY PAGOS QUE SE PUEDEN EDITAR
                          $update_pago_data = array(
                            "id_usuario" => 4394,
                            "modificado_por" =>$this->session->userdata('id_usuario')

                          );
                          $update_comisiones_data = array(
                            "id_usuario" => 4394,
                            "rol_generado" => 38,
                            "modificado_por" =>$this->session->userdata('id_usuario')    
                          );
                      $this->Comisiones_model->updateRecord("pago_comision_ind", $update_pago_data, "id_comision", $pci_others_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
                      $this->Comisiones_model->updateRecord("comisiones", $update_comisiones_data, "id_comision", $pci_others_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
                        }else{
                          $update_comisiones_data = array(
                            "id_usuario" => 4394,
                            "rol_generado" => 38,
                            "modificado_por" =>$this->session->userdata('id_usuario')    
                          );
                          $this->Comisiones_model->updateRecord("comisiones", $update_comisiones_data, "id_comision", $pci_others_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
                        }
                    }
                    }else{

                    }
                }
                
              }
            }
            // UPDATE CLIENT PROSPECTING PLACE
            $clientes_data["lugar_prospeccion"] = 6;
            $clientes_data["plan_comision"] = 0;
            $this->Comisiones_model->updateRecord("clientes", $clientes_data, "id_cliente", $lote_data[0]['idCliente']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
            echo json_encode(1);   
        } else if ($type_transaction == 2) { // REMOVE MKTD
          date_default_timezone_set('America/Mexico_City');
          $flag=0;
          $hoy = date('Y-m-d H:i:s');
          $controversia = $this->Comisiones_model->getEvidenceInformation($id_lote,$lote_data[0]['idCliente']);

            $commission_data = $this->Comisiones_model->getCommisionInformation($id_lote); // MJ: SE OBTIENEN TODOS LOS REGISTROS DE COMISIÓN
            if (COUNT($commission_data) > 0) { // MJ: SE ENCONTRARON REGISTROS EN pago_comision_ind CON ESTATUS PAGADO
              //MO - SI SE ENCONTRO REGISTRO EN COMISIONES SE TOPA LA COMISIÓN 
                for ($i=0; $i <count($commission_data) ; $i++) { 
                  if($commission_data[$i]['id_usuario'] == 4394){
                    $this->Comisiones_model->ToparComision($commission_data[$i]['id_comision'],$comments);
                  }
                  if($commission_data[$i]['id_usuario'] == 4824){
                    $flag =1;

                  }
                }
                if($flag == 0){
                  $this->Comisiones_model->addRecord("comisiones", $insert_comisiones_data,1); // MJ: LLEVA 2 PARÁMETROS $table, $data 
                }

                //ACTUALIZAR CLIENTES Y PROSPECTOS
                if(count($controversia) > 0)  
            {
              $this->Comisiones_model->updateControversia($id_lote,$lote_data[0]['idCliente']);
            }
             
                $update_client_data = array(
                  "lugar_prospeccion" => 11,
                  "modificado_por" => 1,
                  "fecha_modificacion" => $hoy        
                );
                $this->Comisiones_model->updateRecord("clientes", $update_client_data, "id_cliente", $lote_data[0]['idCliente']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
                $this->Comisiones_model->updateRecord("prospectos", $update_client_data, "id_prospecto", $lote_data[0]['id_prospecto']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value

                // MJ: SE TOPA LA COMISIÓN DE MKTD TOMANDO EN CUANTO EL TOTAL DE ABONOS EN ESTATUS 11
            } else{ // MJ: NO SE ENCONTRARON REGISTROS EN pago_comision_ind CON ESTATUS PAGADO
             
            //     
            if(count($controversia) > 0)  
            {
              $this->Comisiones_model->updateControversia($id_lote,$lote_data[0]['idCliente']);
            }
                        
              $update_client_data = array(
                "lugar_prospeccion" => 11,
                "modificado_por" => 1,
                "fecha_modificacion" => $hoy        
              );
              $this->Comisiones_model->updateRecord("clientes", $update_client_data, "id_cliente", $lote_data[0]['idCliente']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
              $this->Comisiones_model->updateRecord("prospectos", $update_client_data, "id_prospecto", $lote_data[0]['id_prospecto']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value

              }
            // MJ: INSERT PARA AGREGAR LA EMPRESA A COMISIONES

            // MJ: SE CAMBIA LUGAR DE PROSPECCIÓN DEL CLIENTE DE 6 A 11
            if ($this->session->userdata('id_rol') == 19 || $this->session->userdata('id_rol') == 20 || $this->session->userdata('id_rol') == 28) {
              $insert_comentariosMktd_data = array('idLote' => $id_lote, 'observacion' => $comments, 'fecha_creacion' => date('Y-m-d H:i:s'), 'creado_por' => $this->session->userdata('id_usuario'), 'id_cliente' => $id_cliente);
              $this->Comisiones_model->addRecord("comentariosMktd", $insert_comentariosMktd_data); // MJ: LLEVA 2 PARÁMETROS $table, $data
            }

            echo json_encode(1);
        }

      }
    /*public function addRemoveMktd()
    {
        $type_transaction = $this->input->post("type_transaction");
        $comments = $this->input->post("comments");
        $id_lote = $this->input->post("id_lote");
        $clientes_data = array(
            "fecha_modificacion" => date("Y-m-d H:i:s"),
            "modificado_por" => $this->session->userdata('id_usuario')
        );
        $lote_data = $this->Comisiones_model->getLoteInformation($id_lote);
        $insert_comisiones_data = array(
            "id_lote" => $lote_data[0]['idLote'],
            "id_usuario" => $type_transaction == 1 ? 4394 : 4824,
            "comision_total" => $lote_data[0]['totalNeto2'] * 0.01,
            "estatus" => 1,
            "observaciones" => $comments,
            "evidencia" => NULL,
            "factura" => NULL,
            "creado_por" => $this->session->userdata('id_usuario'),
            "fecha_creacion" => date("Y-m-d H:i:s"),
            "porcentaje_decimal" => 1,
            "fecha_autorizacion" => date("Y-m-d H:i:s"),
            "rol_generado" => $type_transaction == 1 ? 38 : 45,
            "descuento" => 0
        );
        if ($type_transaction == 1) { // ADD MKTD
          $commission_data = $this->Comisiones_model->getCommisionInformation($id_lote); // MJ: SE OBTIENEN TODOS LOS REGISTROS DE COMISIÓN
          if (COUNT($commission_data) > 0) { // MJ: SE ENCONTRÓ REGISTRO EN COMISIONES
              $cce_data = $this->Comisiones_model->getCompanyCommissionEntry($id_lote, 4394); // MJ: SE BUSCA EL REGISTRO DE COMISIÓN DE EMPRESA SI HAY UNO YA NO SE INSERTA
              if (COUNT($cce_data) <= 0) { // MJ: SI HAY REGISTRO DE COMISIONES, ENTONCES NO INSERTAMOS LA EMPRESA SINO SÍ 
                $this->Comisiones_model->addRecord("comisiones", $insert_comisiones_data); // MJ: LLEVA 2 PARÁMETROS $table, $data                
              } else {
                $update_comisiones_data = array(
                  "comision_total" => $lote_data[0]['totalNeto2'] * 0.01,
                  "observaciones" => $comments,
                  "estatus" => 1         
                );
                // MJ: SE TOPA LA COMISIÓN DE MKTD TOMANDO EN CUANTO EL TOTAL DE ABONOS EN ESTATUS 11
                $this->Comisiones_model->updateRecord("comisiones", $update_comisiones_data, "id_comision", $cce_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
              }
            }
            // UPDATE CLIENT PROSPECTING PLACE
            $clientes_data["lugar_prospeccion"] = 6;
            $this->Comisiones_model->updateRecord("clientes", $clientes_data, "id_cliente", $lote_data[0]['idCliente']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
            echo json_encode(1);
        } else if ($type_transaction == 2) { // REMOVE MKTD
            $commission_data = $this->Comisiones_model->getCommisionInformation($id_lote); // MJ: SE OBTIENEN TODOS LOS REGISTROS DE COMISIÓN
            $pci_data = $this->Comisiones_model->getIndividualPaymentInformation($id_lote, 4394); // MJ: SE OBTIENEN TODOS LOS PAGOS EN 11 PARA TOPAR EN COMISIONES
            $pci_others_data = $this->Comisiones_model->getIndividualPaymentWPInformation($id_lote, 4394); // MJ: SE OBTIENEN TODOS LOS PAGOS DISTINTOS A 11 Y 8
            if (COUNT($pci_data) > 0) { // MJ: SE ENCONTRARON REGISTROS EN pago_comision_ind CON ESTATUS PAGADO
                $update_comisiones_data = array(
                    "comision_total" => $pci_data[0]['abonado'],
                    "observaciones" => $comments,
                    "estatus" => 2            
                );
                // MJ: SE TOPA LA COMISIÓN DE MKTD TOMANDO EN CUANTO EL TOTAL DE ABONOS EN ESTATUS 11
                $this->Comisiones_model->updateRecord("comisiones", $update_comisiones_data, "id_comision", $pci_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
            } else { // MJ: NO SE ENCONTRARON REGISTROS EN pago_comision_ind CON ESTATUS PAGADO
                $cce_data = $this->Comisiones_model->getCompanyCommissionEntry($id_lote, 4394); // MJ: SE BUSCA EL REGISTRO DE COMISIÓN DE EMPRESA SI HAY UNO YA NO SE INSERTA
                $update_comisiones_data = array(
                    "observaciones" => $comments,
                    "estatus" => 2              
                );
                // MJ: SE TOPA LA COMISIÓN DE MKTD TOMANDO EN CUANTO EL TOTAL DE ABONOS EN ESTATUS 11
                $this->Comisiones_model->updateRecord("comisiones", $update_comisiones_data, "id_comision", $cce_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
            }
            // MJ: INSERT PARA AGREGAR LA EMPRESA A COMISIONES
            if (COUNT($commission_data) > 0) { // MJ: SE ENCONTRÓ REGISTRO EN COMISIONES
              $cce_data = $this->Comisiones_model->getCompanyCommissionEntry($id_lote, 4824); // MJ: SE BUSCA EL REGISTRO DE COMISIÓN DE EMPRESA SI HAY UNO YA NO SE INSERTA
              if (COUNT($cce_data) <= 0) { // MJ: SI HAY REGISTRO DE COMISIONES, ENTONCES NO INSERTAMOS LA EMPRESA SINO SÍ 
                $this->Comisiones_model->addRecord("comisiones", $insert_comisiones_data); // MJ: LLEVA 2 PARÁMETROS $table, $data                
              }  else {
                $update_comisiones_data = array(
                  "comision_total" => $lote_data[0]['totalNeto2'] * 0.01,
                  "observaciones" => $comments,
                  "estatus" => 1         
                );
                // MJ: SE TOPA LA COMISIÓN DE MKTD TOMANDO EN CUANTO EL TOTAL DE ABONOS EN ESTATUS 11
                $this->Comisiones_model->updateRecord("comisiones", $update_comisiones_data, "id_comision", $cce_data[0]['id_comision']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
              }
            }
            
            if (COUNT($pci_others_data) > 0) { // MJ: SE ENCONTRARON REGISTROS EN pago_comision_ind CON ESTATUS DISTINTO A PAGADO O REVISIÓN INTERNOMEX
                $update_pci_data = array(
                    "abono_neodata" => 0,
                    "estatus" => 0, // MJ: ESTATUS PIVOTE PARA NO ELIMINAR LOS ABONOS HECHOS AL COMISIONISTA
                    "modificado_por" => $this->session->userdata('id_usuario'),
                    "comentario" => $comments
                );
                for ($i = 0; $i < COUNT($pci_others_data); $i++) { // MJ: SE ACTUALIZAN TODOS LOS REGISTROS DISTINTOS A 11 & 8 QUE FUERON ENCONTRADOS
                    $this->Comisiones_model->updateRecord("pago_comision_ind", $update_pci_data, "id_pago_i", $pci_others_data[0]['id_pago_i']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value
                }
            }
            // MJ: SE CAMBIA LUGAR DE PROSPECCIÓN DEL CLIENTE DE 6 A 11
            $clientes_data["lugar_prospeccion"] = 11;
            $this->Comisiones_model->updateRecord("clientes", $clientes_data, "id_cliente", $lote_data[0]['idCliente']); // MJ: LLEVA 4 PARÁMETROS $table, $data, $key, $value

            if ($this->session->userdata('id_rol') == 19 || $this->session->userdata('id_rol') == 20 || $this->session->userdata('id_rol') == 28) {
              $insert_comentariosMktd_data = array('idLote' => $id_lote, 'observacion' => $comments, 'fecha_creacion' => date('Y-m-d H:i:s'), 'creado_por' => $this->session->userdata('id_usuario'));
              $this->Comisiones_model->addRecord("comentariosMktd", $insert_comentariosMktd_data); // MJ: LLEVA 2 PARÁMETROS $table, $data
            }

            echo json_encode(1);
        }

      }*/



      public function getGeneralStatusFromNeodata($proyecto, $condominio)
      {
  
        $this->load->model('ComisionesNeo_model');
  
          $datos = $this->ComisionesNeo_model->getLotesByAdviser($proyecto, $condominio);
          if(COUNT($datos) > 0){
              $data = array();
              $final_data = array();
              $contador = 0;
              for($i = 0; $i < COUNT($datos); $i++){
                  $data[$i] = $this->ComisionesNeo_model->getGeneralStatusFromNeodata($datos[$i]['referencia'], $datos[$i]['idResidencial']);
               //  echo var_dump($data);
                  // if($data[$i]->Marca != 1){
                      $final_data[$contador] = $this->ComisionesNeo_model->getLoteInformation($datos[$i]['idLote']);
                      //array_push($final_data, $data[$i]->Marca);
                      $final_data[$contador]->reason = $data[$i]->Marca;
                      $contador ++;
                  // }
              }
              if (COUNT($final_data) > 0) {
                  echo json_encode(array("data" => $final_data));
              } else {
                  echo json_encode(array("data" => ''));
              }
          }
          else{
              echo json_encode(array("data" => ''));
          }
      }

      public function carga_listado_factura(){
        echo json_encode( $this->Comisiones_model->get_solicitudes_factura( $this->input->post("idResidencial"), $this->input->post("id_usuario") ) );
    }

 /**-------------------------MKTD COMPARTIDAS------------------------ */

 public function MKTD_compartida()
 {

   /**SE VERIFICA SI MKTD TIENE PAGOS DE ESTE LOTE EN OTROS ESTATUS QUE NO SEA NUEVO */
   $verificar = $this->Comisiones_model->VerificarMKTD($this->input->post('idLote'))->result_array();
//print_r ($verificar);
   if(count($verificar) == 0){
     $row = $this->Comisiones_model->MKTD_compartida($this->input->post('idLote'),$this->input->post('plaza1'),$this->input->post('plaza2'),$this->session->userdata('id_usuario'));

   }else{
$row = 3;
   }


   echo json_encode($row);
 }
 public function getDatosNuevasCompartidas(){
   $dat =  $this->Comisiones_model->getDatosNuevasCompartidas()->result_array();
  for( $i = 0; $i < count($dat); $i++ ){
      $dat[$i]['pa'] = 0;
  }
  echo json_encode( array( "data" => $dat));
 }
 /**----------------------------------------------------- */
/**-------------------------------------PRECIO LOTE MKTD--------------------------------- */
public function SavePrecioLoteMKTD(){
  $precio = str_replace(",",'',$this->input->post('precioL'));
  $idLote = $this->input->post('idLote');
  $Consulta = $this->Comisiones_model->getPrecioMKTD($idLote)->result_array();
  if(count($Consulta) == 0){
    //INSERT
    $row = $this->Comisiones_model->insert_MKTD_precioL($idLote,$precio,$this->session->userdata('id_usuario'));

  }else{
    //UPDATE
    $row = $this->Comisiones_model->Update_MKTD_precioL($idLote,$precio,$this->session->userdata('id_usuario'));

  }
  echo json_encode($row);
}




 function getDatosColabMktdCompartida($sede, $plan,$sede1,$sede2){
    $datos = $this->Comisiones_model->getDatosColabMktdCompartida($sede, $plan,$sede1,$sede2)->result_array();
    $cuantos19=0;
    for ($i=0; $i < count($datos) ; $i++) {
      if($datos[$i]['id_opcion'] == 19) 
      $cuantos19=$cuantos19+1;
    }
 $datos[0]['valor'] = $cuantos19;
    echo json_encode($datos);
  }
/**---------------------------------------------------------------------------------------- */

  /**RESGUARDO */
  public function saveRetiro()
  {
    $opcion = $this->input->post("opc");
    $replace = [",","$"];
  
        
    $descuento = str_replace($replace,"",$this->input->post("monto"));
    
    $usuario = $this->input->post("usuarioid");
    $comentario = $this->input->post("comentario");
   $dat =  $this->Comisiones_model->insertar_retiro($usuario,$descuento,$comentario,$this->session->userdata('id_usuario'),$opcion);
   
     echo json_encode($dat);
    
    
    }
  
    public function getDisponbleResguardoP($user,$opc = ''){
      if($opc == ''){
        $datos = $this->Comisiones_model->getDisponbleResguardo($user)->result_array();
        $extras = $this->Comisiones_model->getDisponbleExtras($user)->result_array();
        //$suma =($datos[0]['suma']+$extras[0]['extras']);
        $suma =$datos[0]['suma'];
      }else{
        $datos = $this->Comisiones_model->getDisponbleResguardo($user)->result_array();
       // $extras = $this->Comisiones_model->getDisponbleExtras($user)->result_array();
       $suma =($datos[0]['suma']);
      }
      
      
      echo json_encode($suma);
    }
  public function getDisponbleResguardo($user){
    $datos = $this->Comisiones_model->getDisponbleResguardo($user)->result_array();
    $extras = $this->Comisiones_model->getDisponbleExtras($user)->result_array();
    $pagado = $this->Comisiones_model->getAplicadoResguardo($user)->result_array();
    $disponible = ($datos[0]['suma'] + $extras[0]['extras']) - $pagado[0]['aplicado'];
    echo json_encode($disponible);
  }
  public function UpdateRetiro(){
  
    $opcion =  $this->input->post("opcion");
    $id = $this->input->post("id_descuento");
    $data = [];
    if($opcion == 'Autorizar'){
      $data = ['estatus' => 2];
    }elseif($opcion == 'Borrar'){
      $motivo =  $this->input->post("motivodelete");
      $data = ['estatus' => 3,
              'motivodel' => $motivo];
    }elseif($opcion == 'Rechazar'){
      $motivo =  $this->input->post("motivodelete");
      $data = ['estatus' => 4,
              'motivodel' => $motivo];
    }elseif($opcion == 'Actualizar'){
      $monto =  $this->input->post("monto");
      $concepto = $this->input->post("conceptos");
      $estado = $this->input->post("estatus");
      // $estatus = 1;
      // if($estado == 67){
      //   $estatus == 67;
      // }
      
      $data = ['monto' => $monto,
                'conceptos' => $concepto,
                'estatus' => $estado];
    }
    // echo $this->input->post("id_bono");
  
    $respuesta =  $this->Comisiones_model->UpdateRetiro($data,$id,$opcion);
  echo json_encode($respuesta);
  
  }
  
  public function getHistoriRetiros($id)
      {
          echo json_encode($this->Comisiones_model->getHistoriRetiros($id)->result_array());
      }
  
  
  

    /**-----------------------REUBICACIÓN-------------------------- */

public function lista_lote($condominio){
  echo json_encode($this->Asesor_model->get_lote_lista($condominio)->result_array());
}

public function SaveReubicacion(){

  $datos = explode(",",$this->input->post('filtro55'));
  $loteNuevo = $datos[0];
  $precioNuevo = $datos[1];
  $idloteAnterior = $this->input->post('idlote1');
  $comentario = $this->input->post('comentarioR');
  $row = $this->Comisiones_model->Update_lote_reubicacion($loteNuevo,$idloteAnterior,$precioNuevo,$this->session->userdata('id_usuario'),$comentario);
echo json_encode($row);
}
public function getComisionesLoteSelected($idLote){
  echo json_encode($this->Comisiones_model->getComisionesLoteSelected($idLote)->result_array());
}
/**------------------------------------------------------------- */
/**-------------------------------BONOS BAJAS-------------------------------------------- */
public function BonosBaja()
{
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $datos = array();
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $salida = str_replace('' . base_url() . '', '', $val);
  $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
  $this->load->view('template/header');
  $this->load->view("ventas/BonosBaja", $datos);
}
/**-------------------------------------------------------------------------------------- */
function getDatosNuevo(){
  echo json_encode($this->Comisiones_model->getDatosNuevo()->result_array());
}
public function save_new_mktd(){

  $respuesta = array( FALSE );
  if($this->input->post("fecha_inicio")){

   // echo "si entro";
   
   $fecha_inicio = $this->input->post("fecha_inicio");
   $arrayuser = $this->input->post("userMKTDSelect[]");
   $puesto = $this->input->post("puesto[]");
   $arrayporc = $this->input->post("porcentajeUserMk[]");
   $arrayplaza = $this->input->post("plazaMKTDSelect[]");
   $arraysede = $this->input->post("sedeMKTDSelect[]");
   $arrayestatus = $this->input->post("estatusMk[]");
 
  $query_max = $this->db->query("SELECT MAX(numero_plan) AS nummax FROM porcentajes_mktd");
  $new_max = intval($query_max->row()->nummax)+1;


  $query_max = $this->db->query("UPDATE planes_mktd SET fin_plan = '".$fecha_inicio."' WHERE id_plan = ".($new_max-1)."");
  $query_max = $this->db->query("INSERT INTO planes_mktd (fecha_plan, fin_plan, fecha_creacion) VALUES('".$fecha_inicio."', NULL, GETDATE())");
  $id = $this->db->insert_id();


   for($i=0;$i<sizeof($arrayuser);$i++){
     if($arraysede[$i]=='2' AND $puesto[$i]!='19' AND $puesto[$i]!='20'){
      $this->db->query("INSERT INTO porcentajes_mktd(numero_plan, id_sede, id_plaza, id_usuario, porcentaje, fecha_inicio, estatus, activo, fecha_creacion, rol) VALUES (".$id.", 0, ".$arrayplaza[$i].", ".$arrayuser[$i].", ".$arrayporc[$i].", '".$fecha_inicio."', 1, 1, GETDATE(), '".$puesto[$i]."')");

     }
     else{
      $this->db->query("INSERT INTO porcentajes_mktd(numero_plan, id_sede, id_plaza, id_usuario, porcentaje, fecha_inicio, estatus, activo, fecha_creacion, rol) VALUES (".$id.", ".$arraysede[$i].", ".$arrayplaza[$i].", ".$arrayuser[$i].", ".$arrayporc[$i].", '".$fecha_inicio."', 1, 1, GETDATE(),'".$puesto[$i]."')");
     }

 
  }
 
 
   $respuesta = array( TRUE );


}
echo json_encode( $respuesta );
  }


public function getMontoDispersado(){
  echo json_encode($this->Comisiones_model->getMontoDispersado()->result_array(), JSON_NUMERIC_CHECK);
}

public function getPagosDispersado(){
  echo json_encode($this->Comisiones_model->getPagosDispersado()->result_array(), JSON_NUMERIC_CHECK);
}

public function getLotesDispersado(){
  echo json_encode($this->Comisiones_model->getLotesDispersado()->result_array(), JSON_NUMERIC_CHECK);
}


public function getMontoDispersadoDates($fecha1, $fecha2){

   $datos["datos_monto"] = $this->Comisiones_model->getMontoDispersadoDates($fecha1, $fecha2)->result_array();
   $datos["datos_pagos"] = $this->Comisiones_model->getPagosDispersadoDates($fecha1, $fecha2)->result_array();
   $datos["datos_lotes"] = $this->Comisiones_model->getLotesDispersadoDates($fecha1, $fecha2)->result_array();

   echo json_encode($datos);

}


  public function historial_pagado()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/historial_pagadoMKTD", $datos);
  }



// public function getPagosDispersadoDates($fecha1, $fecha2){
//   echo json_encode($this->Comisiones_model->getPagosDispersadoDates($fecha1, $fecha2)->result_array(), JSON_NUMERIC_CHECK);
// }

// public function getLotesDispersadoDates($fecha1, $fecha2){
//   echo json_encode($this->Comisiones_model->getLotesDispersadoDates($fecha1, $fecha2)->result_array(), JSON_NUMERIC_CHECK);
// }


public function lista_proyecto($param)
{
  // $this->validateSession();
  $id_user = $this->session->userdata('id_usuario');

  if($param == 0){
    $filtro_00 = '';
  }else{
    $filtro_00 = ' AND pci.estatus = $param';
  }

  switch ($this->session->userdata('id_rol')) {
    case '1':
    case '2':
    case '3':
    case '7':
    case '9':
    // case '1':
      $filtro_post = ' WHERE res.status = 1 AND com.id_usuario = '.$id_user.' '.$filtro_00;
      break;
    
    default:
      $filtro_post = ' WHERE res.status = 1 '.$filtro_00;
      break; 
  }


    echo json_encode($this->Comisiones_model->get_proyectos_comisiones($filtro_post)->result_array());
}

 // public function lista_condominio($param, $proyecto)
 //    {
 //      // $this->validateSession();
 //      $id_user = $this->session->userdata('id_usuario');

 //      // if($param == 0){
 //        $filtro_00 = ' WHERE con.idResidencial = '.$proyecto.' ';
 //      // }else{
 //      //   $filtro_00 = ' AND pci.estatus = '.$param.' AND con.idResidencial = '.$proyecto.' ';
 //      // }

 //      // switch ($this->session->userdata('id_rol')) {
 //      //   case '1':
 //      //   case '2':
 //      //   case '3':
 //      //   case '7':
 //      //   case '9':
 //      //   // case '1':
 //      //     $filtro_post = ' WHERE con.status = 1 AND com.id_usuario = '.$id_user.' '.$filtro_00;
 //      //     break;
        
 //      //   default:
 //      //     $filtro_post = ' WHERE con.status = 1 '.$filtro_00;
 //      //     break; 
 //      // }
 //        echo json_encode($this->Comisiones_model->get_condominios_comisiones($filtro_post)->result_array());
 //    }




 public function lista_roles()
    {
      echo json_encode($this->Comisiones_model->get_lista_roles()->result_array());
    }
public function lista_sedes()
    {
      echo json_encode($this->Comisiones_model->get_lista_sedes()->result_array());
    }
        /**-----------------FACTURAS----------------------------------------- */
        public function SubirPDF(){
          if($this->input->post('opc') == 3){
           $idpago = $this->input->post('id2');
         
         
          }elseif( $this->input->post('opc') == 2 ){
            //ya no aplica
           $uuid = $this->input->post('uuid2');
           $motivo = $this->input->post('motivo');
           $datos = $this->Comisiones_model->RegresarFactura($uuid,$motivo);
         
         
         
           //echo $this->input->post('uuid2');
         if($datos == true){
           echo json_encode(1);
         }else{
           echo json_encode(0);
         }
         
         }else if($this->input->post('opc') == 1){
             $uploadFileDir = './UPLOADS/PDF/';
                 date_default_timezone_set('America/Mexico_City');
                 $datos = explode(".",$this->input->post('xmlfile'));
                 $uuid = $this->input->post('uuid');
                 $nombrefile = $datos[0];
                 //$hoy = date("Y-m-d");
            
           $datos = $this->Comisiones_model->BanderaPDF($uuid);
         
         
                 $fileTmpPath = $_FILES['file-uploadE']['tmp_name'];
                     $fileName = $_FILES['file-uploadE']['name'];
                     $fileSize = $_FILES['file-uploadE']['size'];
                     $fileType = $_FILES['file-uploadE']['type'];
                     $fileNameCmps = explode(".", $fileName);
                     $fileExtension = strtolower(end($fileNameCmps));
                     $newFileName = $nombrefile . '.' . $fileExtension;
                     $uploadFileDir = './UPLOADS/PDF/';
                     $dest_path = $uploadFileDir . $newFileName;
                     
                     
                     $dest_path = $uploadFileDir . $newFileName;
                     move_uploaded_file($fileTmpPath, $dest_path);
                     echo json_encode(1);
                                 
           }elseif($this->input->post('opc') == 4){
         
             $id_user = $this->input->post('id_user');
             $motivo = $this->input->post('motivo');
           $uuid =$this->input->post('uuid2');
           $datos = $this->Comisiones_model->GetPagosFacturas($uuid)->result_array();
            $resultado = array("resultado" => TRUE);
            if( (isset($_POST) && !empty($_POST)) || ( isset( $_FILES ) && !empty($_FILES) ) ){
              $this->db->trans_begin();
              $responsable = $id_user;
              $resultado = TRUE;
              if( isset( $_FILES ) && !empty($_FILES) ){
                $config['upload_path'] = './UPLOADS/XMLS/';
                $config['allowed_types'] = 'xml';
                $this->load->library('upload', $config);
                $resultado = $this->upload->do_upload("xmlfile2");
                if( $resultado ){
                  $xml_subido = $this->upload->data();
                  $datos_xml = $this->Comisiones_model->leerxml( $xml_subido['full_path'], TRUE );
                  
                  $nuevo_nombre = date("my")."_";
                  $nuevo_nombre .= str_replace( array(",", ".", '"'), "", str_replace( array(" ", "/"), "_", limpiar_dato($datos_xml["nameEmisor"]) ))."_";
                  $nuevo_nombre .= date("Hms")."_";
                  $nuevo_nombre .= rand(4, 100)."_";
                  $nuevo_nombre .= substr($datos_xml["uuidV"], -5)."_REFACTURA".".xml";
                  rename( $xml_subido['full_path'], "./UPLOADS/XMLS/".$nuevo_nombre );
                  $datos_xml['nombre_xml'] = $nuevo_nombre;
            
                  for ($i=0; $i <count($datos) ; $i++) { 
                    if(!empty($datos[$i]['id_comision'])){
                      $id_com =  $datos[$i]['id_comision'];
                      $this->Comisiones_model->update_refactura($id_com, $datos_xml,$id_user,$datos[$i]['id_factura']);
                      //$this->Comisiones_model->update_acepta_solicitante($id_com);
                    $this->db->query("INSERT INTO historial_comisiones VALUES (".$id_com.", ".$this->session->userdata('id_usuario').", GETDATE(), 1, 'CONTRALORÍA REFACTURÓ, MOTIVO: ".$motivo." ')");
         
                    }
                  }
                }else{
                  $resultado["mensaje"] = $this->upload->display_errors();
                }
              }
              if ( $resultado === FALSE || $this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $resultado = array("resultado" => FALSE);
                    }else{
                        $this->db->trans_commit();
                        $resultado = array("resultado" => TRUE);
                    }
                }
         
                //$this->Usuarios_modelo->Update_OPN($this->session->userdata('id_usuario'));
                if($resultado){
                 echo json_encode( 1 );
         
                }else{
                 echo json_encode(0);
         
                }
           }
                                 //$response = $this->Usuarios_modelo->SaveCumplimiento($this->session->userdata('id_usuario'),$newFileName);
                                 
         
         }
         
         function pausar_solicitud(){
           $respuesta = array( FALSE );
           if($this->input->post("id_pago")){
              $respuesta = array( $this->Comisiones_model->update_estatus_pausa( $this->input->post("id_pago_i"), $this->input->post("observaciones")));
           }
           echo json_encode( $respuesta );
         }
         function pausar_solicitudM(){
          $respuesta = array( FALSE );
          if($this->input->post("id_pago")){
             $respuesta = array( $this->Comisiones_model->update_estatus_pausaM( $this->input->post("id_pago_i"), $this->input->post("observaciones")));
          }
          echo json_encode( $respuesta );
        }
        /**---------------------------------------- */
    
    
    
  public function saldos_Intmex()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/saldos_Intmex", $datos);
  }

    public function listEmpresa()
    {
        echo json_encode($this->Comisiones_model->listEmpresa()->result_array());
    }

        public function listRegimen()
    {
        echo json_encode($this->Comisiones_model->listRegimen()->result_array());
    }




   public function getDatosSaldosIntmex($a,$b){
      $dat =  $this->Comisiones_model->getDatosSaldosIntmex($a,$b)->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }
    

    /**CAMBIAR PRECIO LOTE */
    public function Ajustes()
{
  $datos = array();
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $salida = str_replace('' . base_url() . '', '', $val);
  $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
  $this->load->view('template/header');
  $this->load->view("ventas/UpdatePrecioLote", $datos);
}
public function CambiarPrecioLote(){
  $idLote = $this->input->post("idLote");
  $precioAnt = $this->input->post("precioAnt");
  $precio=str_replace(",", "", $this->input->post("precioL"));
  $comentario='Se modificó el precio de '.$precioAnt.' a '.$precio;
  $respuesta = $this->Comisiones_model->CambiarPrecioLote($idLote,$precio,$comentario);
echo json_encode($respuesta);
}

public function getPagosByComision($id_comision)
{
  $respuesta = $this->Comisiones_model->getPagosByComision($id_comision);
  echo json_encode($respuesta); 
}
public function ToparComision($id_comision,$idLote = '')
{
  $comentario = $this->input->post("comentario");
  $respuesta = $this->Comisiones_model->ToparComision($id_comision,$comentario);
 // if($idLote != '' ){
  //  $this->Comisiones_model->RecalcularMontos($idLote);
 //}
  echo json_encode($respuesta); 
}


public function GuardarPago($id_comision)
{
  $comentario_topa = $this->input->post('comentario_topa');
  $monotAdd =    $this->input->post('monotAdd');
 
  $respuesta = $this->Comisiones_model->GuardarPago($id_comision, $comentario_topa, $monotAdd);
  echo json_encode($respuesta); 
}




public function SaveAjuste($opc = '')
{
 $id_comision = $this->input->post('id_comision');
 $id_usuario = $this->input->post('id_usuario');
 $id_lote =    $this->input->post('id_lote');
 $porcentaje = $pesos=str_replace("%", "", $this->input->post('porcentaje'));
 $porcentaje_ant = $this->input->post('porcentaje_ant');

 $comision_total = $pesos=str_replace(",", "", $this->input->post('comision_total'));

 $respuesta = $this->Comisiones_model->SaveAjuste($id_comision,$id_lote,$id_usuario,$porcentaje,$porcentaje_ant,$comision_total,$opc);

 
 echo json_encode($respuesta); 
}



    public function historialDescuentos()
{
  $datos = array();
  $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
  $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
  $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $salida = str_replace('' . base_url() . '', '', $val);
  $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
  $this->load->view('template/header');
  $this->load->view("ventas/historialCapitalFechas", $datos);
}




function topar_descuentos(){
  // $respuesta = array( FALSE );

  // if($this->input->post("id_pago_i")){
    $respuesta = array($this->Comisiones_model->update_DU_topar($this->input->post("id_pago"), $this->input->post("observaciones"), $this->input->post("monto") ));
  // }
  echo json_encode( $respuesta );
}



public function getPagosFacturasBaja()
{
  $dat =  $this->Comisiones_model->getPagosFacturasBaja()->result_array();
  for ($i = 0; $i < count($dat); $i++) {
    $dat[$i]['pa'] = 0;
  }
  echo json_encode(array("data" => $dat));
}


public function getPagosByProyect($proyect = '',$formap = ''){
  if(empty($proyect)){
    echo json_encode($this->Comisiones_model->getPagosByProyect());

  }else{
    echo json_encode($this->Comisiones_model->getPagosByProyect($proyect,$formap));

  }
}

function IntMexPagadosByProyect(){
  date_default_timezone_set('America/Mexico_City');
  $idsessionado = $this->session->userdata('id_usuario');
  $idsPagos = $this->input->post("ids");
  $sep = ',';
  $id_pago_i = '';
  //$cadena_equipo = '';
  $data = array();
  for($i=0; $i <count($idsPagos) ; $i++) { 
    $id_pago_i = implode(",", $idsPagos);

   // $id_pago_i .= implode($sep, $idsPagos);
          //  $id_pago_i .= $sep;
            $row_arr=array(
              'id_pago_i' => $idsPagos[$i],
              'id_usuario' =>  $idsessionado,
              'fecha_movimiento' => date('Y-m-d H:i:s'),
              'estatus' => 1,
              'comentario' =>  'INTERNOMEX APLICO PAGO' 
            );
            array_push($data,$row_arr);

  }
  Ini_set('max_execution_time', 0);

  $up_b = $this->Comisiones_model->update_acepta_INTMEX($id_pago_i);
  $ins_b = $this->Comisiones_model->insert_phc($data);

if($up_b == true && $ins_b == true){
$data_response = 1;
echo json_encode($data_response);
} else {
$data_response = 0;
echo json_encode($data_response);
}
}

public function getDesarrolloSelectINTMEX($a = ''){
  if($a == ''){
    echo json_encode($this->Comisiones_model->getDesarrolloSelectINTMEX()->result_array());

  }else{
    echo json_encode($this->Comisiones_model->getDesarrolloSelectINTMEX($a)->result_array());

  }
}


public function getAsesoresBaja() {

  $data = $this->Comisiones_model->getAsesoresBaja();
  if($data != null) {
      echo json_encode($data);
  }else{
      echo json_encode(array());
  }
  exit;
}

public function CederComisiones(){

  $idAsesorOld = $this->input->post('asesorold');
  $rol = $this->input->post('roles2');
  $newUsuario = $this->input->post('usuarioid2');
  $comentario= $this->input->post('comentario');
   $respuesta = array($this->Comisiones_model->CederComisiones($idAsesorOld,$newUsuario,$rol));
  echo json_encode($respuesta[0]);
}

public function datosLotesaCeder($id_usuario){

  $respuesta = array($this->Comisiones_model->datosLotesaCeder($id_usuario));
 echo json_encode($respuesta);
}



public function getUserInventario($id_cliente){

  $datos = $this->Comisiones_model->getUserInventario($id_cliente)->result_array();
  echo json_encode($datos[0]);
}

public function getUserVC($id_cliente){

  $datos = $this->Comisiones_model->getUserVC($id_cliente)->result_array();
  echo json_encode($datos);
}
function getDatosAbonadoDispersion3($idlote){
  echo json_encode($this->Comisiones_model->getDatosAbonadoDispersion3($idlote)->result_array());
}

public function getUsuariosByrol($rol,$user)
  {
    echo json_encode($this->Comisiones_model->getUsuariosByrol($rol,$user)->result_array());
  }
  public function UpdateInventarioClient(){
    $usuarioOld=0;
    $asesor=$this->input->post('asesor');
    $coordinador = $this->input->post('coordinador');
    $gerente = $this->input->post('gerente');
    $rolSelect= $this->input->post('roles3');
    $newColab = $this->input->post('usuarioid3');
    $comentario=$this->input->post('comentario3');
    $idLote=$this->input->post('idLote');
    $idCliente=$this->input->post('idCliente');

    if($rolSelect == 7){
      $usuarioOld=$asesor;
    }else if($rolSelect == 9){
      $usuarioOld=$coordinador;
    }else if($rolSelect == 3){
      $usuarioOld=$gerente;

    }
    $respuesta = array($this->Comisiones_model->UpdateInventarioClient($usuarioOld,$newColab,$rolSelect,$idLote,$idCliente,$comentario));

    echo json_encode($respuesta[0]);
  }

  public function UpdateVcUser(){
    $usuarioOld=0;
    
    $cuantos=$this->input->post('cuantos');

    if($cuantos == 1){
      $asesor=$this->input->post('asesor');
      $coordinador = $this->input->post('coordinador');
      $gerente = $this->input->post('gerente');
      $rolSelect= $this->input->post('rolesvc');
      $newColab = $this->input->post('usuarioid4');
      $comentario=$this->input->post('comentario4');
      $idLote=$this->input->post('idLote');
      $idCliente=$this->input->post('idCliente');

    }else if($cuantos == 2){

    }
 

    if($rolSelect == 7){
      $usuarioOld=$asesor;
    }else if($rolSelect == 9){
      $usuarioOld=$coordinador;
    }else if($rolSelect == 3){
      $usuarioOld=$gerente;

    }
    $respuesta = array($this->Comisiones_model->UpdateVcUser($usuarioOld,$newColab,$rolSelect,$idLote,$idCliente,$comentario,$cuantos));

      echo json_encode($respuesta[0]);

  }
  public function getLideres($lider)
  {
    echo json_encode($this->Comisiones_model->getLideres($lider)->result_array());
  }
  public function AddVentaCompartida(){
    $datosAse = explode(",",$this->input->post('usuarioid5'));
    $coor = $this->input->post('usuarioid6');
    $ger = $this->input->post('usuarioid7');
    $sub = $this->input->post('usuarioid8');
    $id_cliente = $this->input->post('id_cliente');
    $id_lote = $this->input->post('id_lote');
    $respuesta = array($this->Comisiones_model->AddVentaCompartida($datosAse[0],$coor,$ger,$sub,$id_cliente,$id_lote));
    echo json_encode($respuesta[0]);
  }

  public function getUsuariosRol3($rol)
  {
    echo json_encode($this->Comisiones_model->getUsuariosRol3($rol)->result_array());
  }

  public function CancelarDescuento(){
    $id_pago = $this->input->post('id_pago');
    $motivo =  $this->input->post('motivo');
    $monto =  $this->input->post('monto');
    $respuesta = array($this->Comisiones_model->CancelarDescuento($id_pago,$motivo,$monto));
    echo json_encode( $respuesta[0]);
  
  }



public function saveTipoVenta(){

  $idLote = $this->input->post('id');
  $tipo = $this->input->post('tipo');

  $respuesta = $this->Comisiones_model->saveTipoVenta($idLote,$tipo);
 echo json_encode($respuesta); 

}



 public function general_Intmex()
  {
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/general_Intmex", $datos);
  }


      public function getDatosGralInternomex(){
      $dat =  $this->Comisiones_model->getDatosGralInternomex()->result_array();
     for( $i = 0; $i < count($dat); $i++ ){
         $dat[$i]['pa'] = 0;
     }
     echo json_encode( array( "data" => $dat));
    }




  public function lista_estatus()
  {
    $data = $this->Comisiones_model->getListaEstatusHistorialEstatus();
    echo json_encode($data);
  }

public function getDatosHistorialPagoEstatus($proyecto, $condominio, $usuario) {

      ini_set('max_execution_time', 900);
      set_time_limit(900);
      ini_set('memory_limit','2048M');

      
  $dat =  $this->Comisiones_model->getDatosHistorialPagoEstatus($proyecto,$condominio, $usuario)->result_array();
 for( $i = 0; $i < count($dat); $i++ ){
     $dat[$i]['pa'] = 0;
 }
 echo json_encode( array( "data" => $dat));
}


 public function historial_estatus()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/historial_estatus", $datos);
  }



  public function getMktdRol(){
  echo json_encode($this->Comisiones_model->getMktdRol()->result_array());
}


  public function getLotesOrigenmk($user)
  {
    echo json_encode($this->Comisiones_model->getLotesOrigenmk($user)->result_array());
  }



  public function getInformacionDataMK($lote)
  {
    echo json_encode($this->Comisiones_model->getInformacionDataMK($lote)->result_array());
  }




  public function saveDescuentoMK($valor)
  {

 
  $datos =  $this->input->post("idloteorigen[]");
  $descuento = $this->input->post("monto");
  $usuario = $this->input->post("usuarioid");
  $comentario = $this->input->post("comentario");
  $pagos_aplica = 0;
  

    $cuantos = count($datos);
 
    if($cuantos > 1){
     // echo var_dump( $datos);

      $sumaMontos = 0;
      for($i=0; $i <$cuantos ; $i++) { 
        
        if($i == $cuantos-1){

          $formatear = explode(",",$datos[$i]);
          $id = $formatear[0]; 
          $monto = $formatear[1];
          $pago_neodata = $formatear[2];

         $montoAinsertar = $descuento - $sumaMontos;
         $Restante = $monto - $montoAinsertar;

 

         $comision = $this->Comisiones_model->obtenerIDMK($id)->result_array();
 
          $dat =  $this->Comisiones_model->update_descuentoMK($id,$montoAinsertar,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario,$pagos_aplica);
          $dat =  $this->Comisiones_model->insertar_descuentoMK($usuario,$Restante,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor, $comision[0]['id_list'],$comision[0]['empresa']);
         
        }else{

          $formatear = explode(",",$datos[$i]);
           $id=$formatear[0];
          $monto = $formatear[1]; 
 
         $dat = $this->Comisiones_model->update_descuentoMK($id,0,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario, $pagos_aplica);
         $sumaMontos = $sumaMontos + $monto;
        }

  
      }
 

    }else{

      // echo "entra a else 2";
         $formatear = explode(",",$datos[0]);
         $id = $formatear[0];
         $monto = $formatear[1];
         $pago_neodata = $formatear[2];
         $montoAinsertar = $monto - $descuento;
         $Restante = $monto - $montoAinsertar;

         $comision = $this->Comisiones_model->obtenerIDMK($id)->result_array();
         // $dat =  $this->Comisiones_model->update_descuentoMK($id,$descuento);

         // echo 'formatear: '.$formatear ;
         // echo 'monto: '.$monto ;
         // echo 'montoAinsertar: '.$montoAinsertar ;
         // echo 'Restante: '.$Restante ;
          
          $dat =  $this->Comisiones_model->update_descuentoMK($id,$descuento,$comentario, $this->session->userdata('id_usuario'),$valor,$usuario,0);
          $dat =  $this->Comisiones_model->insertar_descuentoMK($usuario,$montoAinsertar,$comision[0]['id_comision'],$comentario,$this->session->userdata('id_usuario'),$pago_neodata,$valor, $comision[0]['id_list'],$comision[0]['empresa']);
 

    }
    echo json_encode($dat);
    
    
    }
/*
    public function porcentajes($idLote){
      echo json_encode($this->Comisiones_model->porcentajes($idLote)->result_array());
    }

    public function InsertNeo(){
      $lote_1 =  $this->input->post("idLote");
      $bonificacion =  $this->input->post("bonificacion");
      $responses = $this->Comisiones_model->validateDispersionCommissions($lote_1)->result_array();
          if(sizeof($responses) > 0 && $responses[0]['bandera'] != 0) {
            $respuesta[0] = 2;
        } else {
      $disparador =  $this->input->post("id_disparador");
      if($disparador == '1' || $disparador == 1){
          $lote_1 =  $this->input->post("idLote");
          $pending_1 =  $this->input->post("pending");
          $abono_nuevo = $this->input->post("abono_nuevo[]");
          $rol = $this->input->post("rol[]");
          $id_comision = $this->input->post("id_comision[]");
          $pago = $this->input->post("pago_neo");
          $suma = 0;
          $replace = [",","$"];
           for($i=0;$i<sizeof($id_comision);$i++){
             $var_n = str_replace($replace,"",$abono_nuevo[$i]);
             $respuesta = $this->Comisiones_model->insert_dispersion_individual($id_comision[$i], $rol[$i], $var_n, $pago);
            }
          for($i=0;$i<sizeof($abono_nuevo);$i++){
            $var_n = str_replace($replace,"",$abono_nuevo[$i]);
            $suma = $suma + $var_n ;
          }
          $resta = $pending_1 - $pago;
            $this->Comisiones_model->UpdateLoteDisponible($lote_1);
          $respuesta = $this->Comisiones_model->update_pago_dispersion($suma, $lote_1, $pago);
        }
        else if($disparador == '0' || $disparador == 0){
          $replace = [",","$"];
          $lote =  $this->input->post("idLote");
          $ids = array();
          $ids[0] =  $this->input->post("idAs");
          $ids[1] = $this->input->post("idCoor");
          $ids[2] =  $this->input->post("idGer");
          $ids[3] =  $this->input->post("idSub");
          $ids[4] =  $this->input->post("idDir");
          $ids[5] =  $this->input->post("idMk");
          $ids[6] =  $this->input->post("idCb");
          $ids[7] =  $this->input->post("idGreen");
          $ids[8] =  $this->input->post("idEm");
    
          $roles = array();
          $roles[0] = $this->input->post("rolAs");
          $roles[1] = $this->input->post("rolCoor");
          $roles[2] = $this->input->post("rolGe");
          $roles[3] = $this->input->post("rolSub");
          $roles[4] = $this->input->post("rolDir");
          $roles[5] = $this->input->post("rolMk");
          $roles[6] = $this->input->post("rolCb");
          $roles[7] = $this->input->post("rolGreen");
          $roles[8] = $this->input->post("rolEm");
    
          $comisiones = array();
          $comisiones[0] = str_replace($replace,"",$this->input->post("totAs"));
          $comisiones[1] = str_replace($replace,"",$this->input->post("totCoor"));
          $comisiones[2] = str_replace($replace,"",$this->input->post("totGer"));
          $comisiones[3] = str_replace($replace,"",$this->input->post("totSub"));
          $comisiones[4] = str_replace($replace,"",$this->input->post("totDir"));
          $comisiones[5] = str_replace($replace,"",$this->input->post("totMk"));
          $comisiones[6] = str_replace($replace,"",$this->input->post("totCb"));
          $comisiones[7] = str_replace($replace,"",$this->input->post("totGreen"));
          $comisiones[8] = str_replace($replace,"",$this->input->post("totEm"));
        
          $porcentajes = array();
    
          $porcentajes[0] = $this->input->post("porAs");
          $porcentajes[1] = $this->input->post("porCoor");
          $porcentajes[2] = $this->input->post("porGer");
          $porcentajes[3] = $this->input->post("porSub");  
          $porcentajes[4] = $this->input->post("porDir");
          $porcentajes[5] = $this->input->post("porMk");
          $porcentajes[6] = $this->input->post("porCb");
          $porcentajes[7] = $this->input->post("porGreen");
          $porcentajes[8] = $this->input->post("porEm");
          
       
          $restos = array();  
    
          $restos[0] = str_replace($replace,"",$this->input->post("restoAs"));
          $restos[1] = str_replace($replace,"",$this->input->post("restoCoor"));
          $restos[2] = str_replace($replace,"",$this->input->post("restoGer"));
          $restos[3] = str_replace($replace,"",$this->input->post("restoSub"));
          $restos[4] = str_replace($replace,"",$this->input->post("restoDir"));
          $restos[5] = str_replace($replace,"",$this->input->post("restoMk"));
          $restos[6] = str_replace($replace,"",$this->input->post("restoCb"));
          $restos[7] = str_replace($replace,"",$this->input->post("restoGreen"));
          $restos[8] = str_replace($replace,"",$this->input->post("restoEm"));
    
          $pago = str_replace($replace,"",$this->input->post("pago_neo"));
          $sumaPor = 0;
          $sumaComi = 0;
          $sumaDispo = 0;
      
          for ($i=0; $i < 9; $i++) { 
            $sumaPor += $porcentajes[$i];
            $sumaComi += $comisiones[$i];
            $sumaDispo += $restos[$i];
            $respuesta =  $this->Comisiones_model->InsertNeo($lote,$ids[$i],$comisiones[$i],$this->session->userdata('id_usuario'),$porcentajes[$i],$restos[$i],$pago,$roles[$i]);
      }
    
      $resta = $sumaComi - $sumaDispo;
    
        $this->Comisiones_model->UpdateLoteDisponible($lote);
    
     $respuesta =  $this->Comisiones_model->InsertPagoComision($lote,$sumaComi,$sumaDispo,$sumaPor,$resta,$this->session->userdata('id_usuario'),$pago,$bonificacion); 
    
      }
    }
      echo json_encode($respuesta);   
    }
*/
public function getUsersClient($lote,$compartida,$TipoVenta,$LupgarP,$mdb,$ismktd,$IdResidencial)
{
  echo json_encode($this->Comisiones_model->getUsersClient($lote,$compartida,$TipoVenta,$LupgarP,$mdb,$ismktd,$IdResidencial),JSON_NUMERIC_CHECK);
}
    /*public function getUsersClient($lote,$compartida)
    {
      echo json_encode($this->Comisiones_model->getUsersClient($lote,$compartida),JSON_NUMERIC_CHECK);
    }*/

    public function InsertNeo(){
      $lote_1 =  $this->input->post("idLote");
      $bonificacion =  $this->input->post("bonificacion");
      $responses = $this->Comisiones_model->validateDispersionCommissions($lote_1)->result_array();
      if(sizeof($responses) > 0 && $responses[0]['bandera'] != 0) {
        $respuesta[0] = 2;
    } else {
    
            $disparador =  $this->input->post("id_disparador");
            if($disparador == '1' || $disparador == 1){
                $lote_1 =  $this->input->post("idLote");
                $pending_1 =  $this->input->post("pending");
                $abono_nuevo = $this->input->post("abono_nuevo[]");
                $rol = $this->input->post("rol[]");
                $id_comision = $this->input->post("id_comision[]");
                $pago = $this->input->post("pago_neo");
                $suma = 0;
                $replace = [",","$"];
                for($i=0;$i<sizeof($id_comision);$i++){
                  $var_n = str_replace($replace,"",$abono_nuevo[$i]);
                  $respuesta = $this->Comisiones_model->insert_dispersion_individual($id_comision[$i], $rol[$i], $var_n, $pago);
                  }
                for($i=0;$i<sizeof($abono_nuevo);$i++){
                  $var_n = str_replace($replace,"",$abono_nuevo[$i]);
                  $suma = $suma + $var_n ;
                }
                $resta = $pending_1 - $pago;
                  $this->Comisiones_model->UpdateLoteDisponible($lote_1);
                $respuesta = $this->Comisiones_model->update_pago_dispersion($suma, $lote_1, $pago);
              }else if($disparador == '0' || $disparador == 0){
                $replace = [",","$"];
                $id_usuario = $this->input->post("id_usuario[]");
                $comision_total = $this->input->post("comision_total[]");
                $porcentaje = $this->input->post("porcentaje[]");
                $id_rol = $this->input->post("id_rol[]");
                $comision_abonada = $this->input->post("comision_abonada[]");
                $comision_pendiente = $this->input->post("comision_pendiente[]");
                $comision_dar = $this->input->post("comision_dar[]");
    
                $pago_neo = $this->input->post("pago_neo");
                $porcentaje_abono = $this->input->post("porcentaje_abono");
                $abonado = $this->input->post("abonado");
                $total_comision = $this->input->post("total_comision");
                $pendiente = $this->input->post("pendiente");
                $idCliente = $this->input->post("idCliente");
    
                $tipo_venta_insert = $this->input->post('tipo_venta_insert'); 
                $lugar_p = $this->input->post('lugar_p');
                $totalNeto2 = $this->input->post('totalNeto2');

                $banderita = 0;
                $PorcentajeAsumar=0;
                // 1.- validar tipo venta
                if($tipo_venta_insert <= 6 || $tipo_venta_insert == 11 || $tipo_venta_insert == 13){
                  if($porcentaje_abono < 8){
                    $PorcentajeAsumar = 8 - $porcentaje_abono;
                    $banderita=1;
                    $porcentaje_abono =8;
                  }
                }
                
                $pivote=0;
    
                for ($i=0; $i <count($id_usuario) ; $i++) { 

                  if($banderita == 1 && $id_rol[$i] == 45){
                    $banderita=0;

                    
                    $comision_total[$i] = $totalNeto2 * (($porcentaje[$i] + $PorcentajeAsumar) / 100 );  
                    $porcentaje[$i] = $porcentaje[$i] + $PorcentajeAsumar;
                   
                  }

                  if($id_rol[$i] == 1){
                    $pivote=str_replace($replace,"",$comision_total[$i]);
                  }

                  $respuesta =  $this->Comisiones_model->InsertNeo($lote_1,$id_usuario[$i],str_replace($replace,"",$comision_total[$i]),$this->session->userdata('id_usuario'),$porcentaje[$i],str_replace($replace,"",$comision_dar[$i]),str_replace($replace,"",$pago_neo),$id_rol[$i],$idCliente,$tipo_venta_insert);
                
                }
                $this->Comisiones_model->UpdateLoteDisponible($lote_1);
                $respuesta =  $this->Comisiones_model->InsertPagoComision($lote_1,str_replace($replace,"",$total_comision),str_replace($replace,"",$abonado),$porcentaje_abono,str_replace($replace,"",$pendiente),$this->session->userdata('id_usuario'),str_replace($replace,"",$pago_neo),str_replace($replace,"",$bonificacion)); 
    
                      if($banderita == 1){
                        $total_com = $totalNeto2 * (($PorcentajeAsumar) / 100 );
                         $this->Comisiones_model->InsertNeo($lote_1,4824,$total_com,$this->session->userdata('id_usuario'),$PorcentajeAsumar,($pivote*$PorcentajeAsumar),str_replace($replace,"",$pago_neo),45,$idCliente,$tipo_venta_insert);

                      }
              }
    
    
    }
    echo json_encode( $respuesta );
    }

    // public function porcentajes($cliente,$tipo,$vigencia){
    //   echo json_encode($this->Comisiones_model->porcentajes($cliente,$tipo,$vigencia)->result_array(),JSON_NUMERIC_CHECK);
    // }
    public function porcentajes($cliente,$tipoVenta){
      echo json_encode($this->Comisiones_model->porcentajes($cliente,$tipoVenta)->result_array(),JSON_NUMERIC_CHECK);
    }
      public function ReporteTotalMktd($mes,$anio){
        $resultado = array();
  
        $estatus='1,13';
        $estatusBonos='2,6';
        $fechaIninio = 0;
        $fechaFin = 0;
        if($mes != 0 && $anio != 0){
          $estatus='11';
          $estatusBonos=3;
  
              if($mes < 10 && $mes > 0){
                $mes="0".$mes;
              }
              $fechaIninio = date($anio."-".$mes."-01");
              $fechaFin = date($anio."-".$mes."-28");
        }
  
      //  echo $fechaIninio;
       // echo $fechaFin;
       
        //OBTENER LOS USUARIOS QUE COMISIONAM EN MKTD DEL CORTE ACTUAL
        $usuarios = $this->Comisiones_model->GetUserMktd($estatus,$fechaIninio,$fechaFin)->result_array();
  $comentario='';
  
        for ($i=0; $i <count($usuarios); $i++) { 
          $sumaTotal=0;
          $Pagadas = $this->Comisiones_model->getComisionesPagadas($usuarios[$i]['id_usuario'],$fechaIninio,$fechaFin)->result_array();
          //OBTENER LOS BONOS DE USUARIO POR USUARIO
          $resultado[$i]['id_usuario'] = $usuarios[$i]['id_usuario']; 
          $resultado[$i]['nombre'] = $usuarios[$i]['nombre']; 
          $resultado[$i]['comision'] = $usuarios[$i]['comision']; 
          $sumaTotal=$sumaTotal+$usuarios[$i]['comision'];
          $resultado[$i]['pagado_mktd'] = $Pagadas[0]['pagado_mktd']; 
          $comentario='BONO NUSKAH - MKTD 5 MENSUALIDADES';
          $resultado[$i]['pagadoBono1'] = 0; 
  
          $BonoPagado1 = $this->Comisiones_model->getBonosPagados($usuarios[$i]['id_usuario'],$comentario,$fechaIninio,$fechaFin)->result_array();
          $resultado[$i]['pagadoBono1'] = $BonoPagado1[0]['pagado']; 
  
          $NUSKAH = $this->Comisiones_model->getBonoXUser($usuarios[$i]['id_usuario'],$comentario,$estatusBonos,$fechaIninio,$fechaFin)->result_array();
          $Bono1=0;
          $resultado[$i]['bono1']=0;
          $resultado[$i]['pagado1']=0;
          for($j=0;$j<count($NUSKAH);$j++){
            $Bono1=$Bono1+$NUSKAH[$j]['impuesto1'];
            $sumaTotal=$sumaTotal+$NUSKAH[$j]['impuesto1'];
            $resultado[$i]['bono1'] = $NUSKAH[0]['monto']; 
            $resultado[$i]['pagado1'] = $NUSKAH[0]['pagado']; 
            $resultado[$i]['id_sede'] = $NUSKAH[0]['id_sede']; 
            $resultado[$i]['impuesto'] = $NUSKAH[0]['impuesto']; 
            $resultado[$i]['forma_pago'] = $NUSKAH[0]['forma_pago']; 
          }
        
          $resultado[$i]['bono_1'] = $NUSKAH; 
          $resultado[$i]['sumaBono1'] = $Bono1; 
          $comentario='BONO MARKETING - COMISIONES SIN EVIDENCIA DISPERSADO A 12 MESES ENTRE TODOS LOS INVOLUCRADOS';
          $BonoPagado2 = $this->Comisiones_model->getBonosPagados($usuarios[$i]['id_usuario'],$comentario,$fechaIninio,$fechaFin)->result_array();
          $resultado[$i]['pagadoBono2'] = $BonoPagado2[0]['pagado']; 
  
          $MKTD = $this->Comisiones_model->getBonoXUser($usuarios[$i]['id_usuario'],$comentario,$estatusBonos,$fechaIninio,$fechaFin)->result_array();
         
  
          $resultado[$i]['bono_2'] = $MKTD;
          $Bono2=0;
          $resultado[$i]['bono2'] = 0; 
          $resultado[$i]['pagado2']=0;
  
          for($j=0;$j<count($MKTD);$j++){
            $Bono2=$Bono2+$MKTD[$j]['impuesto1'];
            $sumaTotal=$sumaTotal+$MKTD[$j]['impuesto1'];
            $resultado[$i]['bono2'] = $MKTD[0]['monto'];
            $resultado[$i]['pagado2'] = $MKTD[0]['pagado']; 
            $resultado[$i]['id_sede'] = $MKTD[0]['id_sede']; 
            $resultado[$i]['impuesto'] = $MKTD[0]['impuesto']; 
            $resultado[$i]['forma_pago'] = $MKTD[0]['forma_pago']; 
   
          }
          
          $resultado[$i]['sumaBono2'] = $Bono2; 
  
          $resultado[$i]['Total'] = $sumaTotal; 
  
        }
        //echo json_encode($resultado);
        echo json_encode( array( "data" => $resultado));
  
  
  
      }
  
      public function ReporteRevisionMKTD(){
        $datos=array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        /*CONSULTAS PARA OBTENER EL PADRE DE LA OPCIÓN ACTUAL PARA ACTIVARLA*/
        $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace(''.base_url().'', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
        /*-----------------*/
        $this->load->view('template/header');
        $this->load->view("ventas/ReporteRevisionMKTD", $datos);
    }


        public function historial_nuevas()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();

        $this->load->view('template/header');
        $this->load->view("ventas/historial_nuevas", $datos);      
    }

    public function getDatosNuevasMontos($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatosNuevasMontos($proyecto,$condominio)->result_array();
      for( $i = 0; $i < count($dat); $i++ ){
        $dat[$i]['pa'] = 0;
      }
      echo json_encode( array( "data" => $dat));
    }


    public function usuarios_nuevas($rol)
    {
      echo json_encode($this->Comisiones_model->usuarios_nuevas($rol)->result_array());
    }

    public function ReporteRevisionMKTD2(){
      $datos=array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      /*CONSULTAS PARA OBTENER EL PADRE DE LA OPCIÓN ACTUAL PARA ACTIVARLA*/
      $val = "https://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace(''.base_url().'', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida,$this->session->userdata('id_rol'))->result();
      /*-----------------*/
      $this->load->view('template/header');
      $this->load->view("ventas/ReporteRevisionMKTD3", $datos);
  }

  public function ReporteTotalMktdFINAL($mes,$anio){
    $resultado = array();
    $sumaTotalBono1=0;
    $sumaTotalBono2=0;
    $sumaTotalComision=0;
    $numeroMayorNUS=0;
    $numeroMayorMKTD=0;
    $estatus='1,13';
    $estatusBonos='2,6';
    $fechaIninio = 0;
    $fechaFin = 0;
    if($mes != 0 && $anio != 0){
      $estatus='11';
      $estatusBonos=3;
          if($mes < 10 && $mes > 0){
            $mes="0".$mes;
          }
          $fechaIninio = date($anio."-".$mes."-01");
          $fechaFin = date($anio."-".$mes."-28");
    }
    //OBTENER LOS USUARIOS QUE COMISIONAM EN MKTD DEL CORTE ACTUAL
    $usuarios = $this->Comisiones_model->GetUserMktd($estatus,$fechaIninio,$fechaFin)->result_array();
$comentario='';
    for ($i=0; $i <count($usuarios); $i++) { 
      $sumaTotal=0;
      $Pagadas = $this->Comisiones_model->getComisionesPagadas($usuarios[$i]['id_usuario'],$fechaIninio,$fechaFin)->result_array();
      //OBTENER LOS BONOS DE USUARIO POR USUARIO
      $resultado[$i]['id_usuario'] = $usuarios[$i]['id_usuario']; 
      $resultado[$i]['nombre'] = $usuarios[$i]['nombre']; 
      $resultado[$i]['comision'] = $usuarios[$i]['comision']; 
      $sumaTotalComision = $sumaTotalComision +$usuarios[$i]['comision'];
      $sumaTotal=$sumaTotal+$usuarios[$i]['comision'];
      $resultado[$i]['pagado_mktd'] = $Pagadas[0]['pagado_mktd']; 
      $comentario='BONO NUSKAH - MKTD 5 MENSUALIDADES';
      $resultado[$i]['pagadoBono1'] = 0; 
      $BonoPagado1 = $this->Comisiones_model->getBonosPagados($usuarios[$i]['id_usuario'],$comentario,$fechaIninio,$fechaFin)->result_array();
      $resultado[$i]['pagadoBono1'] = $BonoPagado1[0]['pagado']; 
      $NUSKAH = $this->Comisiones_model->getBonoXUser($usuarios[$i]['id_usuario'],$comentario,$estatusBonos,$fechaIninio,$fechaFin)->result_array();
      $Bono1=0;
      $resultado[$i]['bono1']=0;
      $resultado[$i]['pagado1']=0;
      for($j=0;$j<count($NUSKAH);$j++){
        if($i==0){
          $numeroMayorNUS = count($NUSKAH);
        }else{
          if($numeroMayorNUS < count($NUSKAH)){
            $numeroMayorNUS = count($NUSKAH);
          }
        }
        $Bono1=$Bono1+$NUSKAH[$j]['impuesto1'];
        $sumaTotalBono1 = $sumaTotalBono1+$NUSKAH[$j]['impuesto1'];
        $sumaTotal=$sumaTotal+$NUSKAH[$j]['impuesto1'];
        $resultado[$i]['bono1'] = $NUSKAH[0]['monto']; 
        $resultado[$i]['pagado1'] = $NUSKAH[0]['pagado']; 
        $resultado[$i]['id_sede'] = $NUSKAH[0]['id_sede']; 
        $resultado[$i]['impuesto'] = $NUSKAH[0]['impuesto']; 
        $resultado[$i]['forma_pago'] = $NUSKAH[0]['forma_pago']; 
      }
      $resultado[$i]['bono_1'] = $NUSKAH; 
      $resultado[$i]['sumaBono1'] = $Bono1; 
      $comentario='BONO MARKETING - COMISIONES SIN EVIDENCIA DISPERSADO A 12 MESES ENTRE TODOS LOS INVOLUCRADOS';
      $BonoPagado2 = $this->Comisiones_model->getBonosPagados($usuarios[$i]['id_usuario'],$comentario,$fechaIninio,$fechaFin)->result_array();
      $resultado[$i]['pagadoBono2'] = $BonoPagado2[0]['pagado']; 
      $MKTD = $this->Comisiones_model->getBonoXUser($usuarios[$i]['id_usuario'],$comentario,$estatusBonos,$fechaIninio,$fechaFin)->result_array();
      $resultado[$i]['bono_2'] = $MKTD;
      $Bono2=0;
      $resultado[$i]['bono2'] = 0; 
      $resultado[$i]['pagado2']=0;
      for($j=0;$j<count($MKTD);$j++){
        if($i==0){
          $numeroMayorMKTD = count($MKTD);
        }else{
          if($numeroMayorMKTD < count($MKTD)){
            $numeroMayorMKTD = count($MKTD);
          }
        }
        $Bono2=$Bono2+$MKTD[$j]['impuesto1'];
        $sumaTotalBono2 = $sumaTotalBono2+$MKTD[$j]['impuesto1'];
        $sumaTotal=$sumaTotal+$MKTD[$j]['impuesto1'];
        $resultado[$i]['bono2'] = $MKTD[0]['monto'];
        $resultado[$i]['pagado2'] = $MKTD[0]['pagado']; 
        $resultado[$i]['id_sede'] = $MKTD[0]['id_sede']; 
        $resultado[$i]['impuesto'] = $MKTD[0]['impuesto']; 
        $resultado[$i]['forma_pago'] = $MKTD[0]['forma_pago']; 
      }
      $resultado[$i]['sumaBono2'] = $Bono2; 
      $resultado[$i]['Total'] = $sumaTotal; 
    }
    $NuevoArr = array();
    $ARRPAGOS = array();
    for ($m=0; $m <count($resultado) ; $m++) { 
      $NuevoArr[$m] = [$resultado[$m]['nombre'],$resultado[$m]['comision']];
      $cadena = '';
      $cadena2 = '';
      $NuevoArr[$m] = [$resultado[$m]['nombre'],$resultado[$m]['comision']];  
      for ($n=0; $n < $numeroMayorNUS ; $n++) {
        $evaluar = $resultado[$m]['bono_1'];
        if(isset($evaluar[$n]['n_p'])){
          if($n == $numeroMayorNUS -1){
            $cadena = $cadena.$evaluar[$n]['n_p'].'/'.$evaluar[$n]['num_pagos'].','.$evaluar[$n]['impuesto1'];
          }else{
            $cadena = $cadena.$evaluar[$n]['n_p'].'/'.$evaluar[$n]['num_pagos'].','.$evaluar[$n]['impuesto1'].',';
          }
        } else{
          if($n == $numeroMayorNUS -1 ){
            $cadena = $cadena.'0/0,0';
          }else{
            $cadena = $cadena.'0/0,0'.',';
          }
         
        }
      } 
      for ($n=0; $n < $numeroMayorMKTD ; $n++) {
        $evaluar = $resultado[$m]['bono_2'];
        if(isset($evaluar[$n]['n_p'])){
          if($n == $numeroMayorMKTD-1){
            $cadena2 = $cadena2.$evaluar[$n]['n_p'].'/'.$evaluar[$n]['num_pagos'].','.$evaluar[$n]['impuesto1'];

          }else{
            $cadena2 = $cadena2.$evaluar[$n]['n_p'].'/'.$evaluar[$n]['num_pagos'].','.$evaluar[$n]['impuesto1'].',';
          }
        } else{
          if($n == $numeroMayorMKTD-1){
            $cadena2 = $cadena2.'0/0,0';
          }else{
            $cadena2 = $cadena2.'0/0,0'.',';
          }
         
        }
      }  
      $uno = explode(",", $cadena);
      $dos = explode(",", $cadena2);   
if($numeroMayorNUS != 0){
for ($d=0; $d <count($uno) ; $d++) { 
  array_push($NuevoArr[$m],$uno[$d]);
}
}
if($numeroMayorMKTD != 0){
for ($d=0; $d <count($dos) ; $d++) { 
  array_push($NuevoArr[$m],$dos[$d]);
}
}

      array_push($NuevoArr[$m],$resultado[$m]['Total']);
      array_push($NuevoArr[$m],$resultado[$m]['sumaBono1']);
      array_push($NuevoArr[$m],$resultado[$m]['sumaBono2']);

    }

    echo json_encode(  array( "data" => $NuevoArr,
    "numeroMayorNUS" => $numeroMayorNUS,
    "numeroMayorMKTD" => $numeroMayorMKTD,
     "sumaBono1" => $sumaTotalBono1,
     "sumaBono2" => $sumaTotalBono2,
     "sumaTotalComision" => $sumaTotalComision ));
  }

  



  
  public function getDatosRevisionMktd2($mes=0,$anio=0,$estatus=0){



    if($mes == 0 ){
      $dat =  $this->Comisiones_model->getDatosRevisionMktd2()->result_array();
    }else{

      if($mes < 10){
        $mes = '0'.$mes;
      }

      $dat =  $this->Comisiones_model->getDatosRevisionMktd2($mes,$anio,$estatus)->result_array();
    }

    //print_r($dat);


   for( $i = 0; $i < count($dat); $i++ ){
    $comentario='BONO NUSKAH - MKTD 5 MENSUALIDADES';
    $comentario2='BONO MARKETING - COMISIONES SIN EVIDENCIA DISPERSADO A 12 MESES ENTRE TODOS LOS INVOLUCRADOS';

    if($mes == 0 && $anio == 0 && $estatus == 0){
      $BonoPagado2 = $this->Comisiones_model->getBonoXUser2($dat[$i]['id_usuario'],$comentario)->result_array();
      $BonoPagado3 = $this->Comisiones_model->getBonoXUser2($dat[$i]['id_usuario'],$comentario2)->result_array();

    }else{
      
      $BonoPagado2 = $this->Comisiones_model->getBonoXUser2($dat[$i]['id_usuario'],$comentario,$mes,$anio,$estatus)->result_array();
      $BonoPagado3 = $this->Comisiones_model->getBonoXUser2($dat[$i]['id_usuario'],$comentario2,$mes,$anio,$estatus)->result_array();

    }
   if(count($BonoPagado2) == 0){
    $dat[$i]['nus'] = 0;

   }else{
    $dat[$i]['nus'] = $BonoPagado2[0]['impuesto1'];

   }




    if(count($BonoPagado3) == 0){
      $dat[$i]['mktd'] = 0;
  
     }else{
      $dat[$i]['mktd'] = $BonoPagado3[0]['impuesto1'];
  
     }
    //$dat[$i]['mktd'] = $BonoPagado3[0]['impuesto1'];
       $dat[$i]['pa'] = 0;
   }
   echo json_encode( array( "data" => $dat));
  }
  /*public function getDatosRevisionMktd2(){
    $dat =  $this->Comisiones_model->getDatosRevisionMktd2()->result_array();
   for( $i = 0; $i < count($dat); $i++ ){
    $comentario='BONO NUSKAH - MKTD 5 MENSUALIDADES';
    $BonoPagado2 = $this->Comisiones_model->getBonoXUser2($dat[$i]['id_usuario'],$comentario)->result_array();
   if(count($BonoPagado2) == 0){
    $dat[$i]['nus'] = 0;

   }else{
    $dat[$i]['nus'] = $BonoPagado2[0]['impuesto1'];

   }

    $comentario2='BONO MARKETING - COMISIONES SIN EVIDENCIA DISPERSADO A 12 MESES ENTRE TODOS LOS INVOLUCRADOS';
    $BonoPagado3 = $this->Comisiones_model->getBonoXUser2($dat[$i]['id_usuario'],$comentario2)->result_array();

    if(count($BonoPagado3) == 0){
      $dat[$i]['mktd'] = 0;
  
     }else{
      $dat[$i]['mktd'] = $BonoPagado3[0]['impuesto1'];
  
     }
    //$dat[$i]['mktd'] = $BonoPagado3[0]['impuesto1'];
       $dat[$i]['pa'] = 0;
   }
   echo json_encode( array( "data" => $dat));
  }*/
  


  public function getPagosByUser($user,$mes,$anio){
    $dat =  $this->Comisiones_model->getPagosByUser($user,$mes,$anio)->result_array();
   echo json_encode( $dat);
  }



  public function liquidadosDescuentos()
    {
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/liquidadosDescuentos", $datos);
    }

  public function getDescuentosLiquidados()
    {
      $res["data"] = $this->Comisiones_model->getDescuentosLiquidados()->result_array();
      echo json_encode($res);
    }

    public function AddEmpresa(){
      $idLote = $this->input->post("idLoteE");
      $Precio = $this->input->post("PrecioLoteE");
      $idCliente = $this->input->post("idClienteE");
  
      $respuesta = $this->Comisiones_model->AddEmpresa($idLote,($Precio*(1/100)),$idCliente);
      echo json_encode($respuesta);
    }


    public function dispersar_pago_especial()
    {
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/dispersar_pago_especial", $datos);
    }
    public function porcentajesEspecial($idCliente){
      echo json_encode($this->Comisiones_model->porcentajesEspecial($idCliente));
    }
    public function getDataDispersionPagoEspecial($val = '')
    {
      //echo $val;
      $datos = array();
      if(empty($val)){
        $datos = $this->Comisiones_model->getDataDispersionPagoEspecial();
      }else{
        $datos = $this->Comisiones_model->getDataDispersionPagoEspecial($val);
      }
      
      if ($datos != null) {
        echo json_encode($datos);
      } else {
        echo json_encode(array());
      }
    }

    /************************/


    function reporte_pagos(){
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $datos = array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace('' . base_url() . '', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
        $this->load->view('template/header');
        $this->load->view("comisiones/reporte_pagos", $datos);
    }

    function getByTypeOU($userType){
        $data = $this->Comisiones_model->getByTypeOU($userType);
        if($data != null) {
            echo json_encode($data);
        }else{
            echo json_encode(array());
        }
        exit;
    }

    function inforReporteAsesor(){
      $id_asesor = $this->session->userdata('id_usuario');

        $data['data']= $this->Comisiones_model->inforReporteAsesor($id_asesor);
        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode(array());
        }
        exit;
    }

    function conglomerado_descuentos(){
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $datos = array();
        $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
        $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
        $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $salida = str_replace('' . base_url() . '', '', $val);
        $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
        $this->load->view('template/header');
        $this->load->view("ventas/conglomerado", $datos);
    }

    function fusionAcLi(){
        $data['data']= $this->Comisiones_model->fusionAcLi();
        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode(array());
        }
        exit;
    }

    public function flujo_comisiones() {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();

      $this->load->view('template/header');
      $this->load->view('ventas/flujo_comisiones', $datos);
    }

    public function getDatosFlujoComisiones() {
      $data = $this->Comisiones_model->getDatosFlujoComisiones()->result_array();
      echo json_encode(array('data' => $data));
    }

      public function getStoppedCommissions()
    {
      $datos = array();
      $datos = $this->Comisiones_model->getStoppedCommissions();
      if ($datos != null) {
        echo json_encode($datos);
      } else {
        echo json_encode(array());
      }
    }

    //  public function viewDetenidas()
    // {
    //     $datos = $this->get_menu->get_menu_data($this->session->userdata('id_rol'));
    //     $this->load->view('template/header');
    //     $this->load->view("ventas/comisiones_detenidas", $datos);
    // }


    
    public function viewDetenidas() {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();

      $this->load->view('template/header');
      $this->load->view('ventas/comisiones_detenidas', $datos);
    }


    /**---------------------------------PRESTAMOS AUTOMATICOS------------------------------------- */
    public function panel_prestamos()
    {

      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      $this->load->view('template/header');
      $this->load->view("ventas/panel_prestamos", $datos);
    }
    public function viewHistorialPrestamos()
    {
        $datos = $this->get_menu->get_menu_data($this->session->userdata('id_rol'));
        $this->load->view('template/header');
        $this->load->view("ventas/historial_prestamos", $datos);
    }
    /**------------------------------------------------------------------------------------------- */


    public function cambiarEstatusComisiones()
    {
        $idPagos = explode(',', $this->input->post('idPagos'));
        $userId = $this->session->userdata('id_usuario');
        $estatus = $_POST['estatus'];
        $comentario = $_POST['comentario'];
        $historiales = array();

        foreach($idPagos as $pago) {
            $historiales[] = array(
                'id_pago_i' => $pago,
                'id_usuario' =>  $userId,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'estatus' => 1,
                'comentario' => $comentario
            );
        }

        $resultUpdate = $this->Comisiones_model->massiveUpdateEstatusComisionInd(implode(',', $idPagos), $estatus);
        $resultMassiveInsert = $this->Comisiones_model->insert_phc($historiales);

        echo ($resultUpdate && $resultMassiveInsert);
    }

    public function getUsersName()
    {
        $result = $this->Comisiones_model->getUsersName();
        echo json_encode($result);
    }

    public function getPuestoByIdOpts()
    {
        $result = $this->Comisiones_model->getPuestoByIdOpts('3,7,9');
        echo json_encode($result);
    }
    public function getDetallePrestamo($idPrestamo)
    {
        $general = $this->Comisiones_model->getGeneralDataPrestamo($idPrestamo);
        $detalle = $this->Comisiones_model->getDetailPrestamo($idPrestamo);
        echo json_encode(array(
            'general' => $general,
            'detalle' => $detalle
        ));
    }
    public function getPrestamosTable($rol, $user)
    {
        $data = $this->Comisiones_model->getPrestamosTable($rol, $user);
        echo json_encode(array('data' => $data));
    }
    public function lista_estatus_descuentos()
    {
      echo json_encode($this->Comisiones_model->lista_estatus_descuentos()->result_array());
    }

    public function getTotalPagoFaltanteUsuario($usuarioId)
    {
        $data = $this->Comisiones_model->getTotalPagoFaltanteUsuario($usuarioId);
        echo json_encode($data);
    }

    public function reactivarPago()
    {
        $idDescuento = $_POST['id_descuento'];
        $fechaActivacion = strtotime($_POST['fecha']);
        $diaActivacion = date('d', $fechaActivacion);
        $mesActivacion = date('m', $fechaActivacion);
        $anioActivacion = date('Y', $fechaActivacion);
        $mesActual = date('m');
        $anioActual = date('Y');

        if ($diaActivacion >= 1 && $diaActivacion <= 5) {
            if ($mesActivacion === $mesActual) {
                if ($anioActivacion === $anioActual) {
                    $result = $this->Comisiones_model->updatePagoReactivadoMismoDiaMes($idDescuento,
                        date('Y-m-d H:i:s', $fechaActivacion));
                } else {
                    $result = $this->Comisiones_model->updatePagoReactivadoFechaDiferente($idDescuento,
                        date('Y-m-d H:i:s', $fechaActivacion));
                }
            } else {
                $result = $this->Comisiones_model->updatePagoReactivadoFechaDiferente($idDescuento,
                    date('Y-m-d H:i:s', $fechaActivacion));
            }
        } else if ($mesActivacion === $mesActual) {
            $result = $this->Comisiones_model->updatePagoReactivadoMismoMes($idDescuento,
                date('Y-m-d H:i:s', $fechaActivacion));
        } else {
            $result = $this->Comisiones_model->updatePagoReactivadoFechaDiferente($idDescuento,
                date('Y-m-d H:i:s', $fechaActivacion));
        }

        echo json_encode($result);
    }

    public function viewAsistentesGerencia()
    {
        $datos = $this->get_menu->get_menu_data($this->session->userdata('id_rol'));
        $this->load->view('template/header');
        $this->load->view("ventas/seguimiento_comisiones_asistente", $datos);
    }

    public function getUsuariosByComisionesAsistentes($idUsuarioSelect, $proyecto, $estatus)
    {
        $data = $this->Comisiones_model->getUsuariosByComisionesAsistentes($idUsuarioSelect, $proyecto, $estatus);
        for($i = 0; $i < count($data); $i++ ){
            $data[$i]['pa'] = 0;
        }
        echo json_encode(array('data' => $data));
    }

    public function getPuestoComisionesAsistentes()
    {
        $data = $this->Comisiones_model->getOpcionCatByIdCatAndIdOpt(1, '3,7,9');
        echo json_encode($data);
    }

    public function findUsuariosByPuestoAsistente($puesto)
    {
        $idUsuario = $this->session->userdata('id_usuario');
        $data = $this->Comisiones_model->findUsuariosByPuestoAsistente($puesto, $idUsuario);
        echo json_encode($data);
    }

    public function findAllResidenciales()
    {
        $data = $this->Comisiones_model->findAllResidenciales();
        echo json_encode($data);
    }

    public function getEstatusComisionesAsistentes()
    {
        $data = $this->Comisiones_model->get_lista_estatus()->result_array();
        echo json_encode($data);
    }

    public function findAllPlanes()
    {
        $data = $this->Comisiones_model->findAllPlanes();
        echo json_encode($data);
    }

    public function findPlanDetailById($idPlan)
    {
        $data = $this->Comisiones_model->findPlanDetailById($idPlan);
        $info = array();
        $info['id_plan'] = $data->id_plan;
        $info['descripcion'] = $data->descripcion;
        $info['comisiones'][] = array(
            'puesto' => $data->director,
            'com' => $data->comDi,
            'neo' => $data->neoDi
        );
        $info['comisiones'][] = array(
            'puesto' => $data->regional,
            'com' => $data->comRe,
            'neo' => $data->neoRe
        );
        $info['comisiones'][] = array(
            'puesto' => $data->subdirector,
            'com' => $data->comSu,
            'neo' => $data->neoSu
        );
        $info['comisiones'][] = array(
            'puesto' => $data->gerente,
            'com' => $data->comGe,
            'neo' => $data->neoGe
        );
        $info['comisiones'][] = array(
            'puesto' => $data->coordinador,
            'com' => $data->comCo,
            'neo' => $data->neoCo
        );
        $info['comisiones'][] = array(
            'puesto' => $data->asesor,
            'com' => $data->comAs,
            'neo' => $data->neoAs
        );
        $info['comisiones'][] = array(
            'puesto' => $data->otro,
            'com' => $data->comOt,
            'neo' => $data->neoOt
        );
        $info['comisiones'][] = array(
            'puesto' => $data->mktd,
            'com' => $data->comMk,
            'neo' => $data->neoMk
        );
        $info['comisiones'][] = array(
            'puesto' => $data->otro2,
            'com' => $data->comOt2,
            'neo' => $data->neoOt2
        );

        echo json_encode($info);
    }

    public function viewVentasCanceladas()
    {
        $datos = $this->get_menu->get_menu_data($this->session->userdata('id_rol'));
        $this->load->view('template/header');
        $this->load->view("ventas/ventas_canceladas", $datos);
    }

    public function getVentasCanceladas()
    {
        $data = $this->Comisiones_model->getVentasCanceladas();
        echo json_encode(array('data' => $data));
    }

    public function getDetailVentaCancelada($idLote, $idCliente)
    {
        $cantidades = $this->Comisiones_model->getVentCanceladaSuma($idLote, $idCliente);
        $detalle = $this->Comisiones_model->getVentaCanceladaDetalle($idLote, $idCliente);
        echo json_encode(array(
            'cantidades' => $cantidades,
            'detalle' => $detalle
        ));
    }

    public function updateBanderaDetenida() {
      $response = $this->Comisiones_model->updateBanderaDetenida($_POST['idLote'], true);
      echo json_encode($response);
    }
    

    public function changeLoteToStopped()
    {

        $response = $this->Comisiones_model->insertHistorialLog($_POST['id_pagoc'], $this->session->userdata('id_usuario'), 1, $_POST['descripcion'],
                'pago_comision', $_POST['motivo']);
        if ($response) {
          $response = $this->Comisiones_model->updateBanderaDetenida($_POST['id_pagoc']);
        }

         echo json_encode($response);
    }

    public function changeLoteToPenalizacion()
    {
        $response = $this->Comisiones_model->insertHistorialLog($_POST['id_lote'], $this->session->userdata('id_usuario'), 1, 'SE ACEPTÓ PENALIZACIÓN',
                'penalizaciones', 'NULL');
        if ($response) {
          $response = $this->Comisiones_model->updatePenalizacion($_POST['id_lote'], $_POST['id_cliente']);
        }

         echo json_encode($response);
    }

    public function changeLoteToPenalizacionCuatro()
    {
        $response = $this->Comisiones_model->insertHistorialLog($_POST['id_lote4'], $this->session->userdata('id_usuario'), 1, 'SE ACEPTÓ PENALIZACIÓN + 160 DÍAS',
                'penalizaciones', 'NULL');
        if ($response) {
          $response = $this->Comisiones_model->updatePenalizacionCuatro($_POST['id_lote4'], $_POST['id_cliente4'], $_POST['asesor'], $_POST['coordinador'], $_POST['gerente']);
        }

         echo json_encode($response);
    }
    

    public function getFormasPago()
    {
        $data = $this->Comisiones_model->getFormasPago();
        echo json_encode($data);
    }

    public function getTotalComisionAsesor()
    {
        $idUsuario = $this->session->userdata('id_usuario');
        $data = $this->Comisiones_model->getTotalComisionAsesor($idUsuario);
        echo json_encode($data);
    }

    public function pagosExtranjero()
    {
      $datos = array();
      $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
      $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
      $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
      $salida = str_replace('' . base_url() . '', '', $val);
      $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
      switch($this->session->userdata('id_rol')){

        case '31':
        $this->load->view('template/header');
        $this->load->view("ventas/vista_extranjero_internomex", $datos);
        break;

        default:
        $this->load->view('template/header');
        $this->load->view("ventas/vista_extranjero_contraloria", $datos);
        break;
      }

    }

    public function getComprobantesExtranjero()
    {
        $data = $this->Comisiones_model->getComprobantesExtranjero();
        echo json_encode(array('data' => $data));
    }

    public function getDatosNuevasEContraloria($proyecto,$condominio){
      $dat =  $this->Comisiones_model->getDatosNuevasEContraloria($proyecto,$condominio)->result_array();
      for( $i = 0; $i < count($dat); $i++ ){
        $dat[$i]['pa'] = 0;
      }
      echo json_encode( array( "data" => $dat));
    }

    public function getDataConglomerado($tipoDescuento)
    {
        $data = $this->Comisiones_model->fusionAcLi($tipoDescuento);
        echo json_encode(array('data' => $data));
    }

    public function eliminarDescuentoUniversidad($idDescuento)
    {
        $this->Comisiones_model->eliminarDescuentoUniversidad($idDescuento);
        echo json_encode(true);
    }

    public function obtenerDescuentoUniversidad($idDescuento)
    {
        $comision = $this->Comisiones_model->obtenerDescuentoUniversidad($idDescuento);
        echo json_encode($comision);
    }

    public function actualizarDescuentoUniversidad()
    {
        $idDescuento = $this->input->post('id_descuento');
        $data = array(
            'monto' => $this->input->post('descuento'),
            'pago_ind' => str_replace(',', '', $this->input->post('pago_ind'))
        );

        $this->Comisiones_model->actualizarDescuentoUniversidad($idDescuento, $data);

        echo json_encode(true);
    }
    public function getHistorialPrestamoAut($idRelacion) {
      $data = $this->Comisiones_model->getHistorialPrestamoAut($idRelacion);
      echo json_encode($data);
  }

  public function sendCommissionToPay() {
    for ($i = 0; $i < count($this->input->post("id_lote")); $i++) {
      $insertToData[$i] = array(
          "id_lote" => $_POST['id_lote'][$i],
          "precio" => 0,
          "dispersion" => 1,
          "estatus" => 1,
          "creado_por" => $this->session->userdata('id_usuario'),
          "fecha_creacion" => date("Y-m-d H:i:s")
      );
    }
    $insertResponse = $this->General_model->insertBatch("reportes_marketing", $insertToData);
    echo json_encode($insertResponse);
  }

  public function historial_estatus_descuentos()
  {

    $datos = array();
    $datos["datos2"] = $this->Asesor_model->getMenu($this->session->userdata('id_rol'))->result();
    $datos["datos3"] = $this->Asesor_model->getMenuHijos($this->session->userdata('id_rol'))->result();
    $val = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $salida = str_replace('' . base_url() . '', '', $val);
    $datos["datos4"] = $this->Asesor_model->getActiveBtn($salida, $this->session->userdata('id_rol'))->result();
    $this->load->view('template/header');
    $this->load->view("ventas/historial_estatus_descuentos", $datos);
  }
  public function lista_estatus_desc()
    {
        $data = $this->Comisiones_model->getListaEstatusHistorialEstatus_desc();
        echo json_encode($data);
    }
    public function getDatosHistorialPagoEstatus_desc($proyecto,$status, $usuario){

      ini_set('max_execution_time',0);
          set_time_limit(0);
          ini_set('memory_limit','-1');
            
      $dat =  $this->Comisiones_model->getDatosHistorialPagoEstatus_desc($proyecto, $status, $usuario)->result_array();
     echo json_encode( array( "data" => $dat));
    }
    public function cambiarEstatusPagosDescuentos()
    {
      $apli = 1;

        $idPagos = explode(',', $this->input->post('idPagos'));
        $userId = $this->session->userdata('id_usuario');
        $estatus = $_POST['estatus'];
        $comentario = $_POST['comentario'];
        $historiales = array();
        if($estatus == 1 || $estatus == 4){
          $apli = 0;
        }

        foreach($idPagos as $pago) {
            $historiales[] = array(
                'id_pago_i' => $pago,
                'id_usuario' =>  $userId,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'estatus' => $estatus,
                'comentario' => $comentario
            );
        }

        $resultUpdate = $this->Comisiones_model->massiveUpdateEstatusComisionIndDescuento(implode(',', $idPagos), $estatus,$apli);
        $resultMassiveInsert = $this->Comisiones_model->insert_phc($historiales);

        echo ($resultUpdate && $resultMassiveInsert);
    }

}
