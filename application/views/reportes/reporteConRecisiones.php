<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="<?= base_url() ?>dist/css/datatableNFilters.css" rel="stylesheet"/>
<style>
        table.dataTable > thead > tr > th, table.dataTable > tbody > tr > th, table.dataTable > tfoot > tr > th, table.dataTable > thead > tr > td, table.dataTable > tbody > tr > td, table.dataTable > tfoot > tr > td {
        white-space: nowrap!important;
    }
    </style>
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
                                <i class="material-icons">list</i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title center-align">Reporte de ventas</h3>
                                <div class="row">
                                    <div class="toolbar">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4 p-r">
                                            <div class="form-group d-flex">
                                                <input type="text" class="form-control datepicker beginDate" id="beginDate"/>
                                                <input type="text" class="form-control datepicker endDate" id="endDate"/>
                                                <button class="btn btn-success btn-round btn-fab btn-fab-mini" id="searchByDateRange">
                                                    <span class="material-icons update-dataTable">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="material-datatables">
                                    <table class="table-striped table-hover" id="ventasRecision"name="ventasRecision">
                                        <thead>
                                            <tr>
                                                <th>ID LOTE</th>
                                                <th>RESIDENCIAL</th>
                                                <th>CONDOMINIO</th>
                                                <th>LOTE</th>
                                                <th>CLIENTE</th>
                                                <th>FECHA APARTADO</th>
                                                <th>ASESOR</th>
                                                <th>COORDINADOR</th>
                                                <th>GERENTE</th>
                                                <th>TIPO LOTE</th>
                                                <th>CASA</th>
                                                <th>ESTATUS ACTUAL</th>
                                                <th>PLAZA VENTA</th>
                                                <th>TIPO VENTA</th>
                                                <th>REFERENCIA</th>
                                                <th>COMPARTIDA</th>
                                                <th>PRECIO FINAL</th>
                                                <th>ESTATUS 9</th>
                                                <th>ESTATUS 11</th>
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
        <?php $this->load->view('template/footer_legend');
       
        ?>
    </div>
    </div><!-- main-panel close -->

    <?php $this->load->view('template/footer');?>
    <!--DATATABLE BUTTONS DATA EXPORT-->
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>dist/js/es.js"></script>
    <!-- DateTimePicker Plugin -->
    <script src="<?= base_url() ?>dist/js/bootstrap-datetimepicker.js"></script>
    <!--  Full Calendar Plugin    -->
    <!-- MODAL WIZARD -->
    <script src="<?=base_url()?>dist/js/controllers/reportes/reportesConResicion.js"></script>
</body>