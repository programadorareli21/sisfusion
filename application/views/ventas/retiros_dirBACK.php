<body>
<div class="wrapper">

        <?php


  if($this->session->userdata('id_rol')=="1" || $this->session->userdata('id_rol')=="2")//contraloria
    {
        /*-------------------------------------------------------*/
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



<style type="text/css">
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: white;
            opacity: 0.4;

        ::-moz-placeholder { /* Firefox 19+ */
            color: white;
            opacity: 0.4;
        }

        :-ms-input-placeholder { /* IE 10+ */
            color: white;
            opacity: 0.4;
        }

        :-moz-placeholder { /* Firefox 18- */
            color: white;
            opacity: 0.4;
        }
        }

        ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 80%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 60px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
    </style>



    <!--<div class="modal fade modal-alertas" id="myModalEspera" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <form method="post" id="form_espera_uno">
                    <div class="modal-body"></div>
                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>-->


    <!--<div class="modal fade modal-alertas" id="modal-delete" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" >
          
            
                    <div class="modal-body"></div>
                    <div class="modal-footer"></div>
                
                
            </div>
        </div>
    </div>-->



 <div class="modal fade modal-alertas" id="modal_nuevas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <!-- <center><img src="<?=base_url()?>static/images/preview.gif" width="250" height="200"></center> -->
            </div>

            <form method="post" id="form_aplicar">
                <div class="modal-body"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-alertas" id="modal_log" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
        <!--    <div class="modal-header bg-red">
             </div> -->

         
                <div class="modal-body" id="bod">
                </div>
            
        </div>
    </div>
</div>




    <!--<div class="modal fade modal-alertas" id="miModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-red">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Retiros</h4>
                </div>
                <form method="post" id="form_descuentos">
                    <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="label">Puesto del usuario</label>
                    <select class="selectpicker roles" name="roles" id="roles" required>
                        <option value="">----Seleccionar-----</option>
                       
                        <option value="2">Sub director</option>  
                        <option value="1">Director</option> 

                    </select>
                    </div>

           
                    <div class="form-group" id="users"><label class="label">Usuario</label>
                    <select id="usuarioid" name="usuarioid" class="form-control directorSelect ng-invalid ng-invalid-required" required data-live-search="true"></select>
                    </div>-->

                    <!-- <div class="form-group" id="loteorigen"><label class="label">Lote origen</label>
                    <select id="idloteorigen"  name="idloteorigen[]" multiple="multiple" class="form-control directorSelect2 js-example-theme-multiple" style="width: 100%;height:200px !important;"  required data-live-search="true"></select>
                    </div> -->



                    

                    <!--<div class="form-group row">


                       <div class="col-md-6">
                       <div class="form-group" >
                       <label class="label">Monto disponible</label>
                       <input class="form-control" type="text" id="idmontodisponible" readonly name="idmontodisponible" value=""></div>
                        <div id="montodisponible">

                        </div>   
                    </div>


                       <div class="col-md-6">
                       <div class="form-group">
                       <label class="label">Monto a descontar</label>
                        <input class="form-control" type="number" step="any" id="monto1" onblur="verificar();" name="monto">
                        </div>
                        </div>
 

                    </div>

                    <div class="form-group">

                        <label class="label">Mótivo de descuento</label>
                        <textarea id="comentario" name="comentario" class="form-control" rows="3" required></textarea>
                        
                    </div>

                    <div class="form-group">

                  <center>
                  <button type="submit" id="btn_abonar" class="btn btn-success">GUARDAR</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal" >CANCELAR</button>

                  </center>
                    </div>

                    </div>
                </form>
            </div>
        </div>
    </div>-->

    <!--<div class="modal fade modal-alertas" id="modal_descuentos" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>-->
            <!-- <form method="post" id="form_descuentos">
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </form> -->
        <!--</div>
    </div>
