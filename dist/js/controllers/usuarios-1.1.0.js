$(document).ready( function() {
    $('[data-toggle="tooltip"]').tooltip();

    $.getJSON("fillSelectsForUsers").done(function(data) {
        for (let i = 0; i < data.length; i++) {
            if (data[i]['id_catalogo'] == 16){ // PAYMENT METHOD SELECT
                $("#payment_method").append($('<option>').val(data[i]['id_opcion']).text(data[i]['nombre']));
            }
            if (data[i]['id_catalogo'] == 1) // MEMBER TYPE SELECT
                $("#member_type").append($('<option>').val(data[i]['id_opcion']).text(data[i]['nombre']));
            if (data[i]['id_catalogo'] == 0) // HEADQUARTER SELECT
                $("#headquarter").append($('<option>').val(data[i]['id_opcion']).text(data[i]['nombre']));
        }

        $('#payment_method').selectpicker('refresh');
        $('#headquarter').selectpicker('refresh');
        $('#member_type').selectpicker('refresh');
    });

    $(".select-is-empty").removeClass("is-empty");

    $('#all_users_datatable thead tr:eq(0) th').each(function (i) {
        if (i != 16) {
            var title = $(this).text();
            $(this).html('<input type="text" style="width:100%; background:#003D82; color:white; border: 0; font-weight: 500;" class="textoshead"  placeholder="' + title + '"/>');
            $('input', this).on('keyup change', function () {
                if ($('#all_users_datatable').DataTable().column(i).search() !== this.value) {
                    $('#all_users_datatable').DataTable()
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        }
    });

    // MJ: EJECUTAR FUNCIÓN PARA EL LLENADO DE LA DT
    fillUsersTable();
});

function fillUsersTable() {
    $allUsersTable = $('#all_users_datatable').DataTable({
        dom: 'Brt' + "<'row'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                className: 'btn buttons-excel',
                titleAttr: 'Listado de usuarios',
                title: 'Listado de usuarios',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    format: {
                        header: function (d, columnIdx) {
                            switch (columnIdx) {
                                case 0:
                                    return 'ESTATUS';
                                    break;
                                case 1:
                                    return 'ID';
                                    break;
                                case 2:
                                    return 'NOMBRE';
                                case 3:
                                    return 'CORREO';
                                    break;
                                case 4:
                                    return 'TELÉFONO';
                                    break;
                                case 5:
                                    return 'TIPO';
                                    break;
                                case 6:
                                    return 'SEDE';
                                    break;
                                case 7:
                                    return 'COORDINADOR';
                                    break;
                                case 8:
                                    return 'GERENTE';
                                    break;
                                case 9:
                                    return 'SUBDIRECTOR';
                                    break;
                                case 10:
                                    return 'DIRECTOR REGIONAL';
                                    break;
                                case 11:
                                    return 'TALLA';
                                    break;
                                case 12:
                                    return 'GÉNERO';
                                    break;
                                case 13:
                                    return 'HIJOS + 12';
                                    break;
                                case 14:
                                    return 'REINGRESO';
                                    break;
                                case 15:
                                    return 'BAJA';
                                    break;
                            }
                        }
                    }
                }
            }
        ],
        ordering: false,
        paging: true,
        scrollX: true,
        pagingType: "full_numbers",
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        language: {
            url: "./..//static/spanishLoader_v2.json",
            paginate: {
                previous: "<i class='fa fa-angle-left'>",
                next: "<i class='fa fa-angle-right'>"
            }
        },
        destroy: true,
        columns: [
            {
                data: function (d) {
                    if (d.estatus == 1) {
                        return '<center><span class="label label-danger" style="background:#27AE60">Activo</span><center>';
                    } else if (d.estatus == 3) {
                        return '<center><span class="label label-danger" style="background:#FF7C00">Inactivo comisionando</span><center>';
                    } else {
                        return '<center><span class="label label-danger" style="background:#E74C3C">Inactivo</span><center>';
                    }
                }
            },
            {
                data: function (d) {
                    return d.id_usuario;
                }
            },
            {
                data: function (d) {
                    return d.nombre;
                }
            },
            {
                data: function (d) {
                    return d.correo;
                }
            },
            {
                data: function (d) {
                    return d.telefono;
                }
            },
            {
                data: function (d) {
                    return d.puesto;
                }
            },
            {
                data: function (d) {
                    return d.sede;
                }
            },
            {
                data: function (d) {
                    return d.coordinador == '  ' ? 'NO APLICA' : d.coordinador;
                }
            },
            {
                data: function (d) {
                    return d.gerente == '  ' ? 'NO APLICA' : d.gerente;
                }
            },
            {
                data: function (d) {
                    return d.subdirector == '  ' ? 'NO APLICA' : d.subdirector;
                }
            },
            {
                data: function (d) {
                    return d.regional == '  ' ? 'NO APLICA' : d.regional;
                }
            },
            {
                data: function (d) {
                    return d.talla == null ? 'SIN ESPECIFICAR' : d.talla;
                }
            },
            {
                data: function (d) {
                    return d.sexo == null ? 'SIN ESPECIFICAR' : d.sexo;
                }
            },
            {
                data: function (d) {
                    return d.hijos_12 == null ? 'SIN ESPECIFICAR' : d.hijos_12;
                }
            },
            {
                data: function (d) {
                    return d.fecha_reingreso == null ? 'SIN ESPECIFICAR' : d.fecha_reingreso;
                }
            },
            {
                data: function (d) {
                    return d.fecha_baja == null ? 'SIN ESPECIFICAR' : d.fecha_baja;
                }
            },
            {
                data: function (d) {
                    var id_rol = id_rol_global;
                    if (id_rol == 8 && d.puesto == 'Contraloría' && d.estatus == 1) {
                        if (userId == 1297 || userId == 1) {
                            return '<div class="d-flex justify-center"><button class="btn-data btn-blueMaderas edit-user-information" data-rol="' + d.id_rol + '" data-id-usuario="' + d.id_usuario + '"><i class="fas fa-pencil-alt"></i></button><button class="btn-data btn-orangeYellow  see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i> </button>' +
                                '<button class="btn-data btn-green change-user-status" title="Dar de baja" id="' + d.id_usuario + '" data-estatus="0" data-id-usuario="' + d.id_usuario + '" data-name="' + d.nombre + '" data-rol="' + d.puesto + '"><i class="fas fa-lock-open"></i></button></div>';
                        } else {
                            return '<div class="d-flex justify-center"><button class="btn-data btn-orangeYellow  see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i> </button>' +
                                '<button class="btn-data btn-green change-user-status" title="Dar de baja" id="' + d.id_usuario + '" data-estatus="0" data-id-usuario="' + d.id_usuario + '" data-name="' + d.nombre + '" data-rol="' + d.puesto + '"><i class="fas fa-lock-open"></i></button></div>';
                        }
                    } else {
                        if (userId == 1297 || userId == 1) {
                            return '<div class="d-flex justify-center"><button class="btn-data btn-blueMaderas edit-user-information" data-rol="' + d.id_rol + '" data-id-usuario="' + d.id_usuario + '"><i class="fas fa-pencil-alt"></i></button><button class="btn-data btn-orangeYellow  see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i> </button>' +
                                '<button class="btn-data btn-warning change-user-status" id="' + d.id_usuario + '" data-estatus="1" data-id-usuario="' + d.id_usuario + '" data-name="' + d.nombre + '" data-rol="' + d.puesto + '"><i class="fas fa-lock"></i></button></div>';
                        } else {
                            if (id_rol == 8 && userId != 1297 && d.puesto == 'Contraloría' && d.estatus == 0) {
                                return '<div class="d-flex justify-center"><button class="btn-data btn-orangeYellow  see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i> </button>' +
                                    '<button class="btn-data btn-warning change-user-status" id="' + d.id_usuario + '" data-estatus="1" data-id-usuario="' + d.id_usuario + '" data-name="' + d.nombre + '" data-rol="' + d.puesto + '"><i class="fas fa-lock"></i></button></div>';
                            }
                        }
                    }

                    if (id_rol == 53) {
                        return '<button class="btn-data btn-azure see-changes-log" data-id-usuario="' + d.id_usuario + '"><span class="material-icons">visibility</span> </button>';
                    } else if (id_rol == 41) {
                        return '<div class="d-flex justify-center"><button class="btn-data btn-blueMaderas edit-user-information" data-rol="' + d.id_rol + '" data-id-usuario="' + d.id_usuario + '"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button class="btn-data btn-orangeYellow  see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i> </button>' +
                            '</div>';
                    } else {
                        if (d.estatus == 1) {
                            return '<div class="d-flex justify-center"><button class="btn-data btn-blueMaderas edit-user-information" data-rol="' + d.id_rol + '" data-id-usuario="' + d.id_usuario + '"><i class="fas fa-pencil-alt"></i></button>' +
                                '<button class="btn-data btn-orangeYellow  see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i> </button>' +
                                '<button class="btn-data btn-green change-user-status" title="Dar de baja" id="' + d.id_usuario + '" data-estatus="0" data-id-usuario="' + d.id_usuario + '" data-name="' + d.nombre + '" data-rol="' + d.puesto + '"><i class="fas fa-lock-open"></i></button></div>';
                        } else {
                            if (d.puesto == 'Asesor' || d.puesto == 'Coordinador de ventas' || d.puesto == 'Gerente') {
                                return '<div class="d-flex justify-center"><button class="btn-data btn-blueMaderas  edit-user-information" data-rol="' + d.id_rol + '" data-id-usuario="' + d.id_usuario + '"><i class="fas fa-pencil-alt"></i></button>' +
                                    '<button class="btn-data btn-orangeYellow see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i></button>' +
                                    '</div>';
                            } else {
                                return '<div class="d-flex justify-center"><button class="btn-data btn-blueMaderas  edit-user-information" data-rol="' + d.id_rol + '" data-id-usuario="' + d.id_usuario + '"><i class="fas fa-pencil-alt"></i></button>' +
                                    '<button class="btn-data btn-orangeYellow see-changes-log" data-id-usuario="' + d.id_usuario + '" ><i class="fas fa-eye"></i></button>' +
                                    '<button class="btn-data btn-warning change-user-status" id="' + d.id_usuario + '" data-estatus="1" data-id-usuario="' + d.id_usuario + '" data-name="' + d.nombre + '" data-rol="' + d.puesto + '"><i class="fas fa-lock"></i></button>' +
                                    '</div>';
                            }

                        }

                    }

                }
            }
        ],
        ajax: {
            url: "getUsersList",
            type: "POST",
            cache: false,
            data: function (d) {
            }
        }
    });
}

