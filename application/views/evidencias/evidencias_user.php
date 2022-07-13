<link href="<?= base_url() ?>dist/css/evidencias_user.css" rel="stylesheet"/>
<!-- <link href="<?= base_url() ?>dist/css/evidenciasRecisiones.css" rel="stylesheet"/> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
<link rel="stylesheet" href="//unpkg.com/videojs-record/dist/css/videojs.record.min.css">
<?php if($information == false){ 
    $this->load->view('evidencias/warning_view');
 }else{ ?>
<body class="">
<div class="wrapper h-auto">
    <div class="spiner-loader hide" id="spiner-loader">
        <div class="backgroundLS">
            <div class="contentLS">
                <div class="center-align">
                    Este proceso puede demorar algunos segundos
                </div>
                <div class="inner">
                    <div class="load-container load1">
                        <div class="loader">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content evidencias">
        <div class="container-fluid">
            <div class="row">
           
                <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="goldMaderas">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <div class="card-content">
                            <div class="toolbar">
                                <h3 class="card-title center-align">Guardar evidencia</h3>
                                <div class="row d-flex direction-row">
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 d-flex direction-column">
                                        <div class="miniCard h-50 mt-0 d-flex align-center justify-center">
                                            <div class="boxInfo">
                                                <div class="row d-flex direction-row mb-1 p-1">
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex align-center justify-center font-size">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 d-flex direction-column">
                                                        <p class="titleMini m-0">Nombre</p>
                                                        <p id="nombreCl" class="nombreCl data"></p>
                                                    </div>
                                                </div>
                                                <div class="row d-flex direction-row mb-1 p-1">
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex align-center justify-center font-size">
                                                        <i class="fas fa-user-friends"></i>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 d-flex direction-column">
                                                        <p class="titleMini m-0">Asesor</p>
                                                        <p id="nombreAs" class="nombreAs data"></p>
                                                    </div>
                                                </div>
                                                <div class="row d-flex direction-row mb-1 p-1">
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex align-center justify-center font-size">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 d-flex direction-column">
                                                        <p class="titleMini m-0">Fecha apartado</p>
                                                    <p id="fechaApartado" class="fechaApartado data"></p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="miniCard h-50 mt-0 d-flex align-center justify-center w-100 mb-0">
                                            <div class="boxInfo h-100 w-100">
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 h-100 d-flex align-center">
                                                    <div class="row d-flex direction-column mb-1 p-1">
                                                        <div class="d-flex direction-row mb-1">
                                                            
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column pl-0">
                                                                <p class="titleMini m-0">Nombre del desarrollo</p>
                                                                <p id="nombreResidencial" class="nombreCl data"></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex direction-row mb-1">
                                                            
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column pl-0">
                                                                <p class="titleMini m-0">Nombre del condominio</p>
                                                                <p id="nombreCondominio" class="nombreCl data"></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex direction-row">
                                                            
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column pl-0">
                                                                <p class="titleMini m-0">Nombre del lote</p>
                                                                <p id="nombreLote" class="nombreCl data"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <h3 CLASS="text-center ">Acción</h3>
                                                    <p class="text-justify">Texto que puede leer el usuario o tambien pueden ser instrucciones</p>
                                                </div>
                                                
                                                <!-- <div class="row p-1 d-flex align-center justify-center direction-row">
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus lote</p>
                                                        <p class="estatus2 w-100 overflow-text">Contratado</p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus comisión</p>
                                                        <p class="estatus2 w-100 overflow-text">Recisión anterior (aún no se dispersa)</p>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row p-1 d-flex align-center justify-center direction-row">
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus contratación</p>
                                                        <p class="estatus2 w-100 overflow-text">15. Acuse entregado (Contraloría)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus contratación</p>
                                                            <p class="estatus2 w-100 overflow-text">15. Acuse entregado (Contraloría)</p>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <!-- <div class="miniCard h-50 mt-0 d-flex align-center justify-center w-100 mb-0">
                                            <div class="boxInfo h-100 w-100">
                                                <div class="row d-flex justify-between mb-1 p-1">
                                                    <div class="d-flex direction-row">
                                                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex align-center justify-center font-size-price ">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-10 col-lg-10 d-flex direction-column pl-0">
                                                            <p class="titleMini-price m-0">Precio de lote</p>
                                                            <p class="nombreCl data-price">1,051,193.47</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex direction-row">
                                                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 d-flex align-center justify-center font-size-price">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-10 col-lg-10 d-flex direction-column pl-0">
                                                            <p class="titleMini-price m-0">Enganche validado</p>
                                                            <p class="nombreCl data-price">95,563.04</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-1 d-flex align-center justify-center direction-row">
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus lote</p>
                                                        <p class="estatus2 w-100 overflow-text">Contratado</p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus comisión</p>
                                                        <p class="estatus2 w-100 overflow-text">Recisión anterior (aún no se dispersa)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-1 d-flex align-center justify-center direction-row">
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus contratación</p>
                                                        <p class="estatus2 w-100 overflow-text">15. Acuse entregado (Contraloría)</p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex direction-row mb-1 p-1">
                                                       
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex direction-column">
                                                            <p class="titleMini m-0">Estatus contratación</p>
                                                            <p class="estatus2 w-100 overflow-text">15. Acuse entregado (Contraloría)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 d-flex align-center justify-center">
                                        <div class="w-100 d-flex justify-center" id="player">
                                            <div id="actionButtons" class="action-buttons-inactive">
                                                <button id="upload"><i class="fas fa-save"></i></button>
                                                <!-- <button>Regrabar</button> -->
                                            </div>
                                            <video id="myVideo" playsinline class="vjs-custom video-js"></video>
                                        </div>
                                        <div class="w-100" id="success">
                                            <i class="far fa-check-circle"></i>
                                            <h3>¡Tu video ha sido guardado con exito!</h3>
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
    <?php $this->load->view('template/footer_legend'); ?>
</div>
</div>

<?php $this->load->view('template/footer'); ?>
<!--DATATABLE BUTTONS DATA EXPORT-->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://www.WebRTC-Experiment.com/RecordRTC.js"></script>
<script src="//unpkg.com/videojs-record/dist/videojs.record.min.js"></script>

<script>
    let url = "<?=base_url()?>";
    let information = {
        idCliente:"<?= $information->data->idCliente?>",
        idLote: "<?= $information->data->idLote?>",
        nombreCl: "<?= $information->data->nombreCl?>",
        nombreAs: "<?= $information->data->nombreAs?>",
        fechaApartado: "<?= $information->data->fechaApartado?>",
        nombreResidencial: "<?= $information->data->nombreResidencial?>",
        nombreCondominio: "<?= $information->data->nombreCondominio?>",
        nombreLote: "<?= $information->data->nombreLote?>"
    };
  
let typeTransaction = 0; // MJ: SELECTS MULTIPLES
</script>

<script src="<?= base_url() ?>dist/js/controllers/general/main_services.js"></script>
<!-- <script src="<?= base_url() ?>dist/js/controllers/general/main_services_dr.js"></script> -->
<script src="<?= base_url() ?>dist/js/controllers/evidencias/user_evidencias.js"></script>
</body>
<?php } ?>