</div>-->

   
<!--<div class="modal fade modal-alertas" id="modal_abono" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-red">-->
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <!--<center><img src="<?=base_url()?>static/images/preview.gif" width="250" height="200"></center>

                

            </div>
            <form method="post" id="form_abono">
                <div class="modal-body"></div>
                <div class="modal-footer">

                </div>
            </form>
            
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



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                 <div class="card-content">
                                    <div class="material-datatables">
                                    <div class="tab-pane active" id="factura-1">
                                        <div class="content">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <h4 class="card-title" ><b>DESCUENTOS DE RESGUARDOS</b></h4>
                                                                    <!-- <p class="category">Comisiones solictadas por colaboradores para proceder a pago sin factura.</b></p> -->
                                                                    <p class="category"><i class="material-icons">info</i> Descuentos aplicados a directivos, todas las comisiones que aparecen en el listado de lotes para poder descontar son solicitudes en estatus 'Enviada a resguardo personal'.</p>

                                                                </div>

                                                            </div>
                                                            
                                                             <div class="col xol-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                            <label style="color: #0a548b;">&nbsp;Total resguardo: $<input style="border-bottom: none; border-top: none; border-right: none;  border-left: none; background: white; color: #0a548b; font-weight: bold;" disabled="disabled" readonly="readonly" type="text" name="totalpv" id="totalp"></label>
                                                            <label style="color: #0a548b;">&nbsp;Ingresos extras: $<input style="border-bottom: none; border-top: none; border-right: none;  border-left: none; background: white; color: #0a548b; font-weight: bold;" disabled="disabled" readonly="readonly" type="text" name="totalx" id="totalx"></label>
                                                            <label style="color: #0a548b;">&nbsp;Saldo disponible: $<input style="border-bottom: none; border-top: none; border-right: none;  border-left: none; background: white; color: #0a548b; font-weight: bold;" disabled="disabled" readonly="readonly" type="text" name="totalpv3" id="totalp3"></label>
                                                            <label style="color: #0a548b;">&nbsp;Descuentos aplicados: $<input style="border-bottom: none; border-top: none; border-right: none;  border-left: none; background: white; color: #EE5808; font-weight: bold;" disabled="disabled" readonly="readonly" type="text" name="totalpv2" id="totalp2"></label>

                                                        </div>
                                                            <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="col col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="proyecto">Directivo:</label>
                                                                            <select name="filtro33" id="filtro33" class="selectpicker" data-style="btn " data-show-subtext="true" data-live-search="true"  title="Selecciona un usuario" data-size="7" required> <option value="0">Seleccione todo</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                           

                                                            <div class="card-content">
                                                                <div class="col xol-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="material-datatables">
                                                                    <div class="form-group">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-responsive table-bordered table-striped table-hover" id="tabla_descuentos" name="tabla_descuentos" style="font-size:12px;">
                                                                                 <thead style="height: 15px;">
                                                                                 <tr style="background: #003D82;">
                                                                                        <th style="font-size: .9em;">ID</th>
                                                                                        <th style="font-size: .9em;">USUARIO</th>
                                                                                            <th style="font-size: .9em;">$ DESCUENTO</th>
                                                                                            <th style="font-size: .9em;">MOTIVO</th>
                                                                                            <th style="font-size: .9em;">ESTATUS</th>
                                                                                            <th style="font-size: .9em;">CREADO POR</th>
                                                                                            <th style="font-size: .9em;">FECHA CAPTURA</th>
                                                                                            <th style="font-size: .9em;">OPCIONES</th>
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
                            </div>
                        </div>
                    </div>
                </div>


<?php $this->load->view('template/footer_legend');?>
</div>
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
<!--<link href="<?=base_url()?>dist/js/controllers/select2/select2.min.css" rel="stylesheet" />
<script src="<?=base_url()?>dist/js/controllers/select2/select2.min.js"></script>-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    var url = "<?=base_url()?>";
    var url2 = "<?=base_url()?>index.php/";
    var totaPen = 0;
    var tr;
    

    function formatMoney( n ) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };




    $(document).ready(function() {

    $.post("<?=base_url()?>index.php/Comisiones/getDirectivos2", function (data) {
            var len = data.length;
            for (var i = 0; i < len; i++) {
                var id = data[i]['id_usuario'];
                var name = data[i]['nombre'];
                $("#filtro33").append($('<option>').val(id).text(name.toUpperCase()));
            }
            $("#filtro33").selectpicker('refresh');
        }, 'json');

    });



    $('#filtro33').change(function(ruta){
        directivo = $('#filtro33').val();
        //alert(directivo);
        DescuentosxDirectivos(directivo);
    });



    /*$("#form_descuentos").on('submit', function(e){
        e.preventDefault();
        let userid =  $('#usuarioid').val();
     
    let formData = new FormData(document.getElementById("form_descuentos"));
formData.append("dato", "valor");
    $.ajax({
        url: 'saveRetiro',
        data: formData,
        method: 'POST',
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
            console.log(data);
            if (data == 1) {
                document.getElementById("form_descuentos").reset();
               // $('#tabla_descuentos').DataTable().ajax.reload(null, false);
                $('#miModal').modal('hide');
                
                DescuentosxDirectivos(userid);
         
               // $(".directorSelect2").val('');
                $("#roles").val('');
                $("#roles").selectpicker("refresh");
                $('#usuarioid').val('default');
                $("#usuarioid").selectpicker("refresh");
                $('#filtro33').val('default');
                $("#filtro33").selectpicker("refresh");

                alerts.showNotification("top", "right", "Descuento registrado con exito.", "success");              
               
            } else if(data == 2) {
               // $('#tabla_descuentos').DataTable().ajax.reload(null, false);
                $('#miModal').modal('hide');
                alerts.showNotification("top", "right", "Ocurrio un error.", "warning");
               // $(".directorSelect2").empty();
              
            }else if(data == 3){
               // $('#tabla_descuentos').DataTable().ajax.reload(null, false);
                $('#miModal').modal('hide');
                alerts.showNotification("top", "right", "El usuario seleccionado ya tiene un pago activo.", "warning");
                //$(".directorSelect2").empty();
           
            }
        },
        error: function(){
            $('#miModal').modal('hide');
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});*/




