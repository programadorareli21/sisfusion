
<body class="">
<div class="wrapper ">
	<?php
	//se debe validar que tipo de perfil esta sesionado para poder asignarle el tipo de sidebar
	if($this->session->userdata('id_rol')=="16")//contratacion
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
		/*$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'contrato' => 0,
			'documentacion' => 1,
			'corrida' => 0,
			'inventario' => 0,
			'inventarioDisponible' => 0,
			'status8' => 0,
			'status14' => 0,
			'lotesContratados' => 0,
			'ultimoStatus' => 0,
			'lotes45dias' => 0,
			'consulta9Status' => 0,
			'consulta12Status' => 0,
			'gerentesAsistentes' => 0,
			'documentacion_ds' => 0,
			'expedientesIngresados'	=>	0,
			'corridasElaboradas'	=>	0,
			'nuevasComisiones'	=>	0,
			'histComisiones'	=>	0
		);
		//$this->load->view('template/contratacion/sidebar', $dato);
		$this->load->view('template/sidebar', $dato);*/
	}
	else if($this->session->userdata('id_rol')=="6")//ventasAsistentes
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
		/*$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'corridaF' => 0,
			'documentacion' => 1,
			'autorizacion' => 0,
			'contrato' => 0,
			'inventario' => 0,
			'estatus8' => 0,
			'estatus14' => 0,
			'estatus7' => 0,
			'reportes' => 0,
			'estatus9' => 0,
			'disponibles' => 0,
			'asesores' => 0,
			'nuevasComisiones' => 0,
			'histComisiones' => 0,
			'prospectos' => 0,
			'prospectosAlta' => 0,
			'documentacion_ds' => 0,
			'nuevasComisiones'	=>	0,
			'histComisiones'	=>	0



		);
		//$this->load->view('template/ventas/sidebar', $dato);
		$this->load->view('template/sidebar', $dato);*/
	}
	elseif($this->session->userdata('id_rol')=="11")//administracion
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
		/*$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'documentacion' => 1,
			'inventario' => 0,
			'status11' => 0,
			'nuevasComisiones'	=>	0,
			'documentacion_ds' => 0,
			'histComisiones'	=>	0
		);
		//$this->load->view('template/administracion/sidebar', $dato);
		$this->load->view('template/sidebar', $dato);*/
	}
	elseif($this->session->userdata('id_rol')=="15")//juridico
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
		/*$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'documentacion' => 1,
			'contrato' => 0,
			'inventario' => 0,
			'status3' => 0,
			'status7' => 0,
			'lotesContratados' => 0,
			'documentacion_ds' => 0,
			'nuevasComisiones'	=>	0,
			'histComisiones'	=>	0
		);
		//$this->load->view('template/juridico/sidebar', $dato);
		$this->load->view('template/sidebar', $dato);*/
	}
	elseif($this->session->userdata('id_rol')=="13")//contraloria
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
	/*	$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'expediente' => 0,
			'corrida' => 0,
			'documentacion' => 1,
			'historialpagos' => 0,
			'inventario' => 0,
			'estatus20' => 0,
			'estatus2' => 0,
			'estatus5' => 0,
			'estatus6' => 0,
			'estatus9' => 0,
			'estatus10' => 0,
			'estatus13' => 0,
			'estatus15' => 0,
			'enviosRL' => 0,
			'estatus12' => 0,
			'acuserecibidos' => 0,
			'comnuevas' => 0,
			'comhistorial' => 0,
			'tablaPorcentajes' => 0,
			'nuevasComisiones'	=>	0,
			'histComisiones'	=>	0,
			'integracionExpediente' => 0,
			'documentacion_ds' => 0,
			'expRevisados' => 0,
			'estatus10Report' => 0,
			'rechazoJuridico' => 0
		);

		//$this->load->view('template/contraloria/sidebar', $dato);
		$this->load->view('template/sidebar', $dato);*/
	}
	elseif($this->session->userdata('id_rol')=="7")//asesor
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
		/*
		$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'corridaF' => 0,
			'inventario' => 0,
			'prospectos' => 0,
			'prospectosAlta' => 0,
			'statistic' => 0,
			'comisiones' => 0,
			'DS'    => 0,
			'DSConsult' => 0,
			'documentacion' => 1,
			'documentacion_ds' => 0,
			'inventarioDisponible'  =>  0,
			'manual'    =>  0,
			'nuevasComisiones'     => 0,
			'histComisiones'       => 0,
			'sharedSales' => 0,
			'coOwners' => 0,
			'references' => 0,
			'autoriza'	=>	0
		);
		$this->load->view('template/sidebar', $dato);*/
	}
	elseif($this->session->userdata('id_rol')=="12")//caja
	{
		/*-------------------------------------------------------*/
$datos = array();
	$datos = $datos4;
	$datos = $datos2;
	$datos = $datos3;  
			$this->load->view('template/sidebar', $datos);
 /*--------------------------------------------------------*/
		/*$dato= array(
			'home' => 0,
			'listaCliente' => 0,
			'documentacion' => 1,
			'documentacion_ds' => 0,
			'cambiarAsesor' => 0,
			'historialPagos' => 0,
			'pagosCancelados' => 0,
			'altaCluster' => 0,
			'altaLote' => 0,
			'inventario' => 0,
			'actualizaPrecio' => 0,
			'actualizaReferencia' => 0,
			'liberacion' => 0
		);
		//$this->load->view('template/contraloria/sidebar', $dato);
		$this->load->view('template/sidebar', $dato);*/
	}
	else
	{
		echo '<script>alert("ACCESSO DENEGADO"); window.location.href="'.base_url().'";</script>';
	}
	?>
	<!--Contenido de la página-->
	<div class="content">
		<div class="container-fluid">
			<!-- modal  INSERT FILE-->
			<div class="modal fade" id="addFile" >
				<div class="modal-dialog">
					<div class="modal-content" >
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<center><h3 class="modal-title" id="myModalLabel"><span class="lote"></span></h3></center>
						</div>
						<div class="modal-body">
							<!--<div class="input-group">
								<label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Seleccionar archivo&hellip; <input type="file" name="expediente" id="expediente" style="display: none;">
                                    </span>
								</label>
								<input type="text" class="form-control" id= "txtexp" name="txtexp" readonly>
							</div>-->
							<div class="input-group">
								<label class="input-group-btn">
									<span class="btn btn-primary btn-file">
									Seleccionar archivo&hellip;<input type="file" name="expediente" id="expediente" style="display: none;">
									</span>
								</label>
								<input type="text" class="form-control" id= "txtexp" readonly>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" id="sendFile" class="btn btn-primary"><span
									class="material-icons" >send</span> Guardar documento </button>
							<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- modal INSERT-->

			<!--modal que pregunta cuando se esta borrando un archivo-->
			<div class="modal fade" id="cuestionDelete" >
				<div class="modal-dialog">
					<div class="modal-content" >
						<div class="modal-header">
							<center><h3 class="modal-title">¡Eliminar archivo!</h3></center>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row centered center-align">
									<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-2">
										<h1 class="modal-title"> <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i></h1>
									</div>
									<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-10">
										<h4 class="modal-title">¿Está seguro de querer eliminar definivamente este archivo (<b><span class="tipoA"></span></b>)? </h4>
										<h5 class="modal-title"><i> Esta acción no se puede deshacer.</i> </h5>
									</div>
								</div>

							</div>
						</div>
						<div class="modal-footer">
							<br><br>
							<button type="button" id="aceptoDelete" class="btn btn-primary"> Si, borrar </button>
							<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"> Cancelar </button>
						</div>
					</div>
				</div>
			</div>
			<!--termina el modal de cuestion-->


			<!-- autorizaciones-->
			<div class="modal fade" id="verAutorizacionesAsesor" >
				<div class="modal-dialog">
					<div class="modal-content" >
						<div class="modal-header">
							<center><h3 class="modal-title">Autorizaciones <span class="material-icons">vpn_key</span></h3></center>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div id="auts-loads">
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"> Aceptar </button>
						</div>
					</div>
				</div>
			</div>
			<!-- autorizaciones end-->



			<div class="row">
				<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header card-header-icon" data-background-color="goldMaderas">
							<i class="material-icons">reorder</i>
						</div>
						<div class="card-content">
							<h4 class="card-title" style="text-align: center">Documentación</h4>
							<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label>Proyecto:</label><br>
									<select name="filtro3" id="filtro3" class="selectpicker" data-show-subtext="true" data-live-search="true"  data-style="btn" title="Selecciona Proyecto" data-size="7" required>
										<?php

										if($residencial != NULL) :

											foreach($residencial as $fila) : ?>
												<option value= <?=$fila['idResidencial']?> > <?=$fila['nombreResidencial']?> </option>
											<?php endforeach;

										endif;

										?>
									</select>
								</div>
								<div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label>Condominio:</label><br>
									<select id="filtro4" name="filtro4" class="selectpicker" data-show-subtext="true" data-live-search="true"  data-style="btn" title="Selecciona Condominio" data-size="7"></select>
								</div>
								<div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label>Lote:</label><br>
									<select id="filtro5" name="filtro5" class="selectpicker" data-show-subtext="true" data-live-search="true"  data-style="btn" title="Selecciona Lote" data-size="7"></select>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-content" style="padding: 30px 20px;">
							<div class="material-datatables">
										<table id="tableDoct" class="table table-bordered table-hover" width="100%" style="text-align:center;">
											<thead>
											<tr>
												<th style="font-size: .9em;" class="text-center">Proyecto</th>
												<th style="font-size: .9em;" class="text-center">Condominio</th>
												<th style="font-size: .9em;" class="text-center">Lote</th>
												<th style="font-size: .9em;" class="text-center">Cliente</th>
												<th style="font-size: .9em;" class="text-center">Nombre de Documento</th>
												<th style="font-size: .9em;" class="text-center">Hora/Fecha</th>
												<th style="font-size: .9em;" class="text-center">Documento</th>
												<th style="font-size: .9em;" class="text-center">Responsable</th>
												<th style="font-size: .9em;" class="text-center">Ubicación</th>
											</tr>
											</thead>

										</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('template/footer_legend');?>
