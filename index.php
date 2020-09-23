<?php

// include the configs / constants for the database connection
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>PROYECTO</title>
	<!-- Latest compiled and minified CSS -->

  <!-- CSS  -->
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            
			
                <span id="reauth-email" class="reauth-email" style="
    font-size: 25px;
    text-transform: capitalize;
">Menu:</span>
                <select class="form-control" id="menu" style="width: 350px;height: 33px;" required>
                  <option value=" ">Seleccione...</option>
                  <option value="agregar">Agregar empleado</option>
                  <option value="eliminar">Eliminar empleado</option>
                   <option value="actualizar">Actualizar empleado</option>
                  <option value="empleados">Empleados</option>
                  <option value="salir">Salir</option>
                </select> 
               
               <div class="agregar" style="display: none;">
                <br>
                <form id="guardar_cliente" name="guardar_cliente">
                  <h1 align="center">Agregar empleado</h1>
                  <div id="resultados_ajax"></div>
                  <table>
                    <tr>
                      <td><span>ID</span></td>
                      <td><input type="text" name="id" required></td>
                    </tr>
                    <tr>
                      <td><span>NOMBRE</span></td>
                      <td><input type="text" name="nombre" required></td>
                    </tr>
                    <tr>
                      <td><span>APELLIDOS</span></td>
                      <td><input type="text" name="apellidos" required></td>
                    </tr>
                    <tr>
                      <td><span>SALARIO</span></td>
                      <td><input type="text" name="salario" required></td>
                    </tr>
                  </table>
               
                <button type="submit" name="login" id="guardar_datos">Agregar empleado</button>
            </form><!-- /form -->
            </div>

            <div class="eliminar" style="display: none;">
                <br>
                <form id="" name="">
                  <h1 align="center">Eliminar cliente</h1>
                  <div id="resultados"></div>
                  <table>
                    <tr>
                      <td><span>ID</span></td>
                      <td><input type="text" name="id_delete" id="id_delete" required></td>
                    </tr>
                  </table>
               
                <button type="button" onclick="eliminar();"  id="eliminar_empleado">Eliminar empleado</button>
            </form><!-- /form -->
            </div>

            <div class="actualizar" style="display: none;">
                <br>
                <form>
                  <h1 align="center">Actualizar empleado</h1>
                  
                  <table>
                    <tr>
                      <td><span>ID</span></td>
                      <td><input type="text" id="id_update" name="id_update"></td>
                    </tr>
                  </table>
                <button type="button" onclick="actualizar();"  id="actualizar_id">Buscar empleado</button>
                <br>
                <div id="resultados_update"></div>
            </form><!-- /form -->
            </div>

            <div class="empleados" style="display: none;">
                <br>
                  <h1 align="center">Empleados</h1>
                  <div id="loader"></div>
                  <div class="outer_div"></div>
<!-- /form -->
            </div>

             <div class="salir" style="display: none;">
                <br>
                <h2 style="color: #000;">El programa ha sido cerrado</h2>
            </div>
        </div><!-- /card-container -->
    </div><!-- /container -->
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript">

              $(document).ready(function(){
                load(1);
                $('#menu').change(function(){
                 var menu=$('#menu').val();
                 if(menu=='agregar'){
                  $('.eliminar').fadeOut();
                  $('.actualizar').fadeOut();
                  $('.salir').fadeOut();
                  $('.agregar').fadeIn();
                  $('.empleados').fadeOut();

                 }
                 if(menu=='eliminar'){
                  $('.agregar').fadeOut();
                  $('.actualizar').fadeOut();
                  $('.salir').fadeOut();
                  $('.eliminar').fadeIn();
                  $('.empleados').fadeOut();

                 }

                 if(menu=='actualizar'){
                  $('.agregar').fadeOut();
                  $('.eliminar').fadeOut();
                  $('.salir').fadeOut();
                  $('.actualizar').fadeIn();
                  $('.empleados').fadeOut();

                 }

                 if(menu=='salir'){
                  $('.agregar').fadeOut();
                  $('.eliminar').fadeOut();
                  $('.actualizar').fadeOut();
                  $('.salir').fadeIn();
                  $('.empleados').fadeOut();

                 }

                 if(menu==' '){
                  $('.agregar').fadeOut();
                  $('.eliminar').fadeOut();
                  $('.actualizar').fadeOut();
                  $('.salir').fadeOut();
                  $('.empleados').fadeOut();

                 }

                 if(menu=='empleados'){
                  $('.agregar').fadeOut();
                  $('.eliminar').fadeOut();
                  $('.actualizar').fadeOut();
                  $('.empleados').fadeIn();


                 }
                })
              })
              $( "#guardar_cliente" ).submit(function( event ) {

                


  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/nuevo_empleado.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_ajax").html(datos);
      $('#guardar_datos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

              function load(page){
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_empleados.php',
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_div").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }

      
      function eliminar ()
    {
      var id=$('#id_delete').val();
    $.ajax({
        type: "GET",
        url: "./ajax/eliminar.php",
        data: "id="+id,
     beforeSend: function(objeto){
      $("#resultados").html("Mensaje: Cargando...");
      },
        success: function(datos){
    $("#resultados").html(datos);
    load(1);
    }
      });
    }

     function actualizar ()
    {
      var id=$('#id_update').val();
    $.ajax({
        type: "GET",
        url: "./ajax/update.php",
        data: "id="+id,
     beforeSend: function(objeto){
      $("#resultados_update").html("Mensaje: Cargando...");
      },
        success: function(datos){
    $("#resultados_update").html(datos);
    load(1);
    }
      });
    }
    
</script>
  </body>
</html>