function showPassword() {
    if ($("#contrasena").attr("type") == "password") $("#contrasena").attr("type", "text");
    else $("#contrasena").attr("type", "password");    
    
    $("#showPass i").toggle();
}

$("#my_personal_info_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'updatePersonalInformation',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            // Actions before send post
        },
        success: function(data) {
            if (data == 1) {
                alerts.showNotification("top", "right", "La información se ha actualizado correctamente.", "success");
                setTimeout(function() {
                    document.location.reload()
                }, 3000);
            } else {
                alerts.showNotification("top", "right", "Asegúrate de haber llenado todos los campos mínimos requeridos.", "warning");
            }
        },
        error: function(){
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});

$("#my_add_user_form").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'saveUser',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            // Actions before send post
        },
        success: function(data) {
            if (data == 1) {
                alerts.showNotification("top", "right", "El usuario se ha registrado correctamente.", "success");
                setTimeout(function() {
                    document.location.reload()
                }, 3000);
            } else {
                alerts.showNotification("top", "right", "Asegúrate de haber llenado todos los campos mínimos requeridos.", "warning");
            }
        },
        error: function(){
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});

function getLeadersList(){
    headquarter = $('#headquarter').val();
    type = $('#member_type').val();
    $("#leader").find("option").remove();
    $.post('getLeadersList/'+headquarter+'/'+type, function(data) {
        var len = data.length;
        for( var i = 0; i<len; i++)
        {
            var id = data[i]['id_usuario'];
            var name = data[i]['nombre'];
            var sede = data[i]['id_sede'];
            $("#leader").append($('<option>').val(id).text(name));
        }
        if(len<=0)
        {
            $("#leader").append('<option selected="selected" value="0">NA</option>');
        }
        $('#leader').selectpicker('refresh');
    }, 'json');
}

