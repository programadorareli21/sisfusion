<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="<?= base_url() ?>dist/css/datatableNFilters.css" rel="stylesheet"/>
<body>
	<div class="wrapper">
		<?php
		$datos = array();
		$datos = $datos4;
		$datos = $datos2;
		$datos = $datos3;
		$this->load->view('template/sidebar', $datos);
		?>

		<!-- Modals -->
		<div class="modal fade modal-alertas" id="myModalEspera" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">

					<form method="post" id="form_espera_uno">
						<div class="modal-body"></div>
						<div class="modal-footer"></div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade modal-alertas" id="myModalDelete" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">

					<form method="post" id="form_delete">
						<div class="modal-body"></div>
						<div class="modal-footer"></div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade modal-alertas" id="miModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-red">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">PRÉSTAMOS Y PENALIZACIONES</h4>
					</div>
					<form method="post" id="form_prestamos">
						<div class="modal-body">
						<div class="form-group">
								<label class="label">Tipo descuento (<b class="text-danger">*</b>)</label>
								<select class="selectpicker" name="tipo" id="tipo" required>
								<option value="">----Seleccionar-----</option>
								</select>
							</div>
							<div class="form-group">
								<label class="label">Puesto del usuario(<b class="text-danger">*</b>)</label>
								<select class="selectpicker" name="roles" id="roles" required>
									<option value="">----Seleccionar-----</option>
									<option value="7">Asesor</option>
									<option value="9">Coordinador</option>
									<option value="3">Gerente</option>
									<option value="2">Sub director</option>      
								</select>
							</div>
							<div class="form-group" id="users"></div>
							<div class="form-group row">
								<div class="col-md-4">
									<label class="label">Monto prestado (<b class="text-danger">*</b>)</label>
									<input class="form-control" type="number" step="any" required onblur="verificar();" id="monto" name="monto">
								</div>
								<div class="col-md-4">
									<label class="label">Número de pagos (<b class="text-danger">*</b>)</label>
									<input class="form-control" id="numeroP" required onblur="verificar();" type="number" name="numeroP">
								</div>
								<div class="col-md-4">
									<label class="label">Pago</label>
									<input class="form-control" id="pago" required type="text" name="pago" readonly>
								</div>
							</div>
							<div class="form-group">
							<p>Nota:</label><b id="texto" style="font-size:12px;"></b></p>
								<label class="label">Comentario(<b class="text-danger">*</b>)</label>
								<textarea id="comentario" name="comentario" required  class="form-control" rows="3"></textarea>
							</div>

							<div class="form-group">
								<center>
									<button type="submit" id="btn_abonar" class="btn btn-success">GUARDAR</button>
									<button class="btn btn-danger" type="button" data-dismiss="modal" >CANCELAR</button>
								</center>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

        <div class="modal fade modal-alertas"
             id="detalle-prestamo-modal"
             role="dialog">
            <div class="modal-dialog modal-lg" style="width:70% !important;height:70% !important;">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

		<div class="modal fade bd-example-modal-sm" id="myModalEnviadas" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body"></div>
				</div>
			</div>
		</div>

		<div class="content boxContent">
			<div class="container-fluid">
				<div class="row">
					<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header card-header-icon" data-background-color="goldMaderas">
								<i class="material-icons">dashboard</i>
                            </div>
							<div class="card-content">
								<h3 class="card-title center-align">Préstamos y penalizaciones</h3>
								<div class="toolbar">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                                <div class="form-group d-flex justify-center align-center">
                                                    <h4 class="title-tot center-align m-0">Préstamos activos:</h4>
                                                    <p class="input-tot pl-1" name="totalp" id="totalp">$0.00</p>
                                                </div>
                                            </div>
											<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                <div class="form-group d-flex justify-center align-center">
													<button ype="button" class="btn-gral-data" data-toggle="modal" data-target="#miModal">Agregar</button>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
								<div class="material-datatables">
									<div class="form-group">
										<div class="table-responsive">
											<table class="table-striped table-hover" id="tabla_prestamos" name="tabla_prestamos">
												<thead>
													<tr>
														<th>ID PRÉSTAMO</th>
														<th>ID USUARIO</th>
														<th>USUARIO</th>
														<th>MONTO</th>
														<th>N°</th>
														<th>PAGO CORRESP.</th>
														<th>ABONADO</th>
														<th>PENDIENTE</th>
														<th>COMENTARIO</th>
														<th>ESTATUS</th>
														<th>TIPO</th>
														<th>FECHA DE REGISTRO</th>
														<th>MÁS</th>
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
			</div>
		</div>
		<?php $this->load->view('template/footer_legend');?>
	</div>
	</div>
	</div><!--main-panel close-->
	<?php $this->load->view('template/footer');?>
	<!--DATATABLE BUTTONS DATA EXPORT-->
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

	<script>
		var url = "<?=base_url()?>";
		var url2 = "<?=base_url()?>index.php/";
		var totaPen = 0;
		var tr;
		$(document).ready(function() {
		$.post("<?=base_url()?>index.php/Comisiones/lista_estatus_descuentos", function (data) {
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id_opcion'];
                    var name = data[i]['nombre'];
                    $("#tipo").append($('<option>').val(id).text(name.toUpperCase()));
                }
                $("#tipo").selectpicker('refresh');
            }, 'json');       
        });


		$('#tipo').change(function(ruta){
        tipo = $('#tipo').val();
		let m = $('#monto').val();
		let texto='';
			if(tipo == 18){
				
				//PRESTAMO
				texto = 'Esté es un pago recurrente, el cual se hará cada mes hasta cubrir el monto prestado.'

				document.getElementById("numeroP").value = 1;
				//document.getElementById("numeroP").readOnly = false;
				if(m != ''){
					verificar();
				}
			
					
			}else{
				texto = 'Esté es un pago único que se hará en una sola exhibición.'
				document.getElementById("numeroP").value = 1;
			//	document.getElementById("numeroP").readOnly = true;
				if(m != ''){
					verificar();
				}
						}
						document.getElementById("texto").innerHTML = texto;

        });
		function closeModalEng(){
			document.getElementById("form_prestamos").reset();
			$("#tipo").selectpicker("refresh");
			$("#roles").selectpicker("refresh");
			document.getElementById("users").innerHTML = '';
			$("#miModal").modal('toggle');	
		}

		function replaceAll(text, busca, reemplaza) {
            while (text.toString().indexOf(busca) != -1)
                text = text.toString().replace(busca, reemplaza);
            return text;
        }

		$("#form_prestamos").on('submit', function(e){ 
			e.preventDefault();
			let formData = new FormData(document.getElementById("form_prestamos"));
			$.ajax({
				url: 'savePrestamo',
				data: formData,
				method: 'POST',
				contentType: false,
				cache: false,
				processData:false,
				success: function(data) {
					if (data == 1) {
						$('#tabla_prestamos').DataTable().ajax.reload(null, false);
						closeModalEng();
						$('#miModal').modal('hide');
						alerts.showNotification("top", "right", "Préstamo registrado con éxito.", "success");
						document.getElementById("form_abono").reset();
					
					} else if(data == 2) {
						$('#tabla_prestamos').DataTable().ajax.reload(null, false);
						closeModalEng();
						$('#miModal').modal('hide');
						alerts.showNotification("top", "right", "Pago liquidado.", "warning");
					}else if(data == 3){
						closeModalEng();
						$('#miModal').modal('hide');
						alerts.showNotification("top", "right", "El usuario seleccionado ya tiene un préstamo activo.", "warning");
					}
				},
				error: function(){
					alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
				}
			});
		});
		$("#form_delete").on('submit', function(e){ 
			e.preventDefault();
			let formData = new FormData(document.getElementById("form_delete"));
			$.ajax({
				url: 'BorrarPrestamo',
				data: formData,
				method: 'POST',
				contentType: false,
				cache: false,
				processData:false,
				success: function(data) {
					if (data == 1) {
						$('#tabla_prestamos').DataTable().ajax.reload(null, false);
						$('#myModalDelete').modal('hide');
						alerts.showNotification("top", "right", "Préstamo eliminado con éxito.", "success");
						document.getElementById("form_delete").reset();
					
					} else{
						$('#myModalDelete').modal('hide');
						alerts.showNotification("top", "right", "Error.", "warning");
					}
				},
				error: function(){
					alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
				}
			});
		});


		$("#tabla_prestamos").ready( function(){
			let titulos = [];

			$('#tabla_prestamos thead tr:eq(0) th').each( function (i) {
				if(  i!=12){
					var title = $(this).text();
					titulos.push(title);
					$(this).html('<input type="text" class="textoshead" placeholder="'+title+'"/>' );
					$( 'input', this ).on('keyup change', function () {
						if (tabla_nuevas.column(i).search() !== this.value ) {
							tabla_nuevas.column(i).search(this.value).draw();

							var total = 0;
							var index = tabla_nuevas.rows({ selected: true, search: 'applied' }).indexes();
							var data = tabla_nuevas.rows( index ).data();
							$.each(data, function(i, v){
								total += parseFloat(v.monto);
							});
							var to1 = formatMoney(total);
							document.getElementById("totalp").textContent = '$' + to1;
							console.log('fsdf'+total);
						}
					});
				}
			});

			$('#tabla_prestamos').on('xhr.dt', function ( e, settings, json, xhr ) {
				var total = 0;
				$.each(json.data, function(i, v){
					total += parseFloat(v.monto);
				});
				var to = formatMoney(total);
				document.getElementById("totalp").textContent = '$' + to;
			});


			tabla_nuevas = $("#tabla_prestamos").DataTable({
				dom: 'Brt'+ "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-6'i><'col-xs-12 col-sm-12 col-md-6 col-lg-6'p>>",
                width: 'auto',
				buttons: [{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
					className: 'btn buttons-excel',
					titleAttr: 'Descargar archivo de Excel',
					title: 'PRÉSTAMOS Y PENALIZACIONES',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10,11],
						format: {
							header:  function (d, columnIdx) {
								if(columnIdx >= 0){
									return ' '+titulos[columnIdx] +' ';
								}  
							}
						}
					}
				}],
				pagingType: "full_numbers",
                fixedHeader: true,
                language: {
                    url: "<?=base_url()?>/static/spanishLoader_v2.json",
                    paginate: {
                        previous: "<i class='fa fa-angle-left'>",
                        next: "<i class='fa fa-angle-right'>"
                    }
                },
                destroy: true,
                ordering: false,
				columns: [
					{
					"width": "4%",
					"data": function( d ){
						return '<p class="m-0">'+d.id_prestamo+'</p>';
					}
				},
					{
					"width": "4%",
					"data": function( d ){
						return '<p class="m-0">'+d.id_usuario+'</p>';
					}
				},	
					{
					"width": "13%",
					"data": function( d ){
						return '<p class="m-0"><b>'+d.nombre+'</b></p>';
					}
				},
				{
					"width": "7%",
					"data": function( d ){
						return '<p class="m-0"><b>$'+formatMoney(d.monto)+'</b></p>';
					}
				},
				{
					"width": "2%",
					"data": function( d ){
						return '<p class="m-0">'+d.num_pagos+'</p>';
					}
				},
				{
					"width": "5%",
					"data": function( d ){
						return '<p class="m-0">$'+formatMoney(d.pago_individual)+'</p>';
					}
				},
				{
					"width": "7%",
					"data": function( d ){
						return '<p class="m-0">$'+formatMoney(d.total_pagado)+'</p>';
					}
				},
				{
					"width": "7%",
					"data": function( d ){
						let color = 'black';
						let resultado  = d.monto - d.total_pagado;
						if(resultado > 0.5){
							color='orange';
						}
						if(resultado < 0.0){
							resultado=0;
						}
						return '<p class="m-0" style="color:'+color+'">$'+formatMoney(resultado)+'</p>';
					}
				},
				{
					"width": "10%",
					"data": function( d ){
						return '<p class="m-0">'+d.comentario+'</p>';
					}
				},
				{
					"width": "6%",
					"data": function( d ){

						if(d.estatus == 1){
							return '<span class="label label-danger" style="background:dodgerblue">ACTIVO</span>';
						}else if(d.estatus == 3 || d.estatus == 2){
							return '<span class="label label-danger" style="background:#27AE60">LIQUIDADO</span>';
						}else if(d.estatus == 0){
							return '<span class="label label-danger" style="background:#D52803">CANCELADO</span>';
						}

						
					} 
				},
				{
					"width": "8%",
					"data": function( d ){
						let etiqueta = '';
						color='000';
						if(d.id_opcion == 18){ //PRESTAMO
							color='89C86C';
						} else if(d.id_opcion == 19){ //SCIO
							color='72EDD6';
						}else if(d.id_opcion == 20){ //PLAZA
							color='72CBED';
						}else if(d.id_opcion == 21){ //LINEA TELEFÓNICA
							color='7282ED';
						}else if(d.id_opcion == 22){ //MANTENIMIENTO
							color='CA72ED';
						}else if(d.id_opcion == 23){ //NÓMINA - ANALISTAS DE COMISIONES
							color='CA15ED';
						}else if(d.id_opcion == 24){ //NÓMINA - ASISTENTES CDMX
							color='CA9315';
						}else if(d.id_opcion == 25){ //NÓMINA - IMSS
							color='34A25C';
						}else if(d.id_opcion == 26){ //NÓMINA -LIDER DE PROYECTO E INNOVACIÓN
							color='165879';
						}

						return '<p><span class="label" style="background:#'+color+';">'+d.tipo+'</span></p>';
					}
				},
				{
					"width": "12%",
					"data": function( d ){
                        if (d.fecha_creacion_referencia !== null && d.estatus == 1) {
                            const fecha = new Date(d.fecha_creacion_referencia);
                            const now = new Date();
                            const mesesDif = monthDiff(fecha, now);
                            if (mesesDif >= 2) {
                                return `
                                    <p>
                                        ${d.fecha_creacion_referencia.split('.')[0]}
                                        <span class="label" style="background: orange">Sin saldo en ${mesesDif} meses</label>
                                    </p>
                                `;
                            }
                        }
                        return '<p class="m-0">'+d.fecha_creacion.split('.')[0]+'</p>';
					}
				},
				{
					"width": "6%",
					"orderable": false,
					"data": function( d ){
						if(d.id_prestamo2 == null && d.estatus == 1){
							return a = `<button href="#" value="${d.id_prestamo}" class="btn-data btn-blueMaderas detalle-prestamo" title="Historial"><i class="fas fa-info"></i></button>
						<button href="#" value="${d.id_prestamo}" data-name="${d.nombre}" class="btn-data btn-warning delete-prestamo" title="Eliminar"><i class="fas fa-trash"></i></button>`;
						}else{
							return a = `<button href="#" value="${d.id_prestamo}" class="btn-data btn-blueMaderas detalle-prestamo" title="Historial"><i class="fas fa-info"></i></button>`;
						}                        
					}
				}],
				ajax: {
					url: url2 + "Comisiones/getPrestamos",
					type: "POST",
					cache: false,
					data: function( d ){
					}
				},
			});
			$('#tabla_prestamos tbody').on('click', '.delete-prestamo', function () {
				const idPrestamo = $(this).val();
				const nombreUsuario = $(this).attr("data-name");
			//	$.getJSON(`${url}Comisiones/BorrarPrestamo/${idPrestamo}`).done(function (data) { 
					const Modalbody = $('#myModalDelete .modal-body');
					const Modalfooter = $('#myModalDelete .modal-footer');
					Modalbody.html('');
					Modalfooter.html('');
					Modalbody.append(`<input type="hidden" value="${idPrestamo}" name="idPrestamo" id="idPrestamo"> <h4>¿Ésta seguro que desea borrar el préstamo de ${nombreUsuario}?</h4>
                           
                        `);

						Modalfooter.append(`<div class="row"><div class="col-md-3"></div><div class="col-md-3"><input type="submit" class="btn btn-success" name="disper_btn"  id="dispersar" value="Aceptar"></div><div class="col-md-3"><input type="button" class="btn btn-danger" data-dismiss="modal" value="CANCELAR"></div></div>`);

					//console.log(data);
					$("#myModalDelete").modal();
				//	$('#tabla_prestamos').DataTable().ajax.reload(null, false);

				//});
			});

            $('#tabla_prestamos tbody').on('click', '.detalle-prestamo', function () {
				$('#spiner-loader').removeClass('hide');

                const idPrestamo = $(this).val();
				let importacion='';
                $.getJSON(`${url}Comisiones/getDetallePrestamo/${idPrestamo}`).done(function (data) {
                    const { general, detalle } = data;
					$('#spiner-loader').addClass('hide');
					console.log(detalle.length);
                    if (detalle.length == 0) {
                        alerts.showNotification("top", "right", "Este préstamo no tiene pagos aplicados.", "warning");
                    } else {
                        const detalleHeaderModal = $('#detalle-prestamo-modal .modal-header');
                        const detalleBodyModal = $('#detalle-prestamo-modal .modal-body');
						console.log(idPrestamo);
						const importaciones = [20,19,18,17,16,15,14,13,12,11];
						console.log(importaciones.indexOf(idPrestamo));
						if(importaciones.indexOf(parseInt(idPrestamo)) >= 0 ){
							importacion = 'Importación contraloría';
						}

                        detalleHeaderModal.html('');
                        detalleBodyModal.html('');
						let numPagosReal = general.num_pago_act == general.num_pagos ? general.num_pago_act :  general.num_pago_act -1;
                        
                        detalleHeaderModal.append(`<div class="text-right"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>`);
                        detalleHeaderModal.append(`<h4 class="card-title"><b>Detalle del préstamo</b><br><p>${importacion}</p></h4>`);
                        detalleBodyModal.append(`
                            <div class="row">
                                <div class="col col col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <h6>USUARIO: <b>${ general.nombre_completo }</b></h6>
                                </div>
                                <div class="col col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <h6>PAGO MENSUAL: <b>$${formatMoney(general.pago_individual)}</b></h6>
                                </div>
                                <div class="col col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                    <h6>PAGOS APLICADOS: <b>${numPagosReal}</b></h6>
                                </div>
                                <div class="col col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                    <h6>MENSUALIDADES: <b>${general.num_pagos}</b></h6>
                                </div>
                                <div class="col col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <h6>MONTO PRESTADO: <b>$${formatMoney(general.monto_prestado)}</b></h6>
                                </div>
                                <div class="col col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <h6>ABONADO: <b style="color:green;">$${formatMoney(general.total_pagado)}</b></h6>
                                </div>
                                <div class="col col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <h6>PENDIENTE: <b style="color:orange;">$${formatMoney(general.pendiente)}</b></h6>
                                </div>
                            </div>
                        `);

                        let htmlTableBody = '';
                        for (let i = 0; i < detalle.length; i++) {
                            htmlTableBody += '<tr>';
							htmlTableBody += `<td scope="row">${general.nombre_completo}</td>`;
							htmlTableBody += `<td scope="row">${detalle[i].sede}</td>`;
							htmlTableBody += `<td scope="row">${detalle[i].tipo}</td>`;
                            htmlTableBody += `<td scope="row"><b>${detalle[i].np}</b></td>`;
							htmlTableBody += `<td scope="row">${detalle[i].nombreResidencial}</td>`;
                            htmlTableBody += `<td>${detalle[i].nombreLote}</td>`;
							htmlTableBody += `<td scope="row"><b>${detalle[i].id_pago_i}</b></td>`;
                            htmlTableBody += `<td style="width:50% !important;">${detalle[i].comentario}</td>`;
                            htmlTableBody += `<td style="width:20% !important;">${detalle[i].fecha_pago}</td>`;
                            htmlTableBody += `<td><b>$${formatMoney(detalle[i].abono_neodata)}</b></td>`;
							htmlTableBody += `<td style="width:20% !important;">${detalle[i].estatus}</td>`;
                            htmlTableBody += '</tr>';
                        }

                        detalleBodyModal.append(`
                            <div style="margin-top: 20px;" class="table-responsive">
                                <table class="table table-striped table-hover" id="table_detalles">
                                    <thead>
                                        <tr>
											<th>Usuario</th>
											<th>Sede</th>
											<th>Tipo</th>
                                            <th>#</th>
											<th>Proyecto</th>
											<th>Lote</th>
                                            <th >Id pago</th>
                                            <th >Comentario</th>
                                            <th >Fecha</th>
                                            <th >Monto</th>
											<th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${htmlTableBody}
                                    </tbody>
                                </table>
                            </div>
                        `);						

                        $("#detalle-prestamo-modal").modal();

						$('#table_detalles thead tr:eq(0) th').each( function (i) {

				if(  i!=12){
					var title = $(this).text();
					titulos.push(title);
					$(this).html('<input type="text" class="textoshead" placeholder="'+title+'"/>' );
					$( 'input', this ).on('keyup change', function () {
						if (tableDetalles.column(i).search() !== this.value ) {
							tableDetalles.column(i).search(this.value).draw();

						}
					});
				}
			});
						var tableDetalles = $('#table_detalles').DataTable({
							dom: 'Brt'+ "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-6'i><'col-xs-12 col-sm-12 col-md-6 col-lg-6'p>>",
                width: 'auto',
				buttons: [{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
					className: 'btn buttons-excel',
					titleAttr: 'Descargar archivo de Excel',
					title: 'PRÉSTAMOS Y PENALIZACIONES',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10],
						format: {
							header:  function (d, columnIdx) {
								if(columnIdx == 0){
                                    return ' USUARIOS ';
                                }else if(columnIdx == 1){
                                    return 'SEDE';
                                }else if(columnIdx == 2){
                                    return 'TIPO';
                                }else if(columnIdx == 3){
                                    return '#';
                                }else if(columnIdx == 4){
                                    return 'PROYECTO';
                                }else if(columnIdx == 5){
                                    return 'LOTE';
                                }else if(columnIdx == 6){
                                    return 'ID PAGO';
                                }else if(columnIdx == 7){
                                    return 'COMENTARIO';
                                }else if(columnIdx == 8){
                                    return 'FECHA';
                                }else if(columnIdx == 9){
                                    return 'MONTO';
                                }else if(columnIdx == 10){
                                    return 'ESTATUS';
                                }

							}
						}
					}
				}],
                width: 'auto',
				ordering: false,	
				"pageLength": 5,
				"lengthMenu": [ 5,10, 25, 50, 75, 100 ],
                language: {
                    url: "<?=base_url()?>/static/spanishLoader_v2.json",
                    paginate: {
                        previous: "<i class='fa fa-angle-left'>",
                        next: "<i class='fa fa-angle-right'>"
                    }
                }
                
						});
						tableDetalles
                    .order([0, 'desc'])
                    .draw();
                    }
                });
            });
		});


		$(window).resize(function(){
			tabla_nuevas.columns.adjust();
		});

		function formatMoney( n ) {
			var c = isNaN(c = Math.abs(c)) ? 2 : c,
				d = d == undefined ? "." : d,
				t = t == undefined ? "," : t,
				s = n < 0 ? "-" : "",
				i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
				j = (j = i.length) > 3 ? j % 3 : 0;
			return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		}


		$("#roles").change(function() {
			var parent = $(this).val();
			document.getElementById("users").innerHTML ='';

			$('#users').append(` 
			<label class="label">Usuario</label>   
			<select id="usuarioid" name="usuarioid" class="form-control directorSelect ng-invalid ng-invalid-required" required data-live-search="true">
			</select>
			`);
			$.post('getUsuariosRol/'+parent+'/1', function(data) {
				$("#usuarioid").append($('<option disabled>').val("default").text("Seleccione una opción"))
				var len = data.length;
				for( var i = 0; i<len; i++){
					var id = data[i]['id_usuario'];
					var name = data[i]['name_user'];
					$("#usuarioid").append($('<option>').val(id).attr('data-value', id).text(name));
				}

				if(len<=0){
				$("#usuarioid").append('<option selected="selected" disabled>No se han encontrado registros que mostrar</option>');
				}
				
				$("#usuarioid").selectpicker('refresh');
			}, 'json'); 
		});

	/*	$("#numeroP").blur(function(){
			let monto = parseFloat($('#monto').val());
			let cantidad = parseFloat($('#numeroP').val());
			let resultado=0;

			if (cantidad < 1 || isNaN(monto)) {
				alerts.showNotification("top", "right", "Debe ingresar una canitdad mayor a 0.", "warning");
				document.getElementById('btn_abonar').disabled=true;
				$('#pago').val(resultado);
			}
			else{
				resultado = monto /cantidad;
				$('#pago').val(formatMoney(resultado));
			}
		});*/

		function verificar(){
			
			console.log($('#monto').val());
			let monto = parseFloat(replaceAll($('#monto').val(), ',','')); 
			
			if($('#numeroP').val() != '')
			{
					if(monto < 1 || isNaN(monto))
					{
						alerts.showNotification("top", "right", "Debe ingresar un monto valido.", "warning");
						document.getElementById('btn_abonar').disabled=true;
					}
					else
					{
						console.log($('#numeroP').val());

						let cantidad = parseFloat(replaceAll($('#numeroP').val(), ',',''));
						console.log(cantidad);
						resultado = parseFloat(monto /cantidad);
						$('#pago').val(formatMoney(parseFloat(resultado)));
						console.log(resultado);
						document.getElementById('btn_abonar').disabled=false;
					}
			}
			
		}

        function monthDiff(dateFrom, dateTo) {
            return dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
        }
	</script>
</body>