let titulos = [];
$('#tabla_descuentos thead tr:eq(0) th').each( function (i) {
 if(i!=8){
  var title = $(this).text();
  titulos.push(title);

  //titulos.push(title);

  $(this).html('<input type="text" style="width:100%; background: #003D82; color: white; border: 0; font-weight: 500"  placeholder="'+title+'"/>' );
  $( 'input', this ).on('keyup change', function () {
      if (tabla_nuevas.column(i).search() !== this.value ) {
        tabla_nuevas
          .column(i)
          .search(this.value)
          .draw();

          var total = 0;
          var index = tabla_nuevas.rows({ selected: true, search: 'applied' }).indexes();
          var data = tabla_nuevas.rows( index ).data();

          $.each(data, function(i, v){
            //  total += parseFloat(v.monto);
          });
          let to1=0;
          // to1 = formatMoney(total);
          //document.getElementById("totalp").value = total;
         // console.log('fsdf'+total);
      }
  } );
}
});
 

 function DescuentosxDirectivos(user) {
        // document.getElementById('totalp').value ='';
        // document.getElementById('totalp2').value ='';
        // document.getElementById('totalp3').value ='';

        let resto = 0;
        let total67 = 0;
        $.post('getDisponbleResguardo/' + user, function(data) {

            document.getElementById('totalp3').value = '';
            // console.log(data);
            let disponible = formatMoney(data.toFixed(3));
            document.getElementById('totalp3').value = disponible;
            //$('#idmontodisponible').val(disponible);
            resto = 0;
            resto = data.toFixed(3);
        }, 'json');

        $.post('getDisponbleResguardoP/' + user, function(data) {

            document.getElementById('totalp').value = '';
            console.log('data' + data);
            let disponible = formatMoney(data);
            console.log('disponible' + disponible);
            document.getElementById('totalp').value = disponible;
            total67 = data;
            // document.getElementById('totalp').innerHTML = disponible;
            //$('#idmontodisponible').val(disponible);
            //  resto=0;
            //  resto = data.toFixed(3);
        }, 'json');


        $('#tabla_descuentos').on('xhr.dt', function(e, settings, json, xhr) {





            // e.preventDefault();
            //e.stopImmediatePropagation(); 
            //document.getElementById('totalp').value ='';
            document.getElementById('totalp2').value = '';


            var total = 0;
            let sumaExtras=0;
            $.each(json.data, function(i, v) {
                if (v.estatus != 3 && v.estatus != 67) {
                    total += parseFloat(v.monto);
                }
                if(v.estatus == 67){
                    sumaExtras=sumaExtras +parseFloat(v.monto);
                }
            });
            let to = 0;
            to = formatMoney(total);
            document.getElementById("totalp2").value = to;

            let extra = 0;
            extra = formatMoney(sumaExtras);
            document.getElementById("totalx").value = extra;
            
            let to2 = 0;
            to2 = parseFloat(resto) + parseFloat(total);
            console.log(resto);
            console.log(total);
            //document.getElementById("totalp").value = formatMoney(to2);
        });

        tabla_nuevas = $("#tabla_descuentos").DataTable({
            dom: 'Brtip',
    width: 'auto',
    "buttons": [

{
    extend:    'excelHtml5',
    text:      'Excel',
    titleAttr: 'Excel',
    title: 'RETIROS',
    exportOptions: {
  
  columns: [0,1,2,3,4,5,6],
  format: {
     header:  function (d, columnIdx) {
         if(columnIdx == 0){
             return ' ID ';
            
            }else if(columnIdx == 1){
                return 'USUARIO';
            }else if(columnIdx == 2){
                return 'MONTO DESCUENTO';
            }else if(columnIdx == 3){
                return 'MOTIVO';
            }else if(columnIdx == 4){
                return 'ESTATUS';
            }else if(columnIdx == 5){
                return 'CREADO POR';
            }else if(columnIdx == 6){
                return 'FECHA CAPTURA';
            }
            else if(columnIdx != 7 && columnIdx !=0){
            //     if(columnIdx == 11){
            //         return 'nose2'
            //     }
            //     else{
                    return ' '+titulos[columnIdx-1] +' ';
            //     }
            }
        }
    }
},

     attr: {
             class: 'btn btn-success',
          }
 },


 ],
            width: 'auto',
            "ordering": false,
           
            "pageLength": 10,
            "bAutoWidth": false,
            "fixedColumns": true,
            "language":{ "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
            "destroy": true,
            "columns": [

                {
                    "width": "5%",
                    "data": function(d) {
                        return '<p style="font-size: .8em"><center>' + d.id_rc + '</center></p>';
                    }
                },
                {
                    "width": "13%",
                    "data": function(d) {
                        return '<p style="font-size: .8em"><center><b>' + d.usuario + '</b></center></p>';
                    }
                },

                {
                    "width": "10%",
                    "data": function(d) {
                        return '<p style="font-size: .8em"><center>$' + formatMoney(d.monto) + '</center></p>';
                    }
                },

                {
                    "width": "13%",
                    "data": function(d) {
                        return '<p style="font-size: .8em"><center>' + d.conceptos + '</center></p>';
                    }
                },
                {
                    "width": "10%",
                    "data": function(d) {
                        if (d.estatus == 1) {
                            return '<center><span class="label label-warning">ACTIVO</span><center>';
                        } else if (d.estatus == 3) {
                            return '<center><span class="label label-danger">CANCELADO</span><center>';
                        } else if (d.estatus == 2) {
                            return '<center><span class="label label-success">APROBADO</span><center>';
                        } else if (d.estatus == 4) {
                            return '<center><span class="label label-danger">RECHAZADO DIRECTIVO</span><center>';
                        }else if (d.estatus == 67) {
                            return '<center><span class="label label-info">INGRESO EXTRA</span><center>';
                        }

                    }
                },
                {
                    "width": "10%",
                    "data": function(d) {
                        return '<p style="font-size: .7em"><center>' + d.creado_por + '</center></p>';
                    }
                },
                {
                    "width": "10%",
                    "data": function(d) {
                        let fecha = d.fecha_creacion.substring(0, d.fecha_creacion.length - 4);
                        return '<p style="font-size: .8em"><center>' + fecha + '</center></p>';
                    }
                },
                {
                    "width": "8%",
                    "orderable": false,
                    "data": function( d ){

                        if(d.estatus == 1){
                            return `<button class="btn btn-danger btn-round btn-fab btn-fab-mini btn-delete" value="'+d.id_rc+','+d.monto+','+d.usuario+'"  style="margin-right: 3px;background-color:#F7411D;border-color:#F7411D"><i class="material-icons" data-toggle="tooltip" data-placement="right" title="RECHAZAR RETIRO">delete</i></button>
                            <button class="btn btn-success btn-round btn-fab btn-fab-mini btn-aut" value="${d.id_rc},${d.monto},${d.usuario}"  style="margin-right: 3px;background-color:#20A117;border-color:#20A117"><i class="material-icons" data-toggle="tooltip" data-placement="right" title="APROBAR RETIRO">check</i></button>`;

                            // <button class="btn btn-success btn-round btn-fab btn-fab-mini btn-aut" value="${d.id_rc},${d.monto},${d.usuario}"  style="margin-right: 3px;background-color:#20A117;border-color:#20A117"><i class="material-icons" data-toggle="tooltip" data-placement="right" title="APROBAR RETIRO">check</i></button>

                        }else if(d.estatus == 3 || d.estatus == 4 || d.estatus == 2){
                            return `<button class="btn btn-success btn-round btn-fab btn-fab-mini btn-log" value="${d.id_rc}"  style="margin-right: 3px;background-color:#9FB5B9;border-color:#9FB5B9"><i class="material-icons" data-toggle="tooltip" data-placement="right" title="LOG">info</i></button>`; 
                        } else{
                            return ``;
                        }

                        // if(d.estatus==0){
 
                    }
                }],
                columnDefs: [
          {

  orderable: false,
  className: 'select-checkbox',
  targets:   0,
  'searchable':false,
  'className': 'dt-body-center'
  }],

            "ajax": {
                "url": url2 + "Comisiones/getRetiros/"+user+'/'+1,
                /*registroCliente/getregistrosClientes*/
                "type": "POST",
                cache: false,
                "data": function( d ){

                }
            },
        });

 
/**------------------------------------------- */
        /*$("#tabla_descuentos tbody").on("click", ".abonar", function(){
            bono = $(this).val();
            var dat = bono.split(",");
            //$("#modal_abono").html("");
            $("#modal_abono .modal-body").append(`<div id="inputhidden">
            <h6>¿Seguro que desea descontar a <b>${dat[3]}</b> la cantidad de <b style="color:red;">$${formatMoney(dat[1])}</b> correspondiente a la comisión de <b>${dat[2]}</b> ?</h6>
            <input type='hidden' name="id_bono" id="id_bono" value="${dat[0]}"><input type='hidden' name="pago" id="pago" value="${dat[1]}"><input type='hidden' name="id_usuario" id="id_usuario" value="${dat[2]}">
           
           <div class="col-md-3"></div>
           <div class="col-md-3">
            <button type="submit" id="" class="btn btn-primary ">GUARDAR</button>
            </div>
            <div class="col-md-3">
            <button type="button" onclick="closeModalEng()" class=" btn btn-danger" data-dismiss="modal">CANCELAR</button>
            </div>
            <div class="col-md-3"></div>

            </div>`);
            $("#modal_abono .modal-body").append(``);
            $('#modal_abono').modal('show');
            //save(bono);
        });*/



        // $("#tabla_descuentos tbody").on("click", ".btn-delete", function(){    
        //     id = $(this).val();
        //     $("#modal-delete .modal-body").append(`<div id="borrarBono"><form id="form-delete">
        //     <h5>¿Estas seguro que deseas eliminar este bono?</h5>
        //     <br>
        //     <input type="hidden" id="id_descuento" name="id_descuento" value="${id}">
        //     <input type="submit" class="btn btn-success" value="Aceptar">
        //     <button class="btn btn-danger" onclick="CloseModalDelete2();">Cerrar</button>
        //     </form></div>`);

        //     $('#modal-delete').modal('show');
        // });


         $("#tabla_descuentos tbody").on("click", ".btn-aut", function(){
    var tr = $(this).closest('tr');
    var row = tabla_nuevas.row( tr );

    id_pago_i = $(this).val();

    $("#modal_nuevas .modal-body").html("");
    $("#modal_nuevas .modal-header").html("");
    $("#modal_nuevas .modal-header").append(`<h3>Autorizar</h3>`);
    $("#modal_nuevas .modal-body").append('<div class="row"><div class="col-lg-12"><p><h5>¿Seguro que desea autorizar a <b>'+row.data().usuario+'</b> la cantidad de <b style="color:red;">$'+formatMoney(row.data().monto)+'</b>?</h5><input type="hidden" name="id_descuento" id="id_descuento" value="'+row.data().id_rc+'"><input type="hidden" name="opcion" id="opcion" value="Autorizar"><br><div><input type="submit"  class="btn btn-success" value="Aceptar"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></p></div></div>');
    $("#modal_nuevas").modal();
});

$("#tabla_descuentos tbody").on("click", ".btn-delete", function(){
    var tr = $(this).closest('tr');
    var row = tabla_nuevas.row( tr );

    id_pago_i = $(this).val();

    $("#modal_nuevas .modal-body").html("");
    $("#modal_nuevas .modal-header").html("");
    // $("#modal_nuevas .modal-header").append(`<h3>Eliminar</h3>`);
    $("#modal_nuevas .modal-body").append('<div class="row"><div class="col-lg-12"><p><h5>¿Está seguro que desea borrar el pago de <b>'+row.data().usuario+'</b> por la cantidad de <b style="color:red;">$'+formatMoney(row.data().monto)+'</b>?</h5><input type="hidden" name="id_descuento" id="id_descuento" value="'+row.data().id_rc+'"> <input type="hidden" id="userid" name="userid" value="'+user+'"><input type="hidden" name="opcion" id="opcion" value="Rechazar"><br><div class="form-group"><label>Motivo de eliminación</label><textarea class="form-control" id="motivodelete" name="motivodelete"></textarea></div><br><div class="text-right"><input type="submit" class="btn btn-success" value="Aceptar"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div></p></div></div>');
    $("#modal_nuevas").modal();
});

$("#tabla_descuentos tbody").on("click", ".btn-log", function(e){
    e.preventDefault();
        e.stopImmediatePropagation();
   // var tr = $(this).closest('tr');
   // var row = tabla_nuevas.row( tr );

    id_rc = $(this).val();
    document.getElementsByClassName('modal_body').innerHTML = '';
    $("#modal_log .modal-body").append("");
    $("#modal_log .modal-body").html("");
    $("#modal_log .modal-body").html("");
    $("#modal_log .modal-body").append(`<h3><b>Historial</b></h3><br>`);
    $("#modal_log .modal-body .timeline").html("");
    $.post("<?=base_url()?>index.php/Comisiones/getHistoriRetiros/"+id_rc, function (data) {
            var len = data.length;
            console.log(data);
            let c=0;
            $("#modal_log .modal-body").append(`
    <div class="row mt-5 mb-5">
        <div class="col-md-12 offset-md-3">
            <ul class="timeline">`);
            for (var i = 0; i < len; i++) {
                if(c > 1){
                    break;
                }
                let fecha = data[i].fecha_creacion.substring(0, data[i].fecha_creacion.length - 4);
                $("#modal_log .modal-body .timeline").append(`
                <li>
                    <em><b>Fecha creación: </b>${fecha}</em><br>
                    <em><b>Autor:</b> ${data[i].usuario} </em>
                    <p><b>Movimiento: </b>${data[i].comentario}</p>
                </li>`);
                if(i == len){
                    c=c+1;
                }
                
            }
            $("#modal_log .modal-body").append(`</ul>
        </div>
    </div><div class="text-right">
    <button type="button" class="btn btn-danger" onclick="cerrar();" data-dismiss="modal">Cerrar</button></div></p></div></div>
    `);
         
        }, 'json');

    
    $("#modal_log").modal();
});


$("#tabla_descuentos tbody").on("click", ".btn-update", function(){
    //alert (resto);
    //alert (total);

    

    var tr = $(this).closest('tr');
    var row = tabla_nuevas.row( tr );

    id_pago_i = $(this).val();

    $("#modal_nuevas .modal-body").html("");
    $("#modal_nuevas .modal-header").html("");
    $("#modal_nuevas .modal-header").append(`<h3><b>Actualizar Información</b></h3>`);
    $("#modal_nuevas .modal-body").append(`<div class="row"><div class="col-lg-12">
    <div class="form-group">
    <label>Monto</label>
    <input type="number" class="form-control" onblur="verificar2(${resto},${row.data().monto})" name="monto" id="monto" value="${row.data().monto}">
   <input type="hidden" id="userid" name="userid" value="${user}">
    </div>
    <div class="form-group">
    <label>Motivo</label>
    <textarea class="form-control" id="conceptos" name="conceptos">${row.data().conceptos}</textarea>
    </div>
     <input type="hidden" name="id_descuento" id="id_descuento" value="${row.data().id_rc}"><input type="hidden" name="opcion" id="opcion" value="Actualizar"><br><div class="text-right"><input type="submit"  class="btn btn-success" id="btnsub" value="Aceptar"><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></div></p></div></div>`);
    $("#modal_nuevas").modal();
});





        //  $("#tabla_descuentos tbody").on("click", ".btn-update", function(){    
        //     id = $(this).val();

        //      bono = $(this).val();
        //     var dat = bono.split(",");

        //      $("#modal_abono .modal-body").append(`<div id="borrarUpdare"><form id="form-update">
        //     <h6>¿Seguro que desea descontar a <b>${dat[3]}</b> la cantidad de <b style="color:red;">$${formatMoney(dat[1])}</b> correspondiente a la comisión de <b>${dat[2]}</b> ?</h6><input type='hidden' name="id_descuento" id="id_descuento" value="${dat[0]}">
        //     <br>
        //      <input type="submit" class="btn btn-success" value="Aceptar">
        //     <button class="btn btn-danger" onclick="CloseModalUpdate2();">Cerrar</button>
        //     </form></div>`);
 
        //     $('#modal_abono').modal('show');
        // });

 





}
function verificar2(resto,monto){
    let montoingresado = $('#monto').val();
    console.log(montoingresado);
    let resta = parseFloat(montoingresado) - parseFloat(monto);
console.log(resta);
    if(parseFloat(resto) > resta){
        document.getElementById('btnsub').disabled = false;
    }else{
        alerts.showNotification("top", "right", "Monto excedido.", "warning");
        document.getElementById('btnsub').disabled = true;

    } 
}
/**-------------------------------------------------------------------------------------------------------------------------------------------------------- */



    /*function closeModalEng(){
       // document.getElementById("inputhidden").innerHTML = "";
        document.getElementById("form_abono").reset();
        a = document.getElementById('inputhidden');
        padre = a.parentNode;
        padre.removeChild(a);
     
    $("#modal_abono").modal('toggle');
    
}*/

/*function Cerrar(){
       // document.getElementById("inputhidden").innerHTML = "";
        a = document.getElementById('bod');
        padre = a.parentNode;
        padre.removeChild(a);
     
    $("#modal_log").modal('toggle');
    
}*/

/*function CloseModalDelete(){
       // document.getElementById("inputhidden").innerHTML = "";
        a = document.getElementById('borrarBono');
        padre = a.parentNode;
        padre.removeChild(a);
     
    $("#modal-delete").modal('toggle');
    
}*/
/*function CloseModalDelete2(){
       // document.getElementById("inputhidden").innerHTML = "";
        document.getElementById("form-delete").reset();
        a = document.getElementById('borrarBono');
        padre = a.parentNode;
        padre.removeChild(a);
     
    $("#modal-delete").modal('toggle');
    
}*/

/*function CloseModalUpdate2(){
       // document.getElementById("inputhidden").innerHTML = "";
        document.getElementById("form-update").reset();
        a = document.getElementById('borrarUpdare');
        padre = a.parentNode;
        padre.removeChild(a);
     
    $("#modal-abono").modal('toggle');
    
}*/
/*$(document).on('submit','#form-delete', function(e){
  e.preventDefault();
var formData = new FormData(document.getElementById("form-delete"));
formData.append("dato", "valor");
    $.ajax({
        method: 'POST',
        url: url+'Comisiones/BorrarDescuento',
        data: formData,
        processData: false,
contentType: false,
        success: function(data) {
            console.log(data);
            if (data == 1) {
                $('#tabla_descuentos').DataTable().ajax.reload(null, false);
                CloseModalDelete2();
               // $('#modal_abono').modal('hide');
                alerts.showNotification("top", "right", "Abono borrado con exito.", "success");
                document.getElementById("form_abono").reset();
                $('#filtro33').val('default');
                $("#filtro33").selectpicker("refresh");
               
            } else if(data == 0) {
                $('#tabla_descuentos').DataTable().ajax.reload(null, false);
                CloseModalDelete2();
                //$('#modal-delete').modal('hide');
                alerts.showNotification("top", "right", "Pago liquidado.", "warning");
            }
        },
        error: function(){
            closeModalEng();
            $('#modal_abono').modal('hide');
            alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
        }
    });
});*/





$("#form_aplicar").submit( function(e) {
    e.preventDefault();
}).validate({
    submitHandler: function( form ) {
        let iduser = $('#userid').val();


        var data = new FormData( $(form)[0] );
        console.log('idUser:  '+iduser);
      //  data.append("id_pago_i", id_pago_i);
        $.ajax({
            // url: url + "Comisiones/pausar_solicitud/",
            url: url+'Comisiones/UpdateRetiro',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data){
                    if( data = 1 ){
                        $("#modal_nuevas").modal('toggle' );
                        alerts.showNotification("top", "right", "Se aplicó el descuento correctamente", "success");
                        setTimeout(function() {
                            tabla_nuevas.ajax.reload();
                            DescuentosxDirectivos(iduser);
                            $('#filtro33').val('default');
                $("#filtro33").selectpicker("refresh");
                            // tabla_otras2.ajax.reload();
                        }, 100);
                    }else{
                        alerts.showNotification("top", "right", "No se ha procesado tu solicitud", "danger");

                    }
                },error: function( ){
                    alert("ERROR EN EL SISTEMA");
                }
            });
    }
});




