<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>dist/css/shadowbox.css">
<link href="<?= base_url() ?>dist/css/datatableNFilters.css" rel="stylesheet"/>
<body>
    <div class="wrapper">
        <?php
            /*-------------------------------------------------------*/
            $datos = array();
            $datos = $datos4;
            $datos = $datos2;
            $datos = $datos3;  
            $this->load->view('template/sidebar', $datos);
            /*--------------------------------------------------------*/
        ?>

        <div class="modal fade" id="seeInformationModalAsimilados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist" style="background: #ACACAC;">
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
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"><b>Cerrar</b></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="content boxContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="nav nav-tabs nav-tabs-cm">
                            <li class="active">
                                <a href="#nuevas" role="tab"  data-toggle="tab">Nuevas</a>
                            </li>
                            <li>
                                <a href="#revision" role="tab"  data-toggle="tab">En revisión</a>
                            </li>
                            <li>
                                <a href="#porPagar" role="tab"  data-toggle="tab">Por pagar</a>
                            </li>
                        </ul>
                        <div class="card no-shadow m-0">
                            <div class="card-content p-0">
                                <div class="nav-tabs-custom">
                                    <div class="tab-content p-2">
                                        <div class="tab-pane active" id="nuevas">
                                            <div class="encabezadoBox">
                                                <div class="row">
                                                    <div class="col-md-12 pb-2">
                                                        <p class="card-title">Comisiones nuevas disponibles para solicitar tu pago, para ver más detalles podrás consultarlo en el historial. <a href="https://maderascrm.gphsis.com/Comisiones/historial_colaborador"><b>clic para ir al historial</b></a>.</p>
                                                    </div>
                                                    <?php if($this->session->userdata('forma_pago') == 3){ ?>
                                                        <div class="col-md-6">
                                                            <p style="color:#0a548b;"><i class="fa fa-info-circle" aria-hidden="true"></i> Al monto mostrado habrá que descontar el <b>impuesto estatal</b> del 
                                                            
                                                            <?php
                                                                $sede = $this->session->userdata('id_sede');
                                                                $query = $this->db->query("SELECT * FROM sedes WHERE estatus in (1) AND id_sede = ".$sede."");

                                                                foreach ($query->result() as $row){
                                                                    $number = $row->impuesto;
                                                                    echo '<b>' .number_format($number,2).'%</b> e ISR de acuerdo a las tablas publicadas en el SAT.';
                                                                }
                                                            ?>
                                                            </p>
                                                        </div>
                                                    <?php }
                                                    else if($this->session->userdata('forma_pago') == 4){ ?>
                                                        <div class="col-md-6">
                                                            <p style="color:#0a548b;"><i class="fa fa-info-circle" aria-hidden="true"></i> La cantidad mostrada es menos las deducciones aplicables para el régimen de <b>Remanente Distribuible.</b>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (($this->session->userdata('forma_pago') == 2 ||
                                                        $this->session->userdata('forma_pago') == 3 ||
                                                        $this->session->userdata('forma_pago') == 4 ||
                                                        $this->session->userdata('forma_pago') == 5) &&
                                                        ($this->session->userdata('id_rol') == 3 ||
                                                        $this->session->userdata('id_rol') == 7 ||
                                                        $this->session->userdata('id_rol') == 9)) { ?>

                                                        <div class="col-md-6">
                                                            <p class="card-title m-1">
                                                                Para consultar más detalles sobre el uso y funcionalidad del apartado
                                                                de comisiones podrás visualizarlo en el siguiente tutorial

                                                                <?php if ($this->session->userdata('forma_pago') == 2) { ?>
                                                                    <a href="https://youtu.be/YuZNsPk8-gY" target="_blank"><u>clic aquí</u></a>
                                                                <?php } ?>
                                                                <?php if ($this->session->userdata('forma_pago') == 3) { ?>
                                                                    <a href="https://youtu.be/LmmIdipDSEA" target="_blank"><u>clic aquí</u></a>
                                                                <?php } ?>
                                                                <?php if ($this->session->userdata('forma_pago') == 4) { ?>
                                                                    <a href="https://youtu.be/oRoJev_AZgs" target="_blank"><u>clic aquí</u></a>
                                                                <?php } ?>
                                                                <?php if ($this->session->userdata('forma_pago') == 5) { ?>
                                                                    <a href="https://youtu.be/4t0MNA8HxZ4" target="_blank"><u>clic aquí</u></a>
                                                                <?php } ?>
                                                            </p>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($this->session->userdata('forma_pago') == 5) { ?>
                                                        <div class="col-md-6">
                                                            <p class="card-title pl-2">Comprobantes fiscales emitidos por residentes en el <b>extranjero</b>
                                                                sin establecimiento permanente en México.
                                                                <a data-toggle="modal" data-target="#info-modal" style="cursor: pointer;">
                                                                    <u>Clic aquí para más información</u>
                                                                </a>
                                                            </p>
                                                        </div>
                                                    <?php } ?>
                                                </div>                                                
                                            </div>
                                            <div class="toolbar">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-4 col-lg-6">
                                                            <div class="form-group text-center">
                                                                <h4 class="title-tot center-align m-0">Saldo sin impuestos:</h4>
                                                                <p class="input-tot pl-2" name="myText_nuevas" id="myText_nuevas">$0.00</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-4 col-lg-6">
                                                            <div class="form-group text-center">
                                                                <h4 class="title-tot center-align m-0">Solicitar:</h4>
                                                                <p class="input-tot pl-1" id="totpagarPen">$0.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-lg-12 text-left mt-1">
                                                    <?= $cadena ?>
                                                </div>
                                            </div> -->
                                            <div class="material-datatables">
                                                <div class="form-group">
                                                    <div class="table-responsive">
                                                        <table class="table-striped table-hover" id="tabla_nuevas_comisiones" name="tabla_nuevas_comisiones">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>ID PAGO</th>
                                                                    <th>REFERENCIA</th>
                                                                    <th>NOMBRE</th>
                                                                    <th>SEDE</th>
                                                                    <th>FORMA PAGO</th>
                                                                    <th>TOTAL COMISION</th>
                                                                    <th>IMPUESTO</th>
                                                                    <th>% COMISION</th>
                                                                    <th>ESTATUS</th>
                                                                    <th>MÁS</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="revision">
                                            <div class="encabezadoBox">
                                                <p class="card-title pl-1">Comisiones enviadas a contraloría para su revisión antes de aplicar tu pago, si requieres ver más detalles como lo pagado y lo pendiente podrás consultarlo en el historial. <a href="https://maderascrm.gphsis.com/Comisiones/historial_colaborador"><b>clic para ir al historial</b></a>.</p>
                                            </div>
                                            <div class="toolbar">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group d-flex justify-center align-center">
                                                                <h4 class="title-tot center-align m-0">Solicitado sin impuestos:</h4>
                                                                <p class="input-tot pl-1" name="myText_revision" id="myText_revision">$0.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table-striped table-hover" id="tabla_revision_comisiones" name="tabla_revision_comisiones">
                                                    <thead>
                                                        <tr>
                                                            <th>ID PAGO</th>
                                                            <th>REFERENCIA</th>
                                                            <th>NOMBRE</th>
                                                            <th>SEDE</th>
                                                            <th>FORMA PAGO</th>
                                                            <th>TOTAL COMISION</th>
                                                            <th>IMPUESTO</th>
                                                            <th>% COMISION</th>
                                                            <th>ESTATUS</th>
                                                            <th>MÁS</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="porPagar">
                                            <div class="encabezadoBox">
                                                <p class="card-title pl-1">Comisiones en proceso de pago por parte de INTERNOMEX. Si requieres ver más detalles como lo pagado y lo pendiente, podrás consultarlo en el historial. <a href="https://maderascrm.gphsis.com/Comisiones/historial_colaborador"><b>clic para ir al historial</b></a>.</p>
                                            </div>
                                            <div class="toolbar">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group d-flex justify-center align-center">
                                                                <h4 class="title-tot center-align m-0">Por pagar sin impuestos:</h4>
                                                                <p class="input-tot pl-1" name="myText_pagadas" id="myText_pagadas">$0.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table-striped table-hover" id="tabla_pagadas_comisiones" name="tabla_pagadas_comisiones">
                                                    <thead>
                                                        <tr>
                                                            <th>ID PAGO</th>
                                                            <th>REFERENCIA</th>
                                                            <th>NOMBRE</th>
                                                            <th>SEDE</th>
                                                            <th>FORMA PAGO</th>
                                                            <th>TOTAL COMISION</th>
                                                            <th>IMPUESTO</th>
                                                            <th>% COMISION</th>
                                                            <th>ESTATUS</th>
                                                            <th>MÁS</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div><!-- Panes -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('template/footer_legend'); ?>
    </div>
    </div><!-- main-panel close -->
    <?php $this->load->view('template/footer'); ?>
    <!--DATATABLE BUTTONS DATA EXPORT-->
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script>
        userType = <?= $this->session->userdata('id_rol') ?>;
        userSede = <?= $this->session->userdata('id_sede') ?>;
    </script>
    <script src="<?=base_url()?>dist/js/controllers/suma/comisionesSuma.js"></script>
</body>
