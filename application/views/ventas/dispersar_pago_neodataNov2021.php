<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="<?= base_url() ?>dist/css/datatableNFilters.css" rel="stylesheet"/>
<body class="">
    <div class="wrapper">
        <?php
        if ($this->session->userdata('id_rol') == "13" || $this->session->userdata('id_rol') == "17" || $this->session->userdata('id_rol') == "32" || $this->session->userdata('id_rol') == "8") //
        {
            $datos = array();
            $datos = $datos4;
            $datos = $datos2;
            $datos = $datos3;
            $this->load->view('template/sidebar', $datos);
        }
        else {
            echo '<script>alert("ACCESSO DENEGADO"); window.location.href="' . base_url() . '";</script>';
        }
        ?>

        <style type="text/css">        
            #modal_nuevas{
                z-index: 1041!important;
            }

            #modal_vc{
                z-index: 1041!important;
            }
        </style>

        <!-- Modals -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reporte dispersion</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" name="fecha1" id="fecha1" class="form-control">
                            </div>
                            <div class="col-md-6" id="f2">
                                <input type="date" name="fecha2" id="fecha2" class="form-control"> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myUpdateBanderaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <form id="my_updatebandera_form" name="my_updatebandera_form" method="post">
                        <div class="modal-body" style="text-align: center;">
                            <input type="hidden" name="id_pagoc" id="id_pagoc">
                            <input type="hidden" name="param" id="param">
                            <h4 class="modal-title"><b>¿Está seguro de regresar este lote a activas?</b></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade modal-alertas" id="modal_pagadas" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" id="form_pagadas">
                        <div class="modal-body"></div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal verifyNEODATA -->
        <div class="modal fade modal-alertas" id="modal_NEODATA" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!--<div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>-->
                    <form method="post" id="form_NEODATA">
                        <div class="modal-body"></div>
                        <div class="modal-footer"></div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- modal verifyNEODATA -->
        <div class="modal fade modal-alertas" id="modal_NEODATA2" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-red" >
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" id="form_NEODATA2">
                        <div class="modal-body"></div>
                        <div class="modal-footer"></div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Modals -->

        <div class="content boxContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="goldMaderas">
                                <i class="fas fa-chart-pie fa-2x"></i>
							</div>
                            <div class="card-content">
                                <div class="encabezadoBox">
                                    <h3 class="card-title center-align" >Dispersión de pago</h3>
                                    <p class="card-title pl-1">(Comisiones con saldo disponible en NEODATA, nuevas sin dispersar y abonadas con saldo a favor.)</p>
                                </div>
                                <div class="toolbar">
                                    <div class="container-fluid">
                                        <div class="row aligned-row">
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                <div class="form-group text-center">
                                                    <h4 class="title-tot center-align m-0">Monto hoy: </h4>
                                                    <p class="category input-tot pl-1" id="monto_label">
                                                        <?php $query = $this->db->query("SELECT SUM(abono_neodata) nuevo_general FROM pago_comision_ind WHERE estatus NOT IN (11,0) AND id_comision IN (select id_comision from comisiones) AND MONTH(GETDATE()) = MONTH(fecha_abono) AND Day(GetDate()) = Day(fecha_abono)");

                                                        foreach ($query->result() as $row){
                                                            $number = $row->nuevo_general;
                                                            echo '<B>$'.number_format($number, 3),'</B>';
                                                        } ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                <div class="form-group text-center">
                                                    <h4 class="title-tot center-align m-0">Pagos hoy: </h4>
                                                    <p class="category input-tot pl-1" id="pagos_label">
                                                        <?php $query = $this->db->query("SELECT count(id_pago_i) nuevo_general FROM pago_comision_ind WHERE estatus NOT IN (11,0) AND id_comision IN (select id_comision from comisiones) AND MONTH(GETDATE()) = MONTH(fecha_abono) AND Day(GetDate()) = Day(fecha_abono) AND abono_neodata>0");
                                                        foreach ($query->result() as $row){
                                                            $number = $row->nuevo_general;
                                                            echo '<B>'.$number,'</B>';
                                                        } ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                                <div class="form-group text-center">
                                                    <h4 class="title-tot center-align m-0">Lotes hoy: </h4>
                                                    <p class="category input-tot pl-1" id="lotes_label">
                                                        <?php $query = $this->db->query("SELECT count(distinct(id_lote)) nuevo_general FROM comisiones WHERE id_comision IN (select id_comision from pago_comision_ind WHERE MONTH(GETDATE()) = MONTH(fecha_abono) AND Day(GetDate()) = Day(fecha_abono) AND estatus NOT IN (11,0) AND id_comision IN (SELECT id_comision FROM comisiones))");
                                                        foreach ($query->result() as $row) {
                                                            $number = $row->nuevo_general;
                                                            echo '<B>'.$number,'</B>';
                                                        } ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 d-flex align-end text-center">
                                                <a data-target="#myModal" data-toggle="modal" class="btn-gral-data" id="MainNavHelp" href="#myModal" style="color:white"> Más detalle</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="material-datatables">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table-striped table-hover" id="tabla_ingresar_9" name="tabla_ingresar_9">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>ID LOTE</th>
                                                        <th>PROYECTO</th>
                                                        <th>CONDOMINIO</th>
                                                        <th>LOTE</th>
                                                        <th>CLIENTE</th>
                                                        <th>TIPO VENTA</th>
                                                        <th>MODALIDAD</th>
                                                        <th>EST. CONTRATACIÓN</th>
                                                        <th>ENT. VENTA</th>
                                                        <th>ÚLTIMA ACT.</th>
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

    $(document).on('click', '.update_bandera', function(e){
        id_pagoc = $(this).attr("data-idpagoc");
        param = $(this).attr("data-param");
        $("#myUpdateBanderaModal").modal();
        $("#id_pagoc").val(id_pagoc);
        $("#param").val(1);
    });

    var url = "<?=base_url()?>";
    var url2 = "<?=base_url()?>index.php/";

    var getInfo1 = new Array(6);
    var getInfo3 = new Array(6);


    $("#tabla_ingresar_9").ready( function(){
        let titulos = [];
        $('#tabla_ingresar_9 thead tr:eq(0) th').each( function (i) {
            if(i != 0 && i != 11){
                var title = $(this).text();
                titulos.push(title);

                $(this).html('<input type="text" class="textoshead" placeholder="'+title+'"/>' );
                $( 'input', this ).on('keyup change', function () {
                    if (tabla_1.column(i).search() !== this.value ) {
                        tabla_1
                        .column(i)
                        .search(this.value)
                        .draw();
                    }
                });
            }
        });

        tabla_1 = $("#tabla_ingresar_9").DataTable({
            dom: 'Brt'+ "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-6'i><'col-xs-12 col-sm-12 col-md-6 col-lg-6'p>>",
            width: 'auto',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                className: 'btn buttons-excel',
                titleAttr: 'Descargar archivo de Excel',
                title: 'REPORTE DISPERSIÓN DE PAGO',
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10],
                    format: {
                        header:  function (d, columnIdx) {
                            if(columnIdx == 0){
                                return ' '+d +' ';
                            }else if(columnIdx == 11){
                                return ' '+d +' ';
                            }else if(columnIdx != 11 && columnIdx !=0){
                                if(columnIdx == 12){
                                    return 'TIPO'
                                }else{
                                    return ' '+titulos[columnIdx-1] +' ';
                                }
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
            columns: [{
                "width": "3%",
                "className": 'details-control',
                "orderable": false,
                "data" : null,
                "defaultContent": '<div class="toggle-subTable"><i class="animacion fas fa-chevron-down fa-lg"></i>'
            },
            {
                "width": "5%",
                "data": function( d ){
                    var lblStats;
                    lblStats ='<p class="m-0"><b>'+d.idLote+'</b></p>';
                    return lblStats;
                }
            },
            {
                "width": "8%",
                "data": function( d ){
                    return '<p class="m-0">'+d.nombreResidencial+'</p>';
                }
            },
            {
                "width": "8%",
                "data": function( d ){
                    return '<p class="m-0">'+(d.nombreCondominio).toUpperCase();+'</p>';
                }
            },
            {
                "width": "11%",
                "data": function( d ){
                    return '<p class="m-0">'+d.nombreLote+'</p>';
                }
            }, 
            {
                "width": "11%",
                "data": function( d ){
                    return '<p class="m-0"><b>'+d.nombre_cliente+'</b></p>';
                }
            }, 
            {
                "width": "8%",
                "data": function( d ){
                    var lblType;
                    if(d.tipo_venta==1) {
                        lblType ='<span class="label label-danger">Venta Particular</span>';
                    }else if(d.tipo_venta==2) {
                        lblType ='<span class="label label-success">Venta normal</span>';
                    }
                    else if(d.tipo_venta==7) {
                        lblType ='<span class="label label-warning">Venta especial</span>';
                    }
                    return lblType;
                }
            }, 
            {
                "width": "8%",
                "data": function( d ){
                    var lblStats;
                    if(d.compartida==null) {
                        lblStats ='<span class="label label-warning" style="background:#E5D141;">Individual</span>';
                    }else {
                        lblStats ='<span class="label label-warning">Compartida</span>';
                    }
                    return lblStats;
                }
            }, 
            {
                "width": "8%",
                "data": function( d ){
                    var lblStats;
                    if(d.idStatusContratacion==15) {
                        lblStats ='<span class="label label-success" style="background:#9E9CD5;">Contratado</span>';
                    }else {
                        lblStats ='<p class="m-0"><b>'+d.idStatusContratacion+'</b></p>';
                    }
                    return lblStats;
                }
            },
            {
                "width": "8%",
                "data": function( d ){
                    var lblStats;
                    if(d.totalNeto2==null) {
                        lblStats ='<span class="label label-danger">Sin precio lote</span>';
                    } else{
                        switch(d.lugar_prospeccion){
                            case '6':
                                if(d.registro_comision == 2){
                                    lblStats ='<span class="label" style="background:#11DFC6;">SOLICITADO MKT</span>';
                                }else{
                                    lblStats ='<span class="label" style="background:#B4A269;">MARKETING DIGÍTAL</span>';
                                }
                            break;

                            case '12':
                                lblStats ='<span class="label" style="background:#00548C;">CLUB MADERAS</span>';
                            break;

                            case '26':
                                lblStats ='<span class="label" style="background:#0860BA;">COREANO VLOGS</span>';
                            break;
                            default:
                                lblStats ='';
                            break;
                        }
                    }
                    return lblStats;
                }
            },
            {
                "width": "8%",
                "data": function( d ){
                    var lblStats;

                    if(d.fecha_modificacion <= '2021-01-01' || d.fecha_modificacion == null ) {
                        lblStats ='';
                    }else {
                        lblStats ='<span class="label label-info">'+d.date_final+'</span>';
                    }
                    return lblStats;
                }
            },
            { 
                "width": "14%",
                "orderable": false,
                "data": function( data ){
                    var BtnStats;
                    if(data.totalNeto2==null) {
                        BtnStats = '';
                    }else {
                        if(data.compartida==null) {
                            if(data.fecha_modificacion <= '2021-01-01' || data.fecha_modificacion == null ) {
                                BtnStats = '<button href="#" value="'+data.idLote+'" data-estatus="'+data.idStatusContratacion+'" data-totalNeto2="'+data.totalNeto2+'" data-compartida="'+0+'" data-tipov="'+data.tipo_venta+'" data-regis="'+data.registro_comision+'" data-lugarP="'+data.lugar_prospeccion+'" data-value="'+data.registro_comision+'" data-code="'+data.cbbtton+'" ' +'class="btn-data btn-sky verify_neodata" title="Verificar en NEODATA">' +'<span class="material-icons">verified_user</span></button> ';
                            }else {
                                BtnStats = '<button class="btn-data btn-orangeYellow marcar_pagada" title="Marcar como liquidada" value="' + data.idLote +'"><i class="material-icons">how_to_reg</i></button><button href="#" value="'+data.idLote+'" data-estatus="'+data.idStatusContratacion+'"  data-value="'+data.registro_comision+'"   data-estatus="'+data.idStatusContratacion+'" data-totalNeto2="'+data.totalNeto2+'" data-compartida="'+0+'" data-tipov="'+data.tipo_venta+'" data-regis="'+data.registro_comision+'" data-lugarP="'+data.lugar_prospeccion+'"  data-code="'+data.cbbtton+'" ' +'class="btn-data btn-sky verify_neodata" title="Verificar en NEODATA">' +'<span class="material-icons">verified_user</span></button> <button href="#" data-param="1" data-idpagoc="' + data.idLote + '" ' +'class="btn-data btn-deepGray update_bandera" title="Regresar a activas">' +'<i class="fas fa-undo-alt"></i></button>';
                            }
                        }else {
                                if(data.fecha_modificacion <= '2021-01-01' || data.fecha_modificacion == null ) {
                                BtnStats = '<button href="#" value="'+data.idLote+'" data-estatus="'+data.idStatusContratacion+'" data-totalNeto2="'+data.totalNeto2+'" data-compartida="'+1+'" data-tipov="'+data.tipo_venta+'" data-regis="'+data.registro_comision+'" data-lugarP="'+data.lugar_prospeccion+'"  data-value="'+data.registro_comision+'" data-code="'+data.cbbtton+'" ' +'class="btn-data btn-green verify_neodata" title="Verificar en NEODATA">' +'<span class="material-icons">verified_user</span></button> ';
                            }else {
                                BtnStats = '<button class="btn-data btn-orangeYellow marcar_pagada" title="Marcar como liquidada" value="' + data.idLote +'"><i class="material-icons">how_to_reg</i></button><button href="#" value="'+data.idLote+'" data-estatus="'+data.idStatusContratacion+'"  data-value="'+data.registro_comision+'" data-estatus="'+data.idStatusContratacion+'" data-totalNeto2="'+data.totalNeto2+'" data-compartida="'+0+'" data-tipov="'+data.tipo_venta+'" data-regis="'+data.registro_comision+'" data-lugarP="'+data.lugar_prospeccion+'"  data-code="'+data.cbbtton+'" ' +'class="btn-data btn-green verify_neodata" title="Verificar en NEODATA">' +'<span class="material-icons">verified_user</span></button> <button href="#" data-param="1" data-idpagoc="' + data.idLote + '" ' +'class="btn-data btn-deepGray update_bandera" title="Regresar a activas">' +'<i class="fas fa-undo-alt"></i></button>';
                            }
                        }
                    }
                    return '<div class="d-flex justify-center">'+BtnStats+'</div>';
                }
            }],
            columnDefs: [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            },
            ],
            ajax: {
                "url": '<?=base_url()?>index.php/Comisiones/getDataDispersionPago',
                "dataSrc": "",
                "type": "POST",
                cache: false,
                "data": function( d ){}
            }
        });

        $('#tabla_ingresar_9 tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = tabla_1.row(tr);
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                $(this).parent().find('.animacion').removeClass("fas fa-chevron-up").addClass("fas fa-chevron-down");
            } 
            else {
                var status;
                var fechaVenc;
                if (row.data().idStatusContratacion == 8 && row.data().idMovimiento == 38) {
                    status = 'Status 8 listo (Asistentes de Gerentes)';
                } 
                else if (row.data().idStatusContratacion == 8 && row.data().idMovimiento == 65 ) {
                    status = 'Status 8 enviado a Revisión (Asistentes de Gerentes)';
                }
                else {
                    status='N/A';
                }
                if (row.data().idStatusContratacion == 8 && row.data().idMovimiento == 38 ||
                    row.data().idStatusContratacion == 8 && row.data().idMovimiento == 65) {
                    fechaVenc = row.data().fechaVenc;
                }else {
                    fechaVenc='N/A';
                }

                var informacion_adicional = '<div class="container subBoxDetail"><div class="row"><div class="col-12 col-sm-12 col-sm-12 col-lg-12" style="border-bottom: 2px solid #fff; color: #4b4b4b; margin-bottom: 7px"><label><b>Información colaboradores</b></label></div><div class="col-12 col-sm-12 col-md-12 col-lg-12"><label><b>Subdirector: </b>' + row.data().subdirector + '</label></div><div class="col-12 col-sm-12 col-md-12 col-lg-12"><label><b>Gerente: </b>' + row.data().gerente + '</label></div><div class="col-12 col-sm-12 col-md-12 col-lg-12"><label><b>Coordinador: </b>' + row.data().coordinador + '</label></div><div class="col-12 col-sm-12 col-md-12 col-lg-12"><label><b>Asesor: </b>' + row.data().asesor + '</label></div></div></div>';

                row.child(informacion_adicional).show();
                tr.addClass('shown');
                $(this).parent().find('.animacion').removeClass("fas fa-chevron-down").addClass("fas fa-chevron-up");
            }
        });

        $("#tabla_ingresar_9 tbody").on("click", ".marcar_pagada", function(){
            var tr = $(this).closest('tr');
            var row = tabla_1.row( tr );
            idLote = $(this).val();

            $("#modal_pagadas .modal-body").html("");
            $("#modal_pagadas .modal-body").append('<h4 class="modal-title">¿Ya se pago completa la comision para el lote <b>'+row.data().nombreLote+'</b>?</h4>');
            $("#modal_pagadas .modal-body").append('<input type="hidden" name="ideLotep" id="ideLotep" value="'+idLote+'"><input type="hidden" name="estatusL" id="estatusL" value="7">');
            $("#modal_pagadas .modal-body").append('<br><div class="row"><div class="col-md-12"><center><input type="submit" class="btn btn-success" value="ACEPTAR"></center></div></div>');
            $("#modal_pagadas").modal();
        });

        $("#tabla_ingresar_9 tbody").on("click", ".pausar", function(){
            var tr = $(this).closest('tr');
            var row = tabla_1.row( tr );
            idLote = $(this).val();

            $("#modal_pagadas .modal-body").html("");
            $("#modal_pagadas .modal-body").append('<h4 class="modal-title">¿Estás seguro de mandar a recisión este lote? <b style="color:red;" >'+row.data().nombreLote+'</b>?</h4>');
            $("#modal_pagadas .modal-body").append(`<div class="form-group"><textarea name="Motivo" id="Motivo" class="form-control" placeholder="Describe brevemente el mótivo y detalles de fecha." cols="70" rows="3" required></textarea></div>
                    <input type="hidden" name="ideLotep" id="ideLotep" value="${idLote}"><input type="hidden" name="estatusL" id="estatusL" value="8">`);
            $("#modal_pagadas .modal-body").append('<br><div class="row"><div class="col-md-12"><center><input type="submit" class="btn btn-success" value="ACEPTAR"></center></div></div>');
            $("#modal_pagadas").modal();
        });

        $("#tabla_ingresar_9 tbody").on("click", ".liquidarPago", function(){
            var tr = $(this).closest('tr');
            var row = tabla_1.row( tr );
            idLote = $(this).val();
            var parametros = {
                "lote" : idLote
            };

            $.ajax({
                type: 'POST',
                url: url2+'Comisiones/LiquidarLote',
                data: parametros,
                beforeSend: function(){
                },
                success: function(data) {
                    if (data == 1) {
                        tabla_1.ajax.reload();
                        alerts.showNotification("top", "right", "LIQUIDADO.", "success");
                    } else {
                        alerts.showNotification("top", "right", "Asegúrate de haber llenado todos los campos mínimos requeridos.", "warning");
                    }
                },
                error: function(){
                    alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
                }
            });
        });

        async function VerificarUsers(idLote,compartida){
            return new Promise(resolve => {
                $.getJSON( url + "Comisiones/getUsersClient/"+idLote+"/"+compartida).done( function( data ){
                    resolve({data:data});
                });
            });
        }

        $("#tabla_ingresar_9 tbody").on("click", ".verify_neodata", async function(){ 
            $("#modal_NEODATA .modal-header").html("");
            $("#modal_NEODATA .modal-body").html("");
            $("#modal_NEODATA .modal-footer").html("");
            var tr = $(this).closest('tr');
            var row = tabla_1.row( tr );
            idLote = $(this).val();
            let cadena = '';
            registro_status = $(this).attr("data-value");
            compartida = $(this).attr("data-compartida");
            id_estatus = $(this).attr("data-estatus");
            tipo_venta = $(this).attr("data-tipov");
            lugar_prospeccionLote = $(this).attr("data-lugarP");
            totalNeto2 = $(this).attr("data-totalNeto2");
            var bandera_anticipo = 0;


            let VentaTipo = 0;
            let vigencia=0;
            let resulq = await VerificarUsers(idLote,compartida);

            if(parseFloat(totalNeto2) > 0){
                if(resulq.data == 0){
                    alerts.showNotification("top", "right", "Venta mal capturada", "warning");
                }
                else{
                    console.log('datos de la consulta ');
                    console.log(row.data);
                    let gerente = resulq.data[0].id_gerente;
                    let asesor = resulq.data[0].id_asesor;
                    let idCliente = resulq.data[0].id_cliente;
                    var fecha_inicio = new Date('2021-09-10');  
                    var fecha_fin = new Date('2021-12-31'); 
                    var fechaApar = resulq.data[0].fechaApartado.split(' ');
                    var fecha_apartado = new Date(fechaApar[0]);
                    if(tipo_venta == 7){
                        console.log('VENTA ESPACIAL 2');
                        //venta Especial
                        if(resulq.data[0].id_coordinador != 0 || resulq.data[0].id_coordinador != ''){
                            //CON 3 USUARIOS
                            VentaTipo=8;
                        }else{
                            //SOLO GASTON
                            console.log('VENTA ESPACIAL ');
                            VentaTipo=7;
                        }
                    }
                    else if(tipo_venta == 1 || tipo_venta == 2){
                        //venta normal o particular
                        if(lugar_prospeccionLote == 6){
                            console.log('VENTA MKTD');
                            //MKTD
                                console.log(fecha_inicio);
                                console.log(fecha_fin);
                                console.log(fecha_apartado);
                                if(resulq.data[0].id_lider == 7092 && (fecha_apartado >= fecha_inicio && fecha_apartado <= fecha_fin)){
                                    //REGIONAL MKTD
                                    console.log('VENTA REGIONAL MKTD');
                                    VentaTipo=6;
                                }else if(resulq.data[0].id_lider == 7092 && (fecha_apartado < fecha_inicio || fecha_apartado > fecha_fin)){
                                    //REGIONAL MKTD
                                    VentaTipo=2;
                                    vigencia=1;
                                }
                                else{
                                    console.log('VENTA SOLO MKTD');
                                    //MKTD
                                    VentaTipo=2;
                                } 
                        }
                        else if(lugar_prospeccionLote != 6 &&  lugar_prospeccionLote != 26){
                            //SIN ESPECIFICAR
                            if(gerente == 832){
                                console.log('VENTA SERGIO');
                                //SERGIO MUÑOZ
                                VentaTipo=3;
                            }
                            else{
                                if(asesor == 2595){
                                    console.log('VENTA VIKY');
                                    //VIKY PAULIN
                                    VentaTipo=9;
                                }
                                else{
                                    if(resulq.data[0].id_lider == 7092  && (fecha_apartado >= fecha_inicio && fecha_apartado <= fecha_fin)){
                                        //REGIONAL
                                        console.log('VENTA REGIONAL');
                                        VentaTipo=5;
                                    }
                                    else if(resulq.data[0].id_lider == 7092  && (fecha_apartado < fecha_inicio || fecha_apartado > fecha_fin)){
                                        VentaTipo=1;
                                        vigencia=1;
                                    }
                                    else{
                                        //NORMAL
                                        console.log('VENTA NORMAL');
                                        VentaTipo=1;
                                    }
                                }
                            }
                        }
                        else if(lugar_prospeccionLote == 26){
                            //COREANO
                            console.log('VENTA COREANO');
                            VentaTipo=4;
                        }
                    }

                    console.log('tipo venta:'+VentaTipo)
                    $("#modal_NEODATA .modal-body").html("");
                    $("#modal_NEODATA .modal-footer").html("");
                    $.getJSON( url + "ComisionesNeo/getStatusNeodata/"+idLote).done( function( data ){
                        //  $("#modal_NEODATA .modal-header").html("");
        
                        console.log('NEO');
                        console.log(data[0]);
                        if(data.length > 0){
                            console.log('ENTRA AL LENGTH');
                            switch (data[0].Marca) {
                                case 0:
                                    $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h4><b>En espera de próximo abono en NEODATA de '+row.data().nombreLote+'.</b></h4><br><h5>Revisar con Administración.</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div></div>');
                                break;
                                case 1:
                                    if(registro_status == 0 || registro_status ==8 || registro_status == 2){
                                        //COMISION NUEVA
                                        let total0 = parseFloat(data[0].Aplicado);
                                        let total = 0;
                                        if(total0 > 0){
                                            total = total0;
                                        }else{
                                            total = 0; 
                                        }

                                        // INICIO BONIFICACION *******************
                                        if(parseFloat(data[0].Bonificado) > 0){
                                            cadena = '<h5>Bonificación: <b style="color:#D84B16;">$'+formatMoney(data[0].Bonificado)+'</b></h4></div></div>';
                                            $("#modal_NEODATA .modal-body").append(`<input type="hidden" name="bonificacion" id="bonificacion" value="${parseFloat(data[0].Bonificado)}">`);
                                        }else{
                                            cadena = '<h5>Bonificación: <b>$'+formatMoney(0)+'</b></h4></div></div>';
                                            $("#modal_NEODATA .modal-body").append(`<input type="hidden" name="bonificacion" id="bonificacion" value="0">`);
                                        }

                                        // FINAL BONIFICACION *********************************
                                        $("#modal_NEODATA .modal-body").append(`<div class="row"><div class="col-md-12 text-center"><h3><i>${row.data().nombreLote}</i></h3></div></div><div class="row"><div class="col-md-3 p-0"><h5>Precio lote: <b>$${formatMoney(totalNeto2)}</b></h5></div><div class="col-md-3 p-0"><h5>Apl. neodata: <b style="color:${data[0].Aplicado <= 0 ? 'black' : 'blue'};">$${formatMoney(data[0].Aplicado)}</b></h5></div><div class="col-md-3 p-0"><h5>Disponible: <b style="color:green;">$${formatMoney(total0)}</b></h5></div><div class="col-md-3 p-0">${cadena}</div></div><br>`);

                                        // OPERACION PARA SACAR 5% ***
                                        first_validate = (totalNeto2 * 0.05).toFixed(3);
                                        new_validate = parseFloat(first_validate);
                                        console.log('OP 5%: '+new_validate);
                                        if(total>new_validate && (id_estatus == 9 || id_estatus == 10 || id_estatus == 11 || id_estatus == 12 || id_estatus == 13 || id_estatus == 14)){
                                            console.log("SOLO DISPERSA LA MITAD*******");
                                            $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h3><i class="fa fa-info-circle" style="color:gray;"></i><b style="color:blue;"> Anticipo </b> diponible <i>'+row.data().nombreLote+'</i></h3></div></div><br><br>');
                                            bandera_anticipo = 1;
                                        }
                                        else if((total<new_validate && (id_estatus == 9 || id_estatus == 10 || id_estatus == 11 || id_estatus == 12 || id_estatus == 13 || id_estatus == 14)) || (id_estatus == 15)){
                                            console.log("SOLO DISPERSA LO PROPORCIONAL*******");
                                            if( lugar_prospeccionLote == 28 || lugar_prospeccionLote == '28'){
                                                $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h3><i class="fa fa-info-circle" style="color:red;"></i> Venta E-commerce <i>'+row.data().nombreLote+'</i></h3></div></div><br><br>');
                                            }
                                            bandera_anticipo = 0;
                                        }
                                        else if((total==new_validate && (id_estatus == 9 || id_estatus == 10 || id_estatus == 11 || id_estatus == 12 || id_estatus == 13 || id_estatus == 14)) || (id_estatus == 15)  ){
                                            console.log("SOLO DISPERSA 5% *******");
                                            $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h3><i class="fa fa-info-circle" style="color:gray;"></i><b style="color:blue;"> Anticipo 5%</b> disponible <i>'+row.data().nombreLote+'</i></h3></div></div><br><br>');
                                            bandera_anticipo = 2;
                                        }

                                        // FIN BANDERA OPERACION PARA SACAR 5% ************
                                        $("#modal_NEODATA .modal-body").append(`<div class="row"><div class="col-md-3"><p style="font-zise:10px;"><b>USUARIOS</b></p></div><div class="col-md-1"><b>%</b></div><div class="col-md-2"><b>TOT. COMISIÓN</b></div><div class="col-md-2"><b><b>ABONADO</b></div><div class="col-md-2"><b>PENDIENTE</b></div><div class="col-md-2"><b>DISPONIBLE</b></div></div>`);
                                        lugar = lugar_prospeccionLote;
                                        var_sum = 0;

                                        let abonado=0;
                                        let porcentaje_abono=0;
                                        let total_comision=0;

                                        $.getJSON( url + "Comisiones/porcentajes/"+idCliente+"/"+VentaTipo+"/"+vigencia).done( function( resultArr ){
                                            let parteAsesor=0;
                                            let parteGerente=0;
                                            let parteCoord=0;
                                            let resta=0;
                                            if((tipo_venta == 7 || tipo_venta == 8) && data[0].Aplicado <= 10000){
                                                for (let j = resultArr.length-1; j >= 0 ;j--) {
                                                    
                                                    if(resultArr[j].id_rol == 7){
                                                        if(data[0].Aplicado > resultArr[j].comision_total){
                                                        parteAsesor= resultArr[j].comision_total;
                                                            resta = data[0].Aplicado - resultArr[j].comision_total;
                                                            if(resta > 500){
                                                                if(resultArr.length == 2){
                                                                    parteGerente = resta;
                                                                }else if(resultArr.length == 3){
                                                                    parteCoord=resta/2; 
                                                                    parteGerente = resta/2;
                                                                }
                                                            }
                                                        }else{
                                                            parteAsesor=data[0].Aplicado;
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            $.each( resultArr, function( i, v){
                                                let porcentajeAse =  v.porcentaje_decimal;
                                                let total_comision1=0;
                                                total_comision1 = totalNeto2 * (porcentajeAse / 100);

                                                let saldo1 = 0;
                                                let total_vo = 0;
                                                total_vo = total;
                                                console.log('TOTAL COMISIÓN'+total_comision1)
                                                console.log('TOTAL_VO'+total_vo)
                                                saldo1 = total_vo * (v.porcentaje_neodata / 100);
                                                    
                                                if(saldo1 > total_comision1){
                                                    saldo1 = total_comision1;
                                                }else if(saldo1 < total_comision1){
                                                    saldo1 = saldo1;
                                                }else if(saldo1 < 1){
                                                    saldo1 = 0;
                                                }

                                                let resto1 = 0;
                                                resto1 = total_comision1 - saldo1;
                                                
                                                if(resto1 < 1){
                                                    resto1 = 0;
                                                }else{
                                                    resto1 = total_comision1 - saldo1;
                                                }

                                                let saldo1C=0;

                                                if(bandera_anticipo == 1){
                                                    console.log("entra a banderaa 1 "+bandera_anticipo);
                                                    saldo1C = (saldo1/2);
                                                } else if(bandera_anticipo == 2){
                                                    console.log("entra a banderaa 2 "+bandera_anticipo);
                                                    saldo1C = (total_comision1/2);
                                                } else{
                                                    console.log("entra a banderaa 0 "+bandera_anticipo);
                                                    saldo1C = saldo1;
                                                }
                                                total_comision = parseFloat(total_comision) + parseFloat(v.comision_total);
                                                abonado =parseFloat(abonado) +parseFloat(saldo1C);
                                                porcentaje_abono = parseFloat(porcentaje_abono) + parseFloat(v.porcentaje_decimal);
                                                console.log('-----');
                                                console.log(saldo1C);

                                                $("#modal_NEODATA .modal-body").append(`<div class="row">
                                                <div class="col-md-3">
                                                <input id="id_usuario" type="hidden" name="id_usuario[]" value="${v.id_usuario}"><input id="id_rol" type="hidden" name="id_rol[]" value="${v.id_rol}">
                                                <input class="form-control ng-invalid ng-invalid-required" required readonly="true" value="${v.nombre}" style="font-size:12px;"><b><p style="font-size:12px;">${v.detail_rol}</p></b></div>
                                                <div class="col-md-1"><input class="form-control ng-invalid ng-invalid-required" name="porcentaje[]"  required readonly="true" type="hidden" value="${v.porcentaje_decimal % 1 == 0 ? parseInt(v.porcentaje_decimal) : parseFloat(v.porcentaje_decimal)}"><input class="form-control ng-invalid ng-invalid-required" required readonly="true" value="${v.porcentaje_decimal % 1 == 0 ? parseInt(v.porcentaje_decimal) : v.porcentaje_decimal.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]}%"></div>
                                                <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required" name="comision_total[]" required readonly="true" value="${formatMoney(v.comision_total)}"></div>
                                                <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required" name="comision_abonada[]" required readonly="true" value="${formatMoney(0)}"></div>
                                                <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required" name="comision_pendiente[]" required readonly="true" value="${formatMoney(v.comision_total)}"></div>
                                                <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required decimals" name="comision_dar[]"  data-old="" id="inputEdit" readonly="true"  value="${ (tipo_venta == 7 || tipo_venta == 8) && data[0].Aplicado < 10000 ? v.id_rol == 7 ? formatMoney(parteAsesor): v.id_rol == 9 ? formatMoney(parteCoord) : formatMoney(parteGerente)   : formatMoney(saldo1C)}"></div></div>`);
                                                if(i == resultArr.length -1){
                                                    $("#modal_NEODATA .modal-body").append(`
                                                    <input type="hidden" name="pago_neo" id="pago_neo" value="${formatMoney(data[0].Aplicado)}">
                                                    <input type="hidden" name="idLote" id="idLote" value="${idLote}">
                                                    <input type="hidden" name="porcentaje_abono" id="porcentaje_abono" value="${porcentaje_abono}">
                                                    <input type="hidden" name="abonado" id="abonado" value="${formatMoney(abonado)}">
                                                    <input type="hidden" name="total_comision" id="total_comision" value="${formatMoney(total_comision)}">
                                                    <input type="hidden" name="bonificacion" id="bonificacion" value="${formatMoney(data[0].Bonificado)}">
                                                    <input type="hidden" name="pendiente" id="pendiente" value="${formatMoney(total_comision-abonado)}">
                                                    <input type="hidden" name="idCliente" id="idCliente" value="${idCliente}">
                                                    <input type="hidden" name="id_disparador" id="id_disparador" value="0">
                                                    <input type="hidden" name="lugar_p" id="lugar_p" value="${lugar_prospeccionLote}">
                                                    <input type="hidden" name="tipo_venta_insert" id="tipo_venta_insert" value="${VentaTipo}">
                                                    <input type="hidden" name="totalNeto2" id="totalNeto2" value="${totalNeto2}">
                                                    `);
                                                }
                                            });
                                            
                                            $("#modal_NEODATA .modal-footer").append('<div class="row"><div class="col-md-3"></div><div class="col-md-3"><input type="submit" class="btn btn-success" name="disper_btn"  id="dispersar" value="Dispersar"></div><div class="col-md-3"><input type="button" class="btn btn-danger" data-dismiss="modal" value="CANCELAR"></div></div>');
                                        
                                        });

        
                                    }
                                    else{
                                        $.getJSON( url + "Comisiones/getDatosAbonadoSuma11/"+idLote).done( function( data1 ){
                                            let total0 = parseFloat((data[0].Aplicado));
                                            let total = 0;
                                            if(total0 > 0){
                                                total = total0;
                                            }
                                            else{
                                                total = 0; 
                                            }

                                            var counts=0;

                                            $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h3><i class="fa fa-info-circle" style="color:gray;"></i> Saldo diponible para <i>'+row.data().nombreLote+'</i>: <b>$'+formatMoney(total0-(data1[0].abonado))+'</b></h3></div></div><br>');

                                            $("#modal_NEODATA .modal-body").append('<div class="row">'+
                                            '<div class="col-md-4">Total pago: <b style="color:blue">'+formatMoney(data1[0].total_comision)+'</b></div>'+
                                            '<div class="col-md-4">Total abonado: <b style="color:green">'+formatMoney(data1[0].abonado)+'</b></div>'+
                                            '<div class="col-md-4">Total pendiente: <b style="color:orange">'+formatMoney((data1[0].total_comision)-(data1[0].abonado))+'</b></div></div>');

                                            if(parseFloat(data[0].Bonificado) > 0){
                                                cadena = '<h4>Bonificación: <b style="color:#D84B16;">$'+formatMoney(data[0].Bonificado)+'</b></h4>';
                                            }else{
                                                cadena = '<h4>Bonificación: <b >$'+formatMoney(0)+'</b></h4>';
                                            }
                                            $("#modal_NEODATA .modal-body").append(`<div class="row"><div class="col-md-4"><h4><b>Precio lote: $${formatMoney(data1[0].totalNeto2)}</b></h4></div>
                                            <div class="col-md-4"><h4>Aplicado neodata: <b>$${formatMoney(data[0].Aplicado)}</b></h4></div><div class="col-md-4">${cadena}</div>
                                            </div><br>`);
                                            
                                            $.getJSON( url + "Comisiones/getDatosAbonadoDispersion/"+idLote).done( function( data ){
                                                $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-3"><p style="font-zise:10px;"><b>USUARIOS</b></p></div><div class="col-md-1"><b>%</b></div><div class="col-md-2"><b>TOT. COMISIÓN</b></div><div class="col-md-2"><b><b>ABONADO</b></div><div class="col-md-2"><b>PENDIENTE</b></div><div class="col-md-2"><b>DISPONIBLE</b></div></div>');
                                                let contador=0;
                                                console.log('gree:'+data.length);
                                                let coor = data.length;
                                                for (let index = 0; index < data.length; index++) {
                                                    const element = data[index].id_usuario;
                                                    if(data[index].id_usuario == 5855){
                                                        contador +=1;
                                                    }
                                                }

                                                $.each( data, function( i, v){
                                                    saldo =0;
                                                    if(tipo_venta == 7 && coor == 2){
                                                        total = total - data1[0].abonado;
                                                        console.log(total);

                                                        saldo = tipo_venta == 7 && v.rol_generado == "3" ? (0.925*total) : tipo_venta == 7 && v.rol_generado == "7" ? (0.075*total) : ((12.5 *(v.porcentaje_decimal / 100)) * total);

                                                    }
                                                    else if(tipo_venta == 7 && coor == 3){
                                                        total = total - data1[0].abonado;
                                                        console.log(total);
                                                        saldo = tipo_venta == 7 && v.rol_generado == "3" ? (0.675*total) : tipo_venta == 7 && v.rol_generado == "7" ? (0.075*total) : tipo_venta == 7 && v.rol_generado == "9" ?  (0.25*total) :   ((12.5 *(v.porcentaje_decimal / 100)) * total);
                                                    }
                                                    else{
                                                        saldo =  ((12.5 *(v.porcentaje_decimal / 100)) * total);
                                                    }

                                                    if(v.abono_pagado>0){
                                                        console.log("OPCION 1");
                                                        evaluar = (v.comision_total-v.abono_pagado);
                                                        if(evaluar<1){
                                                            pending = 0;
                                                            saldo = 0;
                                                        }
                                                        else{
                                                            pending = evaluar;
                                                        }

                                                        resta_1 = saldo-v.abono_pagado;
                                                        console.log('resta_1'+resta_1);

                                                        if(resta_1<1){
                                                            saldo = 0;
                                                        }
                                                        else if(resta_1 >= 1){
                                                            if(resta_1 > pending){
                                                                saldo = pending;
                                                            }
                                                            else{
                                                                saldo = saldo-v.abono_pagado;
                                                            }
                                                        }
                                                    }  
                                                    else if(v.abono_pagado<=0){
                                                        console.log("OPCION 2");
                                                        pending = (v.comision_total);
                                                        if(saldo > pending){
                                                            saldo = pending;
                                                        }
                                                        if(pending < 1){
                                                            saldo = 0;
                                                        }
                                                    }

                                                    $("#modal_NEODATA .modal-body").append(`<div class="row">
                                                    <div class="col-md-3"><input id="id_disparador" type="hidden" name="id_disparador" value="1"><input type="hidden" name="pago_neo" id="pago_neo" value="${total.toFixed(3)}">
                                                    <input type="hidden" name="pending" id="pending" value="${pending}"><input type="hidden" name="idLote" id="idLote" value="${idLote}">
                                                    <input id="rol" type="hidden" name="id_comision[]" value="${v.id_comision}"><input id="rol" type="hidden" name="rol[]" value="${v.id_usuario}">
                                                    <input class="form-control ng-invalid ng-invalid-required" required readonly="true" value="${v.colaborador}" style="font-size:12px;${v.descuento == 1 ? 'color:red;' : ''}">
                                                    <b><p style="font-size:12px;${v.descuento == 1 ? 'color:red;' : ''}">${v.descuento != "1" ?  v.rol : v.rol +' Incorrecto' }</p></b></div>
                                                    <div class="col-md-1"><input class="form-control ng-invalid ng-invalid-required" required readonly="true" style="${v.descuento == 1 ? 'color:red;' : ''}" value="${parseFloat(v.porcentaje_decimal)}%"></div>
                                                    <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required" required readonly="true" style="${v.descuento == 1 ? 'color:red;' : ''}" value="${formatMoney(v.comision_total)}"></div>
                                                    <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required" required readonly="true" style="${v.descuento == 1 ? 'color:red;' : ''}" value="${formatMoney(v.abono_pagado)}"></div>
                                                    <div class="col-md-2"><input class="form-control ng-invalid ng-invalid-required" required readonly="true" value="${formatMoney(pending)}"></div>
                                                    <div class="col-md-2"><input id="abono_nuevo${counts}" onkeyup="nuevo_abono(${counts});" class="form-control ng-invalid ng-invalid-required abono_nuevo"  name="abono_nuevo[]" value="${saldo}" type="hidden">
                                                    <input class="form-control ng-invalid ng-invalid-required decimals"  data-old="" id="inputEdit"  value="${formatMoney(saldo)}"></div></div>`);
                                                    counts++
                                                });
                                            });

                                            $("#modal_NEODATA .modal-footer").append('<div class="row"><div class="col-md-3"></div><div class="col-md-3"><input type="submit" class="btn btn-success" name="disper_btn"  id="dispersar" value="Dispersar"></div><div class="col-md-3"><input type="button" class="btn btn-danger" data-dismiss="modal" value="CANCELAR"></div></div>');
                                            
                                            if(total < 1 ){
                                                $('#dispersar').prop('disabled', true);
                                            }
                                            else{
                                                $('#dispersar').prop('disabled', false);
                                            }
                                        });
                                    }
                                break;
                                case 2:
                                    $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h4><b>No se encontró esta referencia de '+row.data().nombreLote+'.</b></h4><br><h5>Revisar con Administración.</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div> </div>');
                                break;
                                case 3:
                                    $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h4><b>No tiene vivienda, si hay referencia de '+row.data().nombreLote+'.</b></h4><br><h5>Revisar con Administración.</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div> </div>');
                                break;
                                case 4:
                                    $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h4><b>No hay pagos aplicados a esta referencia de '+row.data().nombreLote+'.</b></h4><br><h5>Revisar con Administración.</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div> </div>');
                                break;
                                case 5:
                                    $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h4><b>Referencia duplicada de '+row.data().nombreLote+'.</b></h4><br><h5>Revisar con Administración.</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div> </div>');
                                break;
                                default:
                                    $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h4><b>Aviso.</b></h4><br><h5>Sistema en mantenimiento: .</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div> </div>');
                                break;
                            }
                        }
                        else{
                            console.log("QUERY SIN RESULTADOS");
                            $("#modal_NEODATA .modal-body").append('<div class="row"><div class="col-md-12"><h3><b>No se encontró esta referencia en NEODATA de '+row.data().nombreLote+'.</b></h3><br><h5>Revisar con Administración.</h5></div> <div class="col-md-12"><center><img src="'+url+'static/images/robot.gif" width="320" height="300"></center></div> </div>');
                        }
                    }); //FIN getStatusNeodata
                    
                    $("#modal_NEODATA").modal();
                }
            } 
            else{
                alerts.showNotification("top", "right", "El lote no tiene precio asignado en inventario", "warning");
            }
        }); //FIN VERIFY_NEODATA
        /**----------------------------------------------------------------------- */
    
    });

    $("#form_NEODATA").submit( function(e) {
        $('#dispersar').prop('disabled', true);
        document.getElementById('dispersar').disabled = true;

        e.preventDefault();
    }).validate({
        submitHandler: function( form ) {
            $('#spiner-loader').removeClass('hidden');
            var data = new FormData( $(form)[0] );
            $.ajax({
                url: url + 'Comisiones/InsertNeo',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data){
                    if( data == 1 ){
                        $('#spiner-loader').addClass('hidden');
                        alerts.showNotification("top", "right", "Dispersión guardada con éxito", "success");
                        tabla_1.ajax.reload();
                        $("#modal_NEODATA").modal( 'hide' );
                        function_totales();
                        $('#dispersar').prop('disabled', false);
        document.getElementById('dispersar').disabled = false;

                    }else if (data == 2) {
                        $('#spiner-loader').addClass('hidden');
                        alerts.showNotification("top", "right", "Ya se dispersó por otra persona o es una recisión", "warning");
                        tabla_1.ajax.reload();
                        $("#modal_NEODATA").modal( 'hide' );
                        $('#dispersar').prop('disabled', false);
        document.getElementById('dispersar').disabled = false;
                    }else{
                        $('#spiner-loader').addClass('hidden');
                        alerts.showNotification("top", "right", "No se pudo completar tu solicitud", "danger");
                        $('#dispersar').prop('disabled', false);
        document.getElementById('dispersar').disabled = false;
                    }
                },error: function(){
                    $('#spiner-loader').addClass('hidden');
                    alerts.showNotification("top", "right", "ERROR EN EL SISTEMA, REVISAR CON SISTEMAS", "danger");

                }
            });     
        }
    });   


    $("#form_pagadas").submit( function(e) {
        e.preventDefault();
    }).validate({
        submitHandler: function( form ) {
            $('#spiner-loader').removeClass('hidden');
            var data = new FormData( $(form)[0] );
            $.ajax({
                url: url2 + "Comisiones/liquidar_comision",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data){
                    if(true){
                        $('#spiner-loader').addClass('hidden');
                        $("#modal_pagadas").modal('toggle');
                        tabla_1.ajax.reload();
                        alert("¡Se agregó con éxito!");


                    }else{
                        alert("NO SE HA PODIDO COMPLETAR LA SOLICITUD");
                        $('#spiner-loader').addClass('hidden');
                    }
                },error: function( ){
                    alert("ERROR EN EL SISTEMA");
                }
            });
        }
    });

    $("#form_NEODATA2").submit( function(e) {
        e.preventDefault();
    }).validate({
        submitHandler: function( form ) {
            $('#spiner-loader').removeClass('hidden');
            var data = new FormData( $(form)[0] );
            $.ajax({
                url: url + 'Comisiones/InsertNeoCompartida',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data){
                    if( data == 1 ){
                        $('#spiner-loader').addClass('hidden');
                        tabla_1.ajax.reload();
                        alert("Dispersión guardada con exito.");
                        $("#modal_NEODATA2").modal( 'hide' ); 
                        function_totales();
                    }else if (data == 2) {
                        alert("Ya disperso otra persona esta comision");
                        tabla_1.ajax.reload();
                        $("#modal_NEODATA2").modal( 'hide' ); 
                        function_totales();
                        $('#spiner-loader').addClass('hidden');
                    }else{
                        $('#spiner-loader').addClass('hidden');
                        alert("NO SE HA PODIDO COMPLETAR LA SOLICITUD");
                    }
                },error: function(){
                    $('#spiner-loader').addClass('hidden');
                    alert("ERROR EN EL SISTEMA");
                }
            });
        }
    });

    jQuery(document).ready(function(){
        jQuery('#editReg').on('hidden.bs.modal', function (e) {
            jQuery(this).removeData('bs.modal');
            jQuery(this).find('#comentario').val('');
            jQuery(this).find('#totalNeto').val('');
            jQuery(this).find('#totalNeto2').val('');
        })

        jQuery('#rechReg').on('hidden.bs.modal', function (e) {
            jQuery(this).removeData('bs.modal');
            jQuery(this).find('#comentario3').val('');
        })

        function myFunctionD2(){
            formatCurrency($('#inputEdit'));
        }
    })

    $('.decimals').on('input', function () {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    });

    function SoloNumeros(evt){
        if(window.event){
            keynum = evt.keyCode; 
        }
        else{
            keynum = evt.which;
        } 

        if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 || keynum == 46 ){
            return true;
        }
        else{
            alerts.showNotification("top", "left", "Solo Numeros.", "danger");
            return false;
        }
    }

    function function_totales(){
        $.getJSON( url + "Comisiones/getMontoDispersado").done( function( data ){
            $cadena = '<b>$'+formatMoney(data[0].monto)+'</b>';
            document.getElementById("monto_label").innerHTML = $cadena ;
        });
        $.getJSON( url + "Comisiones/getPagosDispersado").done( function( data ){
            $cadena01 = '<b>'+data[0].pagos+'</b>';
            document.getElementById("pagos_label").innerHTML = $cadena01 ;
        });
        $.getJSON( url + "Comisiones/getLotesDispersado").done( function( data ){
            $cadena02 = '<b>'+data[0].lotes+'</b>';
            document.getElementById("lotes_label").innerHTML = $cadena02 ;
        });  
    }

    $('#fecha1').change( function(){
        fecha1 = $(this).val(); 
        var fecha2 = $('#fecha2').val();
        if(fecha2 == ''){
            alerts.showNotification("top", "right", "Selecciona la segunda fecha", "info");
        }
        else{
            document.getElementById("fecha2").value = "";
        }
    });

    $('#fecha2').change( function(){  
        $("#myModal .modal-body").html('');
        var fecha2 = $(this).val();  
        var fecha1 = $('#fecha1').val();
        if(fecha1 == ''){
            alerts.showNotification("top", "right", "Selecciona la primer fecha", "info");
        }
        else{
            $.getJSON( url + "Comisiones/getMontoDispersadoDates/"+fecha1+'/'+fecha2).done( function( $datos ){
                $("#myModal .modal-body").append('<div class="row"><div class="col-md-12"><p class="category"><b>Monto</b>: <i><b>$'+formatMoney($datos['datos_monto'][0].monto)+'</b></i></p></div></div>');
                $("#myModal .modal-body").append('<div class="row"><div class="col-md-12"><p class="category"><b>Pagos</b>: <i><b>'+formatMoney($datos['datos_pagos'][0].pagos)+'</b></i></p></div></div>');
                $("#myModal .modal-body").append('<div class="row"><div class="col-md-12"><p class="category"><b>Lotes</b>: <i><b>'+formatMoney($datos['datos_lotes'][0].lotes)+'</b></i></p></div></div>');
            });
        }
    });

    $("#my_updatebandera_form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'updateBandera',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
            },
            success: function(data) {
                if (data == 1) {
                    $('#myUpdateBanderaModal').modal("hide");
                    $("#id_pagoc").val("");
                    alerts.showNotification("top", "right", "El registro se ha actualizado exitosamente.", "success");
                    tabla_1.ajax.reload();
                } else {
                    alerts.showNotification("top", "right", "Oops, algo salió mal. Error al intentar actualizar.", "warning");
                }
            },
            error: function(){
                alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
            }
        });
    });

    function formatMoney( n ) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    function formatCurrency(input, blur) {
        var input_val = input.val();
        if (input_val === "") { return; }
        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");
        if (input_val.indexOf(".") >= 0) {
            var decimal_pos = input_val.indexOf(".");
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);
            left_side = formatNumber(left_side);
            right_side = formatNumber(right_side);
            if (blur === "blur") {
            right_side += "00";
            }
            right_side = right_side.substring(0, 2);
            input_val = left_side + "." + right_side;
        } else {
            input_val = formatNumber(input_val);
            input_val = input_val;
            if (blur === "blur") {
            input_val += ".00";
            }
        }
        input.val(input_val);
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

    </script>
</body>