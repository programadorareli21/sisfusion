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

        <div class="content boxContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="goldMaderas">
                                <i class="fas fa-address-book fa-2x"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title center-align">Lista de nuevos clientes</h3>
                                <div class="toolbar">
                                    <div class="row"></div>
                                </div>
                                <div class="material-datatables">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table id="clients-datatable"
                                                class="table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>CLIENTE</th>
                                                            <th>CORREO</th>
                                                            <th>TELÉFONO</th>
                                                            <th>LUGAR PROSPECCIÓN</th>
                                                            <th>ASESOR</th>
                                                            <th>COORDINADOR</th>
                                                            <th>GERENTE</th>
                                                            <th>SUBDIRECTOR</th>
                                                            <th>DIRECTOR REGIONAL</th>
                                                            <th>CREACIÓN</th>
                                                            <th>FECHA CLIENTE</th>
                                                            <th>ACCIONES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                            </table>
                                            <div class="modal fade" id="seeInformationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                <i class="material-icons" onclick="cleanComments()">clear</i>
                                                            </button>
                                                            <h4 class="modal-title">Consulta información</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div role="tabpanel">
                                                                <!-- Nav tabs -->
                                                                <ul class="nav nav-tabs" role="tablist" style="background: #003d82;">
                                                                    <li role="presentation" class="active"><a href="#generalTab" aria-controls="generalTab" role="tab" data-toggle="tab">General</a></li>
                                                                    <li role="presentation"><a href="#commentsTab" aria-controls="commentsTab" role="tab" data-toggle="tab">Comentarios</a></li>
                                                                    <li role="presentation"><a href="#changelogTab" aria-controls="changelogTab" role="tab" data-toggle="tab">Bitácora de cambios</a></li>
                                                                </ul>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content">
                                                                    <div role="tabpanel" class="tab-pane active" id="generalTab">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Personalidad jurídica</label>
                                                                                    <input id="legal-personality-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Nacionalidad</label>
                                                                                    <input id="nationality-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">CURP</label>
                                                                                    <input id="curp-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">RFC</label>
                                                                                    <input id="rfc-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Nombre / Razón social</label>
                                                                                    <input id="name-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Correo electrónico</label>
                                                                                    <input id="email-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Teléfono</label>
                                                                                    <input id="phone-number-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">¿Cómo nos contactaste?</label>
                                                                                    <input id="prospecting-place-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Plaza de venta</label>
                                                                                    <input id="sales-plaza-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Asesor</label>
                                                                                    <input id="asesor-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Coordinador</label>
                                                                                    <input id="coordinador-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Gerente</label>
                                                                                    <input id="gerente-lbl" type="text" class="form-control" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <input type="hidden" id="id-prospecto-lbl" name="id_prospecto_lbl">
                                                                        </div>
                                                                    </div>
                                                                    <div role="tabpanel" class="tab-pane" id="commentsTab">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="card card-plain">
                                                                                    <div class="card-content">
                                                                                        <ul class="timeline timeline-simple" id="comments-list"></ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div role="tabpanel" class="tab-pane" id="changelogTab">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="card card-plain">
                                                                                    <div class="card-content">
                                                                                        <ul class="timeline timeline-simple" id="changelog"></ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="prospecto_lbl" id="prospecto_lbl">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" onclick="{{$('#prospecting-place-lbl').val() == 'MKT digital (especificar)' ? printProspectInfoMktd() : printProspectInfo()}}"><i class="material-icons">cloud_download</i> Descargar pdf</button>
                                                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal" onclick="cleanComments()">Cerrar</button>
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

    $('#clients-datatable thead tr:eq(0) th').each( function (i) {

         if(i != 11){
        var title = $(this).text();
        $(this).html('<input type="text" class="textoshead" placeholder="'+title+'"/>' );
        $( 'input', this ).on('keyup change', function () {
            if ($('#clients-datatable').DataTable().column(i).search() !== this.value ) {
                $('#clients-datatable').DataTable()
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        } );
        }
    });

    userType = <?= $this->session->userdata('id_rol') ?> ;
    idUser = <?= $this->session->userdata('id_usuario') ?> ;
    typeTransaction = 1;
</script>

<!-- MODAL WIZARD -->
<script src="<?=base_url()?>dist/js/modal-steps.min.js"></script>
<!-- <script src="<?=base_url()?>dist/js/controllers/general-1.1.0.js"></script> -->
<script src="<?=base_url()?>dist/js/controllers/consultaClientes.js"></script>
</body>