var dataApartados, dataContratados, dataConEnganche, dataSinEnganche, dataSedes, chartApartados, chartContratados, chartEnganche, chartSinenganche;

sp = { // MJ: SELECT PICKER
    initFormExtendedDatetimepickers: function () {
        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove',
                inline: true
            }
        });
    }
}

$(document).ready(function(){
    sp.initFormExtendedDatetimepickers();
    $('.datepicker').datetimepicker({locale: 'es'});
    setInitialDates();
    recreatApexChart(false);
    getRankings(true, 'general');
    getSedes().then( response => { 
        dataSedes = response 
        buildSelectSedes(dataSedes);
    });
});

var options = {
    series: [],
    chart: {
        height: '100%',
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
            borderRadius: 7,
            barHeight: '50%',
            distributed: false,
            dataLabels: {
                show: true
            },
            
        }
    },
    dataLabels: {
        enabled: true,
    },
    grid: {
        show: false,
    },
    xaxis: {
        categories: [],
        position: 'bottom',
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        labels: {
            show: true,
            formatter: function (val) {
                return val + "%";
            },
            style: {
                colors: ['#FFFFFF','#FFFFFF'],
            },
        }
    },
    yaxis: {
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false,
        },
        labels: {
            show: true,
            formatter: function (val) {
                return val + "%";
            },
            style: {
                colors: ['#FFFFFF','#FFFFFF'],
            },
        }
    },
};

function recreatApexChart(estado, opts){
    if(estado){
        $(".boxChart").html('');
        buildChartsID();
      
        chartApartados = new ApexCharts(document.querySelector('#chart'), setOptionsChart(opts.seriesA[0], opts.categoriesA));
        chartApartados.render();
        
        chartContratados = new ApexCharts(document.querySelector('#chart2'), setOptionsChart(opts.seriesC[0], opts.categoriesC));
        chartContratados.render();
        
        chartEnganche = new ApexCharts(document.querySelector('#chart3'), setOptionsChart(opts.seriesE[0], opts.categoriesE));
        chartEnganche.render();
        
        chartSinenganche = new ApexCharts(document.querySelector('#chart4'), setOptionsChart(opts.seriesS[0], opts.categoriesS));
        chartSinenganche.render();
    }else{
        chartApartados = new ApexCharts(document.querySelector('#chart'), options);
        chartApartados.render();
        chartContratados = new ApexCharts(document.querySelector('#chart2'), options);
        chartContratados.render();
        chartEnganche = new ApexCharts(document.querySelector('#chart3'), options);
        chartEnganche.render();
        chartSinenganche = new ApexCharts(document.querySelector('#chart4'), options);
        chartSinenganche.render();
    }
  
}

function buildChartsID(){
    var boxCharts = document.getElementsByClassName("boxChart");
    for ( var i = 0; i<boxCharts.length; i++ ){
        var id = boxCharts[i].id;
        var html = `<div id="chart`+(id.replace(/\D/g, ""))+`" class="chart"></div>`;
        $('#'+id).append(html);
    }
}

function toggleDatatable(e){
    var columnaActiva = e.closest( '.flexibleR' );
    var columnaChart = e.closest( '.col-chart' );
    var columnDatatable = $( e ).closest( '.row' ).find( '.col-datatable' );
    $( columnDatatable ).html('');
    // La columna se expandera
    if( $(columnaActiva).hasClass('inactivo') ){
        columnaActiva.classList.remove('col-sm-6', 'col-md-6', 'col-lg-6', 'inactivo');
        columnaActiva.classList.add('col-sm-12', 'col-md-12', 'col-lg-12', 'activo');
        columnaChart.classList.remove('col-sm-12', 'col-md-12', 'col-lg-12');
        columnaChart.classList.add('col-sm-6', 'col-md-6', 'col-lg-6');
        columnDatatable.removeClass('hidden');
        reorderColumns(columnDatatable.attr('id'));
    }
    // La columna se contraera 
    else{
        columnaActiva.classList.remove('col-sm-12', 'col-md-12', 'col-lg-12', 'activo');
        columnaActiva.classList.add('col-sm-6', 'col-md-6', 'col-lg-6', 'inactivo');
        columnaChart.classList.remove('col-sm-12', 'col-md-6', 'col-lg-6');
        columnaChart.classList.add('col-sm-12', 'col-md-12', 'col-lg-12');
        columnDatatable.addClass('hidden');
        reorderColumns(columnDatatable.attr('id'));
    }
}