</div>
</div>

</div><!--main-panel close-->
</body>
<?php $this->load->view('template/footer');?>
<!--DATATABLE BUTTONS DATA EXPORT-->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>dist/css/shadowbox.css">
<script type="text/javascript" src="<?=base_url()?>dist/js/shadowbox.js"></script>
<script type="text/javascript">
	Shadowbox.init();
</script>
<script>
	$(document).ready (function() {
		$(document).on('fileselect', '.btn-file :file', function(event, numFiles, label) {
			var input = $(this).closest('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;
			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}
		});


		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
			console.log('triggered');
		});



		$('#filtro3').change(function(){

			var valorSeleccionado = $(this).val();

			// console.log(valorSeleccionado);
			//build select condominios
			$("#filtro4").empty().selectpicker('refresh');
			$.ajax({
				url: '<?=base_url()?>registroCliente/getCondominios/'+valorSeleccionado,
				type: 'post',
				dataType: 'json',
				success:function(response){
					var len = response.length;
					for( var i = 0; i<len; i++)
					{
						var id = response[i]['idCondominio'];
						var name = response[i]['nombre'];
						$("#filtro4").append($('<option>').val(id).text(name));
					}
					$("#filtro4").selectpicker('refresh');

				}
			});
		});


		$('#filtro4').change(function(){
			var residencial = $('#filtro3').val();
			var valorSeleccionado = $(this).val();
			// console.log(valorSeleccionado);
			//$('#filtro5').load("<?//= site_url('registroCliente/getLotesAll') ?>///"+valorSeleccionado+'/'+residencial);
			$("#filtro5").empty().selectpicker('refresh');
			$.ajax({
				url: '<?=base_url()?>registroCliente/getLotesAll/'+valorSeleccionado+'/'+residencial,
				type: 'post',
				dataType: 'json',
				success:function(response){
					var len = response.length;
					for( var i = 0; i<len; i++)
					{
						var id = response[i]['idLote'];
						var name = response[i]['nombreLote'];
						$("#filtro5").append($('<option>').val(id).text(name));
					}
					$("#filtro5").selectpicker('refresh');

				}
			});
		});

		$('#filtro5').change(function(){

			var valorSeleccionado = $(this).val();

			console.log(valorSeleccionado);
			$('#tableDoct').DataTable({
				destroy: true,
				lengthMenu: [[15, 25, 50, -1], [10, 25, 50, "All"]],
				"ajax":
					{
						"url": '<?=base_url()?>index.php/registroCliente/expedientesWS/'+valorSeleccionado,
						"dataSrc": ""
					},
				"dom": "rtip",
				"language":{ "url": "<?=base_url()?>/static/spanishLoader.json" },
				"ordering": false,
				"columns":
					[
						{
						"width": "8%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+d.nombreResidencial+'</p>';
						}
						},
		
						{
						"width": "8%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+d.nombre+'</p>';
						}
						},
						{
						"width": "12%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+d.nombreLote+'</p>';
						}
						},
						{
						"width": "10%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+d.nomCliente +' ' +d.apellido_paterno+' '+d.apellido_materno+'</p>';
						}
						},
							
						{
						"width": "10%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+d.movimiento+'</p>';
						}
						},
						{
						"width": "10%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+d.modificado+'</p>';
						}
						},

						{
							"width": "10%",
							data: null,
							render: function ( data, type, row )
							{

								if (getFileExtension(data.expediente) == "pdf") {
									if(data.tipo_doc == 8){
										if(data.idMovimiento == 36 || data.idMovimiento == 6 || data.idMovimiento == 23 || data.idMovimiento == 76 || data.idMovimiento == 83){
											file = '<a class="pdfLink3" data-Pdf="'+data.expediente+'" title= "Ver archivo"  data-nomExp="'+data.expediente+'"><img src=\'<?=base_url()?>static/images/pdf.png\' style="width:30%"/></a> | <button type="button" title= "Eliminar archivo" id="deleteDoc" class="btn btn-danger btn-sm delete" data-tipodoc="'+data.movimiento+'" data-iddoc="'+data.idDocumento+'" ><span class="glyphicon glyphicon-trash"></span></i></button>';
										} else {
											file = '<a class="pdfLink3" data-Pdf="'+data.expediente+'" title= "Ver archivo"  data-nomExp="'+data.expediente+'"><img src=\'<?=base_url()?>static/images/pdf.png\' style="width:30%"/></a>';
										}
									} else {
										file = '<a class="pdfLink" data-Pdf="'+data.expediente+'" title= "Ver archivo"  data-nomExp="'+data.expediente+'"><img src=\'<?=base_url()?>static/images/pdf.png\' style="width:30%"/></a>';
									}
								}
								else if (getFileExtension(data.expediente) == "xlsx") {
									file = '<a href="../../static/documentos/cliente/corrida/' + data.expediente + '" ><img src="<?=base_url()?>static/images/excel.png" style="width:27%"/> <src="../../static/documentos/cliente/corrida/"' + data.expediente + '"></a>';
								}
								else if (getFileExtension(data.expediente) == "NULL" || getFileExtension(data.expediente) == 'null' || getFileExtension(data.expediente) == "") {
									if(data.tipo_doc == 7){
										file = '<button type="button" title= "Corrida inhabilitada" class="btn btn-warning btn-sm disabled"><i class="fa fa-list-alt" aria-hidden="true"></i></button>';
									} else if(data.tipo_doc == 8){
										if(data.idMovimiento == 36 || data.idMovimiento == 6 || data.idMovimiento == 23 || data.idMovimiento == 76 || data.idMovimiento == 83){
											file = '<button type="button" id="updateDoc" title= "Adjuntar archivo" class="btn btn-success btn-sm update" data-iddoc="'+data.idDocumento+'" data-tipodoc="'+data.tipo_doc+'" data-descdoc="'+data.movimiento+'" data-idCliente="'+data.idCliente+'" data-nombreResidencial="'+data.nombreResidencial+'" data-nombreCondominio="'+data.nombre+'" data-nombreLote="'+data.nombreLote+'" data-idCondominio="'+data.idCondominio+'" data-idLote="'+data.idLote+'"><i class="fa fa-upload" aria-hidden="true"></i></button>';
										} else {
											file = '<button type="button" id="updateDoc" title= "No se permite adjuntar archivos" class="btn btn-success btn-sm disabled"><i class="fa fa-upload" aria-hidden="true"></i></button>';
										}
									} else {
										file = '<button type="button" id="updateDoc" title= "No se permite adjuntar archivos" class="btn btn-success btn-sm disabled"><i class="fa fa-upload" aria-hidden="true"></i></button>';
									}
								}
								else if (getFileExtension(data.expediente) == "Depósito de seriedad") {
									file = '<a class="btn btn-primary btn-round btn-fab btn-fab-mini pdfLink2" data-idc="'+data.id_cliente+'" data-nomExp="'+data.expediente+'" title= "Depósito de seriedad"><i class="material-icons">insert_drive_file</i></a>';
								}
                                else if (getFileExtension(data.expediente) == "Depósito de seriedad versión anterior") {
                                    file = '<a class="btn btn-primary btn-round btn-fab btn-fab-mini pdfLink22" data-idc="'+data.id_cliente+'" data-nomExp="'+data.expediente+'" title= "Depósito de seriedad"><i class="material-icons">insert_drive_file</i></a>';
                                }
								else if (getFileExtension(data.expediente) == "Autorizaciones") {
									file = '<a href="#" class="btn btn-danger btn-sm btn-round btn-fab btn-fab-mini seeAuts" title= "Autorizaciones" data-id_autorizacion="'+data.id_autorizacion+'" data-idLote="'+data.idLote+'"><i class="material-icons">vpn_key</i></a>';
								}
								else if (getFileExtension(data.expediente) == "Prospecto") {
									file = '<a href="#" class="btn btn-primary btn-sm verProspectos" title= "Prospección" data-id-prospeccion="'+data.id_prospecto+'" data-nombreProspecto="'+data.nomCliente+' '+data.apellido_paterno+' '+data.apellido_materno+'"><i class="material-icons">record_voice_over</i></a>';
								}
								else
								{
									file = '<a class="pdfLink" data-Pdf="'+data.expediente+'" data-nomExp="'+data.expediente+'"><img src="<?=base_url()?>static/documentos/cliente/expediente/'+data.expediente+'" style="width:30%"/></a>';
								}
								return file;
							}
						},
						{
						"width": "10%",
						"data": function( d ){
							return '<p style="font-size: .8em">'+ myFunctions.validateEmptyFieldDocs(d.primerNom) +' '+myFunctions.validateEmptyFieldDocs(d.apellidoPa)+' '+myFunctions.validateEmptyFieldDocs(d.apellidoMa)+'</p>';
						}
						},						
						
						{
						"width": "10%",
						"data": function( d ){
							var validaub = (d.ubic == null) ? '' : d.ubic;
							
							return '<p style="font-size: .8em">'+ validaub +'</p>';
						}
						},	
					]
			});

		});






	});/*document Ready*/

	function getFileExtension(filename) {
		validaFile =  filename == null ? 'null':
			filename == 'Depósito de seriedad' ? 'Depósito de seriedad':
				filename == 'Autorizaciones' ? 'Autorizaciones':
					filename.split('.').pop();
		return validaFile;
	}

	$(document).on('click', '.pdfLink', function () {
		var $itself = $(this);
		Shadowbox.open({
			content:    '<div><iframe style="overflow:hidden;width: 100%;height: -webkit-fill-available;" src="<?=base_url()?>static/documentos/cliente/expediente/'+$itself.attr('data-Pdf')+'"></iframe></div>',
			player:     "html",
			title:      "Visualizando archivo: " + $itself.attr('data-nomExp'),
			width:      985,
			height:     660
		});
	});
	$(document).on('click', '.pdfLink2', function () {
		var $itself = $(this);
		Shadowbox.open({
			content:    '<div><iframe style="overflow:hidden;width: 100%;height: -webkit-fill-available;" src="<?=base_url()?>asesor/deposito_seriedad/'+$itself.attr('data-idc')+'/1/"></iframe></div>',
			player:     "html",
			title:      "Visualizando archivo: " + $itself.attr('data-nomExp'),
			width:      1600,
			height:     900
		});
	});
	$(document).on('click', '.pdfLink22', function () {
        var $itself = $(this);
        Shadowbox.open({
            content:    '<div><iframe style="overflow:hidden;width: 100%;height: -webkit-fill-available;" src="<?=base_url()?>asesor/deposito_seriedad_ds/'+$itself.attr('data-idc')+'/1/"></iframe></div>',
            player:     "html",
            title:      "Visualizando archivo: " + $itself.attr('data-nomExp'),
            width:      1600,
            height:     900
        });
    });
	$(document).on('click', '.pdfLink3', function () {
		var $itself = $(this);
		Shadowbox.open({
			content:    '<div><iframe style="overflow:hidden;width: 100%;height: -webkit-fill-available;" src="<?=base_url()?>static/documentos/cliente/contrato/'+$itself.attr('data-Pdf')+'"></iframe></div>',
			player:     "html",
			title:      "Visualizando archivo: " + $itself.attr('data-nomExp'),
			width:      985,
			height:     660
		});
	});

	$(document).on('click', '.verProspectos', function () {
		var $itself = $(this);
		Shadowbox.open({
			/*verProspectos*/
			content:    '<div><iframe style="overflow:hidden;width: 100%;height: -webkit-fill-available;" src="<?=base_url()?>clientes/printProspectInfo/'+$itself.attr('data-id-prospeccion')+'"></iframe></div>',
			player:     "html",
			title:      "Visualizando Prospecto: " + $itself.attr('data-nombreProspecto'),
			width:      985,
			height:     660

		});
	});

	$(document).on('click', '.seeAuts', function (e) {
		e.preventDefault();
		var $itself = $(this);
		var idLote=$itself.attr('data-idLote');
		$.post( "<?=base_url()?>index.php/registroLote/get_auts_by_lote/"+idLote, function( data ) {
			$('#auts-loads').empty();
			var statusProceso;
			$.each(JSON.parse(data), function(i, item) {
				if(item['estatus'] == 0)
				{
					statusProceso="<small class='label bg-green' style='background-color: #00a65a'>ACEPTADA</small>";
				}
				else if(item['estatus'] == 1)
				{
					statusProceso="<small class='label bg-orange' style='background-color: #FF8C00'>En proceso</small>";
				}
				else if(item['estatus'] == 2)
				{
					statusProceso="<small class='label bg-red' style='background-color: #8B0000'>DENEGADA</small>";
				}
				else if(item['estatus'] == 3)
				{
					statusProceso="<small class='label bg-blue' style='background-color: #00008B'>En DC</small>";
				}
				else
				{
					statusProceso="<small class='label bg-gray' style='background-color: #2F4F4F'>N/A</small>";
				}
				$('#auts-loads').append('<h4>Solicitud de autorización:  '+statusProceso+'</h4><br>');
			    $('#auts-loads').append('<h4>Autoriza: '+item['nombreAUT']+'</h4><br>');
				$('#auts-loads').append('<p style="text-align: justify;"><i>'+item['autorizacion']+'</i></p>' +
					'<br><hr>');

			});
			$('#verAutorizacionesAsesor').modal('show');
		});
	});


	var miArrayAddFile = new Array(8);
	var miArrayDeleteFile = new Array(1);

	$(document).on("click", ".update", function(e){

		e.preventDefault();

		var descdoc= $(this).data("descdoc");
		var idCliente = $(this).attr("data-idCliente");
		var nombreResidencial = $(this).attr("data-nombreResidencial");
		var nombreCondominio = $(this).attr("data-nombreCondominio");
		var idCondominio = $(this).attr("data-idCondominio");
		var nombreLote = $(this).attr("data-nombreLote");
		var idLote = $(this).attr("data-idLote");
		var tipodoc = $(this).attr("data-tipodoc");
		var iddoc = $(this).attr("data-iddoc");

		miArrayAddFile[0] = idCliente;
		miArrayAddFile[1] = nombreResidencial;
		miArrayAddFile[2] = nombreCondominio;
		miArrayAddFile[3] = idCondominio;
		miArrayAddFile[4] = nombreLote;
		miArrayAddFile[5] = idLote;
		miArrayAddFile[6] = tipodoc;
		miArrayAddFile[7] = iddoc;

		$(".lote").html(descdoc);
		$('#addFile').modal('show');

	});

	$(document).on('click', '#sendFile', function(e) {
		e.preventDefault();
		var idCliente = miArrayAddFile[0];
		var nombreResidencial = miArrayAddFile[1];
		var nombreCondominio = miArrayAddFile[2];
		var idCondominio = miArrayAddFile[3];
		var nombreLote = miArrayAddFile[4];
		var idLote = miArrayAddFile[5];
		var tipodoc = miArrayAddFile[6];
		var iddoc = miArrayAddFile[7];
		var expediente = $("#expediente")[0].files[0];

		var validaFile = (expediente == undefined) ? 0 : 1;

		var dataFile = new FormData();

		dataFile.append("idCliente", idCliente);
		dataFile.append("nombreResidencial", nombreResidencial);
		dataFile.append("nombreCondominio", nombreCondominio);
		dataFile.append("idCondominio", idCondominio);
		dataFile.append("nombreLote", nombreLote);
		dataFile.append("idLote", idLote);
		dataFile.append("expediente", expediente);
		dataFile.append("tipodoc", tipodoc);
		dataFile.append("idDocumento", iddoc);

		if (validaFile == 0) {
			//toastr.error('Debes seleccionar un archivo.', '¡Alerta!');
			alerts.showNotification('top', 'right', 'Debes seleccionar un archivo', 'danger');
		}

		if (validaFile == 1) {
			$('#sendFile').prop('disabled', true);
			$.ajax({
				url: "addFileContrato",
				data: dataFile,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success : function (response) {
					response = JSON.parse(response);
					if(response.message == 'OK') {
						//toastr.success('Contrato enviado.', '¡Alerta de Éxito!');
						alerts.showNotification('top', 'right', 'Contrato enviada', 'success');
						$('#sendFile').prop('disabled', false);
						$('#addFile').modal('hide');
						$('#tableDoct').DataTable().ajax.reload();
					} else if(response.message == 'ERROR'){
						//toastr.error('Error al enviar contrato y/o formato no válido.', '¡Alerta de error!');
						alerts.showNotification('top', 'right', 'Error al enviar contrato y/o formato no válido', 'danger');
						$('#sendFile').prop('disabled', false);
					}
				}
			});
		}

	});

	$(document).on("click", ".delete", function(e){
		e.preventDefault();
		var iddoc= $(this).data("iddoc");
		var tipodoc= $(this).data("tipodoc");

		miArrayDeleteFile[0] = iddoc;

		$(".tipoA").html(tipodoc);
		$('#cuestionDelete').modal('show');

	});

	$(document).on('click', '#aceptoDelete', function(e) {
		e.preventDefault();
		var id = miArrayDeleteFile[0];
		var dataDelete = new FormData();
		dataDelete.append("idDocumento", id);

		$('#aceptoDelete').prop('disabled', true);
		$.ajax({
			url: "<?=base_url()?>index.php/registroCliente/deleteContrato",
			data: dataDelete,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success : function (response) {
				response = JSON.parse(response);
				if(response.message == 'OK') {
					//toastr.success('Archivo eliminado.', '¡Alerta de Éxito!');
					alerts.showNotification('top', 'right','Archivo Eliminado', 'success');
					$('#aceptoDelete').prop('disabled', false);
					$('#cuestionDelete').modal('hide');
					$('#tableDoct').DataTable().ajax.reload();
				} else if(response.message == 'ERROR'){
					//toastr.error('Error al eliminar el archivo.', '¡Alerta de error!');
					alerts.showNotification('top', 'right','Error al eliminar el archivo', 'danger');
					$('#tableDoct').DataTable().ajax.reload();
				}
			}
		});

	});
</script>