function getLeadersListForEdit(headquarter, type, leader){
    $("#leader").find("option").remove();
    $.post('getLeadersList/'+headquarter+'/'+type, function(data) {
        var len = data.length;
        for( var i = 0; i<len; i++)
        {
            var id = data[i]['id_usuario'];
            var name = data[i]['nombre'];
            var sede = data[i]['id_sede'];
            if(id == leader){
                $("#leader").append($('<option selected>').val(id).text(name));
                $("#lastLI").val(id);
            } else{
                $("#leader").append($('<option>').val(id).text(name));
            }
        }
        if(len<=0)
        {
            $("#leader").append('<option selected="selected" value="0">NA</option>');
        }
        $('#leader').selectpicker('refresh');
    }, 'json');
}

function cleadFieldsHeadquarterChange(){
    $("#leader").find("option").remove();
    $("#member_type").val("");
}
function CloseModalBaja(){
    document.getElementById('nameUs').innerHTML = '';
    $('#id_user').val(0);
    $('#idrol').val(0);
    document.getElementById('motivo').innerHTML = '';
    $('#BajaUserForm')[0].reset();
    $('#BajaUser').modal("hide");
}
function BajaConfirmM(){
    document.getElementById('msj').innerHTML = '';
    document.getElementById('nameUs2').innerHTML = '';
    $('#iduser').val(0);
    $('#id_rol').val(0);
    $('#status').val(0);
    $('#BajaConfirmForm')[0].reset();
    $('#BajaConfirm').modal("hide");
}
$("#BajaUserForm").on('submit', function(e){
    e.preventDefault();
    document.getElementById('btnS').disabled = true;
    $.ajax({
        type: 'POST',
        url: 'changeUserStatus',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            // Actions before send post
        },
        success: function(data) {
            if( data == 1 ){
                if (estatus == 1) {
                    alerts.showNotification("top", "right", "Se ha activado con éxito.", "success");
                } else {
                    alerts.showNotification("top", "right", "Se ha desactivado con éxito.", "success");
                }
                CloseModalBaja();
                $allUsersTable.ajax.reload();
            }else{
                alerts.showNotification("top", "right", "Asegúrate de haber llenado todos los campos mínimos requeridos.", "warning");
            }
            document.getElementById('btnS').disabled = false;

        },
        error: function(){
            document.getElementById('btnS').disabled = false;
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});
$("#BajaConfirmForm").on('submit', function(e){
    e.preventDefault();
    document.getElementById('btnSub').disabled = true;
    $.ajax({
        type: 'POST',
        url: 'changeUserStatus',
        data: {'id_user': $('#iduser').val(), 'estatus': $('#status').val()},
        dataType: 'json',
        success: function(data){

            BajaConfirmM();
            if( data == 1 ){
                if (estatus == 1) {
                    alerts.showNotification("top", "right", "Se ha activado con éxito.", "success");
                } else {
                    alerts.showNotification("top", "right", "Se ha desactivado con éxito.", "success");
                }
                $allUsersTable.ajax.reload();
            }else{
                alerts.showNotification("top", "right", "Asegúrate de haber llenado todos los campos mínimos requeridos.", "warning");
            }
            document.getElementById('btnSub').disabled = false;
        },error: function( ){
            BajaConfirmM();
            document.getElementById('btnSub').disabled = false;
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});

$(document).on('click', '.change-user-status', function(e) {
    e.preventDefault();
    id_user = $(this).attr("data-id-usuario");
    $('#'+id_user+'').prop('disabled', true);
    estatus = $(this).attr("data-estatus");
    id_rol = $(this).attr("data-rol");
    nameUser = $(this).attr("data-name");
if(estatus == 0 && (id_rol == 'Asesor' || id_rol == 'Gerente' || id_rol == 'Coordinador de ventas')){
    document.getElementById('nameUs').innerHTML = '';
    $('#id_user').val(0);
    $('#idrol').val(0);


    document.getElementById('nameUs').innerHTML = nameUser;
    $('#id_user').val(id_user);
    $('#idrol').val(id_rol);
    $("#BajaUser").modal();
}else{
    document.getElementById('nameUs2').innerHTML = '';
    document.getElementById('msj').innerHTML = '';

    $('#iduser').val(0);
    $('#id_rol').val(0);
    $('#status').val(0);
    if(estatus == 0){
        document.getElementById('msj').innerHTML = '¿Está seguro que desea dar de baja a ';
        document.getElementById('nameUs2').innerHTML = nameUser;
        //alert('baja');
        $('#iduser').val(id_user);
        $('#id_rol').val(id_rol);
        $('#status').val(estatus);
        $("#BajaConfirm").modal();

    }else{
        document.getElementById('msj').innerHTML = '¿Está seguro que desea dar de alta a ';
        document.getElementById('nameUs2').innerHTML = nameUser;
       // alert('alta');
        $('#iduser').val(id_user);
        $('#id_rol').val(id_rol);
        $('#status').val(estatus);
        $("#BajaConfirm").modal();

    }
}
$('#'+id_user+'').prop('disabled', false);
});

$(document).on('click', '.edit-user-information', function(e){
    id_usuario = $(this).attr("data-id-usuario");
    $.getJSON("getUserInformation/"+id_usuario).done( function( data ){
        $.each( data, function(i, v){
            let leader;
            if (v.id_rol == 9)
                leader = v.gerente_id
            else if (v.id_rol == 3)
                leader = v.subdirector_id
            else
                leader = v.id_lider;
            getLeadersListForEdit(v.id_sede, v.id_rol, leader);
            $("#editUserModal").modal();
            fillFields(v);
            validateEmptyFields(v);
        });
    });
});
$(document).on('change', '#sedech', function() {
    let id_sede = $('#sedech').val();
    $("#sucursal").empty();
    $("#sucursal").append($('<option disabled selected>').val("").text("Seleccione una opción"));
    $.getJSON("getSucursalCH/"+id_sede).done( function( data ){

        var select = document.getElementsByName('sucursal')[0];
        if(data.data.length > 0){
            $('#sucursal').prop('required', true);
        }else{
            document.getElementById("sucursal").removeAttribute("required");

        }
        $.each( data.data, function(i, v){
                var option = document.createElement("option");
                option.text = v.nom_oficina;
                option.value = v.idsucursal;
                select.add(option);
        });
        $('#sucursal').selectpicker('refresh');
    });
});
function getSedesCH(sede = 0,sucursal = 0){
    $('#spiner-loader').removeClass('hide');
    $('#sedech').selectpicker('refresh');
    $("#sedech").empty();
    sede == 0 ?  $("#sedech").append($('<option disabled selected>').val("").text("Seleccione una opción")) : '';
    $('#sedech').prop('required', true);

    $.getJSON("getSedesCH").done( function( data ){
        $('#spiner-loader').addClass('hide');
        var select = document.getElementsByName('sedech')[0];
        $.each( data.data, function(i, v){
            if(v.idsede != 7){
                var option = document.createElement("option");
                option.text = v.nom_sede;
                option.value = v.idsede;
                select.add(option);
                if(v.idsede == sede){
                    $('#sedech').val(v.idsede);
                    $.getJSON("getSucursalCH/"+sede).done( function( data2 ){
                        var select = document.getElementsByName('sucursal')[0];
                        $.each( data2.data, function(i, v){
                                var option = document.createElement("option");
                                option.text = v.nom_oficina;
                                option.value = v.idsucursal;
                                select.add(option);
                                if(v.idsucursal == sucursal){
                                    $('#sucursal').selectpicker('refresh');
                                $('#sucursal').selectpicker('val',v.idsucursal);
                                }
                        });
                    });
                }
            }
        });
        $('#sedech').selectpicker('refresh');
    });
}
function fillFields (v) {
    $("#id_usuario").val(v.id_usuario);
    $("#name").val(v.nombre);
    $("#last_name").val(v.apellido_paterno);
    $("#mothers_last_name").val(v.apellido_materno);
    $("#rfc").val(v.rfc);
    $("#payment_method").val(v.forma_pago);
    $("#email").val(v.correo);
    $("#phone_number").val(v.telefono);
    $("#headquarter").val(v.id_sede);
    $("#member_type").val(v.id_rol);
    $("#lastTM").val(v.id_rol);
    $("#talla").val(v.talla == null ? 0 : v.talla);
    $("#sexo").val(v.sexo == null ? 'S' : v.sexo);
    $("#hijos").val(v.tiene_hijos == null ? 'NO' : v.tiene_hijos);
    $("#noHijos").val(v.hijos_12 == null ? 0 : v.hijos_12);
    $('#payment_method').selectpicker('refresh');
    $('#headquarter').selectpicker('refresh');
    $('#member_type').selectpicker('refresh');
    $('#sexo').selectpicker('refresh');
    $('#hijos').selectpicker('refresh');

    if(v.id_rol == 7 || v.id_rol== 3 || v.id_rol == 9){
        $('#ch'). show();
        document.getElementById("sedech").removeAttribute("required");
        $("#sedech").empty();
        document.getElementById("sucursal").removeAttribute("required");
        $("#sucursal").empty();
                if(v.sedech == null){
                    getSedesCH();
                }else{
                    getSedesCH(v.sedech,v.sucursalch);
                }
                $('#sedech').selectpicker('refresh');
            }
            else{
                $('#ch'). hide();
                document.getElementById("sedech").removeAttribute("required");
                $("#sedech").empty();
                document.getElementById("sucursal").removeAttribute("required");
                $("#sucursal").empty();
            }
            $("#rol_actual").val(v.id_rol);
    $("#username").val(v.usuario);
    $("#contrasena").val(v.contrasena);
}

function validateEmptyFields (v) {
    if (v.nombre != '')
        $(".div_name").removeClass("is-empty");
    if (v.apellido_paterno != '')
        $(".div_last_name").removeClass("is-empty");
    if (v.apellido_materno != '')
        $(".div_mothers_last_name").removeClass("is-empty");
    if (v.rfc != '')
        $(".div_rfc").removeClass("is-empty");
    if (v.forma_pago != '')
        $(".div_payment_method").removeClass("is-empty");
    if (v.correo != '')
        $(".div_email").removeClass("is-empty");
    if (v.telefono != '')
        $(".div_phone_number").removeClass("is-empty");
    if (v.id_sede != '')
        $(".div_headquarter").removeClass("is-empty");
    if (v.id_rol != '')
        $(".div_membertype").removeClass("is-empty");
    if (v.id_lider != '')
        $(".div_leader").removeClass("is-empty");
    if (v.hijos_12 == '')
        $(".div_nohijos").removeClass("is-empty");
    if (v.talla != '')
        $(".div_talla").removeClass("is-empty");
}

$("#editUserForm").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'updateUser',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        },
        success: function(data) {
            if (data == 1) {
                $allUsersTable.ajax.reload();
                $('#editUserModal').modal("hide");
                alerts.showNotification("top", "right", "El registro se ha actualizado exitosamente.", "success");
            } else {
                alerts.showNotification("top", "right", "Asegúrate de haber llenado todos los campos mínimos requeridos.", "warning");
            }
        },
        error: function(){
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});



$(document).on('click', '.see-changes-log', function(){
    id_usuario = $(this).attr("data-id-usuario");
    $.post("getChangeLogUsers/"+id_usuario).done( function( data ){
        $("#changesRegsUsers").modal();
        $.each( JSON.parse(data), function(i, v){
            // $("#changesRegsUsers").modal();
            fillChangelogUsers(v);
        });
    });
});

function fillChangelogUsers(v) {
    var nombreMovimiento;
    var dataMovimiento;


    switch (v.col_afect) {
      case 'nombre':
            nombreMovimiento = 'Nombre';
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
      case 'apellido_paterno':
            nombreMovimiento = 'Apellido paterno';
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
      case 'apellido_materno':
            nombreMovimiento = 'Apellido materno';
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
      case 'contrasena':
            nombreMovimiento = 'Contraseña';
            dataMovimiento = 'Cambio de Contraseña';
        break;
      case 'telefono':
            nombreMovimiento = 'Teléfono';
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
      case 'imagen_perfil':
            nombreMovimiento = 'Imagen de perfil';
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
      case 'forma_pago':
            nombreMovimiento = 'Forma de pago';
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
      default:
            nombreMovimiento = v.col_afect;
            dataMovimiento = '<b>Valor anterior:</b> ' + v.anterior + '\n' +
        '            <br>\n' +
        '            <b>Valor nuevo:</b> ' + v.nuevo + '\n';
        break;
    }


    $("#changelogUsers").append('<li class="timeline-inverted">\n' +
        '    <div class="timeline-badge success"><span class="material-icons">done</span></div>\n' +
        '    <div class="timeline-panel">\n' +
        '            <label><h6 style="text-transform:uppercase">' + nombreMovimiento + '</h6></label><br>\n' +
                    dataMovimiento +
        '        <h6>\n' +
        '            <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i> ' + v.fecha_creacion + ' - ' + v.creador + '</span>\n' +
        '        </h6>\n' +
        '    </div>\n' +
        '</li>');
}
