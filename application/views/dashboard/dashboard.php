<link href="<?= base_url() ?>dist/css/datatableNFilters.css" rel="stylesheet"/>
<link href="<?= base_url() ?>dist/css/dashboardStyles.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/select/1.3.0/css/select.bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/select/1.3.0/css/select.bootstrap.min.css" rel="stylesheet">
<body class="">
    <div class="wrapper ">
        <?php
            $datos = array();
            $datos = $datos4;
            $datos = $datos2;
            $datos = $datos3;
            $this->load->view('template/sidebar', $datos);
        ?>

        <div class="content boxContent">
            <div class="container-fluid">
                <ul class="nav nav-pills nav-pills-gray">
                    <li class="active" id="anclaInicio" onclick="changePill(this.id)">
                        <a href="#Inicio" data-toggle="tab">Inicio</a>
                    </li>
                    <li id="anclaCalendario" onclick="changePill(this.id)">
                        <a href="#Calendario" data-toggle="tab">Calendario</a>
                    </li>
                    <li id="anclaProspectos" onclick="changePill(this.id)">
                        <a href="#Prospectos" data-toggle="tab">Prospectos</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="Inicio" >
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-content">
                                        <h3 class="card-title center-align" >Dashboard</h3>
                                        <div class="container-fluid">
                                            <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12  d-flex row-reverse boxNavPills">
                                                <div class="ck-button">
                                                    <label>
                                                        <input type="checkbox" value="2" name="infoMainSelector" id="infoMainSelector2" class="infoMainSelector"><span>Asesores </span>
                                                    </label>
                                                </div>
                                                <div class="ck-button">
                                                    <label>
                                                        <input type="checkbox" value="1" name="infoMainSelector" id="infoMainSelector1" class="infoMainSelector" checked><span>Propios </span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="row" style="height: 210px;">
                                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 h-100 box1Inicio1" >
                                                    <div class="card h-100 m-0">
                                                        <div class="row h-40  m-0">
                                                            <div class="col-md-12 h-100 boxGraphic">
                                                                <h4 class="text-left">Total Prospectos</h4>
                                                                <h2 class="numberGraphic" id="numberGraphic">--</h2>
                                                            </div>
                                                        </div>
                                                        <div class="row h-60  m-0">
                                                            <div class="col-md-12 pb-0 h-100 p-0">
                                                                <div id="chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 h-100 box1Inicio2">
                                                    <div class="card h-100 m-0">
                                                        <div class="row h-20 m-0">
                                                            <div class="col-md-3  h-100 boxGraphic">
                                                                <h4 class="text-left">Total de ventas</h4>
                                                                <h2 class="numberGraphic" id="total_ventas">--</h2>
                                                            </div>
                                                        </div>
                                                        <div class="row h-80  m-0">
                                                            <div class="col-md-12 pb-0  d-flex align-end">
                                                                <div class="col-md-12 pb-0 h-50">
                                                                    <div id="chart2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pdt-50">
                                                <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12  d-flex row-reverse boxNavPills">
                                                    <ul class="nav nav-pills">
                                                        <li class="active" onclick="weekFilter(this.id)" id="thisWeek">
                                                            <a href="#thisWeek" data-toggle="tab" >Esta semana</a>
                                                        </li>
                                                        <li onclick="weekFilter(this.id)" id="lastWeek">
                                                            <a href="#lastWeek" data-toggle="tab" >Semana pasada</a>
                                                        </li>
                                                        <li onclick="weekFilter(this.id)" id="lastMonth">
                                                            <a href="#lastMonth" data-toggle="tab" >Último mes</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 box1Inicio3" >
                                                    <div class="card h-100">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Lorem ipsue
                                                            </h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Prospectos totales</h4>
                                                                    <h2 id="pt_card" class="subtitle_skeleton numberElement"></h2>

                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-success btn-round btn-fab btn-fab">
                                                                        <i class="material-icons">person</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Nuevos prospectos</h4>
                                                                    <h2 id="np_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-primary btn-round btn-fab btn-fab">
                                                                        <i class="material-icons">person_add</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Ventas apartados</h4>
                                                                    <h2 id="va_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-round btn-fab btn-fab">
                                                                        <i class="material-icons">record_voice_over</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Cancelados apartados</h4>
                                                                    <h2 id="ca_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-round btn-danger  btn-fab btn-fab">
                                                                        <i class="material-icons">close</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 box1Inicio3" >
                                                    <div class="card h-100">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Lorem ipsue
                                                            </h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Cierres totales</h4>
                                                                    <h2 id="ct_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-fab btn-fab" style="background-color: orange">
                                                                        <i class="material-icons">do_not_disturb</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Prospectos con cita</h4>
                                                                    <h2 id="pcc_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-primary btn-round btn-fab btn-fab">
                                                                        <i class="material-icons">where_to_votes</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Ventas contratadas</h4>
                                                                    <h2 id="vc_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-success btn-round btn-fab btn-fab">
                                                                        <i class="material-icons">how_to_reg</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col col-xs-12 col-sm-12 col-md-8 col-lg-8 infoElementBox">
                                                                    <h4>Contratos Cancelados</h4>
                                                                    <h2 id="cc_card" class="subtitle_skeleton numberElement">--</h2>
                                                                </div>
                                                                <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4 center-align iconElementBox">
                                                                    <button class="btn btn-round btn-danger  btn-fab btn-fab">
                                                                        <i class="material-icons">layers_clear</i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 box1Inicio4" >
                                                    <div class="card h-100">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Lorem ipsue</h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="row" >
                                                                <div id="chart4"></div>
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
                    <div class="tab-pane" id="Calendario">
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-content">
                                        <h3 class="card-title center-align" >Calendario</h3>
                                        <div class="container-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Prospectos">
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-content">
                                        <h3 class="card-title center-align" >Prospectos</h3>
                                        <div class="container-fluid">
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
    </div><!--main-panel close-->
