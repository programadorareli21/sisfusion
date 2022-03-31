<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="<?= base_url() ?>dist/css/datatableNFilters.css" rel="stylesheet"/>
<body>
    <div class="wrapper">
        <?php
            if($this->session->userdata('id_rol')=="19" || $this->session->userdata('id_rol')=="28" )//sistemas
            {
                $datos = array();
                $datos = $datos4;
                $datos = $datos2;
                $datos = $datos3;  
                $this->load->view('template/sidebar', $datos);
            }
            else
            {
                echo '<script>alert("ACCESSO DENEGADO"); window.location.href="'.base_url().'";</script>';
            }
        ?>
    
        <!-- Modals -->
        <!--<div class="modal fade modal-alertas" id="modal_users" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
            
                    <form method="post" id="form_interes">
                        <div class="modal-body"></div>
                    </form>
                </div>
            </div>
        </div>-->

        <div class="modal fade modal-alertas" id="modal_colaboradores" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
            
                    <form method="post" id="form_colaboradores">
                        <div class="modal-body"></div>
                        <div class="modal-footer"></div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade modal-alertas" id="modal_mktd" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">EDITAR INFORMACIÓN</h4>
                    </div>
                    <form method="post" id="form_MKTD">
                        <div class="modal-body"></div>
                        <div class="modal-footer"></div>
                    </form>
                </div>
            </div>
        </div>

        <!--<div class="modal fade modal-alertas" id="modalParcialidad" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">SOLICITAR PARCIALIDAD DE PAGO</h4>
                    </div>
                    <form method="post" id="form_parcialidad">
                        <div class="modal-body"></div>
                    </form>
                </div>
            </div>
        </div>-->


        <div class="modal fade" id="seeInformationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons" onclick="cleanComments()">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist" style="background: #949494;">
                                <div id="nameLote"></div>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="changelogTab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-plain">
                                                <div class="card-content">
                                                    <ul class="timeline timeline-simple" id="comments-list-asimilados"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal" onclick="cleanComments()"><b>Cerrar</b></button>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="modal fade modal-alertas" id="modal_documentacion" role="dialog">
            <div class="modal-dialog" style="width:800px; margin-top:20px">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <!--<div class="modal fade bd-example-modal-sm" id="myModalEnviadas" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>-->

        <!--<div class="modal fade modal-alertas" id="documento_preview" role="dialog">
            <div class="modal-dialog" style= "margin-top:20px;"></div>
        </div>-->
        <!-- END Modals -->

        <div class="content boxContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">        
                        <ul class="nav nav-tabs nav-tabs-cm" role="tablist">
                            <li class="active"><a href="#nuevas-1" role="tab" data-toggle="tab">LOTES VALIDADOS</a></li>
                            <li><a href="#proceso-1" role="tab" data-toggle="tab">DISPERSADOS DIRECCIÓN MKTD</a></li>
                        </ul>
                        
                        <div class="card no-shadow m-0 border-conntent__tabs">
                            <div class="card-content p-0">
                                <div class="nav-tabs-custom">
                                    <div class="tab-content p-2">
                                        <div class="tab-pane active" id="nuevas-1">
                                            <div class="text-center">
                                                <h3 class="card-title center-align">Comisiones validadas por cobranza</h3>
                                                <p class="card-title pl-1">(Pagos ya validados por el área de cobranza MKTD, actualmente se encuentran en espera de dispersión por parte de dirección)</p>
                                            </div>
                                            <div class="toolbar">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group d-flex justify-center align-center">
                                                                <h4 class="title-tot center-align m-0">Disponible</h4>
                                                                <p class="input-tot pl-1" id="myText_nuevas">$0.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="m-0" for="proyecto">Sedes</label>
                                                                <select name="filtro33" id="filtro33" class="selectpicker select-gral m-0" data-style="btn " data-show-subtext="true" data-live-search="true"  title="Selecciona una sede" data-size="7" required> <option value="0">Seleccione todo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table-striped table-hover" id="tabla_plaza_1" name="tabla_plaza_1">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>ID LOTE</th>
                                                                <th>PROY.</th>
                                                                <th>CONDOMINIO</th>
                                                                <th>LOTE</th>
                                                                <th>REFERENCIA</th>
                                                                <th>PRECIO LOTE</th>
                                                                <th>EMP.</th>
                                                                <th>TOT. COM.</th>
                                                                <th>P. CLIENTE</th>
                                                                <th>SOLICITADO</th>    
                                                                <th>TIPO VENTA</th>
                                                                <th>USUARIO</th>
                                                                <th>DETALLE</th>
                                                                <th>PLAZA</th>
                                                                <th>FEC. ENVÍO</th>
                                                                <th>MÁS</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="proceso-1">
                                            <div class="text-center">
                                                <h3 class="card-title center-align">Comisiones dispersadas por dirección mktd</h3>
                                                <p class="card-title pl-1">(Lotes correspondientes a comisiones solicitadas para pago por el área de MKTD, en espera de validación contraloría y pago de internomex)</p>
                                            </div>
                                            <div class="toolbar">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group d-flex justify-center align-center">
                                                                <h4 class="title-tot center-align m-0">Total</h4>
                                                                <p class="input-tot pl-1" id="myText_proceso">$0.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table-striped table-hover" id="tabla_plaza_2" name="tabla_plaza_2">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>ID LOTE</th>
                                                                <th>PROY.</th>
                                                                <th>CONDOMINIO</th>
                                                                <th>LOTE</th>
                                                                <th>REFERENCIA</th>
                                                                <th>PRECIO LOTE</th>
                                                                <th>EMP.</th>
                                                                <th>TOT. COM.</th>
                                                                <th>P. CLIENTE</th>
                                                                <th>SOLICITADO</th>
                                                                <th>TIPO VENTA</th>
                                                                <th>USUARIO</th>
                                                                <th>PLAZA</th>
                                                                <th>FEC. ENVÍO</th>
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
        $(document).ready(function() {
            $("#tabla_asimilados").prop("hidden", true);
            $.post("<?=base_url()?>index.php/Comisiones/lista_sedes", function (data) {
                var len = data.length;
                for (var i = 0; i < len; i++) {
                    var id = data[i]['idResidencial'];
                    var name = data[i]['descripcion'];
                    $("#filtro33").append($('<option>').val(id).text(name.toUpperCase()));
                }
                $("#filtro33").selectpicker('refresh');
            }, 'json');
        }); 
    
        $('#filtro33').change(function(ruta){
            proyecto = $('#filtro33').val();
            if(proyecto == '' || proyecto == null || proyecto == undefined){
                proyecto = 0;
            }
            getAssimilatedCommissions(proyecto);
        });
 
        var url = "<?=base_url()?>";
        var url2 = "<?=base_url()?>index.php/";
        var totalLeon = 0;
        var totalQro = 0;
        var totalSlp = 0;
        var totalMerida = 0;
        var totalCdmx = 0;
        var totalCancun = 0;
        var tr;
        var tabla_remanente2 ;
        var totaPen = 0;

        //INICIO TABLA QUERETARO************
        let titulos = [];
        $('#tabla_plaza_1 thead tr:eq(0) th').each( function (i) {
            if(i != 0 ){
                var title = $(this).text();
                titulos.push(title);
                $(this).html('<input type="text" class="textoshead" placeholder="'+title+'"/>');
                $('input', this).on('keyup change', function() {
                    if (tabla_plaza_12.column(i).search() !== this.value) {
                        tabla_plaza_12
                        .column(i)
                        .search(this.value)
                        .draw();

                        var total = 0;
                        var index = tabla_plaza_12.rows({
                            selected: true,
                            search: 'applied'
                        }).indexes();
                        var data = tabla_plaza_12.rows(index).data();
                        $.each(data, function(i, v) {
                            total += parseFloat(v.pago_cliente);
                        });
                        var to1 = formatMoney(total);
                        document.getElementById("myText_nuevas").textContent = '$'+formatMoney(total);
                    }
                });
            } 
            else{
                $(this).html('<input id="all" type="checkbox" style="width:20px; height:20px;" onchange="selectAll(this)"/>');
            }
        });

        function getAssimilatedCommissions(sede){
            $('#tabla_plaza_1').on('xhr.dt', function(e, settings, json, xhr) {
                var total = 0;
                $.each(json.data, function(i, v) {
                    total += parseFloat(v.pago_cliente);
                });
                var to = formatMoney(total);
                document.getElementById("myText_nuevas").textContent = '$'+ to;
            });

            $("#tabla_plaza_1").prop("hidden", false);
            tabla_plaza_12 = $("#tabla_plaza_1").DataTable({
                dom: 'Brt'+ "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-6'i><'col-xs-12 col-sm-12 col-md-6 col-lg-6'p>>",
                width: 'auto',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    className: 'btn buttons-excel',
                    titleAttr: 'Descargar archivo de Excel',
                    title: 'COMISIONES VALIDADAS COBRANZA MKTD',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
                        format: {
                            header:  function (d, columnIdx) {
                                if(columnIdx == 0){
                                    return 'ID PAGO';
                                }else if(columnIdx == 1){
                                    return 'ID LOTE';
                                }
                                else if(columnIdx == 2){
                                    return 'PROYECTO';
                                }else if(columnIdx == 3){
                                    return 'CONDOMINIO';
                                }else if(columnIdx == 4){
                                    return 'NOMBRE LOTE ';
                                }else if(columnIdx == 5){
                                    return 'REFERENCIA';
                                }else if(columnIdx == 6){
                                    return 'PRECIO LOTE';
                                }else if(columnIdx == 7){
                                    return 'EMPRESA';
                                }else if(columnIdx == 8){
                                    return 'TOT. COMISIÓN';
                                }else if(columnIdx == 9){
                                    return 'P. CLIENTE';
                                }else if(columnIdx == 10){
                                    return 'TOT. PAGAR';
                                }else if(columnIdx == 11){
                                    return 'TIPO VENTA';
                                }else if(columnIdx == 12){
                                    return 'COMISIONISTA';
                                }else if(columnIdx == 13){
                                    return 'DETALLE';
                                }else if(columnIdx == 14){
                                    return 'PLAZA';
                                }else if(columnIdx == 15){
                                    return 'FECH. ENVÍO';
                                }else if(columnIdx != 16 && columnIdx !=0){
                                    return ' '+titulos[columnIdx-1] +' ';
                                }
                            }
                        }
                    },
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
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.id_pago_i+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.id_lote+'</p>';
                    }
                },
                {
                    "width": "3%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.proyecto+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.condominio+'</p>';
                    }
                },
                {
                    "width": "8%",
                    "data": function( d ){
                        return '<p class="m-0"><b>'+d.lote+'</b></p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.referencia+'</p>';
                    }
                },
                {
                    "width": "7%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.precio_lote)+'</p>';
                    }
                },
                {
                    "width": "3%",
                    "data": function( d ){
                        return '<p class="m-0"><b>'+d.empresa+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.comision_total)+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.pago_neodata)+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.pago_cliente)+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        if(d.lugar_prospeccion == 6){
                            return '<p class="m-0">COMISIÓN + MKTD <br><b> ('+d.porcentaje_decimal+'% de '+d.porcentaje_abono+'%)</b></p>';
                        }
                        else{
                            return '<p class="m-0">COMISIÓN <br><b> ('+d.porcentaje_decimal+'% de '+d.porcentaje_abono+'%)</b></p>';
                        }
                    
                    }
                },
                {
                    "width": "6%",
                    "data": function( d ){
                        return '<p class="m-0"><b>'+d.usuario+'</b></i></p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        if(d.estatus == 1){
                            p0 = '<p title="Lote dispersión automática"><span class="label" style="background:dodgerblue;color: white;">AUTOMÁTICO</span></p>';
                        }
                        else{
                            p0 = '<p title="Lote dispersión manual"><span class="label" style="background:orange;color: white;">MANUAL</span></p>';
                        }
                        if(d.bonificacion >= 1){
                            p1 = '<p title="Lote con bonificación en NEODATA"><span class="label" style="background:pink;color: black;">Bon. $'+formatMoney(d.bonificacion)+'</span></p>';
                        }
                        else{
                            p1 = '';
                        }
                        if(d.lugar_prospeccion == 0){
                            p2 = '<p title="Lote con cancelación de CONTRATO"><span class="label" style="background:crimson;">Recisión</span></p>';
                        }
                        else{
                            p2 = '';
                        }
                        return p0 + p1 + p2;;
                    }
                },
                {
                    "width": "6%",
                    "data": function( d ){
                        if(d.idc_mktd == null){
                            if (d.ubicacion_dos == null) {
                                return '<p  class="m-0" style="color:crimson;"><b>Sin lugar de venta asignado</b></p>';
                            }
                            else {
                                return '<p  class="m-0">' + d.nombre + '</p>';
                            }
                        }
                        else{
                            return '<span class="label label-warning">Compartida</span><br><br>'+'<p class="m-0"><b>' +d.sd1+' / '+d.sd2+ '</b></p>';
                        }
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        var BtnStats1;
                            BtnStats1 =  '<p class="m-0">'+d.fecha_pago_intmex+'</p>';
                        return BtnStats1;
                    }
                },
                {
                    "width": "5%",
                    "orderable": false,
                    "data": function( data ){
                        var BtnStats;
                        BtnStats = '<button href="#" value="'+data.id_pago_i+'" data-value="'+data.lote+'" data-code="'+data.cbbtton+'" ' +'class="btn-data btn-blueMaderas consultar_logs_asimilados" title="Detalles">' +'<i class="fa fa-info" aria-hidden="true"></i></button>';
                        return BtnStats;
                    }
                }],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0,
                    searchable :false,
                    className: 'dt-body-center',
                    select: {
                        style:    'os',
                        selector: 'td:first-child'
                    },
                }],
                ajax: {
                    url: url2 + "Comisiones/getDatosEnviadasADirectorMK/"+sede,
                    type: "POST",
                    cache: false,
                    "data": function( d ){}
                },
                order: [[ 1, 'asc' ]]
            });

            
            $("#tabla_plaza_1 tbody").on("click", ".consultar_logs_asimilados", function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                id_pago = $(this).val();
                lote = $(this).attr("data-value");

                $("#seeInformationModal").modal();
                $("#nameLote").append('<p><h5 style="color: white;">HISTORIAL DEL PAGO DE: <b>'+lote+'</b></h5></p>');
                $.getJSON("getComments/"+id_pago).done( function( data ){
                    $.each( data, function(i, v){
                        $("#comments-list-asimilados").append('<div class="col-lg-12"><p><i style="color:gray;">'+v.comentario+'</i><br><b style="color:#3982C0">'+v.fecha_movimiento+'</b><b style="color:gray;"> - '+v.nombre_usuario+'</b></p></div>');
                    });
                });
            });
        }
        //FIN TABLA NUEVA
    
        // INICIO TABLA EN PROCESO
        $("#tabla_plaza_2").ready( function(){
            let titulos = [];
            $('#tabla_plaza_2 thead tr:eq(0) th').each( function (i) {
                if( i != 15 ){
                    var title = $(this).text();
                    titulos.push(title);

                    $(this).html('<input type="text" class="textoshead" placeholder="'+title+'"/>' );
                    $( 'input', this ).on('keyup change', function () {
                        if (plaza_2.column(i).search() !== this.value ) {
                            plaza_2
                            .column(i)
                            .search(this.value)
                            .draw();

                            var total = 0;
                            var index = plaza_2.rows({ selected: true, search: 'applied' }).indexes();
                            var data = plaza_2.rows( index ).data();

                            $.each(data, function(i, v){
                                total += parseFloat(v.pago_cliente);
                            });
                            var to1 = formatMoney(total);
                            document.getElementById("myText_proceso").textContent = '$'+ formatMoney(total);
                        }
                    } );
                }
            });

            let c=0;
            $('#tabla_plaza_2').on('xhr.dt', function ( e, settings, json, xhr ) {
                var total = 0;
                $.each(json.data, function(i, v){
                    total += parseFloat(v.pago_cliente);
                });
                var to = formatMoney(total);            
                document.getElementById("myText_proceso").textContent = '$'+ to;
            });


            plaza_2 = $("#tabla_plaza_2").DataTable({
                dom: 'Brt'+ "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-6'i><'col-xs-12 col-sm-12 col-md-6 col-lg-6'p>>",
                width: 'auto',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    className: 'btn buttons-excel',
                    titleAttr: 'Descargar archivo de Excel',
                    title: 'DISPERSADOS_DIRECCIÓN_MKTD',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
                        format: {
                            header:  function (d, columnIdx) {
                                if(columnIdx == 0){
                                    return 'ID PAGO';
                                }else if(columnIdx == 1){
                                    return 'ID LOTE';
                                }
                                else if(columnIdx == 2){
                                    return 'PROYECTO';
                                }else if(columnIdx == 3){
                                    return 'CONDOMINIO';
                                }else if(columnIdx == 4){
                                    return 'NOMBRE LOTE ';
                                }else if(columnIdx == 5){
                                    return 'REFERENCIA';
                                }else if(columnIdx == 6){
                                    return 'PRECIO LOTE';
                                }else if(columnIdx == 7){
                                    return 'EMPRESA';
                                }else if(columnIdx == 8){
                                    return 'TOT. COMISIÓN';
                                }else if(columnIdx == 9){
                                    return 'P. CLIENTE';
                                }else if(columnIdx == 10){
                                    return 'TOT. PAGAR';
                                }else if(columnIdx == 11){
                                    return 'TIPO VENTA';
                                }else if(columnIdx == 12){
                                    return 'COMISIONISTA';
                                }else if(columnIdx == 13){
                                    return 'PUESTO';
                                }else if(columnIdx == 14){
                                    return 'FECH. ENVÍO';
                                }
                            }
                        }
                    },
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
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.id_pago_i+'</p>';
                    }
                },
                {
                    "width": "3%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.id_lote+'</p>';
                    }
                },
                {
                    "width": "3%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.proyecto+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.condominio+'</p>';
                    }
                },
                {
                    "width": "8%",
                    "data": function( d ){
                        return '<p class="m-0"><b>'+d.lote+'</b></p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">'+d.referencia+'</p>';
                    }
                },
                {
                    "width": "7%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.precio_lote)+'</p>';
                    }
                },

                {
                    "width": "3%",
                    "data": function( d ){
                        return '<p class="m-0"><b>'+d.empresa+'</p>';
                    }
                },
                
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.comision_total)+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.pago_neodata)+'</p>';
                    }
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        return '<p class="m-0">$'+formatMoney(d.pago_cliente)+'</p>';
                    }
                },
                {
                    "width": "8%",
                    "data": function( d ){
                        if(d.lugar_prospeccion == 6){
                            return '<p class="m-0">COMISIÓN + MKTD <br><b> ('+d.porcentaje_decimal+'% de '+d.porcentaje_abono+'%)</b></p>';
                        }
                        else{
                            return '<p class="m-0">COMISIÓN <br><b> ('+d.porcentaje_decimal+'% de '+d.porcentaje_abono+'%)</b></p>';
                        }
                    
                    }
                },
                {
                    "width": "8%",
                    "data": function( d ){
                        return '<p class="m-0"><b>'+d.usuario+'</b></i></p>';
                    }
                },
                // {
                //     "width": "6%",
                //     "data": function( d ){
                //         return '<p class="m-0"><i> '+d.puesto+'</i></p>';
                //     }
                // },
                 {
                    "width": "6%",
                    "data": function( d ){
                        return '<p  class="m-0">' + d.sede + '</p>';
                         // return '<span class="label label-warning">Compartida</span><br><br>'+'<p class="m-0"><b>' +d.sd1+' / '+d.sd2+ '</b></p>';
                        }
                    
                },
                {
                    "width": "5%",
                    "data": function( d ){
                        var BtnStats1;
                        BtnStats1 =  '<p class="m-0">'+d.fecha_creacion+'</p>';
                        return BtnStats1;
                    }
                },
                {
                    "width": "5%",
                    "orderable": false,
                    "data": function( data ){
                        var BtnStats;
                        
                        BtnStats = '<button href="#" value="'+data.id_pago_i+'" data-value="'+data.lote+'" data-code="'+data.cbbtton+'" ' +'class="btn-data btn-blueMaderas consultar_logs_asimilados" title="Detalles">' +'<i class="fas fa-info"></i></button>';
                        return BtnStats;
                    }
                }],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0,
                    'searchable':false,
                    'className': 'dt-body-center',
                    select: {
                        style:    'os',
                        selector: 'td:first-child'
                    },
                }],
                ajax: {
                    "url": url2 + "Comisiones/getDatosNuevasmkContraloria",
                    "type": "POST",
                    cache: false,
                    "data": function( d ){}
                },
                "order": [[ 1, 'asc' ]]
            });

            
            $("#tabla_plaza_2 tbody").on("click", ".consultar_logs_asimilados", function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                id_pago = $(this).val();
                lote = $(this).attr("data-value");

                $("#seeInformationModal").modal();
                $("#nameLote").append('<p><h5 style="color: white;">HISTORIAL DEL PAGO DE: <b>'+lote+'</b></h5></p>');
                $.getJSON("getComments/"+id_pago).done( function( data ){
                    $.each( data, function(i, v){
                        $("#comments-list-asimilados").append('<div class="col-lg-12"><p><i style="color:gray;">'+v.comentario+'</i><br><b style="color:#3982C0">'+v.fecha_movimiento+'</b><b style="color:gray;"> - '+v.nombre_usuario+'</b></p></div>');
                    });
                });
            });
        });
 
        // FUNCTION MORE
        /*$(document).on( "click", ".nuevo_plan", function(){
            $("#modal_mktd .modal-body").html("");
            $("#modal_mktd .modal-footer").html("");

            $.getJSON( url + "Comisiones/getDatosNuevo/").done( function( data1 ){
                $("#modal_mktd .modal-body").append('<div class="row"><div class="col-md-6"><label>Fecha inicio: </label><input type="date" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" name="fecha_inicio" id="fecha_inicio" required=""></div></div>');

                $.each( data1, function( i, v){
                    $("#modal_mktd .modal-body").append('<div class="row">'
                            +'<div class="col-md-3"><br><input class="form-contol ng-invalid ng-invalid-required" style="border: 1px solid white; outline: none;" value="'+v.puesto+'"  readonly><input id="puesto" name="puesto[]" value="'+v.id_rol+'" type="hidden"></div>'

                            +'<div class="col-md-3"><select id="userMKTDSelect'+i+'" name="userMKTDSelect[]" class="form-control userMKTDSelect ng-invalid ng-invalid-required" required data-live-search="true"></select></div>'

                            +'<div class="col-md-2"><input id="porcentajeUserMk'+i+'" name="porcentajeUserMk[]" class="form-control porcentajeUserMk ng-invalid ng-invalid-required" required placeholder="%" value="0"></div>'

                            +'<div class="col-md-2"><select id="plazaMKTDSelect'+i+'" name="plazaMKTDSelect[]" class="form-control plazaMKTDSelect ng-invalid ng-invalid-required"   data-live-search="true"></select></div>'

                            +'<div class="col-md-2"><select id="sedeMKTDSelect'+i+'" name="sedeMKTDSelect[]" class="form-control sedeMKTDSelect ng-invalid ng-invalid-required"   data-live-search="true"></select></div></div>');

                            $.post('getUserMk', function(data) {
                            $("#userMKTDSelect"+i+"").append($('<option disabled>').val("default").text("Seleccione una opción"))
                            var len = data.length;
                            for( var j = 0; j<len; j++)
                            {
                                var id = data[j]['id_usuario'];
                                var name = data[j]['name_user'];
                                // var sede = data[i]['id_sede'];
                                // alert(name);
                                $("#userMKTDSelect"+i+"").append($('<option>').val(id).attr('data-value', id).text(name));
                            }
                            if(len<=0)
                            {
                            $("#userMKTDSelect"+i+"").append('<option selected="selected" disabled>No se han encontrado registros que mostrar</option>');
                            }
                            
                            $("#userMKTDSelect"+i+"").val(data1[i].id_usuario);                     
    
                            $("#userMKTDSelect"+i+"").selectpicker('refresh');
                        }, 'json');



                        $.post('getPlazasMk', function(data) {
                            $("#plazaMKTDSelect"+i+"").append($('<option disabled>').val("default").text("Seleccione una opción"))
                            var len = data.length;
                            for( var j = 0; j<len; j++)
                            {
                                var id = data[j]['id_opcion'];
                                var name = data[j]['nombre'];
                                // var sede = data[i]['id_sede'];
                                // alert(name);
                                $("#plazaMKTDSelect"+i+"").append($('<option>').val(id).attr('data-value', id).text(name));
                            }
                            if(len<=0)
                            {
                            $("#plazaMKTDSelect"+i+"").append('<option selected="selected" disabled>No se han encontrado registros que mostrar</option>');
                            }
                    
                                    $("#plazaMKTDSelect"+i+"").val(1); 
        
                            $("#plazaMKTDSelect"+i+"").selectpicker('refresh');
                        }, 'json');



                        $.post('getSedeMk', function(data) {
                            $("#sedeMKTDSelect"+i+"").append($('<option disabled>').val("default").text("Seleccione una opción"))
                            var len = data.length;
                            for( var j = 0; j<len; j++)
                            {
                                var id = data[j]['id_sede'];
                                var name = data[j]['nombre'];
                                
                                $("#sedeMKTDSelect"+i+"").append($('<option>').val(id).attr('data-value', id).text(name));
                            }
                            if(len<=0)
                            {
                            $("#sedeMKTDSelect"+i+"").append('<option selected="selected" disabled>No se han encontrado registros que mostrar</option>');
                            }
                            console.log(data1[i].id_sede);

                            if(data1[i].id_rol=='20'){
                                
                                $("#sedeMKTDSelect"+i+"").val(data1[i].id_sede);

                            }else{
                                    $("#sedeMKTDSelect"+i+"").val(2); 
                            }


                                // $("#sedeMKTDSelect"+i+"").val(data1[i].id_usuario);
                            $("#sedeMKTDSelect"+i+"").selectpicker('refresh');
                        }, 'json'); 
                });
            });

            $("#modal_mktd .modal-footer").append('<br><div class="row"><div class="col-md-12"><center><input type="submit" id="btnsubmit" class="btn btn-success" value="GUARDAR"></center></div></div>');
            $("#modal_mktd").modal();
        });*/

        function formatMoney( n ) {
            var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };

        /*$(document).on( "click", ".subir_factura", function(){
            resear_formulario();
            id_comision = $(this).val();
            link_post = "Comisiones/guardar_solicitud/"+id_comision;
            $("#modal_formulario_solicitud").modal( {backdrop: 'static', keyboard: false} );
            });*/

        //FUNCION PARA LIMPIAR EL FORMULARIO CON DE PAGOS A PROVEEDOR.
        function resear_formulario(){
            $("#modal_formulario_solicitud input.form-control").prop("readonly", false).val("");
            $("#modal_formulario_solicitud textarea").html('');

            $("#modal_formulario_solicitud #obse").val('');
    
            var validator = $( "#frmnewsol" ).validate();
            validator.resetForm();
            $( "#frmnewsol div" ).removeClass("has-error");

        }
 
        /*$("#cargar_xml").click( function(){
            subir_xml( $("#xmlfile") );
        });*/

        var justificacion_globla = "";

        /*function subir_xml( input ){
            var data = new FormData();
            documento_xml = input[0].files[0];
            var xml = documento_xml;

            data.append("xmlfile", documento_xml);
            resear_formulario();
            $.ajax({
                url: url + "Comisiones/cargaxml",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data){
                    if( data.respuesta[0] ){
                        documento_xml = xml;
                        var informacion_factura = data.datos_xml;
                        cargar_info_xml( informacion_factura );
                        $("#solobs").val( justificacion_globla );
                    }
                    else{
                        input.val('');
                        alert( data.respuesta[1] );
                    }
                },
                error: function( data ){
                    input.val('');
                    alert("ERROR INTENTE COMUNICARSE CON EL PROVEEDOR");
                }
            });
        }*/

        /*function cargar_info_xml( informacion_factura ){
            $("#emisor").val( ( informacion_factura.nameEmisor ? informacion_factura.nameEmisor[0] : '') ).attr('readonly',true);
            $("#rfcemisor").val( ( informacion_factura.rfcemisor ? informacion_factura.rfcemisor[0] : '') ).attr('readonly',true);
            $("#receptor").val( ( informacion_factura.namereceptor ? informacion_factura.namereceptor[0] : '') ).attr('readonly',true);
            $("#rfcreceptor").val( ( informacion_factura.rfcreceptor ? informacion_factura.rfcreceptor[0] : '') ).attr('readonly',true);
            $("#regimenFiscal").val( ( informacion_factura.regimenFiscal ? informacion_factura.regimenFiscal[0] : '') ).attr('readonly',true);
            $("#formaPago").val( ( informacion_factura.formaPago ? informacion_factura.formaPago[0] : '') ).attr('readonly',true);
            $("#total").val( ('$ '+informacion_factura.total ? '$ '+informacion_factura.total[0] : '') ).attr('readonly',true);
            $("#cfdi").val( ( informacion_factura.usocfdi ? informacion_factura.usocfdi[0] : '') ).attr('readonly',true);
            $("#metodopago").val( ( informacion_factura.metodoPago ? informacion_factura.metodoPago[0] : '') ).attr('readonly',true);
            $("#unidad").val( ( informacion_factura.claveUnidad ? informacion_factura.claveUnidad[0] : '') ).attr('readonly',true);
            $("#clave").val( ( informacion_factura.claveProdServ ? informacion_factura.claveProdServ[0] : '') ).attr('readonly',true);
            $("#obse").val( ( informacion_factura.descripcion ? informacion_factura.descripcion[0] : '') ).attr('readonly',true);
        }*/

        $("#form_colaboradores").submit( function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: function( form ) {
                $('#loader').removeClass('hidden');
                var data = new FormData( $(form)[0] );
                let sumat=0;
                let valor = parseFloat($('#pago_mktd').val()).toFixed(3);
                let valor1 = parseFloat(valor-0.10);
                let valor2 = parseFloat(valor)+0.010;
            
                for(let i=0;i<$('#cuantos').val();i++){
                    sumat += parseFloat($('#abono_marketing_'+i).val());
                }
                
                let sumat2 =  parseFloat((sumat).toFixed(3));
                document.getElementById('Sumto').innerHTML= ''+ parseFloat(sumat2.toFixed(3)) +'';
                if(parseFloat(sumat2.toFixed(3)) < valor1){
                    alerts.showNotification("top", "right", "Falta dispersar", "warning");
                }
                else{
                    if(parseFloat(sumat2.toFixed(3)) >= valor1 && parseFloat(sumat2.toFixed(3)) <= valor2 ){
                        $.ajax({
                            url: url2 + "Comisiones/nueva_mktd_comision",
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            method: 'POST',
                            type: 'POST', // For jQuery < 1.9
                            success: function(data){
                                if(true){
                                    $('#loader').addClass('hidden');
                                    $("#modal_colaboradores").modal('toggle');
                                    plaza_2.ajax.reload();
                                    plaza_1.ajax.reload();
                                    alert("¡Se agregó con éxito!");
                                }else{
                                    alert("NO SE HA PODIDO COMPLETAR LA SOLICITUD");
                                    $('#loader').addClass('hidden');
                                }
                            },error: function( ){
                                alert("ERROR EN EL SISTEMA");
                            }
                        });
                    }
                    else if(parseFloat(sumat2.toFixed(3)) > valor1 && parseFloat(sumat2.toFixed(3)) > valor2 ){
                        alerts.showNotification("top", "right", "Cantidad excedida", "danger");
                    }
                }
            }
        });

        $("#frmnewsol").submit( function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: function( form ) {
                var data = new FormData( $(form)[0] );
                data.append("xmlfile", documento_xml);
                $.ajax({
                    url: url + link_post,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    method: 'POST',
                    type: 'POST', // For jQuery < 1.9
                    success: function(data){
                        if( data.resultado ){
                            alert("LA FACTURA SE SUBIO CORRECTAMENTE");
                            $("#modal_formulario_solicitud").modal( 'toggle' );
                            tabla_nuevas.ajax.reload();
                        }else{
                            alert("NO SE HA PODIDO COMPLETAR LA SOLICITUD");
                        }
                    },error: function(){
                        alert("ERROR EN EL SISTEMA");
                    }
                });
            }
        });          

        $("#form_MKTD").submit( function(e) {
            e.preventDefault();        
        }).validate({
            rules: {
                'porcentajeUserMk[]':{
                    required: true,
                }
            },
            messages: {
                'porcentajeUserMk[]':{
                    required : "Dato requerido"
                }
            },
            submitHandler: function( form ) {
                var data = new FormData( $(form)[0] );
                $.ajax({
                    url: url + "Comisiones/save_new_mktd",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    method: 'POST',
                    type: 'POST', // For jQuery < 1.9
                    success: function(data){
                        if( data.resultado ){
                            alert("LA FACTURA SE SUBIO CORRECTAMENTE");
                                $("#modal_mktd").modal( 'toggle' );
                            //  tabla_nuevas.ajax.reload();
                        }else{
                            alert("NO SE HA PODIDO COMPLETAR LA SOLICITUD");
                        }
                    },error: function(){
                        alert("ERROR EN EL SISTEMA");
                    }
                });   
            }
        });

        /*function calcularMontoParcialidad() {
            $precioFinal = parseFloat($('#value_pago_cliente').val());
            $precioNuevo = parseFloat($('#new_value_parcial').val());
            if ($precioNuevo >= $precioFinal) {
                $('#label_estado').append('<label>MONTO NO VALIDO</label>');
            }
            else if ($precioNuevo < $precioFinal) {
                $('#label_estado').append('<label>MONTO VALIDO</label>');
            }
        }*/

        /*function preview_info(archivo){
            $("#documento_preview .modal-dialog").html("");
            $("#documento_preview").css('z-index', 9999);
            archivo = url+"dist/documentos/"+archivo+"";
            var re = /(?:\.([^.]+))?$/;
            var ext = re.exec(archivo)[1];
            elemento = "";
            if (ext == 'pdf'){
                elemento += '<iframe src="'+archivo+'" style="overflow:hidden; width: 100%; height: -webkit-fill-available">';
                elemento += '</iframe>';
                $("#documento_preview .modal-dialog").append(elemento);
                $("#documento_preview").modal();
            }
            if(ext == 'jpg' || ext == 'jpeg'){
                elemento += '<div class="modal-content" style="background-color: #333; display:flex; justify-content: center; padding:20px 0">';
                elemento += '<img src="'+archivo+'" style="overflow:hidden; width: 40%;">';
                elemento += '</div>';
                $("#documento_preview .modal-dialog").append(elemento);
                $("#documento_preview").modal();
            }
            if(ext == 'xlsx'){
                elemento += '<div class="modal-content">';
                elemento += '<iframe src="'+archivo+'"></iframe>';
                elemento += '</div>';
                $("#documento_preview .modal-dialog").append(elemento);
            }
        }*/
 
        function cleanComments() {
            var myCommentsList = document.getElementById('comments-list-asimilados');
            var myCommentsLote = document.getElementById('nameLote');
            myCommentsList.innerHTML = '';
            myCommentsLote.innerHTML = '';
        }

        $(window).resize(function(){
            plaza_1.columns.adjust();
            plaza_2.columns.adjust();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
        });

    </script>

    <script>
        $(document).ready( function(){
            $.getJSON( url + "Comisiones/report_plazas").done( function( data ){
                $(".report_plazas").html();
                $(".report_plazas1").html();
                $(".report_plazas2").html();
                if(data[0].id_plaza == '0' || data[1].id_plaza == 0){
                    if(data[0].plaza00==null || data[0].plaza00=='null' ||data[0].plaza00==''){
                        $(".report_plazas").append('<label style="color: #6a2c70;">&nbsp;<b>Porcentaje:</b> '+data[0].plaza01+'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Restante</b> 0%</label>');
                    }
                    else{
                        $(".report_plazas").append('<label style="color: #6a2c70;">&nbsp;<b>Porcentaje:</b> '+data[0].plaza01+'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Restante</b> '+data[0].plaza00+'%</label>');
                    }
                }
                if(data[1].id_plaza == '1' || data[1].id_plaza == 1){
                    if(data[1].plaza10==null || data[1].plaza10=='null' ||data[1].plaza10==''){
                        $(".report_plazas1").append('<label style="color: #b83b5e;">&nbsp;<b>Porcentaje:</b> '+data[1].plaza11+'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Restante</b> 0%</label>');
                    }
                    else{
                        $(".report_plazas1").append('<label style="color: #b83b5e;">&nbsp;<b>Porcentaje:</b> '+data[1].plaza11+'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Restante</b> '+data[1].plaza10+'%</label>');
                    }
                }
                if(data[2].id_plaza == '2' || data[2].id_plaza == 2){
                    if(data[2].plaza20==null || data[2].plaza20=='null' ||data[2].plaza20==''){
                        $(".report_plazas2").append('<label style="color: #f08a5d;">&nbsp;<b>Porcentaje:</b> '+data[2].plaza21+'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Restante</b> 0%</label>');
                    }
                    else{
                        $(".report_plazas2").append('<label style="color: #f08a5d;">&nbsp;<b>Porcentaje:</b> '+data[2].plaza21+'%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Restante</b> '+data[2].plaza20+'%</label>');
                    }
                }
            });
        });                                               
    </script>
</body>