function buildEstructuraDT(dataName, dataApartados){
    var tableHeaders = '';
    var arrayHeaders = Object.keys(dataApartados[0]);
    for( i=0; i<arrayHeaders.length; i++ ){
        tableHeaders += '<th>' + arrayHeaders[i] + '</th>';
    }

    var id = 'table'+dataName;
    var estructura = `<div class="container-fluid p-0" style="padding:15px!important">
                        <table class="table-striped table-hover" id="`+id+`" name="table">
                            <thead>
                                <tr>
                                    `+tableHeaders+`
                                </tr>
                            </thead>
                        </table>
                    </div>`;
    $("#"+dataName).html(estructura);
}

function reorderColumns(){
    var principalColumns = document.getElementsByClassName("flexibleR");
    var mainRow = document.getElementById('mainRow');
    let opts = getCacheOptions();
    let dates = getCacheDates();
    var elements = document.createDocumentFragment();
    var inactivos = [], activos = [], selectsSede = [];
    
    for( var i = 0; i<principalColumns.length; i++){
        var select = {};
        (principalColumns[i].classList.contains('inactivo')) ? inactivos.push(i) : activos.push(i)
        var boxSedes= $(principalColumns[i]).find('.boxSedes');
        var idBox = boxSedes.attr('id');
        var select = $("#"+idBox).find('#sedes'+(idBox.replace(/\D/g, "")));
        var idSelect = $( select ).attr('id');
        select['name'] = $( select ).attr('id');
        select['value'] = $("#"+idSelect).val();
        selectsSede.push(select);
    }

    //Array con orden correcto de columnas primero las activas y después inactivas
    var orden = activos.concat(inactivos);
    orden.forEach(idx => {
        if($(principalColumns[idx]).hasClass('inactivo')){
            principalColumns[idx].classList.add('hidden');
        }
        elements.appendChild(principalColumns[idx].cloneNode(true));
    });
    mainRow.innerHTML = null;
    mainRow.appendChild(elements);

    buildSelectSedes(dataSedes, selectsSede);
    buildDatePikcer(dates);
    recreatApexChart(true,opts);

    for( i = 1; i<=principalColumns.length; i++){
        (function(i){
            setTimeout(function(){
                $(principalColumns[i-1]).removeClass('hidden');
                if($(principalColumns[i-1]).hasClass('activo')){
                    var columnDatatable = $( principalColumns[i-1]).find('.col-datatable');
                    var id = columnDatatable.attr('id');
                    $("#"+id).html('');
                    if( id == 'Apartados' ){
                        buildEstructuraDT(id, dataApartados);
                        buildTableApartados(dataApartados);
                    }
                    else if( id == 'Contratados' ){
                        buildEstructuraDT(id, dataContratados);
                        buildTableContratados(dataContratados);
                    }
                    else if( id == 'ConEnganche' ){
                        buildEstructuraDT(id, dataConEnganche);
                        buildTableConEnganche(dataConEnganche);
                    }
                    else if( id == 'sinEnganche' ){
                        buildEstructuraDT(id, dataSinEnganche);
                        buildTableSinEnganche(dataSinEnganche);
                    }
                }
                $(principalColumns[i-1]).addClass('fadeInAnimationDelay'+i);
            }, 500 * i)
        }(i));
    }   
}