</body>
<?php $this->load->view('template/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="<?=base_url()?>dist/js/controllers/dashboard/dashboard.js"></script>
<script>
    $(document).ready(function(){
        loadInit();
    });
    function loadInit(){
        let select1 = document.getElementById('infoMainSelector1').checked;
        let select2 = document.getElementById('infoMainSelector2').checked;
        if(select1 == true){
            console.log("Actualmente está activo propios");
            loadData();
        }
        else if(select2 == true){
            console.log("Actualmente está activo Asesores");
        }
    }


    function loadData(){
        let response_vtas;
        $.ajax({
            url: "<?=base_url()?>index.php/Dashboard/getProspectsByUserSessioned",
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            beforeSend: function(){
                $('#spiner-loader').removeClass('hide');
            },
            success : function (response) {
                response = JSON.parse(response);
                response_vtas = response['total_ventas'][0];
                response = response[0];

                console.log(response_vtas);
                if(response.prospectos > 0) {


                    $('#spiner-loader').addClass('hide');
                    $('.numberElement').removeClass('subtitle_skeleton');

                    $('#numberGraphic').text(response.prospectos);
                    $('#pt_card').text(response.prospectos);
                    $('#total_ventas').text(response_vtas.ventas_apartadas);

                    chart2.updateSeries([{
                        data: [response_vtas.porcentajeApartado],
                        name: 'Ventas apartados'
                    },{
                        data: [response_vtas.porcentajeCanceladoApartado],
                        name: 'Cancelados apartados'
                    },{
                        data: [response_vtas.porcentajeContratado],
                        name: 'Ventas contratadas'
                    },{
                        data: [response_vtas.porcentajeCanceladoContratado],
                        name: 'Canceladas contratadas'
                    }])

                }else if(response.message == 'ERROR'){
                    alerts.showNotification('top', 'right', 'Ocurrió un error, intentalo nuevamente', 'danger');
                    $('#spiner-loader').addClass('hide');
                }
            }
        });
        loadData2();
    }

    function changePill(element){
        if(element == 'anclaInicio'){
            $('.box1Inicio1').addClass('fadeInAnimation');
            $('.box1Inicio2').addClass('fadeInAnimationDelay2');
            $('.box1Inicio3').addClass('fadeInAnimationDelay3');
            $('.box1Inicio4').addClass('fadeInAnimationDelay3');
            $('.boxNavPills').addClass('fadeInAnimationDelay4');
            console.log('Afectare el tab de Inicio');
        }
        if(element == 'anclaCalendario'){
            console.log('Afectare el tab de Calendario');
        }
        if(element == 'anclaProspectos'){
            console.log('Afectare el tab de Prospectos');
        }
    }
    function weekFilter(element){
        let typeTransaction = 0;
        if(element == 'thisWeek'){
            console.log("Se mostrará el filtro #thisWeek");
            var curr = new Date; // get current date
            var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
            var last = first + 6; // last day is the first day + 6

            var firstday = new Date(curr.setDate(first));
            let inicio_semana = new Date(firstday.getFullYear(), firstday.getMonth(), firstday.getDate())
            inicio_semana = inicio_semana.toISOString().split('T')[0];

            var lastday = new Date(curr.setDate(last));
            let fin_semana = new Date(lastday.getFullYear(), lastday.getMonth(), lastday.getDate());
            fin_semana = fin_semana.toISOString().split('T')[0];
            typeTransaction = validateMainFilters();
            console.log("Fecha inicio: ", inicio_semana);
            console.log("Fecha fin: ", fin_semana);
            var com2 = new FormData();
            com2.append("fecha_inicio", inicio_semana);
            com2.append("fecha_fin", fin_semana);
            com2.append("typeTransaction", typeTransaction);

            $.ajax({
                url: "<?=base_url()?>index.php/Dashboard/getDataFromDates",
                data:com2,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    // $('#spiner-loader').removeClass('hide');
                    $('.numberElement').addClass('subtitle_skeleton');
                    cleanValues(true);
                },
                success : function (response) {
                    response = JSON.parse(response);
                    let array_chart_numbers = [];
                    $('.numberElement').removeClass('subtitle_skeleton');
                    response.map((element)=>{
                        if(element.queryType == 'prospectos_totales'){
                            $('#pt_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_nuevos'){
                            $('#np_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_apartados'){
                            $('#va_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cancelados_apartados'){
                            $('#ca_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cierres_totales'){
                            $('#ct_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_cita'){
                            $('#pcc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_contratadas'){
                            $('#vc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'contratos_cancelados'){
                            $('#cc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                    });
                    console.log(array_chart_numbers);
                    /*$('#pt_card').text(response.prospectos);*/
                    // $('#spiner-loader').addClass('hide');
                    chart4.updateSeries([{
                        data: array_chart_numbers
                    }])

                }
            });
        }
        if(element == 'lastWeek'){
            console.log("Se mostrará el filtro #lastWeek");
            let semana_pasada =  getLastWeek();
            let start_sp;
            let end_sp;
            semana_pasada.map((element)=>{
                if(element.type==1){
                    start_sp = element.date;
                }else{
                    end_sp = element.date;
                }
            });

            console.log("Fecha inicio: ", start_sp);
            console.log("Fecha fin: ", end_sp);
            typeTransaction = validateMainFilters();
            var com2 = new FormData();
            com2.append("fecha_inicio", start_sp);
            com2.append("fecha_fin", end_sp);
            com2.append("typeTransaction", typeTransaction);



            $.ajax({
                url: "<?=base_url()?>index.php/Dashboard/getDataFromDates",
                data:com2,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    // $('#spiner-loader').removeClass('hide');
                    $('.numberElement').addClass('subtitle_skeleton');
                    cleanValues(true);
                },
                success : function (response) {
                    response = JSON.parse(response);
                    let array_chart_numbers = [];
                    $('.numberElement').removeClass('subtitle_skeleton');
                    response.map((element)=>{
                        if(element.queryType == 'prospectos_totales'){
                            $('#pt_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_nuevos'){
                            $('#np_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_apartados'){
                            $('#va_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cancelados_apartados'){
                            $('#ca_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cierres_totales'){
                            $('#ct_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_cita'){
                            $('#pcc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_contratadas'){
                            $('#vc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'contratos_cancelados'){
                            $('#cc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                    });
                    console.log(array_chart_numbers);
                    /*$('#pt_card').text(response.prospectos);*/
                    // $('#spiner-loader').addClass('hide');
                    chart4.updateSeries([{
                        data: array_chart_numbers
                    }])

                }
            });

        }
        if(element == 'lastMonth'){
            console.log("Se mostrará el filtro #lastMonth");
            let mes_pasada =  getLastMonth();
            let start_sp;
            let end_sp;
            mes_pasada.map((element)=>{
                if(element.type==1){
                    start_sp = element.date;
                }else{
                    end_sp = element.date;
                }
            });
            console.log("Fecha inicio: ", start_sp);
            console.log("Fecha fin: ", end_sp);
            typeTransaction = validateMainFilters();
            var com2 = new FormData();
            com2.append("fecha_inicio", start_sp);
            com2.append("fecha_fin", end_sp);
            com2.append("typeTransaction", typeTransaction);
            $.ajax({
                url: "<?=base_url()?>index.php/Dashboard/getDataFromDates",
                data:com2,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    // $('#spiner-loader').removeClass('hide');
                    $('.numberElement').addClass('subtitle_skeleton');
                    cleanValues(true);
                },
                success : function (response) {
                    response = JSON.parse(response);
                    let array_chart_numbers = [];
                    $('.numberElement').removeClass('subtitle_skeleton');
                    response.map((element)=>{
                        if(element.queryType == 'prospectos_totales'){
                            $('#pt_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_nuevos'){
                            $('#np_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_apartados'){
                            $('#va_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cancelados_apartados'){
                            $('#ca_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cierres_totales'){
                            $('#ct_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_cita'){
                            $('#pcc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_contratadas'){
                            $('#vc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'contratos_cancelados'){
                            $('#cc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                    });
                    console.log(array_chart_numbers);
                    /*$('#pt_card').text(response.prospectos);*/
                    // $('#spiner-loader').addClass('hide');
                    chart4.updateSeries([{
                        data: array_chart_numbers
                    }])

                }
            });
        }
    }
    $(document).on('click', '.infoMainSelector', function(){
        let selector1 = $('#infoMainSelector1')[0];
        let selector2 = $('#infoMainSelector2')[0];
        let valueOf = this.value;
        let isCheck = this.checked;

        // console.log(valueOf);
        // console.log(isCheck);

        let transaction = '';

        if(valueOf == 1 && isCheck){
            if(selector1.checked && selector2.checked){
                console.log("Se mostraran AMBOS");
                transaction = 3;
            }
            else{
                console.log("Se mostraran los propios");
                transaction = 1;
            }
        }
        else if(valueOf == 2 && isCheck){
            if(selector1.checked && selector2.checked){
                console.log("Se mostraran AMBOS");
                transaction = 3;
            }else{
                console.log("Se mostraran los asesores");
                transaction = 2;
            }
        }else{
            if(selector1.checked && !selector2.checked){
                console.log("Se mostraran los propios");
                transaction = 1;
            }
            else if(selector2.checked && !selector1.checked){
                console.log("Se mostraran los asesores");
                transaction = 2;
            }else if(selector1.checked && selector2.checked){
                console.log("Se mostraran AMBOS");
                transaction = 3;
            }else
            {
                console.log('NADA SELECCIONADO');
                transaction = 0;
            }
        }

        loadData2();


    });

    function loadData2(){
        let typeTransaction = 0;
        let thisWeekS = $('#thisWeek');
        let lastWeekS = $('#lastWeek');
        let lastMonthS = $('#lastMonth');
        if(thisWeekS.hasClass('active')){
            console.log("Se deben mostrar el filtro de esta semana");
            var curr = new Date; // get current date
            var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
            var last = first + 6; // last day is the first day + 6

            var firstday = new Date(curr.setDate(first));
            let inicio_semana = new Date(firstday.getFullYear(), firstday.getMonth(), firstday.getDate()) // can also be a Temporal object
            inicio_semana = inicio_semana.toISOString().split('T')[0];

            var lastday = new Date(curr.setDate(last));
            let fin_semana = new Date(lastday.getFullYear(), lastday.getMonth(), lastday.getDate());
            fin_semana = fin_semana.toISOString().split('T')[0];


            console.log("Week start: ", inicio_semana);
            console.log("Week end: ", fin_semana);
            var com2 = new FormData();
            typeTransaction = validateMainFilters();
            com2.append("fecha_inicio", inicio_semana);
            com2.append("fecha_fin", fin_semana);
            com2.append("typeTransaction", typeTransaction);

            $.ajax({
                url: "<?=base_url()?>index.php/Dashboard/getDataFromDates",
                data:com2,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    // $('#spiner-loader').removeClass('hide');
                    $('.numberElement').addClass('subtitle_skeleton');
                    cleanValues(true);
                },
                success : function (response) {
                    response = JSON.parse(response);
                    let array_chart_numbers = [];
                    $('.numberElement').removeClass('subtitle_skeleton');
                    response.map((element)=>{
                        if(element.queryType == 'prospectos_totales'){
                            $('#pt_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_nuevos'){
                            $('#np_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_apartados'){
                            $('#va_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cancelados_apartados'){
                            $('#ca_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cierres_totales'){
                            $('#ct_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_cita'){
                            $('#pcc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_contratadas'){
                            $('#vc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'contratos_cancelados'){
                            $('#cc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                    });
                    console.log(array_chart_numbers);
                    /*$('#pt_card').text(response.prospectos);*/
                    // $('#spiner-loader').addClass('hide');
                    chart4.updateSeries([{
                        data: array_chart_numbers
                    }])

                }
            });

        }
        else if(lastWeekS.hasClass('active')){
            console.log("Se deben mostrar el filtro de la semana pasada");
            console.log("Se mostrará el filtro #lastWeek");
            let semana_pasada =  getLastWeek();
            let start_sp;
            let end_sp;
            semana_pasada.map((element)=>{
                if(element.type==1){
                    start_sp = element.date;
                }else{
                    end_sp = element.date;
                }
            });

            console.log("Fecha inicio: ", start_sp);
            console.log("Fecha fin: ", end_sp);
            typeTransaction = validateMainFilters();
            var com2 = new FormData();
            com2.append("fecha_inicio", start_sp);
            com2.append("fecha_fin", end_sp);
            com2.append("typeTransaction", typeTransaction);



            $.ajax({
                url: "<?=base_url()?>index.php/Dashboard/getDataFromDates",
                data:com2,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    // $('#spiner-loader').removeClass('hide');
                    $('.numberElement').addClass('subtitle_skeleton');
                    cleanValues(true);
                },
                success : function (response) {
                    response = JSON.parse(response);
                    let array_chart_numbers = [];
                    $('.numberElement').removeClass('subtitle_skeleton');
                    response.map((element)=>{
                        if(element.queryType == 'prospectos_totales'){
                            $('#pt_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_nuevos'){
                            $('#np_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_apartados'){
                            $('#va_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cancelados_apartados'){
                            $('#ca_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cierres_totales'){
                            $('#ct_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_cita'){
                            $('#pcc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_contratadas'){
                            $('#vc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'contratos_cancelados'){
                            $('#cc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                    });
                    console.log(array_chart_numbers);
                    /*$('#pt_card').text(response.prospectos);*/
                    // $('#spiner-loader').addClass('hide');
                    chart4.updateSeries([{
                        data: array_chart_numbers
                    }])

                }
            });
        }
        else if(lastMonthS.hasClass('active')){
            console.log("Se deben mostrar el filtro del ultimo mes");
            let mes_pasada =  getLastMonth();
            let start_sp;
            let end_sp;
            mes_pasada.map((element)=>{
                if(element.type==1){
                    start_sp = element.date;
                }else{
                    end_sp = element.date;
                }
            });
            console.log("Fecha inicio: ", start_sp);
            console.log("Fecha fin: ", end_sp);
            typeTransaction = validateMainFilters();
            var com2 = new FormData();
            com2.append("fecha_inicio", start_sp);
            com2.append("fecha_fin", end_sp);
            com2.append("typeTransaction", typeTransaction);
            $.ajax({
                url: "<?=base_url()?>index.php/Dashboard/getDataFromDates",
                data:com2,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function(){
                    // $('#spiner-loader').removeClass('hide');
                    $('.numberElement').addClass('subtitle_skeleton');
                    cleanValues(true);
                },
                success : function (response) {
                    response = JSON.parse(response);
                    let array_chart_numbers = [];
                    $('.numberElement').removeClass('subtitle_skeleton');
                    response.map((element)=>{
                        if(element.queryType == 'prospectos_totales'){
                            $('#pt_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_nuevos'){
                            $('#np_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_apartados'){
                            $('#va_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cancelados_apartados'){
                            $('#ca_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'cierres_totales'){
                            $('#ct_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'prospectos_cita'){
                            $('#pcc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'ventas_contratadas'){
                            $('#vc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                        if(element.queryType == 'contratos_cancelados'){
                            $('#cc_card').text(element.numerosTotales);
                            array_chart_numbers.push(element.numerosTotales);
                        }
                    });
                    console.log(array_chart_numbers);
                    /*$('#pt_card').text(response.prospectos);*/
                    // $('#spiner-loader').addClass('hide');
                    chart4.updateSeries([{
                        data: array_chart_numbers
                    }])

                }
            });
        }
    }

    const formatter = new Intl.DateTimeFormat("en-GB", { // <- re-use me
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    })

    function getLastWeek(){
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first));
        let inicio_semana = new Date(firstday.getFullYear(), firstday.getMonth(), firstday.getDate()-7) // can also be a Temporal object
        inicio_semana = inicio_semana.toISOString().split('T')[0];

        var lastday = new Date(curr.setDate(last));
        let fin_semana = new Date(lastday.getFullYear(), lastday.getMonth(), lastday.getDate()-7);
        fin_semana = fin_semana.toISOString().split('T')[0];

        let dates = [];
        dates.push({"date":inicio_semana, type:1});
        dates.push({"date":fin_semana, type:2});
        return dates;
    }

    function getLastMonth(){
        var now = new Date();
        var prevMonthLastDate = new Date(now.getFullYear(), now.getMonth(), 0);
        var prevMonthFirstDate = new Date(now.getFullYear() - (now.getMonth() > 0 ? 0 : 1), (now.getMonth() - 1 + 12) % 12, 1);

        function formatDateComponent(dateComponent) {
            return (dateComponent < 10 ? '0' : '') + dateComponent;
        };

        var formatDate = function(date) {
            // return formatDateComponent(date.getMonth() + 1) + '/' + formatDateComponent(date.getDate()) + '/' + date.getFullYear();
            return date.getFullYear() + '-' +formatDateComponent(date.getMonth() + 1) + '-' + formatDateComponent(date.getDate());
        };


        let dates = [];
        dates.push({"date":formatDate(prevMonthFirstDate), type:1});
        dates.push({"date":formatDate(prevMonthLastDate), type:2});
        return dates;
    }

    function validateMainFilters(){
        let selector1 = $('#infoMainSelector1')[0];
        let selector2 = $('#infoMainSelector2')[0];
        let valueOf = this.value;
        let isCheck = this.checked;

        // console.log(valueOf);
        // console.log(isCheck);
        let transaction = '';

        if(valueOf == 1 && isCheck){
            if(selector1.checked && selector2.checked){
                console.log("Se mostraran AMBOS");
                transaction = 3;
            }
            else{
                console.log("Se mostraran los propios");
                transaction = 1;
            }
        }
        else if(valueOf == 2 && isCheck){
            if(selector1.checked && selector2.checked){
                console.log("Se mostraran AMBOS");
                transaction = 3;
            }else{
                console.log("Se mostraran los asesores");
                transaction = 2;
            }
        }else{
            if(selector1.checked && !selector2.checked){
                console.log("Se mostraran los propios");
                transaction = 1;
            }
            else if(selector2.checked && !selector1.checked){
                console.log("Se mostraran los asesores");
                transaction = 2;
            }else if(selector1.checked && selector2.checked){
                console.log("Se mostraran AMBOS");
                transaction = 3;
            }else
            {
                console.log('NADA SELECCIONADO');
                transaction = 0;
            }
        }
        return transaction;
    }

    function cleanValues(validator){
        if(validator){
            $('#pt_card').text('');
            $('#np_card').text('');
            $('#va_card').text('');
            $('#ca_card').text('');
            $('#ct_card').text('');
            $('#pcc_card').text('');
            $('#vc_card').text('');
            $('#cc_card').text('');
        }

    }
</script>

