<body>
<div class="wrapper">
    <?php
        switch ($this->session->userdata('id_rol')) {
            case "1": // DIRECTOR
            case "2": // SUBDIRECTOR
            case "3": // GERENTE
            case "4": // ASISTENTE DIRECTOR
            case "5": // ASISTENTE SUBDIRECTOR
            case "9": // COORDINADOR
            case "19": // SUBDIRECTOR MKTD
            case "20": // GERENTE MKTD
                $dato= array(
                    'home' => 0,
                    'usuarios' => 0,
                    'statistics' => 0,
                    'manual' => 0,
                    'aparta' => 0,
                    'prospectos' => 0,
                    'prospectosAlta' => 0,
                    'sharedSales' => 1,
                    'coOwners' => 0
                );
                $this->load->view('template/ventas_pr/sidebar', $dato);
                break;
            case "7": // ASESOR
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
                    'documentacion' => 0,
                    'inventarioDisponible'  =>  0,
                    'manual'    =>  0,
                    'nuevasComisiones'     => 0,
                    'histComisiones'       => 0,
                    'sharedSales' => 1,
                    'coOwners' => 0,
                    'references' => 0,
					'autoriza' => 0
                );
                //$this->load->view('template/asesor/sidebar', $dato);
                $this->load->view('template/sidebar', $dato);
                break;


            case "18": // DIRECTOR MKTD
                $dato= array(
                'home' => 0,
                'usuarios' => 0,
                'statistics' => 0,
                'manual' => 0,
                'aparta' => 0,
                'prospectos' => 0,
                'prospectosMktd' => 0,
                'prospectosAlta' => 0,
                'sharedSales' => 1,
                'coOwners' => 0,
                'references' => 0,
                'plazasComisiones'     => 0,
                'nuevasComisiones' => 0,
                'histComisiones' => 0,
                'bulkload' => 0
            );

                //$this->load->view('template/asesor/sidebar', $dato);
                $this->load->view('template/sidebar', $dato);
                break;




                      


            case "6": // ASISTENTE GERENCIA
                $dato= array(
                    'home' => 0,
                    'listaCliente' => 0,
                    'corridaF' => 0,
                    'documentacion' => 0,
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
                    'sharedSales' => 1,
                    'coOwners' => 0
                );
                $this->load->view('template/sidebar', $dato);//template/ventas/sidebar
                break;
            default:
                $dato= array(
                    'prospectos' => 0,
                    'prospectosAlta' => 0,
                    'sharedSales' => 1,
                    'coOwners' => 0
                );
                $this->load->view('template/asesor/sidebar', $dato);
                break;
        }
    ?>
    <style>
        .label-inf {
            color: #333;
        }
        /*.modal-body-scroll{
            height: 100px;
            width: 100%;
            overflow-y: auto;
        }*/
        select:invalid {
            border: 2px dashed red;
        }

    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="block full">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-icon" data-background-color="goldMaderas">
                                        <i class="material-icons">list</i>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <h4 class="card-title">
                                                Ventas compartidas
                                                <i class="material-icons" data-toggle="modal" data-target="#addSalesPartnerModal">add_circle</i>
                                            </h4>
                                            <div class="table-responsive">

                                                <div class="material-datatables">
                                                    <table id="shared-sales-datatable" class="table table-striped table-no-bordered table-hover" style="text-align:center;"><!--table table-bordered table-hover -->
                                                        <thead>
                                                            <tr>
                                                                <th class="disabled-sorting text-right"><center>Estado</center></th>
                                                                <th class="disabled-sorting text-right"><center>Prospecto</center></th>
                                                                <th class="disabled-sorting text-right"><center>Asesor</center></th>
                                                                <th class="disabled-sorting text-right"><center>Coordinador</center></th>
                                                                <th class="disabled-sorting text-right"><center>Gerente</center></th>
                                                                <th class="disabled-sorting text-right"><center>Fecha alta</center></th>
                                                                <th class="disabled-sorting text-right"><center>Acciones</center></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                    <div class="modal fade" id="addSalesPartnerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                        <i class="material-icons">clear</i>
                                                                    </button>
                                                                    <h4 class="modal-title">¿Con quién compartirás este prospecto?</h4>
                                                                </div>
                                                                <form id="addSalesPartnerForm" name="addSalesPartnerForm" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="col-lg-12">
                                                                            <label class="control-label"> Selecciona tu prospecto</label>
                                                                            <select class="selectpicker" name="prospecto" id="prospecto" data-style="select-with-transition" data-live-search="true" data-size="7" required></select>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <label class="control-label">Ahora, elije un asesor</label>
                                                                            <select class="selectpicker" name="asesor" id="asesor" data-style="select-with-transition" data-live-search="true" data-size="7" required onchange="getSalesPartnerInformation(this)"></select>
                                                                        </div>
                                                                        <input type="hidden" name="id_coordinador" id="id_coordinador">
                                                                        <input type="hidden" name="id_gerente" id="id_gerente">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancelar</button>
                                                                    </div>
                                                                </form>
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
        </div>
    </div>
	<?php $this->load->view('template/footer_legend');?>
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
<script src="<?php base_url()?>dist/js/jquery.validate.js"></script>

<script src="<?=base_url()?>dist/js/controllers/general-1.1.0.js"></script>

</html>