function getRankings(general = false, typeRanking = null){
    let dates = getDates(typeRanking);
    let sede = getSede(typeRanking);
    $.ajax({
        type: 'POST',
        url: `${base_url}Ranking/getAllRankings`,
        data: {general: general, typeRanking: typeRanking,beginDate: dates.beginDate, endDate: dates.endDate, sede: sede},
        dataType: 'json',
        cache: false,
        beforeSend: function() {
          $('#spiner-loader').removeClass('hide');
        },
        success: function(data) {
            
            divideRankingArrays(data);
            updateGraph(typeRanking, data, general);
            if(!general){
                validateToggledDatatable(typeRanking);
            }
            $('#spiner-loader').addClass('hide');
        },
        error: function() {
          $('#spiner-loader').addClass('hide');
          alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
}

function divideRankingArrays(data){
    Object.entries(data).forEach(([key, value]) => {
        if(key == 'Apartados'){
            dataApartados = value;            
        }
        else if(key == 'Contratados'){
            dataContratados = value;
        }
        else if(key == 'ConEnganche'){
            dataConEnganche = value;
        }
        else if(key == 'SinEnganche'){
            dataSinEnganche = value;
        }
    });
    return {dataApartados:dataApartados, dataContratados:dataContratados, dataConEnganche:dataConEnganche, dataSinEnganche:dataSinEnganche}
}

function buildTableApartados(data){
    $('#tableApartados thead tr:eq(0) th').each(function (i) {
        const title = $(this).text();
        $(this).html('<input type="text" center;" class="textoshead"  placeholder="' + title + '"/>');
        $('input', this).on('keyup change', function () {
            if ($("#tableApartados").DataTable().column(i).search() !== this.value) {
                $("#tableApartados").DataTable().column(i)
                    .search(this.value).draw();
            }
        });
    });

    $("#tableApartados").DataTable({
        dom: 'rt'+ "<'container-fluid pt-1 pb-1'<'row'<'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'i><'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'p>>>",
        pagingType: "full_numbers",
        pageLength : 10,
        width: '100%',
        destroy: true,
        ordering: false,
        scrollX: true,
        language: {
            url: `${base_url}static/spanishLoader_v2.json`,
            paginate: {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>"
            }
        },
        data: data,
        columns: [{
            title: 'Totales',
            data: function(d){
                return d.totalAT
            }
        },
        {
            title: 'Suma',
            data: function(d){
                return d.sumaTotal
            }
        },
        {
            title: 'Nombre',
            data: function(d){
                return d.nombreUsuario
            }
        },
        {
            title: 'Puesto',
            data: function(d){
                return d.rol
            }
        },
        {
            title: 'ID',
            data: function(d){
                return d.id_asesor
            }
        },],
        columnDefs: [{
            visible: false,
            searchable: false
        }],
    });
}

function buildTableContratados(data){
    $('#tableContratados thead tr:eq(0) th').each(function (i) {
        const title = $(this).text();
        $(this).html('<input type="text" center;" class="textoshead"  placeholder="' + title + '"/>');
        $('input', this).on('keyup change', function () {
            if ($("#tableContratados").DataTable().column(i).search() !== this.value) {
                $("#tableContratados").DataTable().column(i)
                    .search(this.value).draw();
            }
        });
    });

    $("#tableContratados").DataTable({
        dom: 'rt'+ "<'container-fluid pt-1 pb-1'<'row'<'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'i><'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'p>>>",
        pagingType: "full_numbers",
        pageLength : 10,
        width: '100%',
        destroy: true,
        ordering: false,
        scrollX: true,
        language: {
            url: `${base_url}static/spanishLoader_v2.json`,
            paginate: {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>"
            }
        },
        data: data,
        columns: [{
            title: 'Totales',
            data: function(d){
                return d.totalConT
            }
        },
        {
            title: 'Suma',
            data: function(d){
                return d.sumaTotal
            }
        },
        {
            title: 'Nombre',
            data: function(d){
                return d.nombreUsuario
            }
        },
        {
            title: 'Puesto',
            data: function(d){
                return d.rol
            }
        },
        {
            title: 'ID',
            data: function(d){
                return d.id_asesor
            }
        },],
        columnDefs: [{
            visible: false,
            searchable: false
        }],
    });
}

function buildTableConEnganche(data){
    $('#tableConEnganche thead tr:eq(0) th').each(function (i) {
        const title = $(this).text();
        $(this).html('<input type="text" center;" class="textoshead"  placeholder="' + title + '"/>');
        $('input', this).on('keyup change', function () {
            if ($("#tableConEnganche").DataTable().column(i).search() !== this.value) {
                $("#tableConEnganche").DataTable().column(i)
                    .search(this.value).draw();
            }
        });
    });

    $("#tableConEnganche").DataTable({
        dom: 'rt'+ "<'container-fluid pt-1 pb-1'<'row'<'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'i><'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'p>>>",
        pagingType: "full_numbers",
        pageLength : 10,
        width: '100%',
        destroy: true,
        ordering: false,
        scrollX: true,
        language: {
            url: `${base_url}static/spanishLoader_v2.json`,
            paginate: {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>"
            }
        },
        data: data,
        columns: [{
            title: 'Totales',
            data: function(d){
                return d.cuantos
            }
        },
        {
            title: 'Suma',
            data: function(d){
                return d.sumaTotal
            }
        },
        {
            title: 'Nombre',
            data: function(d){
                return d.asesor
            }
        },
        {
            title: 'Puesto',
            data: function(d){
                return d.rol
            }
        },
        {
            title: 'ID',
            data: function(d){
                return d.id_asesor
            }
        },],
        columnDefs: [{
            visible: false,
            searchable: false
        }],
    });
}

function buildTableSinEnganche(data){
    $('#tablesinEnganche thead tr:eq(0) th').each(function (i) {
        const title = $(this).text();
        $(this).html('<input type="text" center;" class="textoshead"  placeholder="' + title + '"/>');
        $('input', this).on('keyup change', function () {
            if ($("#tablesinEnganche").DataTable().column(i).search() !== this.value) {
                $("#tablesinEnganche").DataTable().column(i)
                    .search(this.value).draw();
            }
        });
    });

    $("#tablesinEnganche").DataTable({
        dom: 'rt'+ "<'container-fluid pt-1 pb-1'<'row'<'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'i><'col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-center'p>>>",
        pagingType: "full_numbers",
        pageLength : 10,
        width: '100%',
        destroy: true,
        ordering: false,
        scrollX: true,
        language: {
            url: `${base_url}static/spanishLoader_v2.json`,
            paginate: {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>"
            }
        },
        data: data,
        columns: [{
            title: 'Totales',
            data: function(d){
                return d.cuantos
            }
        },
        {
            title: 'Suma',
            data: function(d){
                return d.sumaTotal
            }
        },
        {
            title: 'Nombre',
            data: function(d){
                return d.asesor
            }
        },
        {
            title: 'Puesto',
            data: function(d){
                return d.rol
            }
        },
        {
            title: 'ID',
            data: function(d){
                return d.id_asesor
            }
        },],
        columnDefs: [{
            visible: false,
            searchable: false
        }],
    });
}

function formatData(data) {
    let
        apartados = [],
        apartadosLabel = [],
        contratados = [],
        contratadosLabel = [],
        enganche = [],
        engancheLabel = [],
        sinEnganche = [],
        sinEngancheLabel = [];

    if (data.Apartados) {
        let count = 0;
        (data.Apartados).forEach(element => {
            if (count < 10) {
                apartados.push(element.totalAT);
                apartadosLabel.push(element.nombreUsuario);
                count++;
            }
        });
    }
    if (data.Contratados) {
        let count = 0;
        (data.Contratados).forEach(element => {
            if (count < 10) {
                contratados.push(element.totalConT);
                contratadosLabel.push(element.nombreUsuario);
                count++;
            }
        });
    }
    if (data.ConEnganche) {
        let count = 0;
        (data.ConEnganche).forEach(element => {
            if (count < 10) {
                enganche.push(element.cuantos);
                engancheLabel.push(element.asesor);
                count++;
            }
        });
    }
    if (data.SinEnganche) {
        let count = 0;
        (data.SinEnganche).forEach(element => {
            if (count < 10) {
                sinEnganche.push(element.cuantos);
                sinEngancheLabel.push(element.asesor);
                count++;
            }
        });
    }

    return {
        apartados: {
            name: 'Apartados',
            data: apartados
        },
        apartadosLabel: apartadosLabel,
        contratados: {
            name: 'Contratados',
            data: contratados
        },
        contratadosLabel: contratadosLabel,
        enganche: {
            name: 'Enganche',
            data: enganche
        },
        engancheLabel: engancheLabel,
        sinEnganche: {
            name: 'Sin enganche',
            data: sinEnganche
        },
        sinEngancheLabel: sinEngancheLabel
    };
}

function updateGraph(typeRanking, data, general){
    let series = formatData(data);
    switch (typeRanking) {
        case 'general':
            chartApartados.updateOptions(setOptionsChart(series.apartados, series.apartadosLabel));
            chartContratados.updateOptions(setOptionsChart(series.contratados, series.contratadosLabel));
            chartEnganche.updateOptions(setOptionsChart(series.enganche, series.engancheLabel));
            chartSinenganche.updateOptions(setOptionsChart(series.sinEnganche, series.sinEngancheLabel));
            break;
        case 'Apartados':
            chartApartados.updateOptions(setOptionsChart(series.apartados, series.apartadosLabel));
            break;
        case 'Contratados':
            chartContratados.updateOptions(setOptionsChart(series.contratados, series.contratadosLabel));
            break;
        case 'ConEnganche':
            chartEnganche.updateOptions(setOptionsChart(series.enganche, series.engancheLabel));
            break;
        case 'SinEnganche':
            chartSinenganche.updateOptions(setOptionsChart(series.sinEnganche, series.sinEngancheLabel));
            break;

        default:
            break;
    }
}

function setOptionsChart(series, categories){
    let options = { 
        series: [series],
        chart: {
            height: 'auto',
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        colors: ['#0089B7','#039590', '#00ACB8', '#4BBC8E', '#00CDA3', '#92E784', '#F9F871'],
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 7,
                barHeight: '50%',
                distributed: true,
                dataLabels: {
                    show: true
                },
            }
        },
        dataLabels: {
            enabled: true,
        },
        grid: {
            show: false,
        },
        xaxis: {
            categories: categories,
            position: 'bottom',
            axisBorder: {
                show: false
            },
            labels: {
                show: true,
                formatter: function (val) {
                    return val;
                }
            },
            style: {
                colors: []
            },
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: true,
                formatter: function (val) {
                    return val;
                },
                style: {
                    colors: []
                }
            }
        },
        legend:{
            show: false
        }
    }
    return options;
}

function setInitialDates() {
    var beginDt = moment().startOf('year').format('MM/DD/YYYY');
    var endDt = moment().format('MM/DD/YYYY');
    $('.beginDate').val(beginDt);
    $('.endDate').val(endDt);
}

function getDates(typeRanking){
    let beginDate, endDate;
    switch (typeRanking) {
        case 'general':
           beginDate = null;
           endDate = null;
            break;
        case 'Apartados':
            beginDate = $('#beginDateApartados').val();
            endDate = $('#endDateApartados').val();
            break;
        case 'Contratados':
            beginDate = $('#beginDateContratados').val();
            endDate = $('#endDateContratados').val();
            break;
        case 'ConEnganche':
            beginDate = $('#beginDateConEnganche').val();
            endDate = $('#endDateConEnganche').val();
            break;
        case 'SinEnganche':
            beginDate = $('#beginDateSinEnganche').val();
            endDate = $('#endDateSinEnganche').val();
            break;
        default:
            break;
    }
    return {beginDate: beginDate == null ? beginDate : formatDate(beginDate), endDate: endDate == null ? endDate : formatDate(endDate)};
}

function getSedes(){
    return $.ajax({
        type: 'POST',
        url: `${base_url}Ranking/getSedes`,
        data: {},
        dataType: 'json',
        cache: false,
        beforeSend: function() {
          $('#spiner-loader').removeClass('hide');
        },
        success: function(data) {
            // response = data;
        },
        error: function() {
          $('#spiner-loader').addClass('hide');
          alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
}

function buildSelectSedes(dataSedes, selectsSede){
    $('.boxSedes').html('');
    var boxSedes = document.getElementsByClassName("boxSedes");
    for ( var i = 0; i<boxSedes.length; i++ ){
        var id = boxSedes[i].id;
        var html = `<select id="sedes`+(id.replace(/\D/g, ""))+`" name="sedes" class="selectMini sedes w-100 m-0">Sedes</select>`;
        $('#'+id).append(html);
    }

    $(".sedes").append($('<option disabled>').val("0").text("Seleccione una opción"));
    for( var i =0; i<dataSedes.length; i++ ){
        var id_sede = dataSedes[i]['id_sede'];
        var nombre = dataSedes[i]['nombre'];
        $(".sedes").append($('<option>').val(id_sede).text(nombre));
    }
    $(".sedes").val(2);
    $(".sedes").selectpicker('refresh');

    if ( selectsSede != undefined ){
        setOptionsSelected(selectsSede);
    }
}

function setOptionsSelected(selectsSede){
    var boxSedes = document.getElementsByClassName("boxSedes");
    for ( var i = 0; i<boxSedes.length; i++ ){
        var idBox = boxSedes[i].id;
        var select = $("#"+idBox).find('#sedes'+(idBox.replace(/\D/g, "")));
        var id = select.attr('id');
        let obj = selectsSede.find(o => o.name === id );
        $("#"+id).val(obj.value);
        $("#"+id).selectpicker('refresh');
    }
}

function validateToggledDatatable(typeRanking){
    if ( typeRanking == 'Apartados' ){
        var columna = $("#"+typeRanking).closest( '.flexibleR' );
        if ($( columna ).hasClass('activo')){
            buildTableApartados(dataApartados);
        }
    }
    else if( typeRanking == 'Contratados' ){
        var columna = $("#"+typeRanking).closest( '.flexibleR' );
        if ($( columna ).hasClass('activo')){
            buildTableContratados(dataContratados);
        }
    }
    else if( typeRanking == 'ConEnganche' ){
        var columna = $("#"+typeRanking).closest( '.flexibleR' );
        if ($( columna ).hasClass('activo')){
            buildTableConEnganche(dataConEnganche);
        }
    }
    else if( typeRanking == 'SinEnganche' ){
        var columna = $("#"+typeRanking).closest( '.flexibleR' );
        if ($( columna ).hasClass('activo')){
            buildTableSinEnganche(dataSinEnganche);
        }
    }
}

function formatDate(date) {
    var dateParts = date.split("/");
    var d = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

function getCacheOptions(){
    let obj = 
       {
            seriesA: chartApartados.w.config.series,
            categoriesA: chartApartados.w.config.xaxis.categories,
           
            seriesC: chartContratados.w.config.series,
            categoriesC: chartContratados.w.config.xaxis.categories,
          
            seriesE: chartEnganche.w.config.series,
            categoriesE: chartEnganche.w.config.xaxis.categories,
           
            seriesS: chartSinenganche.w.config.series,
            categoriesS: chartSinenganche.w.config.xaxis.categories,
          
    }
    return obj;
}

function getCacheDates(){
   let obj ={ 
        beginDateApartados : $('#beginDateApartados').val(),
        endDateApartados : $('#endDateApartados').val(),

        beginDateContratados : $('#beginDateContratados').val(),
        endDateContratados : $('#endDateContratados').val(),

        beginDateConEnganche : $('#beginDateConEnganche').val(),
        endDateConEnganche : $('#endDateConEnganche').val(),

        beginDateSinEnganche : $('#beginDateSinEnganche').val(),
        endDateSinEnganche : $('#endDateSinEnganche').val()
    }
           
    return obj;
}

function buildDatePikcer(dates){
    $('.datepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove',
            inline: true
        }
    });

     $('#beginDateApartados').val(dates.beginDateApartados),
     $('#endDateApartados').val(dates.endDateApartados),

     $('#beginDateContratados').val(dates.beginDateContratados),
     $('#endDateContratados').val(dates.endDateContratados),

     $('#beginDateConEnganche').val(dates.beginDateConEnganche),
     $('#endDateConEnganche').val(dates.endDateConEnganche),

     $('#beginDateSinEnganche').val(dates.beginDateSinEnganche),
     $('#endDateSinEnganche').val(dates.endDateSinEnganche)
}

function getSede(typeRanking){
    let sede;
    switch (typeRanking) {
        case 'general':
           sede = 2;
            break;
        case 'Apartados':
            sede = $('#sedes1').val();
            break;
        case 'Contratados':
            sede = $('#sedes2').val();
            break;
        case 'ConEnganche':
            sede = $('#sedes3').val();
            break;
        case 'SinEnganche':
            sede = $('#sedes4').val();
            break;
        default:
            break;
    }
    return sede;
}

$('[data-toggle="tooltip"]').tooltip();