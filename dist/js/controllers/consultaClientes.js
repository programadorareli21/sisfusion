$(document).ready(function() 
{
    $usersTable = $('#clients-datatable').DataTable({
        dom: 'Brt'+ "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-6'i><'col-xs-12 col-sm-12 col-md-6 col-lg-6'p>>",
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
            className: 'btn buttons-excel',
            titleAttr: 'Lista nuevos clientes',
            title:'Lista nuevos clientes',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                format: {
                    header: function (d, columnIdx) {
                        switch (columnIdx) {
                            case 0:
                                return 'CLIENTE';
                                break;
                            case 1:
                                return 'CORREO';
                                break;
                            case 2:
                                return 'TELÉFONO';
                            case 3:
                                return 'LUGAR PROSPECCIÓN';
                                break;
                            case 4:
                                return 'ASESOR';
                                break;
                            case 5:
                                return 'COORDINADOR';
                                break;
                            case 6:
                                return 'GERENTE';
                                break;
                            case 7:
                                return 'SUBDIRECTOR';
                                break;
                            case 8:
                                return 'DIRECTOR REGIONAL';
                                break;
                            case 9:
                                return 'CREACIÓN';
                                break;
                            case 10:
                                return 'FECHA CLIENTE';
                                break;
                        }
                    }
                }
            }
        }],
        pagingType: "full_numbers",
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            url: "../static/spanishLoader_v2.json",
            paginate: {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>"
            }
        },
        destroy: true,
        ordering: false,
        columns: [{
                data: function(d) {
                    return d.nombre + '<br>' +'<span class="label" style="background:#1ABC9C">'+ d.id_prospecto +'</span>';
                }
            },
            {
                data: function(d) {
                    return d.correo;
                }
            },
            {
                data: function(d) {
                    return d.telefono;
                }
            },
            {
                data: function(d) {
                    return d.nombre_lp;
                }
            },
            {
                data: function(d) {
                    return d.asesor;
                }
            },
            {
                data: function (d) {
                    return d.coordinador == '  ' ? 'SIN ESPECIFICAR' : d.coordinador;
                }
            },
            {
                data: function (d) {
                    return d.gerente == '  ' ? 'SIN ESPECIFICAR' : d.gerente;
                }
            },
            {
                data: function (d) {
                    return d.subdirector == '  ' ? 'SIN ESPECIFICAR' : d.subdirector;
                }
            },
            {
                data: function (d) {
                    return d.regional == '  ' ? 'SIN ESPECIFICAR' : d.regional;
                }
            },
            {
                data: function(d) {
                    return d.fecha_creacion;
                }
            },
            {
                data: function(d) {
                    return d.fecha_cliente;
                }
            },
            {
                data: function(d) {
                    if (idUser != d.id_asesor && d.lugar_prospeccion == 6 && userType != 19 && userType != 20) { // NO ES ASESORY EL REGISTRO ES DE MKTD QUITO EL BOTÓN DE VER
                        return '';
                    } else { // ES EL ASESOR DEL EXPEDIENTE O ES UN GERENTE O SUBIDIRECTOR DE MKTD QUIEN CONSULTA
                        return '<center><button class="btn-data btn-details-grey see-information" data-id-prospecto="' + d.id_prospecto + '" style="margin-right: 3px;" rel="tooltip" data-placement="left" title="Ver información"><i class="fas fa-eye"></i></button></center>';
                    }
                }
            }
        ],
        ajax: {
            url: "getClientsList",
            type: "POST",
            cache: false,
            data: function(d) {}
        }
    });

});

function printProspectInfo() {
    id_prospecto = $("#prospecto_lbl").val();
    window.open("printProspectInfo/" + id_prospecto, "_blank")
}

function printProspectInfoMktd() {
    id_prospecto = $("#prospecto_lbl").val();
    window.open("printProspectInfoMktd/" + id_prospecto, "_blank")
}
function fillTimeline(v) {
    //colours = ["success", "danger", "warning", "info", "rose"];
    //colourSelected = colours[Math.floor(Math.random() * colours.length)];
    $("#comments-list").append('<li class="timeline-inverted">\n' +
        '    <div class="timeline-badge info"></div>\n' +
        '    <div class="timeline-panel">\n' +
        '            <label><h6>' + v.creador + '</h6></label>\n' +
        '            <br>' + v.observacion + '\n' +
        '        <h6>\n' +
        '            <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i> ' + v.fecha_creacion + '</span>\n' +
        '        </h6>\n' +
        '    </div>\n' +
        '</li>');
}