// $(document).on('submit','#form-update', function(e){ 
//   e.preventDefault();
// var formData = new FormData(document.getElementById("form-update"));
// formData.append("dato", "valor");
//     $.ajax({
//         method: 'POST',
//         url: url+'Comisiones/UpdateDescuento',
//         data: formData,
//         processData: false,
// contentType: false,
//         success: function(data) {
//             console.log(data);
//             if (data == 1) {
//                 $('#tabla_descuentos').DataTable().ajax.reload(null, false);
//                 CloseModalDelete2();
//                // $('#modal_abono').modal('hide');
//                 alerts.showNotification("top", "right", "Abono registrado con exito.", "success");
//              document.getElementById("form_abono").reset();
               
//             } else if(data == 0) {
//                 $('#tabla_descuentos').DataTable().ajax.reload(null, false);
//                 CloseModalDelete2();
//                 //$('#modal-delete').modal('hide');
//                 alerts.showNotification("top", "right", "Pago liquidado.", "warning");
//             }
//         },
//         error: function(){
//             closeModalEng();
//             $('#modal_abono').modal('hide');
//             alerts.showNotification("top", "right", "Oops, algo salió mal.", "danger");
//         }
//     });
// });


 
    // FIN TABLA PAGADAS



    /*function mandar_espera(idLote, nombre) {
        idLoteespera = idLote;
        // link_post2 = "Cuentasxp/datos_para_rechazo1/";
        link_espera1 = "Comisiones/generar comisiones/";
        $("#myModalEspera .modal-footer").html("");
        $("#myModalEspera .modal-body").html("");
        $("#myModalEspera ").modal();
        // $("#myModalEspera .modal-body").append("<div class='btn-group'>LOTE: "+nombre+"</div>");
        $("#myModalEspera .modal-footer").append("<div class='btn-group'><button type='submit' class='btn btn-success'>GENERAR COMISIÓN</button></div>");
    }*/






    // FUNCTION MORE

    // $(window).resize(function(){
    //  tabla_nuevas.columns.adjust();
    //  tabla_proceso.columns.adjust();
    //  tabla_pagadas.columns.adjust();
    //  tabla_otras.columns.adjust();
    // });




    /*$("#roles").change(function() {
        var parent = $(this).val();
         document.getElementById('monto1').value = ''; 
        document.getElementById('idmontodisponible').value = ''; 


         $('#usuarioid option').remove();
 
        $.post('getUsuariosRol/'+parent, function(data) {
                        $("#usuarioid").append($('<option>').val("0").text("Seleccione una opción"));
                        var len = data.length;
                        for( var i = 0; i<len; i++)
                        {
                            var id = data[i]['id_usuario'];
                            var name = data[i]['name_user'];
                      
                            $("#usuarioid").append($('<option>').val(id).attr('data-value', id).text(name));
                        }
                        if(len<=0)
                        {
                        $("#usuarioid").append('<option selected="selected" disabled>No se han encontrado registros que mostrar</option>');
                        }
                           // $("#usuariosrol").val(v.id_director);
                        $("#usuarioid").selectpicker('refresh');
                    }, 'json'); 
    });*/



    /*$("#usuarioid").change(function() {

        document.getElementById('monto1').value = ''; 
        document.getElementById('idmontodisponible').value = 'Cargando....'; 
        
         var user = $(this).val();
         
        
         $.post('getDisponbleResguardo/'+user, function(data) {
                       // console.log(data);
                       let disponible = formatMoney(data.toFixed(3));
                       $('#idmontodisponible').val(disponible);
                    }, 'json'); 



                    
    });*/


 


    /*$("#numeroP").change(function(){
       
        let monto = parseFloat($('#monto1').val());
        let cantidad = parseFloat($('#numeroP').val());
        let resultado=0;

        if (isNaN(monto)) {
            alerts.showNotification("top", "right", "Debe ingresar un monto valido.", "warning");
            $('#pago').val(resultado);
            document.getElementById('btn_abonar').disabled=true;
        }else{
            //console.log(monto);
            resultado = monto /cantidad;
 
            if(resultado > 0){
                document.getElementById('btn_abonar').disabled=false;
            $('#pago').val(formatMoney(resultado));
            }else{
                document.getElementById('btn_abonar').disabled=true;
            $('#pago').val(formatMoney(0));
            }
        }
    });*/
    function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}
/*function verificar(){
    let valorDispo = $('#idmontodisponible').val();
    let disponible = replaceAll(valorDispo,',','');
    let monto_ingresado = replaceAll($('#monto1').val(),',','');
    let monto = parseFloat(monto_ingresado).toFixed(2);
console.log('disponible: '+disponible);
console.log('monto: '+monto);
    // alert(monto);
    // alert(disponible);
    if(monto < 1 || isNaN(monto)){
        alerts.showNotification("top", "right", "Debe ingresar un monto mayor a 0.", "warning");
        document.getElementById('btn_abonar').disabled=true; 
    }else{

        if(parseFloat(disponible) < parseFloat(monto)){
            alerts.showNotification("top", "right", "El monto ingresado es mayor a lo disponible.", "warning");
            document.getElementById('btn_abonar').disabled=true;
        }else{
            document.getElementById('btn_abonar').disabled=false;
            //alert('simon');
        }
}
        
}*/




</script>
   