function fillFields(v, type) {
    /*
     * 0 update prospect
     * 1 see information modal
     * 2 update reference
     */
    if (type == 0) {
        $("#nationality").val(v.nacionalidad);
        $("#legal_personality").val(v.personalidad_juridica);
        $("#curp").val(v.curp);
        $("#rfc").val(v.rfc);
        $("#name").val(v.nombre);
        $("#last_name").val(v.apellido_paterno);
        $("#mothers_last_name").val(v.apellido_materno);
        $("#date_birth").val(v.fecha_nacimiento);
        $("#email").val(v.correo);
        $("#phone_number").val(v.telefono);
        $("#phone_number2").val(v.telefono_2);
        $("#civil_status").val(v.estado_civil);
        $("#matrimonial_regime").val(v.regimen_matrimonial);
        $("#spouce").val(v.conyuge);
        $("#from").val(v.originario_de);
        $("#home_address").val(v.domicilio_particular);
        $("#occupation").val(v.ocupacion);
        $("#company").val(v.empresa);
        $("#position").val(v.posicion);
        $("#antiquity").val(v.antiguedad);
        $("#company_antiquity").val(v.edadFirma);
        $("#company_residence").val(v.direccion);
        $("#prospecting_place").val(v.lugar_prospeccion);
        $("#advertising").val(v.medio_publicitario);
        $("#sales_plaza").val(v.plaza_venta);
        //document.getElementById("observations").innerHTML = v.observaciones;
        $("#observation").val(v.observaciones);
        if (v.tipo_vivienda == 1) {
            document.getElementById('own').setAttribute("checked", "true");
        } else if (v.tipo_vivienda == 2) {
            document.getElementById('rented').setAttribute("checked", "true");
        } else if (v.tipo_vivienda == 3) {
            document.getElementById('paying').setAttribute("checked", "true");
        } else if (v.tipo_vivienda == 4) {
            document.getElementById('family').setAttribute("checked", "true");
        } else {
            document.getElementById('other').setAttribute("checked", "true");
        }

        pp = v.lugar_prospeccion;
        console.log(pp);
        if (pp == 3 || pp == 7 || pp == 9 || pp == 10) { // SPECIFY OPTION
            $("#specify").val(v.otro_lugar);
        } else if (pp == 6) { // SPECIFY MKTD OPTION
            document.getElementById('specify_mkt').value = v.otro_lugar;
        } else if (pp == 21) { // RECOMMENDED SPECIFICATION
            document.getElementById('specify_recommends').value = v.otro_lugar;
        } else { // WITHOUT SPECIFICATION
            $("#specify").val("");
        }

    } else if (type == 1) {
        $("#nationality-lbl").val(v.nacionalidad);
        $("#legal-personality-lbl").val(v.personalidad_juridica);
        $("#curp-lbl").val(v.curp);
        $("#rfc-lbl").val(v.rfc);
        $("#name-lbl").val(v.nombre);
        $("#last-name-lbl").val(v.apellido_paterno);
        $("#mothers-last-name-lbl").val(v.apellido_materno);
        $("#email-lbl").val(v.correo);
        $("#phone-number-lbl").val(v.telefono);
        $("#phone-number2-lbl").val(v.telefono_2);
        $("#prospecting-place-lbl").val(v.lugar_prospeccion);
        $("#specify-lbl").html(v.otro_lugar);
        //$("#advertising-lbl").val(v.medio_publicitario);
        $("#sales-plaza-lbl").val(v.plaza_venta);
        $("#comments-lbl").val(v.observaciones);
        $("#asesor-lbl").val(v.asesor);
        $("#coordinador-lbl").val(v.coordinador);
        $("#gerente-lbl").val(v.gerente);
        $("#phone-asesor-lbl").val(v.tel_asesor);
        $("#phone-coordinador-lbl").val(v.tel_coordinador);
        $("#phone-gerente-lbl").val(v.tel_gerente);

    } else if (type == 2) {
        $("#prospecto_ed").val(v.id_prospecto).trigger('change');
        $("#prospecto_ed").selectpicker('refresh');
        $("#kinship_ed").val(v.parentesco).trigger('change');
        $("#kinship_ed").selectpicker('refresh');
        $("#name_ed").val(v.nombre);
        $("#phone_number_ed").val(v.telefono);
    }
}
function fillChangelog(v) {
    $("#changelog").append('<li class="timeline-inverted">\n' +
        '    <div class="timeline-badge success"><span class="material-icons">check</span></div>\n' +
        '    <div class="timeline-panel">\n' +
        '            <label><h6>' + v.parametro_modificado + '</h6></label><br>\n' +
        '            <b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n' +
        '        <h6>\n' +
        '            <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i> ' + v.fecha_creacion + ' - ' + v.creador + '</span>\n' +
        '        </h6>\n' +
        '    </div>\n' +
        '</li>');
}

function cleanComments() {
    var myCommentsList = document.getElementById('comments-list');
    myCommentsList.innerHTML = '';

    var myChangelog = document.getElementById('changelog');
    myChangelog.innerHTML = '';
}

$(document).on('click', '.see-information', function(e) {
    id_prospecto = $(this).attr("data-id-prospecto");
    $("#seeInformationModal").modal();
    $("#prospecto_lbl").val(id_prospecto);

    $.getJSON("getInformationToPrint/" + id_prospecto).done(function(data) {
        $.each(data, function(i, v) {
            fillFields(v, 1);
        });
    });

    $.getJSON("getComments/" + id_prospecto).done(function(data) {
        counter = 0;
        $.each(data, function(i, v) {
            counter++;
            fillTimeline(v, counter);
        });
    });

    $.getJSON("getChangelog/" + id_prospecto).done(function(data) {
        $.each(data, function(i, v) {
            fillChangelog(v);
        });
    });

});